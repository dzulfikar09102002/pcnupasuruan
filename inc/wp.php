<?php
/* ============================================================
   HELPER WORDPRESS REST API (sisi server)
   Dipakai halaman baca (news/baca.php, articles/baca.php) dan
   api/komentar.php. Semua respons di-cache sebentar di folder
   temp supaya halaman tidak lambat.
   ============================================================ */

define('WP_SITE', 'https://pcnupasuruankota.id');
define('WP_API_ROOT', WP_SITE . '/wp-json/');
define('WP_CACHE_DIR', sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'pcnu-wp-cache');
define('WP_CACHE_TTL', 300);

// Semua tanggal ditampilkan dalam WIB (GMT+7), apa pun zona waktu server/WordPress.
date_default_timezone_set('Asia/Jakarta');

function wp_url($path, $query = array())
{
  $url = WP_API_ROOT . ltrim($path, '/');
  if ($query) {
    $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($query);
  }
  return $url;
}

function wp_cache_file($url)
{
  return WP_CACHE_DIR . DIRECTORY_SEPARATOR . md5($url) . '.json';
}

function wp_cache_baca($url, $ttl)
{
  $file = wp_cache_file($url);
  if ($ttl <= 0 || !is_file($file) || (time() - filemtime($file)) > $ttl) return null;
  $isi = json_decode((string) @file_get_contents($file), true);
  return is_array($isi) ? $isi : null;
}

function wp_cache_tulis($url, $hasil)
{
  if (!is_dir(WP_CACHE_DIR)) @mkdir(WP_CACHE_DIR, 0775, true);
  @file_put_contents(wp_cache_file($url), json_encode($hasil));
}

function wp_cache_hapus($url)
{
  $file = wp_cache_file($url);
  if (is_file($file)) @unlink($file);
}

function wp_curl_handle($url)
{
  $ch = curl_init($url);
  curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HEADER => true,
    CURLOPT_CONNECTTIMEOUT => 8,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => array('Accept: application/json'),
    CURLOPT_USERAGENT => 'PCNU-Kopas-Frontend/1.0',
  ));
  return $ch;
}

function wp_curl_hasil($ch, $mentah)
{
  $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $ukuranHeader = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  $headerMentah = substr((string) $mentah, 0, $ukuranHeader);
  $body = substr((string) $mentah, $ukuranHeader);

  $total = null;
  $totalPages = null;
  if (preg_match('/^X-WP-Total:\s*(\d+)/mi', $headerMentah, $m)) $total = (int) $m[1];
  if (preg_match('/^X-WP-TotalPages:\s*(\d+)/mi', $headerMentah, $m)) $totalPages = (int) $m[1];

  return array(
    'ok' => $status >= 200 && $status < 300,
    'status' => $status,
    'data' => json_decode($body, true),
    'total' => $total,
    'totalPages' => $totalPages,
  );
}

/**
 * Ambil satu endpoint. Mengembalikan array: ok, status, data, total, totalPages.
 */
function wp_get($path, $query = array(), $ttl = WP_CACHE_TTL)
{
  $hasil = wp_get_banyak(array('x' => array($path, $query, $ttl)));
  return $hasil['x'];
}

/**
 * Ambil beberapa endpoint sekaligus secara paralel (curl_multi).
 * $daftar = array(kunci => array(path, query[, ttl]))
 */
function wp_get_banyak($daftar)
{
  $hasil = array();
  $antrian = array();

  foreach ($daftar as $kunci => $req) {
    $url = wp_url($req[0], isset($req[1]) ? $req[1] : array());
    $ttl = isset($req[2]) ? $req[2] : WP_CACHE_TTL;
    $cache = wp_cache_baca($url, $ttl);
    if ($cache !== null) {
      $hasil[$kunci] = $cache;
    } else {
      $antrian[$kunci] = $url;
    }
  }

  if (!$antrian) return $hasil;

  $mh = curl_multi_init();
  $handles = array();
  foreach ($antrian as $kunci => $url) {
    $handles[$kunci] = wp_curl_handle($url);
    curl_multi_add_handle($mh, $handles[$kunci]);
  }

  do {
    $status = curl_multi_exec($mh, $aktif);
    if ($aktif) curl_multi_select($mh, 1.0);
  } while ($aktif && $status === CURLM_OK);

  foreach ($handles as $kunci => $ch) {
    $r = wp_curl_hasil($ch, curl_multi_getcontent($ch));
    if ($r['ok']) wp_cache_tulis($antrian[$kunci], $r);
    $hasil[$kunci] = $r;
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
  }
  curl_multi_close($mh);

  return $hasil;
}

/** Query daftar komentar sebuah tulisan — dipakai bersama agar cache-nya bisa dihapus setelah komentar baru masuk. */
function wp_query_komentar($postId)
{
  return array('post' => (int) $postId, 'per_page' => 100, 'order' => 'asc', 'orderby' => 'date');
}

/* ---------------------------------------------------------
   UTILITAS TAMPILAN
   --------------------------------------------------------- */
function esc($teks)
{
  return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

/** Teks polos dari HTML WordPress (judul/excerpt yang berisi entity). */
function teks_polos($html)
{
  $teks = html_entity_decode(strip_tags((string) $html), ENT_QUOTES | ENT_HTML5, 'UTF-8');
  return trim(preg_replace('/\s+/u', ' ', $teks));
}

function potong_teks($teks, $maks)
{
  if (mb_strlen($teks) <= $maks) return $teks;
  $teks = mb_substr($teks, 0, $maks);
  return preg_replace('/\s+\S*$/u', '', $teks) . '…';
}

/**
 * Waktu sebuah objek WP (post/page/komentar) sebagai ISO UTC yang pasti.
 * Field 'date' WP tidak membawa zona waktu (mengikuti setelan situs, saat ini UTC),
 * jadi selalu pakai '<kunci>_gmt' + 'Z' supaya konversi ke WIB benar.
 */
function tanggal_wp($obj, $kunci = 'date')
{
  if (!empty($obj[$kunci . '_gmt'])) return $obj[$kunci . '_gmt'] . 'Z';
  return isset($obj[$kunci]) ? $obj[$kunci] : '';
}

function format_tanggal_id($iso, $denganJam = false)
{
  $ts = strtotime((string) $iso);
  if (!$ts) return '';
  $bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
  $hasil = date('j', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y', $ts);
  if ($denganJam) $hasil .= ', ' . date('H.i', $ts) . ' WIB';
  return $hasil;
}

function waktu_baca($html)
{
  $jumlahKata = count(preg_split('/\s+/u', teks_polos($html), -1, PREG_SPLIT_NO_EMPTY));
  return max(1, (int) ceil($jumlahKata / 200));
}

function gambar_unggulan($item, $ukuran = 'large')
{
  if (!empty($item['_embedded']['wp:featuredmedia'][0])) {
    $media = $item['_embedded']['wp:featuredmedia'][0];
    if (!empty($media['media_details']['sizes'][$ukuran]['source_url'])) {
      return $media['media_details']['sizes'][$ukuran]['source_url'];
    }
    if (!empty($media['source_url'])) return $media['source_url'];
  }
  if (!empty($item['content']['rendered']) && preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $item['content']['rendered'], $m)) {
    return html_entity_decode($m[1]);
  }
  return null;
}

/** Istilah (kategori/tag) dari _embedded wp:term. */
function istilah_item($item, $taksonomi)
{
  $hasil = array();
  if (empty($item['_embedded']['wp:term'])) return $hasil;
  foreach ($item['_embedded']['wp:term'] as $grup) {
    foreach ((array) $grup as $t) {
      if (isset($t['taxonomy']) && $t['taxonomy'] === $taksonomi) $hasil[] = $t;
    }
  }
  return $hasil;
}

/** URL halaman baca lokal untuk sebuah item WP (page → berita, post → artikel). */
function url_baca($item, $baseUrl)
{
  $folder = (isset($item['type']) && $item['type'] === 'page') ? 'news/' : 'articles/';
  return $baseUrl . $folder . 'baca.php?slug=' . rawurlencode($item['slug']);
}

/** URL absolut halaman saat ini (untuk share & meta OG). */
function url_sekarang()
{
  $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
  $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
  $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
  return ($https ? 'https' : 'http') . '://' . $host . $uri;
}

/** Warna badge tag — disamakan dengan warnaTagMap di assets/common.js. */
function warna_tag($nama)
{
  $peta = array(
    'Bahtsul Masail' => array('#e0f2fe', '#0369a1'),
    'Kalam' => array('#fef3c7', '#b45309'),
    'Khotbah' => array('#dcfce7', '#15803d'),
    'Tarbiyah Jinsiyah' => array('#fce7f3', '#be185d'),
    'Hikayat' => array('#fef9c3', '#854d0e'),
    'Opini' => array('#ede9fe', '#6d28d9'),
    'Fikrah' => array('#ffedd5', '#c2410c'),
    'Pesantren' => array('#ccfbf1', '#0f766e'),
    'Sejarah' => array('#fae8ff', '#86198f'),
    'Sosial' => array('#fee2e2', '#b91c1c'),
    'Ekonomi' => array('#e0e7ff', '#3730a3'),
    'Pendidikan' => array('#dbeafe', '#1d4ed8'),
  );
  $nama = teks_polos($nama);
  return isset($peta[$nama]) ? $peta[$nama] : array('#ecfdf5', '#047857');
}

/** Markup kartu — sama persis dengan kartuBeritaHTML() di assets/common.js. */
function kartu_berita_html($item, $baseUrl, $namaTag = '')
{
  $judul = isset($item['title']['rendered']) && $item['title']['rendered'] !== '' ? $item['title']['rendered'] : '(Tanpa judul)';
  $excerpt = potong_teks(teks_polos(isset($item['excerpt']['rendered']) ? $item['excerpt']['rendered'] : ''), 130);
  $gambar = gambar_unggulan($item, 'medium_large');
  $link = url_baca($item, $baseUrl);

  $thumb = $gambar
    ? '<img src="' . esc($gambar) . '" alt="" loading="lazy">'
    : '<div class="ph-fallback"><svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg></div>';

  $badge = '';
  if ($namaTag !== '') {
    $w = warna_tag($namaTag);
    $badge = '<span class="badge-tag" style="background-color:' . $w[0] . ';color:' . $w[1] . ';">' . esc(teks_polos($namaTag)) . '</span>';
  }

  return '<article class="news-card">'
    . '<a class="news-thumb" href="' . esc($link) . '">' . $thumb . '</a>'
    . '<div class="news-body">'
    . $badge
    . '<span class="news-date">' . esc(format_tanggal_id(tanggal_wp($item))) . '</span>'
    . '<h3><a href="' . esc($link) . '">' . $judul . '</a></h3>'
    . '<p>' . esc($excerpt) . '</p>'
    . '<a class="news-link" href="' . esc($link) . '">Baca selengkapnya <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>'
    . '</div>'
    . '</article>';
}

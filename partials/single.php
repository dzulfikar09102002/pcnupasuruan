<?php
/* ============================================================
   TEMPLATE HALAMAN BACA (single)
   Di-include oleh news/baca.php ($jenis = 'berita', WP pages)
   dan articles/baca.php ($jenis = 'artikel', WP posts).
   ============================================================ */
require_once __DIR__ . '/../inc/wp.php';

if (!isset($baseUrl)) $baseUrl = '../';
$adalahBerita = ($jenis === 'berita');
$endpoint = $adalahBerita ? 'wp/v2/pages' : 'wp/v2/posts';
$labelJenis = $adalahBerita ? 'Berita' : 'Artikel';
$folderJenis = $adalahBerita ? 'news/' : 'articles/';
$labelLawan = $adalahBerita ? 'Artikel Pilihan' : 'Berita Terkini';

$slug = isset($_GET['slug']) ? trim((string) $_GET['slug']) : '';
$idParam = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$item = null;
if ($slug !== '') {
  $r = wp_get($endpoint, array('slug' => $slug, '_embed' => 1));
  if ($r['ok'] && !empty($r['data'][0])) $item = $r['data'][0];
} elseif ($idParam > 0) {
  $r = wp_get($endpoint . '/' . $idParam, array('_embed' => 1));
  if ($r['ok'] && !empty($r['data']['id'])) $item = $r['data'];
}

// Slug ternyata milik tipe lain (post ↔ page)? Arahkan ke folder yang benar.
if (!$item && $slug !== '') {
  $lain = wp_get($adalahBerita ? 'wp/v2/posts' : 'wp/v2/pages', array('slug' => $slug, '_fields' => 'id,slug,type'));
  if ($lain['ok'] && !empty($lain['data'][0])) {
    header('Location: ' . url_baca($lain['data'][0], $baseUrl), true, 301);
    exit;
  }
}

/* ---------- Data pendukung (diambil paralel) ---------- */
$komentar = array();
$sebelumnya = null;
$berikutnya = null;
$terkait = array();
$terbaru = array();
$lawan = array();
$daftarTopik = array();
$kategori = array();
$tags = array();

if ($item) {
  $kategori = istilah_item($item, 'category');
  $tags = istilah_item($item, 'post_tag');

  $filterNavigasi = array();
  if (!$adalahBerita && !empty($item['categories']) && in_array(7, $item['categories'])) {
    $filterNavigasi['categories'] = 7;
  }

  $permintaan = array(
    'komentar' => array('wp/v2/comments', wp_query_komentar($item['id']), 60),
    'sebelumnya' => array($endpoint, $filterNavigasi + array('before' => $item['date'], 'per_page' => 1, 'orderby' => 'date', 'order' => 'desc', '_fields' => 'id,slug,type,title,date')),
    'berikutnya' => array($endpoint, $filterNavigasi + array('after' => $item['date'], 'per_page' => 1, 'orderby' => 'date', 'order' => 'asc', '_fields' => 'id,slug,type,title,date')),
    'terbaru' => array($endpoint, $filterNavigasi + array('exclude' => $item['id'], 'per_page' => 6, 'orderby' => 'date', 'order' => 'desc', '_embed' => 1)),
    'lawan' => $adalahBerita
      ? array('wp/v2/posts', array('categories' => 7, 'per_page' => 4, 'orderby' => 'date', 'order' => 'desc', '_embed' => 1))
      : array('wp/v2/pages', array('per_page' => 4, 'orderby' => 'date', 'order' => 'desc', '_embed' => 1)),
  );
  if (!$adalahBerita) {
    $permintaan['topik'] = array('wp/v2/tags', array('per_page' => 30, 'hide_empty' => 'true', 'orderby' => 'count', 'order' => 'desc', '_fields' => 'id,name,count'));
    if (!empty($item['tags'])) {
      $permintaan['terkait'] = array('wp/v2/posts', array('tags' => implode(',', $item['tags']), 'exclude' => $item['id'], 'per_page' => 3, '_embed' => 1));
    }
  }

  $hasil = wp_get_banyak($permintaan);

  if ($hasil['komentar']['ok'] && is_array($hasil['komentar']['data'])) $komentar = $hasil['komentar']['data'];
  if ($hasil['sebelumnya']['ok'] && !empty($hasil['sebelumnya']['data'][0])) $sebelumnya = $hasil['sebelumnya']['data'][0];
  if ($hasil['berikutnya']['ok'] && !empty($hasil['berikutnya']['data'][0])) $berikutnya = $hasil['berikutnya']['data'][0];
  if ($hasil['terbaru']['ok'] && is_array($hasil['terbaru']['data'])) $terbaru = $hasil['terbaru']['data'];
  if ($hasil['lawan']['ok'] && is_array($hasil['lawan']['data'])) $lawan = $hasil['lawan']['data'];
  if (isset($hasil['topik']) && $hasil['topik']['ok'] && is_array($hasil['topik']['data'])) $daftarTopik = $hasil['topik']['data'];

  // Tulisan terkait: yang setopik (tag sama) dulu, lalu dilengkapi tulisan terbaru.
  $sudahAda = array($item['id'] => true);
  $kandidat = array();
  if (isset($hasil['terkait']) && $hasil['terkait']['ok'] && is_array($hasil['terkait']['data'])) $kandidat = $hasil['terkait']['data'];
  foreach (array_merge($kandidat, $terbaru) as $k) {
    if (count($terkait) >= 3) break;
    if (isset($sudahAda[$k['id']])) continue;
    $sudahAda[$k['id']] = true;
    $terkait[] = $k;
  }
}

/* ---------- Kamus tag untuk badge kartu terkait ---------- */
$kamusTag = array();
foreach ($daftarTopik as $t) $kamusTag[$t['id']] = $t['name'];
foreach ($tags as $t) $kamusTag[$t['id']] = $t['name'];

function nama_tag_pertama($k, $kamusTag)
{
  if (!empty($k['tags'])) {
    foreach ($k['tags'] as $id) if (isset($kamusTag[$id])) return $kamusTag[$id];
  }
  foreach (istilah_item($k, 'post_tag') as $t) return $t['name'];
  return '';
}

/* ---------- Komentar berutas ---------- */
$anakKomentar = array();
foreach ($komentar as $k) {
  $anakKomentar[(int) $k['parent']][] = $k;
}
$bolehKomentar = $item && isset($item['comment_status']) && $item['comment_status'] === 'open';
$kedalamanMaks = 4;

function render_komentar($parent, $anakKomentar, $bolehKomentar, $kedalaman, $kedalamanMaks)
{
  if (empty($anakKomentar[$parent])) return '';
  $html = '';
  foreach ($anakKomentar[$parent] as $k) {
    $nama = trim(teks_polos($k['author_name'])) !== '' ? teks_polos($k['author_name']) : 'Anonim';
    $avatar = isset($k['author_avatar_urls']['96']) ? $k['author_avatar_urls']['96'] : '';
    $namaHtml = esc($nama);
    if (!empty($k['author_url'])) {
      $namaHtml = '<a href="' . esc($k['author_url']) . '" rel="nofollow ugc noopener" target="_blank">' . $namaHtml . '</a>';
    }
    $html .= '<li class="komentar" id="comment-' . (int) $k['id'] . '">'
      . '<article class="komentar-body">'
      . ($avatar
        ? '<img class="komentar-avatar" src="' . esc($avatar) . '" alt="" loading="lazy" width="48" height="48">'
        : '<span class="komentar-avatar komentar-avatar-huruf">' . esc(mb_strtoupper(mb_substr($nama, 0, 1))) . '</span>')
      . '<div class="komentar-main">'
      . '<header class="komentar-meta"><strong class="komentar-nama">' . $namaHtml . '</strong>'
      . '<a class="komentar-waktu" href="#comment-' . (int) $k['id'] . '"><time datetime="' . esc(tanggal_wp($k)) . '">' . esc(format_tanggal_id(tanggal_wp($k), true)) . '</time></a></header>'
      . '<div class="komentar-isi">' . $k['content']['rendered'] . '</div>'
      . (($bolehKomentar && $kedalaman < $kedalamanMaks)
        ? '<button type="button" class="komentar-balas" data-parent="' . (int) $k['id'] . '" data-nama="' . esc($nama) . '">'
        . '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 14L4 9l5-5"/><path d="M4 9h10a6 6 0 016 6v4"/></svg> Balas</button>'
        : '')
      . '</div>'
      . '</article>';
    $anak = render_komentar((int) $k['id'], $anakKomentar, $bolehKomentar, $kedalaman + 1, $kedalamanMaks);
    if ($anak !== '') $html .= '<ol class="komentar-anak">' . $anak . '</ol>';
    $html .= '</li>';
  }
  return $html;
}

/* ---------- Meta halaman ---------- */
$namaSitus = 'PCNU Kota Pasuruan';
if ($item) {
  $judulPolos = teks_polos($item['title']['rendered']);
  $ringkasan = potong_teks(teks_polos(!empty($item['excerpt']['rendered']) ? $item['excerpt']['rendered'] : $item['content']['rendered']), 160);
  $gambarOg = gambar_unggulan($item, 'large');
  $punyaFeatured = !empty($item['_embedded']['wp:featuredmedia'][0]['source_url']);
  // Nama akun WP saat ini berupa alamat email — jangan pernah tampilkan email ke publik.
  $penulis = !empty($item['_embedded']['author'][0]['name']) ? $item['_embedded']['author'][0] : array();
  if (empty($penulis['name']) || strpos($penulis['name'], '@') !== false) {
    $penulis = array('name' => 'Redaksi ' . $namaSitus, 'description' => isset($penulis['description']) ? $penulis['description'] : '', 'avatar_urls' => array());
  }
  $menitBaca = waktu_baca($item['content']['rendered']);
  $urlKanonik = preg_replace('/\?.*$/', '', url_sekarang()) . '?slug=' . rawurlencode($item['slug']);
  $judulHalaman = $judulPolos . ' — ' . $namaSitus;
} else {
  http_response_code(404);
  $judulPolos = $labelJenis . ' tidak ditemukan';
  $ringkasan = 'Tulisan yang Anda cari tidak ditemukan atau sudah dipindahkan.';
  $judulHalaman = $judulPolos . ' — ' . $namaSitus;
}

$statusKomentar = isset($_GET['komentar']) ? $_GET['komentar'] : '';
$pesanKomentar = isset($_GET['pesan']) ? teks_polos($_GET['pesan']) : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo esc($judulHalaman); ?></title>
<meta name="description" content="<?php echo esc($ringkasan); ?>">
<link rel="icon" href="https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png">
<?php if ($item): ?>
<link rel="canonical" href="<?php echo esc($urlKanonik); ?>">
<meta property="og:type" content="article">
<meta property="og:site_name" content="<?php echo esc($namaSitus); ?>">
<meta property="og:title" content="<?php echo esc($judulPolos); ?>">
<meta property="og:description" content="<?php echo esc($ringkasan); ?>">
<meta property="og:url" content="<?php echo esc($urlKanonik); ?>">
<?php if ($gambarOg): ?><meta property="og:image" content="<?php echo esc($gambarOg); ?>">
<?php endif; ?>
<meta property="article:published_time" content="<?php echo esc(date('c', strtotime(tanggal_wp($item)))); ?>">
<meta property="article:modified_time" content="<?php echo esc($item['modified']); ?>">
<meta name="twitter:card" content="<?php echo $gambarOg ? 'summary_large_image' : 'summary'; ?>">
<script type="application/ld+json"><?php echo json_encode(array(
  '@context' => 'https://schema.org',
  '@type' => $adalahBerita ? 'NewsArticle' : 'Article',
  'headline' => $judulPolos,
  'description' => $ringkasan,
  'image' => $gambarOg ? array($gambarOg) : array(),
  'datePublished' => date('c', strtotime(tanggal_wp($item))),
  'dateModified' => $item['modified'],
  'author' => array('@type' => 'Organization', 'name' => teks_polos($penulis['name'])),
  'publisher' => array('@type' => 'Organization', 'name' => $namaSitus),
  'mainEntityOfPage' => $urlKanonik,
), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
<?php else: ?>
<meta name="robots" content="noindex">
<?php endif; ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/theme.css">
</head>
<body class="halaman-baca">
<div class="progres-baca" id="progresBaca" aria-hidden="true"></div>
<?php include __DIR__ . '/header.php'; ?>

<?php if (!$item): ?>

<section class="page-hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <div class="wrap">
    <div class="breadcrumb">
      <a href="<?php echo $baseUrl; ?>">Beranda</a>
      <span class="sep">/</span>
      <a href="<?php echo $baseUrl . $folderJenis; ?>"><?php echo $labelJenis; ?></a>
      <span class="sep">/</span>
      <span class="here">Tidak ditemukan</span>
    </div>
    <h1><?php echo esc($judulPolos); ?></h1>
    <p><?php echo esc($ringkasan); ?> Coba cari dengan kata kunci lain.</p>
    <form class="form-cari form-cari-hero" action="<?php echo $baseUrl . $folderJenis; ?>" method="get" role="search">
      <input type="search" name="s" placeholder="Cari <?php echo strtolower($labelJenis); ?>…" aria-label="Kata kunci pencarian" value="<?php echo esc(str_replace('-', ' ', $slug)); ?>">
      <button type="submit">Cari</button>
    </form>
  </div>
</section>
<section class="warta">
  <div class="wrap">
    <div class="section-more" style="margin-top:0;">
      <a class="btn" href="<?php echo $baseUrl . $folderJenis; ?>">Lihat Semua <?php echo $labelJenis; ?></a>
    </div>
  </div>
</section>

<?php else: ?>

<section class="page-hero single-hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <div class="wrap">
    <div class="breadcrumb">
      <a href="<?php echo $baseUrl; ?>">Beranda</a>
      <span class="sep">/</span>
      <a href="<?php echo $baseUrl . $folderJenis; ?>"><?php echo $labelJenis; ?></a>
      <span class="sep">/</span>
      <span class="here"><?php echo esc(potong_teks($judulPolos, 48)); ?></span>
    </div>

    <div class="single-label">
      <span class="eyebrow"><span class="motif-star"></span> <?php echo $labelJenis; ?></span>
      <?php foreach ($tags as $t): $w = warna_tag($t['name']); ?>
        <a class="badge-tag" href="<?php echo $baseUrl; ?>articles/?tag=<?php echo (int) $t['id']; ?>" style="background-color:<?php echo $w[0]; ?>;color:<?php echo $w[1]; ?>;"><?php echo esc(teks_polos($t['name'])); ?></a>
      <?php endforeach; ?>
    </div>

    <h1><?php echo $item['title']['rendered']; ?></h1>

    <div class="single-meta">
      <?php if ($penulis): ?>
        <span class="meta-penulis">
          <?php if (!empty($penulis['avatar_urls']['48'])): ?><img src="<?php echo esc($penulis['avatar_urls']['48']); ?>" alt="" width="28" height="28"><?php endif; ?>
          <?php echo esc(teks_polos($penulis['name'])); ?>
        </span>
      <?php endif; ?>
      <span><time datetime="<?php echo esc(tanggal_wp($item)); ?>"><?php echo esc(format_tanggal_id(tanggal_wp($item))); ?></time></span>
      <span><?php echo $menitBaca; ?> menit baca</span>
      <a href="#komentar"><?php echo count($komentar); ?> komentar</a>
    </div>
  </div>
</section>

<section class="baca">
  <div class="wrap baca-layout">
    <article class="baca-artikel" id="isiArtikel">
      <?php if ($punyaFeatured): $fm = $item['_embedded']['wp:featuredmedia'][0]; ?>
        <figure class="baca-cover">
          <img src="<?php echo esc(gambar_unggulan($item, 'large')); ?>" alt="<?php echo esc(isset($fm['alt_text']) ? $fm['alt_text'] : ''); ?>">
          <?php if (!empty($fm['caption']['rendered'])): ?><figcaption><?php echo teks_polos($fm['caption']['rendered']); ?></figcaption><?php endif; ?>
        </figure>
      <?php endif; ?>

      <div class="entry-content" id="entryContent">
        <?php echo $item['content']['rendered']; ?>
      </div>

      <?php if ($item['modified'] && substr($item['modified'], 0, 10) !== substr($item['date'], 0, 10)): ?>
        <p class="baca-diperbarui">Diperbarui <?php echo esc(format_tanggal_id(tanggal_wp($item, 'modified'), true)); ?></p>
      <?php endif; ?>

      <?php if ($tags): ?>
        <div class="baca-tags">
          <span class="label-kecil">Topik</span>
          <?php foreach ($tags as $t): ?>
            <a class="chip" href="<?php echo $baseUrl; ?>articles/?tag=<?php echo (int) $t['id']; ?>">#<?php echo esc(teks_polos($t['name'])); ?></a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="baca-share" data-url="<?php echo esc($urlKanonik); ?>" data-judul="<?php echo esc($judulPolos); ?>">
        <span class="label-kecil">Bagikan</span>
        <a class="share-btn share-wa" href="https://wa.me/?text=<?php echo rawurlencode($judulPolos . ' — ' . $urlKanonik); ?>" target="_blank" rel="noopener" aria-label="Bagikan ke WhatsApp">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.5 14.4c-.3-.1-1.8-.9-2-1s-.5-.1-.7.1-.8 1-.9 1.2-.3.2-.6.1a8 8 0 01-2.4-1.5 9 9 0 01-1.6-2c-.2-.3 0-.5.1-.6l.4-.5.3-.5v-.5c0-.1-.7-1.6-.9-2.2-.2-.6-.5-.5-.7-.5h-.6a1.1 1.1 0 00-.8.4 3.4 3.4 0 00-1 2.5 5.9 5.9 0 001.2 3.1 13.4 13.4 0 005.2 4.6c1.9.8 2.7.9 3.6.7a3.1 3.1 0 002-1.4 2.5 2.5 0 00.2-1.4c-.1-.1-.3-.2-.6-.4zM12 21.8a9.8 9.8 0 01-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4A9.8 9.8 0 1112 21.8zm8.4-18.2A11.8 11.8 0 001.8 17.8L.1 24l6.4-1.7A11.8 11.8 0 0024 12a11.7 11.7 0 00-3.6-8.4z"/></svg>
          <span>WhatsApp</span>
        </a>
        <a class="share-btn share-fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode($urlKanonik); ?>" target="_blank" rel="noopener" aria-label="Bagikan ke Facebook">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12a12 12 0 10-13.9 11.9v-8.4h-3V12h3V9.4c0-3 1.8-4.7 4.5-4.7a18 18 0 012.7.2v2.9h-1.5c-1.5 0-2 .9-2 1.9V12h3.4l-.5 3.5h-2.9v8.4A12 12 0 0024 12z"/></svg>
          <span>Facebook</span>
        </a>
        <a class="share-btn share-x" href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode($judulPolos); ?>&url=<?php echo rawurlencode($urlKanonik); ?>" target="_blank" rel="noopener" aria-label="Bagikan ke X">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.2 2.3h3.4l-7.4 8.4 8.7 11.5h-6.8l-5.3-7-6.1 7H1.3l7.9-9L.9 2.3h7l4.8 6.3 5.5-6.3zm-1.2 17.9h1.9L7 4.2H5l12 16z"/></svg>
          <span>X</span>
        </a>
        <a class="share-btn share-tg" href="https://t.me/share/url?url=<?php echo rawurlencode($urlKanonik); ?>&text=<?php echo rawurlencode($judulPolos); ?>" target="_blank" rel="noopener" aria-label="Bagikan ke Telegram">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.9 4.3l-3.3 15.5c-.2 1.1-.9 1.4-1.8.9l-5-3.7-2.4 2.3c-.3.3-.5.5-1 .5l.3-5.1 9.3-8.4c.4-.4-.1-.6-.6-.2L5.9 13.3l-4.9-1.5c-1.1-.3-1.1-1.1.2-1.6L20.5 2.8c.9-.3 1.7.2 1.4 1.5z"/></svg>
          <span>Telegram</span>
        </a>
        <button type="button" class="share-btn share-salin" id="btnSalinTautan" aria-label="Salin tautan">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 007.5.5l3-3a5 5 0 00-7-7l-1.7 1.7"/><path d="M14 11a5 5 0 00-7.5-.5l-3 3a5 5 0 007 7l1.7-1.7"/></svg>
          <span>Salin tautan</span>
        </button>
      </div>

      <?php if ($penulis): ?>
        <div class="baca-penulis">
          <?php if (!empty($penulis['avatar_urls']['96'])): ?><img src="<?php echo esc($penulis['avatar_urls']['96']); ?>" alt="" width="64" height="64" loading="lazy"><?php else: ?><span class="baca-penulis-ikon"><span class="motif-star"></span></span><?php endif; ?>
          <div>
            <span class="label-kecil">Ditulis oleh</span>
            <strong><?php echo esc(teks_polos($penulis['name'])); ?></strong>
            <p><?php echo !empty($penulis['description']) ? esc(teks_polos($penulis['description'])) : 'Tim redaksi ' . $namaSitus . ' — dikelola oleh LTN NU Kota Pasuruan.'; ?></p>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($sebelumnya || $berikutnya): ?>
        <nav class="baca-navigasi" aria-label="Tulisan lainnya">
          <?php if ($sebelumnya): ?>
            <a class="nav-sebelumnya" href="<?php echo esc(url_baca($sebelumnya, $baseUrl)); ?>">
              <span class="label-kecil">‹ Sebelumnya</span>
              <strong><?php echo $sebelumnya['title']['rendered']; ?></strong>
            </a>
          <?php else: ?><span></span><?php endif; ?>
          <?php if ($berikutnya): ?>
            <a class="nav-berikutnya" href="<?php echo esc(url_baca($berikutnya, $baseUrl)); ?>">
              <span class="label-kecil">Berikutnya ›</span>
              <strong><?php echo $berikutnya['title']['rendered']; ?></strong>
            </a>
          <?php endif; ?>
        </nav>
      <?php endif; ?>

      <!-- ================= KOMENTAR ================= -->
      <section class="komentar-area" id="komentar">
        <h2 class="komentar-judul">
          <?php echo count($komentar) ? count($komentar) . ' Komentar' : 'Komentar'; ?>
        </h2>

        <?php if ($statusKomentar === 'terkirim'): ?>
          <div class="komentar-notice sukses">Komentar Anda berhasil dikirim.</div>
        <?php elseif ($statusKomentar === 'moderasi'): ?>
          <div class="komentar-notice sukses">Terima kasih! Komentar Anda sedang menunggu moderasi admin.</div>
        <?php elseif ($statusKomentar === 'gagal'): ?>
          <div class="komentar-notice gagal"><?php echo esc($pesanKomentar ?: 'Komentar gagal dikirim.'); ?></div>
        <?php endif; ?>

        <?php if ($komentar): ?>
          <ol class="komentar-daftar" id="daftarKomentar">
            <?php echo render_komentar(0, $anakKomentar, $bolehKomentar, 1, $kedalamanMaks); ?>
          </ol>
        <?php else: ?>
          <ol class="komentar-daftar" id="daftarKomentar"></ol>
          <?php if ($bolehKomentar): ?><p class="komentar-kosong" id="komentarKosong">Belum ada komentar. Jadilah yang pertama memberi tanggapan.</p><?php endif; ?>
        <?php endif; ?>

        <?php if ($bolehKomentar): ?>
          <div id="wadahFormKomentar">
            <form class="form-komentar" id="formKomentar" method="post" action="<?php echo $baseUrl; ?>api/komentar.php" novalidate>
              <div class="form-komentar-head">
                <h3 id="judulFormKomentar">Tinggalkan Komentar</h3>
                <button type="button" class="batal-balas" id="batalBalas" hidden>Batal membalas</button>
              </div>
              <p class="form-catatan">Alamat email Anda tidak akan dipublikasikan. Kolom bertanda <span class="wajib">*</span> wajib diisi.</p>

              <input type="hidden" name="comment_post_ID" value="<?php echo (int) $item['id']; ?>">
              <input type="hidden" name="comment_parent" id="komentarParent" value="0">
              <input type="hidden" name="kembali" value="<?php echo esc(isset($_SERVER['REQUEST_URI']) ? preg_replace('/[?&]komentar=[^&#]*(&pesan=[^&#]*)?/', '', $_SERVER['REQUEST_URI']) : ''); ?>">
              <div class="hp-field" aria-hidden="true">
                <label>Jangan diisi <input type="text" name="situs_alt" tabindex="-1" autocomplete="off"></label>
              </div>

              <label class="field field-penuh">
                <span>Komentar <span class="wajib">*</span></span>
                <textarea name="comment" id="komentarIsi" rows="5" maxlength="5000" required></textarea>
              </label>
              <div class="field-grid">
                <label class="field">
                  <span>Nama <span class="wajib">*</span></span>
                  <input type="text" name="author" id="komentarNama" maxlength="245" autocomplete="name" required>
                </label>
                <label class="field">
                  <span>Email <span class="wajib">*</span></span>
                  <input type="email" name="email" id="komentarEmail" maxlength="100" autocomplete="email" required>
                </label>
                <label class="field">
                  <span>Situs web</span>
                  <input type="url" name="url" id="komentarUrl" maxlength="200" autocomplete="url" placeholder="https://">
                </label>
              </div>
              <label class="field-cek">
                <input type="checkbox" id="komentarIngat" value="1">
                <span>Simpan nama, email, dan situs web saya pada peramban ini untuk komentar berikutnya.</span>
              </label>
              <div class="form-aksi">
                <button type="submit" class="btn btn-hijau" id="btnKirimKomentar">Kirim Komentar</button>
                <div class="form-status" id="statusKomentar" role="status" aria-live="polite"></div>
              </div>
            </form>
          </div>
        <?php else: ?>
          <p class="komentar-tutup">Komentar ditutup untuk tulisan ini.</p>
        <?php endif; ?>
      </section>
    </article>

    <!-- ================= SIDEBAR ================= -->
    <aside class="baca-sidebar">
      <div class="widget">
        <h4 class="widget-judul">Cari <?php echo $labelJenis; ?></h4>
        <form class="form-cari" action="<?php echo $baseUrl . $folderJenis; ?>" method="get" role="search">
          <input type="search" name="s" placeholder="Kata kunci…" aria-label="Kata kunci pencarian">
          <button type="submit" aria-label="Cari">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.5-3.5"/></svg>
          </button>
        </form>
      </div>

      <?php if ($terbaru): ?>
        <div class="widget">
          <h4 class="widget-judul"><?php echo $labelJenis; ?> Terbaru</h4>
          <ul class="widget-daftar">
            <?php foreach (array_slice($terbaru, 0, 5) as $t): $g = gambar_unggulan($t, 'thumbnail'); ?>
              <li>
                <a href="<?php echo esc(url_baca($t, $baseUrl)); ?>">
                  <span class="widget-thumb"><?php if ($g): ?><img src="<?php echo esc($g); ?>" alt="" loading="lazy"><?php else: ?><span class="motif-star"></span><?php endif; ?></span>
                  <span class="widget-teks">
                    <strong><?php echo $t['title']['rendered']; ?></strong>
                    <small><?php echo esc(format_tanggal_id(tanggal_wp($t))); ?></small>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ($daftarTopik): ?>
        <div class="widget">
          <h4 class="widget-judul">Topik</h4>
          <div class="widget-topik">
            <?php foreach ($daftarTopik as $t): ?>
              <a class="chip" href="<?php echo $baseUrl; ?>articles/?tag=<?php echo (int) $t['id']; ?>"><?php echo esc(teks_polos($t['name'])); ?> <small><?php echo (int) $t['count']; ?></small></a>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($lawan): ?>
        <div class="widget widget-gelap">
          <h4 class="widget-judul"><?php echo $labelLawan; ?></h4>
          <ul class="widget-daftar">
            <?php foreach (array_slice($lawan, 0, 4) as $t): ?>
              <li>
                <a href="<?php echo esc(url_baca($t, $baseUrl)); ?>">
                  <span class="widget-teks">
                    <strong><?php echo $t['title']['rendered']; ?></strong>
                    <small><?php echo esc(format_tanggal_id(tanggal_wp($t))); ?></small>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="widget widget-toc" id="widgetToc" hidden>
        <h4 class="widget-judul">Daftar Isi</h4>
        <ol class="toc-daftar" id="tocDaftar"></ol>
      </div>
    </aside>
  </div>
</section>

<?php if ($terkait): ?>
<section class="warta baca-terkait">
  <div class="wrap">
    <div class="divider"><span><?php echo $labelJenis; ?> Terkait</span></div>
    <div class="section-head">
      <h2>Baca Juga</h2>
    </div>
    <div class="news-grid" id="gridTerkait">
      <?php foreach ($terkait as $t) echo kartu_berita_html($t, $baseUrl, $adalahBerita ? '' : nama_tag_pertama($t, $kamusTag)); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<div class="lightbox" id="fotoLightbox" aria-hidden="true">
  <div class="lightbox-backdrop" id="lightboxBackdrop"></div>
  <button type="button" class="lightbox-close" id="lightboxClose" aria-label="Tutup">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
  </button>
  <img class="lightbox-img" id="lightboxImg" src="" alt="Pratinjau foto">
</div>

<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>

<script src="<?php echo $baseUrl; ?>assets/common.js"></script>
<script src="<?php echo $baseUrl; ?>assets/baca.js"></script>
</body>
</html>

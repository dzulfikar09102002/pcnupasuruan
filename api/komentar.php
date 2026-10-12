<?php
/* ============================================================
   PROXY KIRIM KOMENTAR → WordPress
   REST API WordPress menolak komentar anonim
   (rest_comment_login_required), jadi komentar diteruskan ke
   form komentar bawaan WP: /wp-comments-post.php.
   Dipanggil via fetch dari assets/baca.js (balasan JSON), atau
   sebagai form biasa tanpa JS (balasan redirect).
   ============================================================ */
require_once __DIR__ . '/../inc/wp.php';

$mintaJson = (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

function selesai($ok, $status, $pesan, $tambahan = array())
{
  global $mintaJson;

  if ($mintaJson) {
    header('Content-Type: application/json; charset=utf-8');
    if (!$ok) http_response_code(422);
    echo json_encode(array('ok' => $ok, 'status' => $status, 'pesan' => $pesan) + $tambahan, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
  }

  // Tanpa JS: kembali ke halaman asal (hanya path lokal, cegah open redirect).
  $kembali = isset($_POST['kembali']) ? (string) $_POST['kembali'] : '';
  if ($kembali === '' || $kembali[0] !== '/' || (isset($kembali[1]) && ($kembali[1] === '/' || $kembali[1] === '\\'))) {
    $kembali = '../';
  }
  $kembali = preg_replace('/#.*$/', '', $kembali);
  $kembali .= (strpos($kembali, '?') === false ? '?' : '&') . 'komentar=' . $status;
  if (!$ok) $kembali .= '&pesan=' . rawurlencode($pesan);
  $kembali .= isset($tambahan['komentar']['id']) && $status === 'terkirim' ? '#comment-' . (int) $tambahan['komentar']['id'] : '#komentar';
  header('Location: ' . $kembali, true, 303);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Allow: POST');
  http_response_code(405);
  exit('Metode tidak diizinkan.');
}

$postId = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
$parent = isset($_POST['comment_parent']) ? (int) $_POST['comment_parent'] : 0;
$isi = isset($_POST['comment']) ? trim((string) $_POST['comment']) : '';
$nama = isset($_POST['author']) ? trim((string) $_POST['author']) : '';
$email = isset($_POST['email']) ? trim((string) $_POST['email']) : '';
$situs = isset($_POST['url']) ? trim((string) $_POST['url']) : '';

// Honeypot: bot yang mengisi kolom tersembunyi dianggap "berhasil" tanpa diteruskan.
if (!empty($_POST['situs_alt'])) {
  selesai(true, 'moderasi', 'Terima kasih! Komentar Anda sedang menunggu moderasi.');
}

if ($postId <= 0) selesai(false, 'gagal', 'Tulisan tidak valid.');
if ($isi === '') selesai(false, 'gagal', 'Silakan tulis komentar Anda.');
if (mb_strlen($isi) > 5000) selesai(false, 'gagal', 'Komentar terlalu panjang (maksimal 5000 karakter).');
if ($nama === '') selesai(false, 'gagal', 'Nama wajib diisi.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) selesai(false, 'gagal', 'Alamat email tidak valid.');
if ($situs !== '' && !preg_match('#^https?://#i', $situs)) $situs = 'https://' . $situs;
if ($situs !== '' && !filter_var($situs, FILTER_VALIDATE_URL)) selesai(false, 'gagal', 'Alamat situs web tidak valid.');

// Batasi 1 komentar per 20 detik per IP pengunjung.
$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'x';
$fileJeda = WP_CACHE_DIR . DIRECTORY_SEPARATOR . 'jeda-' . md5($ip);
if (is_file($fileJeda) && (time() - filemtime($fileJeda)) < 20) {
  selesai(false, 'gagal', 'Anda mengirim komentar terlalu cepat. Tunggu sebentar lalu coba lagi.');
}
if (!is_dir(WP_CACHE_DIR)) @mkdir(WP_CACHE_DIR, 0775, true);
@touch($fileJeda);

$ch = curl_init(WP_SITE . '/wp-comments-post.php');
curl_setopt_array($ch, array(
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query(array(
    'comment_post_ID' => $postId,
    'comment_parent' => $parent,
    'author' => $nama,
    'email' => $email,
    'url' => $situs,
    'comment' => $isi,
  )),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => true,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_CONNECTTIMEOUT => 8,
  CURLOPT_TIMEOUT => 20,
  CURLOPT_USERAGENT => isset($_SERVER['HTTP_USER_AGENT']) ? substr($_SERVER['HTTP_USER_AGENT'], 0, 250) : 'PCNU-Kopas-Frontend/1.0',
));
$mentah = curl_exec($ch);
if ($mentah === false) {
  $err = curl_error($ch);
  curl_close($ch);
  selesai(false, 'gagal', 'Tidak dapat terhubung ke server WordPress (' . $err . ').');
}
$kode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$ukuranHeader = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
curl_close($ch);
$header = substr($mentah, 0, $ukuranHeader);
$body = substr($mentah, $ukuranHeader);

// Sukses: WordPress me-redirect ke permalink tulisan (#comment-ID).
if ($kode >= 300 && $kode < 400 && preg_match('/^Location:\s*(\S+)/mi', $header, $m)) {
  $lokasi = $m[1];
  $idKomentar = preg_match('/#comment-(\d+)/', $lokasi, $mm) ? (int) $mm[1] : 0;
  $menungguModerasi = strpos($lokasi, 'unapproved=') !== false;

  wp_cache_hapus(wp_url('wp/v2/comments', wp_query_komentar($postId)));

  $status = $menungguModerasi ? 'moderasi' : 'terkirim';
  selesai(true, $status, $menungguModerasi
    ? 'Terima kasih! Komentar Anda sedang menunggu moderasi admin.'
    : 'Komentar Anda berhasil dikirim.', array(
    'komentar' => array(
      'id' => $idKomentar,
      'parent' => $parent,
      'nama' => $nama,
      'situs' => $situs,
      'isi' => nl2br(esc($isi)),
      'tanggal' => format_tanggal_id(date('c'), true),
      'avatar' => 'https://secure.gravatar.com/avatar/' . hash('sha256', strtolower($email)) . '?s=96&d=mm&r=g',
    ),
  ));
}

// Gagal: ambil pesan error dari halaman wp_die().
$pesan = '';
if (preg_match('/<div class="wp-die-message">(.*?)<\/div>/is', $body, $m) || preg_match('/<body[^>]*>(.*?)<\/body>/is', $body, $m)) {
  $pesan = teks_polos(preg_replace('/<p><a [^>]*history\.back[^<]*<\/a><\/p>/i', '', $m[1]));
  $pesan = preg_replace('/^(Eror|Error|Galat)\s*:\s*/iu', '', $pesan);
}
if ($pesan === '') {
  $pesan = $kode === 409 ? 'Komentar yang sama sudah pernah dikirim.' : 'Komentar gagal dikirim (kode ' . $kode . ').';
}
selesai(false, 'gagal', $pesan);

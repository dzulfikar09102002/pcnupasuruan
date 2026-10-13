<?php
$baseUrl = '../';
require_once __DIR__ . '/../inc/wp.php';

/* Link bagikan ?p=slug: isi judul & meta OG dari WP supaya pratinjau WhatsApp/Facebook benar.
   Detailnya sendiri tetap dibuka sebagai modal oleh assets/program.js. */
$judulHalaman = 'Program Kegiatan — PCNU Kota Pasuruan';
$deskripsi = 'Program dan kegiatan PCNU Kota Pasuruan bersama lembaga, badan otonom, dan warga Nahdliyin.';
$gambarOg = '';
$slugProgram = isset($_GET['p']) ? trim((string) $_GET['p']) : '';
if ($slugProgram !== '') {
  $r = wp_get('wp/v2/posts', array('slug' => $slugProgram, '_embed' => 1));
  if ($r['ok'] && !empty($r['data'][0])) {
    $program = $r['data'][0];
    $judulHalaman = teks_polos($program['title']['rendered']) . ' — Program PCNU Kota Pasuruan';
    $ringkas = potong_teks(teks_polos(isset($program['excerpt']['rendered']) ? $program['excerpt']['rendered'] : ''), 200);
    if ($ringkas !== '') $deskripsi = $ringkas;
    $gambarOg = (string) gambar_unggulan($program, 'large');
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo esc($judulHalaman); ?></title>
<meta name="description" content="<?php echo esc($deskripsi); ?>">
<meta property="og:type" content="website">
<meta property="og:site_name" content="PCNU Kota Pasuruan">
<meta property="og:title" content="<?php echo esc($judulHalaman); ?>">
<meta property="og:description" content="<?php echo esc($deskripsi); ?>">
<meta property="og:url" content="<?php echo esc(url_sekarang()); ?>">
<?php if ($gambarOg !== ''): ?>
<meta property="og:image" content="<?php echo esc($gambarOg); ?>">
<meta name="twitter:card" content="summary_large_image">
<?php endif; ?>
<link rel="icon" href="https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/theme.css">
</head>
<body data-judul-asli="Program Kegiatan — PCNU Kota Pasuruan">
<?php include __DIR__ . '/../partials/header.php'; ?>

<section class="page-hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <div class="wrap">
    <div class="breadcrumb">
      <a href="<?php echo $baseUrl; ?>">Beranda</a>
      <span class="sep">/</span>
      <span class="here">Program</span>
    </div>
    <h1>Program &amp; Kegiatan</h1>
    <p>Dokumentasi program dan kegiatan PCNU Kota Pasuruan bersama lembaga, badan otonom, dan warga Nahdliyin.</p>
    <form class="form-cari form-cari-hero" action="" method="get" role="search">
      <input type="search" name="s" placeholder="Cari program…" aria-label="Kata kunci pencarian" value="<?php echo isset($_GET['s']) ? esc($_GET['s']) : ''; ?>">
      <?php if (!empty($_GET['kategori'])): ?><input type="hidden" name="kategori" value="<?php echo (int) $_GET['kategori']; ?>"><?php endif; ?>
      <button type="submit">Cari</button>
    </form>
    <?php include __DIR__ . '/../partials/sosial.php'; ?>
  </div>
</section>

<section class="warta program-ig">
  <div class="wrap">
    <div class="filter-topik" id="programKategori" aria-label="Filter kategori program"></div>
    <div class="filter-info" id="programInfo" hidden></div>
    <div class="ig-grid" id="programGrid"></div>
    <div class="pagination" id="programPagination"></div>
  </div>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script src="<?php echo $baseUrl; ?>assets/common.js"></script>
<script src="<?php echo $baseUrl; ?>assets/program.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
  initTemaBersama();
  muatHalamanProgram({
    gridId: "programGrid",
    paginationId: "programPagination",
    infoId: "programInfo",
    kategoriId: "programKategori",
    perPage: 12
  });
});
</script>
</body>
</html>

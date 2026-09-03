<?php
$baseUrl = '../';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Berita — PCNU Kota Pasuruan</title>
<meta name="description" content="Seluruh berita dan kabar kegiatan PCNU Kota Pasuruan, badan otonom, dan lembaga di lingkungan Nahdlatul Ulama Kota Pasuruan.">
<link rel="icon" href="https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/theme.css">
</head>
<body>
<?php include __DIR__ . '/../partials/header.php'; ?>

<section class="page-hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <div class="wrap">
    <div class="breadcrumb">
      <a href="<?php echo $baseUrl; ?>">Beranda</a>
      <span class="sep">/</span>
      <span class="here">Berita</span>
    </div>
    <h1>Seluruh Berita PCNU Kota Pasuruan</h1>
    <p>Kumpulan lengkap kabar kegiatan, kerja sama, dan khidmah warga Nahdliyin Kota Pasuruan — diperbarui langsung dari WordPress.</p>
  </div>
</section>

<section class="warta">
  <div class="wrap">
    <div class="news-grid" id="newsGrid"></div>
    <div class="pagination" id="newsPagination"></div>
  </div>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script src="<?php echo $baseUrl; ?>assets/common.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
  initTemaBersama();
  muatDaftarBerpaginasi({
    gridId: "newsGrid",
    paginationId: "newsPagination",
    endpoint: "wp/v2/pages",
    perPage: 12,
    pakaiTag: false,
    pesanKosong: "Belum ada berita yang bisa ditampilkan.",
    pesanError: "Berita belum bisa dimuat"
  });
});
</script>
</body>
</html>

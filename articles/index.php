<?php
$baseUrl = '../';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Artikel — PCNU Kota Pasuruan</title>
<meta name="description" content="Kajian, gagasan, dan artikel pilihan seputar keislaman dan keorganisasian dari PCNU Kota Pasuruan.">
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
      <span class="here">Artikel</span>
    </div>
    <h1>Kajian & Fikrah — Artikel Pilihan</h1>
    <p>Catatan ilmiah, gagasan, serta ulasan seputar keislaman dan keorganisasian dari PCNU Kota Pasuruan.</p>
  </div>
</section>

<section class="warta">
  <div class="wrap">
    <div class="news-grid" id="artikelGrid"></div>
    <div class="pagination" id="artikelPagination"></div>
  </div>
</section>

<?php include __DIR__ . '/../partials/footer.php'; ?>

<script src="<?php echo $baseUrl; ?>assets/common.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function(){
  initTemaBersama();
  muatDaftarBerpaginasi({
    gridId: "artikelGrid",
    paginationId: "artikelPagination",
    endpoint: "wp/v2/posts?categories=7",
    perPage: 12,
    pakaiTag: true,
    pesanKosong: "Belum ada artikel yang dipublikasikan.",
    pesanError: "Artikel belum bisa dimuat"
  });
});
</script>
</body>
</html>

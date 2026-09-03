<?php if(!isset($baseUrl)) { $baseUrl = './'; } ?>
<header class="site-header">
  <div class="wrap">
    <a class="brand" href="<?php echo $baseUrl; ?>" id="brandLink">
      <img id="logoImg" alt="Logo PCNU Kota Pasuruan" style="display:none;">
      <div class="brand-fallback" id="logoFallback">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg>
      </div>
      <span class="brand-text">
        <strong id="siteTitle">PCNU Kota Pasuruan</strong>
        <small>NU Bishoffil Wahid</small>
      </span>
    </a>
    <nav class="main-nav">
      <a href="<?php echo $baseUrl; ?>#profil">Profil</a>
      <a href="<?php echo $baseUrl; ?>news/">Berita</a>
      <a href="<?php echo $baseUrl; ?>#kepengurusan">Pengurus</a>

      <div class="nav-dropdown">
        <a href="javascript:void(0)" class="drop-btn">Badan Otonom</a>
        <div class="dropdown-content">
          <a href="https://www.instagram.com/pc_fatayatkopas/" target="_blank">Fatayat NU</a>
          <a href="https://www.instagram.com/ansorkopas/" target="_blank">GP Ansor NU</a>
          <a href="https://www.instagram.com/pcipnuippnu_kotapasuruan/" target="_blank">IPNU</a>
          <a href="https://www.instagram.com/pcipnuippnu_kotapasuruan/" target="_blank">IPPNU</a>
          <a href="https://www.instagram.com/isharicabangkota/" target="_blank">Ishari NU</a>
          <a href="#">ISNU</a>
          <a href="https://www.instagram.com/muslimatnu.kopas/" target="_blank">Muslimat NU</a>
          <a href="#">Pagar Nusa</a>
          <a href="#">PMII</a>
          <a href="https://www.instagram.com/pcpergunukotapasuruan/" target="_blank">Pergunu</a>
        </div>
      </div>
      <div class="nav-dropdown">
        <a href="javascript:void(0)" class="drop-btn">Lembaga</a>
        <div class="dropdown-content">
          <a href="https://www.instagram.com/lakpesdam_nu_kota_pasuruan/" target="_blank">Lakpesdam NU</a>
          <a href="#">LAZISNU</a>
          <a href="#">LDNU</a>
          <a href="#">Lesbumi NU</a>
          <a href="#">LFNU</a>
          <a href="#">LKKNU</a>
          <a href="#">LKNU</a>
          <a href="#">LP Ma'arif NU</a>
          <a href="#">LPBHNU</a>
          <a href="#">LPBINU</a>
          <a href="#">LPNU</a>
          <a href="#">LPPNU</a>
          <a href="#">LTNNU</a>
        </div>
      </div>

      <a href="<?php echo $baseUrl; ?>#layanan">Layanan</a>
      <a href="<?php echo $baseUrl; ?>articles/">Artikel</a>
      <a href="<?php echo $baseUrl; ?>#kontak">Kontak</a>
    </nav>
    <button class="nav-toggle" aria-label="Buka menu">☰</button>
  </div>
</header>

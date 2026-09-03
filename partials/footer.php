<?php
if(!isset($baseUrl)) { $baseUrl = './'; }
$tahun = date('Y');
?>
<footer>
  <div class="footer-particles" id="footerParticles" aria-hidden="true"></div>
  <div class="wrap footer-grid">
    <div>
      <div class="footer-brand">
        <img id="footerLogoImg" alt="Logo PCNU Kota Pasuruan" style="display:none;">
        <strong id="footerTitle">PCNU Kota Pasuruan</strong>
      </div>
      <p class="footer-desc" id="footerDesc">Pengurus Cabang Nahdlatul Ulama Kota Pasuruan — membersamai umat lewat khidmah lembaga dan program kemaslahatan.</p>
      <p class="footer-desc" style="margin-top:12px;">📍 Jl. Untung Suropati No.16, Kebonagung, Kec. Purworejo, Kota Pasuruan, Jawa Timur 67116</p>
    </div>
    <div class="footer-col">
      <h4>Jelajah</h4>
      <ul>
        <li><a href="<?php echo $baseUrl; ?>news/">Berita</a></li>
        <li><a href="<?php echo $baseUrl; ?>#kepengurusan">Kepengurusan</a></li>
        <li><a href="<?php echo $baseUrl; ?>#program">Program</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Lembaga</h4>
      <ul>
        <li><a href="<?php echo $baseUrl; ?>#program">LP Ma'arif NU</a></li>
        <li><a href="<?php echo $baseUrl; ?>#program">RMI NU</a></li>
        <li><a href="<?php echo $baseUrl; ?>#program">LTMNU</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Kajian</h4>
      <ul>
        <li><a href="<?php echo $baseUrl; ?>articles/">Artikel Pilihan</a></li>
        <li><a href="<?php echo $baseUrl; ?>#kontak">Kontak Kami</a></li>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <span>© <?php echo $tahun; ?> PCNU Kota Pasuruan. All rights reserved</span>
    <span>Powered by LTN NU Kota Pasuruan.</span>
  </div>
</footer>

<button type="button" class="back-to-top" id="btnBackToTop" aria-label="Kembali ke atas">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M18 15l-6-6-6 6"/>
  </svg>
</button>

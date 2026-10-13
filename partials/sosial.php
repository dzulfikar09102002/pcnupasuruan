<?php
/* Tautan akun Instagram resmi. Dipakai di beranda (#program-kegiatan), program/index.php, dan footer. */
$akunInstagram = array(
  array('url' => 'https://www.instagram.com/pcnu.kotapasuruan/', 'akun' => '@pcnu.kotapasuruan', 'nama' => 'PCNU Kota Pasuruan'),
  array('url' => 'https://www.instagram.com/mediaseputarnukota/', 'akun' => '@mediaseputarnukota', 'nama' => 'LTN NU Kota Pasuruan'),
);
?>
<div class="sosial-ig">
  <?php foreach ($akunInstagram as $ig): ?>
  <a href="<?php echo $ig['url']; ?>" target="_blank" rel="noopener" aria-label="Instagram <?php echo $ig['nama']; ?> (<?php echo $ig['akun']; ?>)">
    <span class="ikon-ig"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></span>
    <span><strong><?php echo $ig['akun']; ?></strong><small><?php echo $ig['nama']; ?></small></span>
  </a>
  <?php endforeach; ?>
</div>

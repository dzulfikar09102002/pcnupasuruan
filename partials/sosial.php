<?php
/* Akun media sosial resmi.
   - Default: tombol Instagram (beranda #program-kegiatan, program/index.php).
   - $sosialFooter = true sebelum include: strip "Ikuti Kami" di footer, termasuk kanal YouTube. */
$ikonSosial = array(
  'instagram' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
  'youtube' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M23 7.2a3 3 0 0 0-2.1-2.1C19 4.6 12 4.6 12 4.6s-7 0-8.9.5A3 3 0 0 0 1 7.2 31 31 0 0 0 .5 12a31 31 0 0 0 .5 4.8 3 3 0 0 0 2.1 2.1c1.9.5 8.9.5 8.9.5s7 0 8.9-.5a3 3 0 0 0 2.1-2.1 31 31 0 0 0 .5-4.8 31 31 0 0 0-.5-4.8zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>',
);
$akunSosial = array(
  array('platform' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/pcnu.kotapasuruan/', 'akun' => '@pcnu.kotapasuruan', 'nama' => 'PCNU Kota Pasuruan'),
  array('platform' => 'instagram', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/mediaseputarnukota/', 'akun' => '@mediaseputarnukota', 'nama' => 'LTN NU Kota Pasuruan'),
  array('platform' => 'youtube', 'label' => 'YouTube', 'url' => 'https://www.youtube.com/@seputarnukota', 'akun' => '@seputarnukota', 'nama' => 'LTN NU Kota Pasuruan'),
);
?>
<?php if (!empty($sosialFooter)): ?>
<div class="wrap footer-sosial">
  <div class="footer-sosial-teks">
    <span class="footer-sosial-label">Ikuti Kami</span>
    <strong>Kabar &amp; dokumentasi kegiatan NU Kota Pasuruan</strong>
  </div>
  <div class="footer-sosial-list">
    <?php foreach ($akunSosial as $s): ?>
    <a class="kartu-sosial kartu-sosial-<?php echo $s['platform']; ?>" href="<?php echo $s['url']; ?>" target="_blank" rel="noopener" aria-label="<?php echo $s['label'] . ' ' . $s['nama'] . ' (' . $s['akun'] . ')'; ?>">
      <span class="kartu-sosial-ikon"><?php echo $ikonSosial[$s['platform']]; ?></span>
      <span class="kartu-sosial-teks">
        <small><?php echo $s['label']; ?></small>
        <strong><?php echo $s['akun']; ?></strong>
        <em><?php echo $s['nama']; ?></em>
      </span>
      <svg class="kartu-sosial-panah" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M8 7h9v9"/></svg>
    </a>
    <?php endforeach; ?>
  </div>
</div>
<?php else: ?>
<div class="sosial-ig">
  <?php foreach ($akunSosial as $ig): if ($ig['platform'] !== 'instagram') continue; ?>
  <a href="<?php echo $ig['url']; ?>" target="_blank" rel="noopener" aria-label="Instagram <?php echo $ig['nama']; ?> (<?php echo $ig['akun']; ?>)">
    <span class="ikon-ig"><?php echo $ikonSosial['instagram']; ?></span>
    <span><strong><?php echo $ig['akun']; ?></strong><small><?php echo $ig['nama']; ?></small></span>
  </a>
  <?php endforeach; ?>
</div>
<?php endif; ?>

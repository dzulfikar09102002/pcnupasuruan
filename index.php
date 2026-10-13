<?php
$baseUrl = './';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PCNU Kota Pasuruan</title>
<meta name="description" content="Situs resmi Pengurus Cabang Nahdlatul Ulama (PCNU) Kota Pasuruan. Seputar kegiatan, khidmah umat, dan lembaga-lembaga NU di Kota Pasuruan.">
<link rel="icon" href="https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..600&family=Schibsted+Grotesk:wght@400..800&family=Amiri:wght@400;700&family=Lora:wght@700&family=Space+Mono&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $baseUrl; ?>assets/theme.css">
</head>
<body>
<div class="progres-gulir" id="progresGulir" aria-hidden="true"></div>
<?php include __DIR__ . '/partials/header.php'; ?>

<section class="hero">
  <div class="hero-pattern" aria-hidden="true"></div>
  <canvas class="hero-partikel" id="heroPartikel" aria-hidden="true"></canvas>
  <div class="wrap wrap-hero">
    <div>
      <span class="eyebrow hero-masuk" style="--i:0;"><span class="motif-star"></span> Pengurus Cabang Nahdlatul Ulama</span>
      <h1 class="judul-hero">
        <span class="baris" style="--i:1;"><span>Membersamai umat,</span></span>
        <span class="baris" style="--i:2;"><em>menjaga amanah</em></span>
        <span class="baris" style="--i:3;"><span>para muassis.</span></span>
      </h1>
      <p class="lead hero-masuk" style="--i:5;">Situs resmi PCNU Kota Pasuruan — kabar kegiatan, khidmah lembaga, dan program kemaslahatan umat dari Nahdlatul Ulama Kota Pasuruan.</p>
      <div class="cta-row hero-masuk" style="--i:6;">
        <a href="#warta" class="btn btn-emas">Berita Terbaru</a>
        <a href="#profil" class="btn btn-ghost">Tentang PCNU</a>
      </div>
    </div>

    <div class="hero-visual" id="heroVisual">
      <div class="carousel-frame" id="heroCarousel">
        <div class="carousel-track" id="heroCarouselTrack">
          <div class="slide active">
            <div class="ph-fallback">
              <span class="ph-kaligrafi" aria-hidden="true">&#1606;&#1607;&#1590;&#1577; &#1575;&#1604;&#1593;&#1604;&#1605;&#1575;&#1569;</span>
            </div>
          </div>
        </div>
        <button type="button" class="carousel-arrow prev" id="heroPrev" aria-label="Foto sebelumnya">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button type="button" class="carousel-arrow next" id="heroNext" aria-label="Foto berikutnya">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
        </button>
      </div>
      <div class="carousel-dots" id="heroCarouselDots"></div>
    </div>
  </div>
</section>

<div class="fact-strip">
  <div class="wrap">
    <div class="fact"><strong data-count-to="16" data-count-format="int">0</strong><span>PONDOK PESANTREN (RMI)</span></div>
    <div class="fact"><strong data-count-to="3000" data-count-format="id" data-count-prefix="±">0</strong><span>SISWA DI BAWAH LP MA'ARIF</span></div>
    <div class="fact"><strong data-count-to="500" data-count-format="id" data-count-prefix="±">0</strong><span>TAKMIR MASJID (LTMNU)</span></div>
    <div class="fact">
      <strong><span id="tahunKhidmat">2025–2030</span></strong>
      <span>MASA KHIDMAT PENGURUS</span>
    </div>
  </div>
</div>

<?php
/* Pita berjalan nama badan otonom & lembaga. Isi ditulis dua kali supaya putarannya mulus. */
$pitaBanom = array('Muslimat NU', 'Fatayat NU', 'GP Ansor', 'Banser', 'IPNU', 'IPPNU', 'Pagar Nusa', 'ISHARI', "LP Ma'arif NU", 'RMI NU', 'LAZISNU', 'LTMNU', 'Lakpesdam NU', 'Pergunu', 'ISNU', 'Lesbumi NU');
?>
<div class="pita-banom" aria-label="Badan otonom dan lembaga PCNU Kota Pasuruan">
  <div class="pita-banom-jalur">
    <?php for ($putaran = 0; $putaran < 2; $putaran++): ?>
    <ul class="pita-banom-isi"<?php if ($putaran) echo ' aria-hidden="true"'; ?>>
      <?php foreach ($pitaBanom as $nama): ?><li><?php echo $nama; ?></li><?php endforeach; ?>
    </ul>
    <?php endfor; ?>
  </div>
</div>

<section class="program-ig" id="program-kegiatan">
  <div class="wrap">
    <div class="divider"><span>Program Kegiatan</span></div>
    <div class="section-head">
      <h2>Program &amp; Kegiatan Terbaru</h2>
      <p>Ikuti kabar program dan kegiatan PCNU Kota Pasuruan bersama lembaga dan badan otonom. Geser untuk melihat foto lain, ketuk untuk membaca dan berkomentar.</p>
    </div>
    <div class="ig-baris">
      <button type="button" class="ig-baris-panah ig-baris-kiri" aria-label="Program sebelumnya" disabled>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div class="ig-grid ig-grid-geser" id="programGrid"></div>
      <button type="button" class="ig-baris-panah ig-baris-kanan" aria-label="Program berikutnya">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>
      </button>
    </div>
    <div class="section-more">
      <a class="btn" href="<?php echo $baseUrl; ?>program/">Lihat Semua Program <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
    <?php include __DIR__ . '/partials/sosial.php'; ?>
  </div>
</section>

<section class="profil" id="profil">
  <div class="wrap profil-grid">
    <div class="profil-text">
      <div class="divider"><span>Profil</span></div>
      <h2 style="font-size:clamp(24px,3vw,34px);color:var(--hijau);margin-bottom:20px;">PCNU Kota Pasuruan</h2>
      <p><strong>PCNU Kota Pasuruan</strong> merupakan struktur kepengurusan tingkat cabang (kota) dari organisasi kemasyarakatan Islam terbesar di Indonesia, Nahdlatul Ulama, yang beroperasi di wilayah administratif Kota Pasuruan, Jawa Timur. Sebagai salah satu basis kultural "Kota Santri", PCNU Kota Pasuruan memegang peran strategis dalam membina keagamaan, pendidikan, sosial, dan ekonomi masyarakat nahdliyin di wilayah perkotaan.</p>

      <div class="profil-block">
        <h3><span class="motif-star"></span>Sejarah Singkat & Akar Kultural</h3>
        <p>Pasuruan memiliki akar sejarah yang sangat kuat dengan Nahdlatul Ulama. Tokoh-tokoh ulama besar Pasuruan telah terlibat sejak masa-masa awal berdirinya NU di dekade 1920-an. Karakter Kota Pasuruan yang kental dengan tradisi pesantren — salah satunya dipengaruhi oleh figur legendaris Al-Maghfurlah KH. Abdul Hamid — menjadikan PCNU Kota Pasuruan sebagai pilar utama dalam menjaga tradisi Islam <em>Ahlussunnah wal Jama'ah An-Nahdliyah</em>.</p>
      </div>

      <div class="profil-block">
        <h3><span class="motif-star"></span>Kepengurusan & Khidmah</h3>
        <p>Struktur PCNU Kota Pasuruan digerakkan oleh dua dewan utama: <strong>Syuriah</strong> (dewan penasihat/ulama) dan <strong>Tanfidziyah</strong> (dewan pelaksana harian). Ketua Tanfidziyah dipimpin oleh <strong>H. Mohammad Nailur Rohman</strong> ("Gus Amak"), cucu dari KH. Abdul Hamid. Di bawah kepemimpinannya, PCNU Kota Pasuruan membawa corak pergerakan yang dinamis dan adaptif terhadap perkembangan zaman.</p>
      </div>
      <div class="profil-block">
        <h3><span class="motif-star"></span>Fokus Gerakan & Pendekatan Strategis</h3>
        <p><strong>Pendekatan Milenial</strong> — merangkul generasi muda perkotaan lewat seni, hobi, dan media digital. <strong>Kemandirian Organisasi</strong> — menanamkan mentalitas khidmah yang mandiri demi mengawal program keumatan berkelanjutan. <strong>Penguatan Administrasi</strong> — sosialisasi berkala pedoman organisasi agar MWC hingga Ranting berjalan profesional dan terukur.</p>
      </div>
      <div class="profil-block">
        <h3><span class="motif-star"></span>Sinergi & Badan Otonom</h3>
        <p style="margin-bottom:14px;">Program-program PCNU Kota Pasuruan ditopang berbagai Badan Otonom dan lembaga, serta bersinergi aktif dengan Pemerintah Kota Pasuruan dan aparat keamanan.</p>
        <div class="profil-list">
          <span class="chip">Muslimat NU</span>
          <span class="chip">Fatayat NU</span>
          <span class="chip">GP Ansor</span>
          <span class="chip">Banser</span>
          <span class="chip">IPNU</span>
          <span class="chip">IPPNU</span>
          <span class="chip">LAZISNU</span>
          <span class="chip">LKKNU</span>
        </div>
      </div>
      <div class="profil-block" style="margin-bottom:0;">
        <h3><span class="motif-star"></span>Catatan</h3>
        <p>Di wilayah administrasi Pasuruan terdapat dua kepengurusan cabang NU: <strong>PCNU Kota Pasuruan</strong> (wilayah kota madya) dan <strong>PCNU Kabupaten Pasuruan</strong> (wilayah kabupaten). Keduanya sama-sama aktif bergerak selaras di bawah naungan PWNU Jawa Timur.</p>
      </div>
    </div>
    <div class="profil-side">
      <div class="profil-card">
        <span class="label">Kantor PCNU Kota Pasuruan</span>
        <address>Jl. Untung Suropati No.16, Kebonagung,<br>Kec. Purworejo, Kota Pasuruan,<br>Jawa Timur 67116</address>
        <a class="map-link" href="https://www.google.com/maps/dir//PCNU+KOTA+PASURUAN,+Jl.+Untung+Suropati+No.16,+Kebonagung,+Kec.+Purworejo,+Kota+Pasuruan,+Jawa+Timur+67116/@-7.6514352,112.9050948,14z" target="_blank" rel="noopener">📍 Buka di Google Maps</a>
      </div>
      <div class="profil-photos">
        <img src="https://pcnupasuruankota.id/wp-content/uploads/2026/06/WhatsApp-Image-2026-04-18-at-19.48.47-780x470-2.jpeg" alt="Kegiatan PCNU Kota Pasuruan" loading="lazy">
        <img src="https://pcnupasuruankota.id/wp-content/uploads/2026/06/mudhofir.jpg" alt="Pengurus PCNU Kota Pasuruan" loading="lazy">
        <img src="https://pcnupasuruankota.id/wp-content/uploads/2026/06/13_1775382724-3.webp" alt="Kegiatan PCNU Kota Pasuruan" loading="lazy">
        <img src="https://pcnupasuruankota.id/wp-content/uploads/2026/06/rsz-img-20250713-wa0045_1752458455-1.webp" alt="Kegiatan PCNU Kota Pasuruan" loading="lazy">
      </div>
    </div>
  </div>
</section>

<section class="warta" id="warta">
  <div class="wrap">
    <div class="divider"><span>Kabar Terkini</span></div>
    <div class="section-head">
      <h2>Seputar PCNU Kota Pasuruan</h2>
      <p>Informasi terkini seputar kegiatan, kerja sama, dan khidmah warga Nahdliyin Kota Pasuruan.</p>
    </div>
    <div class="news-grid" id="newsGrid"></div>
    <div class="section-more">
      <a class="btn" href="<?php echo $baseUrl; ?>news/">Lihat Semua Berita <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
  </div>
</section>
<section class="galeri" id="galeri">
  <div class="wrap">
    <div class="divider"><span>Dokumentasi</span></div>
    <div class="section-head">
      <h2>Galeri Kegiatan</h2>
      <p>Momen-momen kegiatan PCNU Kota Pasuruan bersama lembaga, badan otonom, dan warga Nahdliyin.</p>
    </div>
  </div>

  <div class="galeri-container-outer">
    <div class="galeri-wrap" id="galeriWrap" tabindex="0" role="region" aria-label="Galeri foto, geser untuk melihat lebih banyak">
      <div class="galeri-track" id="galeriTrack"></div>
    </div>
  </div>
</section>

<div class="lightbox" id="fotoLightbox" aria-hidden="true">
  <div class="lightbox-backdrop" id="lightboxBackdrop"></div>
  <button type="button" class="lightbox-close" id="lightboxClose" aria-label="Tutup">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
  </button>
  <img class="lightbox-img" id="lightboxImg" src="" alt="Pratinjau foto">
</div>
<section class="kepengurusan" id="kepengurusan">
  <div class="wrap">
    <div class="divider"><span>Masa Khidmat 2025–2030</span></div>
    <div class="section-head">
      <h2>Kepengurusan</h2>
      <p>Nakhoda PCNU Kota Pasuruan hasil Konferensi Cabang ke-X.</p>
    </div>
    <div class="pimpinan-grid">
      <div class="pimpinan-card">
        <span class="motif-star"></span>
        <h3>Gus H. M. Nailurrohman</h3>
        <span class="jabatan">Ketua Tanfidziyah — "Gus Amak"</span>
        <blockquote>"NU harus kembali kepada umat. Kalau kita mendapatkan amanah menjadi pengurus NU, berarti kita harus ngurusi umat."</blockquote>
      </div>
      <div class="pimpinan-card">
        <span class="motif-star"></span>
        <h3>KH. Abdul Halim Mas'ud</h3>
        <span class="jabatan">Rais Syuriah</span>
        <blockquote>"Saya siap menjalankan amanah sebagai Rais Syuriah PCNU Kota Pasuruan masa khidmat 2025–2030."</blockquote>
      </div>
    </div>
  </div>
</section>

<section class="layanan" id="layanan">
  <div class="wrap">
    <div class="divider"><span>Layanan & Konsultasi PCNU Kota Pasuruan</span></div>
    <div class="section-head">
      <h2>Program Kegiatan</h2>
      <p>Masyarakat dapat berkonsultasi, menyampaikan aspirasi, maupun memperoleh informasi terkait program dan kegiatan badan otonom serta lembaga di lingkungan PCNU Kota Pasuruan sesuai jadwal bidang berikut.</p>
    </div>
    <div class="bidang-grid">
      <div class="bidang-card v1">
        <span class="kategori">Bidang Pengembangan</span>
        <h3>Keagamaan, Dakwah &amp; Masjid<br><span style="font-weight:400;opacity:.8;font-size:12.5px;">LDNU · LBMNU · LTMNU · LFNU · LWPNU · ISHARI · JQHNU</span></h3>
        <span class="jadwal">Senin — Pkl. 11.00 s/d 13.00 WIB</span>
        <a class="selengkapnya" href="https://www.instagram.com/pcnu.kotapasuruan/?hl=en" target="_blank" rel="noopener">Selengkapnya</a>
      </div>
      <div class="bidang-card v2">
        <span class="kategori">Bidang Pengembangan</span>
        <h3>SDM, Pendidikan &amp; Kebudayaan<br><span style="font-weight:400;opacity:.8;font-size:12.5px;">LP Ma'arif NU · RMINU · LTNNU · LESBUMI NU · LAKPESDAM NU · PERGUNU · PAGARNUSA</span></h3>
        <span class="jadwal">Selasa — Pkl. 14.00 s/d 16.00 WIB</span>
        <a class="selengkapnya" href="https://www.youtube.com/channel/UCxxdFf1o_qCWp4ZBzeszryQ" target="_blank" rel="noopener">Selengkapnya</a>
      </div>
      <div class="bidang-card v3">
        <span class="kategori">Bidang Perekonomian</span>
        <h3>Ketahanan Pangan Ummat<br><span style="font-weight:400;opacity:.8;font-size:12.5px;">LPNU · LPPNU · ISNU</span></h3>
        <span class="jadwal">Rabu — Pkl. 12.00 s/d 14.00 WIB</span>
        <a class="selengkapnya" href="https://www.facebook.com/lpnukopas/photos" target="_blank" rel="noopener">Selengkapnya</a>
      </div>
    </div>
    <div class="unggulan-strip">
      <div class="unggulan-item">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M8 6h8M8 10h8M8 14h4"/></svg></div>
        <h4>Santri Digital</h4>
      </div>
      <div class="unggulan-item">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21c-4-3-8-6.5-8-11a5 5 0 019-3 5 5 0 019 3c0 4.5-4 8-8 11z"/></svg></div>
        <h4>Maslahah Umat</h4>
      </div>
      <div class="unggulan-item">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-6 4 4 4-8"/></svg></div>
        <h4>Nuconomic</h4>
      </div>
      <div class="unggulan-item">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg></div>
        <h4>Layanan &amp; Konsultasi</h4>
      </div>
    </div>
  </div>
</section>

<section class="program" id="program">
  <div class="wrap">
    <div class="divider"><span>Liputan Kegiatan</span></div>
    <div class="section-head">
      <h2>Sorotan Kegiatan</h2>
      <p>Beberapa kegiatan nyata yang pernah dan sedang dijalankan lembaga-lembaga di bawah PCNU Kota Pasuruan.</p>
    </div>
    <div class="program-grid">
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20"/></svg></div>
        <h3>Juleha — Juru Sembelih Halal</h3>
        <p>Pembinaan kader juru sembelih ayam potong sesuai syariat, sekaligus membuka peluang wirausaha bagi warga Nahdliyin.</p>
      </div>
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18"/></svg></div>
        <h3>Perlindungan Sosial BPJS</h3>
        <p>Kerja sama dengan BPJS Ketenagakerjaan untuk memberi jaminan sosial bagi warga NU di sektor mandiri.</p>
      </div>
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19V5a2 2 0 012-2h9l5 5v11a2 2 0 01-2 2H6a2 2 0 01-2-2z"/></svg></div>
        <h3>LP Ma'arif — Pendidikan</h3>
        <p>Menaungi ribuan siswa dan mengapresiasi guru lansia berdedikasi lewat Lencana Bintang Ma'arif NU.</p>
      </div>
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18M7 15l4-6 4 4 4-8"/></svg></div>
        <h3>NU Expo — Ekonomi Umat</h3>
        <p>Menggerakkan UMKM dan kolaborasi wirausaha warga Nahdliyin lewat NU Kulakukan (Nuku).</p>
      </div>
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21c-4-3-8-6.5-8-11a5 5 0 019-3 5 5 0 019 3c0 4.5-4 8-8 11z"/></svg></div>
        <h3>RMI — Pesantren</h3>
        <p>Menaungi belasan pondok pesantren di Kota Pasuruan dalam Robithah Ma'had Islamiyah.</p>
      </div>
      <div class="program-card">
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.5 14.2A8.5 8.5 0 119.8 3.5a6.8 6.8 0 0010.7 10.7z"/></svg></div>
        <h3>Huwal Habiban</h3>
        <p>Kegiatan rutin dzikir dan sholawat sebagai penjaga tradisi spiritual pengurus dan warga NU.</p>
      </div>
    </div>
  </div>
</section>

<section class="warta" id="artikel">
  <div class="wrap">
    <div class="divider"><span>Kajian & Fikrah</span></div>
    <div class="section-head">
      <h2>Artikel Pilihan</h2>
      <p>Catatan ilmiah, gagasan, serta ulasan seputar keislaman dan keorganisasian .</p>
    </div>
    <div class="news-grid" id="artikelGrid"></div>
    <div class="section-more">
      <a class="btn" href="<?php echo $baseUrl; ?>articles/">Lihat Semua Artikel <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
    </div>
  </div>
</section>

<div class="cta-banner" id="kontak">
  <div class="wrap cta-inner">
    <div>
      <h2>Ingin bersilaturahmi atau berkolaborasi dengan PCNU Kota Pasuruan?</h2>
      <p>Pengurus, lembaga, banom, hingga warga Nahdliyin dapat menghubungi kantor PCNU Kota Pasuruan untuk informasi lebih lanjut.</p>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>

<script src="<?php echo $baseUrl; ?>assets/common.js"></script>
<script src="<?php echo $baseUrl; ?>assets/program.js"></script>
<script>
(function(){
  "use strict";

  var heroSlideIndex = 0;
  var heroSlideTimer = null;

  function bangunDotHero(jumlah){
    var wadahDot = document.getElementById("heroCarouselDots");
    if(!wadahDot || jumlah <= 1) return;
    var html = "";
    for(var i = 0; i < jumlah; i++){
      html += '<button type="button" class="' + (i === 0 ? "active" : "") + '" data-index="' + i + '" aria-label="Slide ' + (i + 1) + '"></button>';
    }
    wadahDot.innerHTML = html;
    wadahDot.querySelectorAll("button").forEach(function(tombol){
      tombol.addEventListener("click", function(){
        pindahKeSlideHero(parseInt(this.getAttribute("data-index"), 10));
        aturUlangAutoplayHero(jumlah);
      });
    });
  }

  function perbaruiDotAktif(){
    var wadahDot = document.getElementById("heroCarouselDots");
    if(!wadahDot) return;
    wadahDot.querySelectorAll("button").forEach(function(tombol, i){
      tombol.classList.toggle("active", i === heroSlideIndex);
    });
  }

  function pindahKeSlideHero(index) {
    var track = document.getElementById("heroCarouselTrack");
    if (!track) return;

    var totalSlide = track.children.length;
    if (totalSlide === 0) return;

    heroSlideIndex = ((index % totalSlide) + totalSlide) % totalSlide;
    track.style.transform = "translateX(-" + (heroSlideIndex * 100) + "%)";

    perbaruiDotAktif();
  }

  function aturUlangAutoplayHero(jumlah){
    if(heroSlideTimer) clearInterval(heroSlideTimer);
    if(jumlah <= 1) return;
    heroSlideTimer = setInterval(function(){
      pindahKeSlideHero(heroSlideIndex + 1);
    }, 4500);
  }

  function pasangKontrolCarousel(){
    var tombolPrev = document.getElementById("heroPrev");
    var tombolNext = document.getElementById("heroNext");
    var track = document.getElementById("heroCarouselTrack");

    if(tombolPrev){
      tombolPrev.addEventListener("click", function(){
        var total = track ? track.querySelectorAll(".slide").length : 1;
        pindahKeSlideHero(heroSlideIndex - 1);
        aturUlangAutoplayHero(total);
      });
    }
    if(tombolNext){
      tombolNext.addEventListener("click", function(){
        var total = track ? track.querySelectorAll(".slide").length : 1;
        pindahKeSlideHero(heroSlideIndex + 1);
        aturUlangAutoplayHero(total);
      });
    }
  }

  function muatHeroCarousel(){
    fetchGambarDariMediaLibrary("search=hero-img&per_page=10")
      .then(function(gambar){
        if(!gambar.length) return;

        var track = document.getElementById("heroCarouselTrack");
        if(!track) return;

        track.innerHTML = gambar.map(function(url){
          return '<div class="slide"><img src="' + url + '" alt="Kegiatan PCNU Kota Pasuruan" loading="lazy"></div>';
        }).join("");

        bangunDotHero(gambar.length);
        pindahKeSlideHero(0);
        aturUlangAutoplayHero(gambar.length);
      })
      .catch(function(err){
        console.warn("Carousel hero pakai ikon fallback:", err.message);
      });
  }

  function ambilGambarDariPages(){
    return fetch(API_ROOT + "wp/v2/pages?_embed&per_page=50&orderby=date&order=desc")
      .then(function(r){ return r.ok ? r.json() : []; })
      .catch(function(){ return []; })
      .then(function(semuaItem){
        semuaItem = Array.isArray(semuaItem) ? semuaItem : [];
        semuaItem.sort(function(a, b){ return new Date(b.date) - new Date(a.date); });

        var semuaGambar = [];
        semuaItem.forEach(function(item){
          var tanggalItem = new Date(item.date);
          var featured = ambilFeaturedImage(item);
          if(featured) semuaGambar.push({ url: featured, tanggal: tanggalItem });
          if(item.content && item.content.rendered){
            ambilSemuaGambarKonten(item.content.rendered).forEach(function(url){
              semuaGambar.push({ url: url, tanggal: tanggalItem });
            });
          }
        });
        return semuaGambar;
      });
  }

  function muatGaleri(){
    var track = document.getElementById("galeriTrack");
    if(!track) return;

    var skelHtml = "";
    for(var i = 0; i < 6; i++){ skelHtml += '<div class="galeri-skel"></div>'; }
    track.innerHTML = skelHtml;
    track.style.animation = "none";

    Promise.all([
      ambilGambarDariPages(),
      fetchGambarDenganTanggalDariMediaLibrary("search=galeri&per_page=100&orderby=date&order=desc")
    ])
    .then(function(hasil){
      var gabungan = hasil[0].concat(hasil[1]);
      gabungan.sort(function(a, b){ return b.tanggal - a.tanggal; });

      var urlSudahAda = {};
      var gambarUnik = [];
      gabungan.forEach(function(item){
        if(item.url && !urlSudahAda[item.url]){
          urlSudahAda[item.url] = true;
          gambarUnik.push(item.url);
        }
      });

      if(gambarUnik.length) return gambarUnik;

      return fetchGambarDariMediaLibrary("per_page=30&media_type=image&orderby=date&order=desc");
    })
    .then(function(gambarFinal){
      if(!gambarFinal || !gambarFinal.length){
        track.innerHTML = '<div class="galeri-item"><div class="ph-fallback">' + GAMBAR_KOSONG_HTML + '</div></div>';
        track.style.animation = "none";
        return;
      }

      var gambarDipadatkan = gambarFinal.slice();
      while(gambarDipadatkan.length < 10 && gambarFinal.length > 0){
        gambarDipadatkan = gambarDipadatkan.concat(gambarFinal);
      }

      var setGanda = gambarDipadatkan.concat(gambarDipadatkan);
      track.innerHTML = setGanda.map(galeriKartuHTML).join("");
      track.style.animation = "";
    })
    .catch(function(err){
      console.warn("Galeri belum bisa dimuat:", err.message);
      track.innerHTML = '<div class="galeri-item"><div class="ph-fallback">' + GAMBAR_KOSONG_HTML + '</div></div>';
      track.style.animation = "none";
    });
  }

  function muatWarta(){
    var grid = document.getElementById("newsGrid");
    if(!grid) return;
    tampilkanSkeleton(grid, 9);

    fetch(API_ROOT + "wp/v2/pages?_embed&per_page=9&orderby=date&order=desc")
      .then(function(res){
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        return res.json();
      })
      .then(function(daftarItem){
        if(!Array.isArray(daftarItem) || daftarItem.length === 0){
          tampilkanErrorBerita(grid, "Belum ada berita yang bisa ditampilkan.", muatWarta);
          return;
        }
        var kartuHtml = "";
        daftarItem.forEach(function(item){
          kartuHtml += kartuBeritaHTML(item, ambilFeaturedImage(item));
        });
        grid.innerHTML = kartuHtml;
        daftarkanReveal(grid.querySelectorAll(".news-card"));
      })
      .catch(function(err){
        tampilkanErrorBerita(grid, "Berita belum bisa dimuat (" + err.message + ").", muatWarta);
      });
  }

  function muatArtikel(){
    var grid = document.getElementById("artikelGrid");
    if(!grid) return;
    tampilkanSkeleton(grid, 6);

    Promise.all([
      fetch(API_ROOT + "wp/v2/tags?per_page=100").then(function(res){ return res.json(); }).catch(function(){ return []; }),
      fetch(API_ROOT + "wp/v2/posts?_embed&categories=7&per_page=6&orderby=date&order=desc").then(function(res){
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        return res.json();
      })
    ])
    .then(function(results){
      var semuaTag = results[0];
      var daftarItem = results[1];

      var tagDict = {};
      if(Array.isArray(semuaTag)){
        semuaTag.forEach(function(tag){ tagDict[tag.id] = tag.name; });
      }

      if(!Array.isArray(daftarItem) || daftarItem.length === 0){
        tampilkanErrorBerita(grid, "Belum ada artikel yang dipublikasikan.", muatArtikel);
        return;
      }

      var kartuHtml = "";
      daftarItem.forEach(function(item){
        var gambar = ambilFeaturedImage(item);
        var namaTag = "";
        if(item.tags && item.tags.length > 0){
          namaTag = tagDict[item.tags[0]] || "";
        }
        kartuHtml += kartuBeritaHTML(item, gambar, namaTag);
      });

      grid.innerHTML = kartuHtml;
      daftarkanReveal(grid.querySelectorAll(".news-card"));
    })
    .catch(function(err){
      tampilkanErrorBerita(grid, "Artikel belum bisa dimuat (" + err.message + ").", muatArtikel);
    });
  }

  /* ---------------------------------------------------------
     AUTO-SCROLL GALERI + INTERAKSI MANUAL + LIGHTBOX
     --------------------------------------------------------- */
  var GALERI_DURASI_MS   = 250000;
  var GALERI_JEDA_RESUME = 2200;
  var galeriRAF        = null;
  var galeriJedaSampai  = 0;
  var galeriWaktuLalu   = null;

  function tundaAutoScrollGaleri(){
    galeriJedaSampai = performance.now() + GALERI_JEDA_RESUME;
  }

  function jalankanAutoScrollGaleri(){
    var wrap  = document.getElementById("galeriWrap");
    var track = document.getElementById("galeriTrack");
    if(!wrap || !track) return;
    if(galeriRAF) cancelAnimationFrame(galeriRAF);

    function langkah(waktu){
      galeriRAF = requestAnimationFrame(langkah);

      if(galeriWaktuLalu === null) galeriWaktuLalu = waktu;
      var delta = waktu - galeriWaktuLalu;
      galeriWaktuLalu = waktu;

      if(performance.now() < galeriJedaSampai) return;

      var setLebar = track.scrollWidth / 2;
      if(!setLebar || setLebar <= 0) return;

      var kecepatanPerMs = setLebar / GALERI_DURASI_MS;
      wrap.scrollLeft += kecepatanPerMs * delta;

      if(wrap.scrollLeft >= setLebar){
        wrap.scrollLeft -= setLebar;
      }
    }
    galeriRAF = requestAnimationFrame(langkah);
  }

  function pasangInteraksiManualGaleri(){
    var wrap = document.getElementById("galeriWrap");
    if(!wrap) return;

    var sedangDrag  = false;
    var sudahGeser  = false;
    var mulaiX      = 0;
    var mulaiScroll = 0;

    wrap.addEventListener("wheel", tundaAutoScrollGaleri, { passive:true });
    wrap.addEventListener("touchstart", tundaAutoScrollGaleri, { passive:true });
    wrap.addEventListener("touchmove", tundaAutoScrollGaleri, { passive:true });
    wrap.addEventListener("keydown", function(e){
      if(["ArrowLeft","ArrowRight","Home","End"].indexOf(e.key) !== -1){
        tundaAutoScrollGaleri();
      }
    });

    wrap.addEventListener("mousedown", function(e){
      sedangDrag = true;
      sudahGeser = false;
      wrap.classList.add("is-dragging");
      mulaiX = e.pageX - wrap.offsetLeft;
      mulaiScroll = wrap.scrollLeft;
      tundaAutoScrollGaleri();
    });

    window.addEventListener("mousemove", function(e){
      if(!sedangDrag) return;
      var x = e.pageX - wrap.offsetLeft;
      var jarak = x - mulaiX;
      if(Math.abs(jarak) > 4) sudahGeser = true;
      e.preventDefault();
      wrap.scrollLeft = mulaiScroll - jarak * 1.15;
      tundaAutoScrollGaleri();
    });

    window.addEventListener("mouseup", function(){
      if(!sedangDrag) return;
      sedangDrag = false;
      wrap.classList.remove("is-dragging");
      tundaAutoScrollGaleri();
    });

    wrap.addEventListener("click", function(e){
      if(sudahGeser){
        e.stopPropagation();
        e.preventDefault();
        sudahGeser = false;
      }
    }, true);
  }

  function pasangLightboxGaleri(){
    var track      = document.getElementById("galeriTrack");
    var lightbox   = document.getElementById("fotoLightbox");
    var lbImg      = document.getElementById("lightboxImg");
    var tombolTutup = document.getElementById("lightboxClose");
    var backdrop   = document.getElementById("lightboxBackdrop");
    if(!track || !lightbox || !lbImg) return;

    function bukaLightbox(src, alt){
      lbImg.src = src;
      lbImg.alt = alt || "Pratinjau foto";
      lightbox.classList.add("is-open");
      lightbox.setAttribute("aria-hidden", "false");
      document.body.classList.add("lightbox-open");
    }

    function tutupLightbox(){
      lightbox.classList.remove("is-open");
      lightbox.setAttribute("aria-hidden", "true");
      document.body.classList.remove("lightbox-open");
    }

    track.addEventListener("click", function(e){
      var img = e.target.closest ? e.target.closest(".galeri-item img") : null;
      if(!img) return;
      bukaLightbox(img.src, img.alt);
    });

    if(tombolTutup) tombolTutup.addEventListener("click", tutupLightbox);
    if(backdrop) backdrop.addEventListener("click", tutupLightbox);
    document.addEventListener("keydown", function(e){
      if(e.key === "Escape") tutupLightbox();
    });
  }

  /* ---------------------------------------------------------
     COUNT-UP ANGKA FAKTA
     --------------------------------------------------------- */
  function easeOutQuart(t){ return 1 - Math.pow(1 - t, 4); }

  function animasiHitungAngka(elemen){
    var target = parseFloat(elemen.getAttribute("data-count-to"));
    if(isNaN(target)) return;
    var format = elemen.getAttribute("data-count-format") || "int";
    var prefix = elemen.getAttribute("data-count-prefix") || "";
    var durasi = 1500;
    var mulai = null;

    function langkah(waktu){
      if(mulai === null) mulai = waktu;
      var progres = Math.min((waktu - mulai) / durasi, 1);
      var nilai = Math.round(target * easeOutQuart(progres));
      var teks = format === "id" ? nilai.toLocaleString("id-ID") : String(nilai);
      elemen.textContent = prefix + teks;
      if(progres < 1) requestAnimationFrame(langkah);
    }
    requestAnimationFrame(langkah);
  }

  function pasangCountUp(){
    var elemenAngka = document.querySelectorAll("[data-count-to]");
    if(!elemenAngka.length) return;
    if(!("IntersectionObserver" in window)){
      elemenAngka.forEach(animasiHitungAngka);
      return;
    }
    var observer = new IntersectionObserver(function(entries, obs){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          animasiHitungAngka(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold:0.5 });
    elemenAngka.forEach(function(el){ observer.observe(el); });
  }

  function pasangScrollRevealHalamanIni(){
    daftarkanReveal(document.querySelectorAll(".section-head"));
    daftarkanReveal(document.querySelectorAll(".bidang-card"));
    daftarkanReveal(document.querySelectorAll(".pimpinan-card"));
    daftarkanReveal(document.querySelectorAll(".unggulan-item"));
    daftarkanReveal(document.querySelectorAll(".profil-block"));
    daftarkanReveal(document.querySelectorAll(".profil-card"));
    daftarkanReveal(document.querySelectorAll(".profil-photos img"));
    daftarkanReveal(document.querySelectorAll(".program-card"));
    daftarkanReveal(document.querySelectorAll(".cta-inner > div"));
  }

  /* ---------------------------------------------------------
     EFEK LANDING: sorotan kursor & kemiringan 3D di hero,
     paralaks kaligrafi, dan garis progres gulir
     --------------------------------------------------------- */
  function pasangEfekLanding(){
    var hero = document.querySelector(".hero");
    var visual = document.getElementById("heroVisual");
    var progres = document.getElementById("progresGulir");
    var kurangiGerak = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var bisaHover = window.matchMedia && window.matchMedia("(hover: hover) and (pointer: fine)").matches;
    var antreBingkai = false;
    var posisiKursor = null;

    function gambarUlang(){
      antreBingkai = false;
      var gulir = window.pageYOffset || document.documentElement.scrollTop;
      var tinggiDok = document.documentElement.scrollHeight - window.innerHeight;
      if(progres) progres.style.transform = "scaleX(" + (tinggiDok > 0 ? Math.min(gulir / tinggiDok, 1) : 0) + ")";
      if(!hero || kurangiGerak) return;
      var tinggiHero = hero.offsetHeight;
      if(gulir < tinggiHero){
        hero.style.setProperty("--gulir", Math.round(gulir));
      }
      if(posisiKursor && visual){
        var kotak = hero.getBoundingClientRect();
        var x = (posisiKursor.x - kotak.left) / kotak.width;
        var y = (posisiKursor.y - kotak.top) / kotak.height;
        hero.style.setProperty("--kursor-x", (x * 100).toFixed(1) + "%");
        hero.style.setProperty("--kursor-y", (y * 100).toFixed(1) + "%");
        visual.style.setProperty("--miring-x", ((0.5 - y) * 7).toFixed(2) + "deg");
        visual.style.setProperty("--miring-y", ((x - 0.5) * 9).toFixed(2) + "deg");
      }
    }
    function minta(){
      if(antreBingkai) return;
      antreBingkai = true;
      requestAnimationFrame(gambarUlang);
    }

    window.addEventListener("scroll", minta, { passive:true });
    window.addEventListener("resize", minta);
    if(hero && bisaHover && !kurangiGerak){
      hero.addEventListener("pointermove", function(e){
        posisiKursor = { x:e.clientX, y:e.clientY };
        hero.classList.add("hero-aktif");
        minta();
      });
      hero.addEventListener("pointerleave", function(){
        posisiKursor = null;
        hero.classList.remove("hero-aktif");
        if(visual){
          visual.style.setProperty("--miring-x", "0deg");
          visual.style.setProperty("--miring-y", "0deg");
        }
      });
    }
    minta();
  }

  /* ---------------------------------------------------------
     PARTIKEL HERO: butiran cahaya emas melayang naik, berkelip,
     dan menyingkir pelan dari kursor. Berhenti saat hero tidak
     terlihat atau tab disembunyikan.
     --------------------------------------------------------- */
  function pasangPartikelHero(){
    var kanvas = document.getElementById("heroPartikel");
    var hero = document.querySelector(".hero");
    if(!kanvas || !hero || !kanvas.getContext) return;
    var ctx = kanvas.getContext("2d");
    var kurangiGerak = window.matchMedia && window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var rasio = Math.min(window.devicePixelRatio || 1, 2);
    var lebar = 0, tinggi = 0;
    var partikel = [];
    var kursor = null;
    var terlihat = true;
    var idBingkai = null;
    var waktuLalu = 0;

    function buatPartikel(acakTinggi){
      var kedalaman = Math.random();               /* 0 = jauh, 1 = dekat */
      return {
        x: Math.random() * lebar,
        y: acakTinggi ? Math.random() * tinggi : tinggi + 10,
        r: 0.7 + kedalaman * 2.6,
        vy: 6 + kedalaman * 22,                    /* px per detik */
        goyang: Math.random() * Math.PI * 2,
        lajuGoyang: 0.4 + Math.random() * 0.8,
        amplitudo: 6 + Math.random() * 18,
        kelip: Math.random() * Math.PI * 2,
        lajuKelip: 0.8 + Math.random() * 1.6,
        terang: 0.4 + kedalaman * 0.6,
        dx: 0, dy: 0
      };
    }

    function ukurUlang(){
      lebar = hero.offsetWidth;
      tinggi = hero.offsetHeight;
      kanvas.width = Math.round(lebar * rasio);
      kanvas.height = Math.round(tinggi * rasio);
      ctx.setTransform(rasio, 0, 0, rasio, 0, 0);
      var target = Math.round(Math.min(140, Math.max(40, lebar * tinggi / 8500)));
      while(partikel.length < target) partikel.push(buatPartikel(true));
      partikel.length = target;
    }

    function gambar(waktu){
      var dt = waktuLalu ? Math.min((waktu - waktuLalu) / 1000, 0.05) : 0.016;
      waktuLalu = waktu;
      ctx.clearRect(0, 0, lebar, tinggi);
      ctx.globalCompositeOperation = "lighter";
      for(var i = 0; i < partikel.length; i++){
        var p = partikel[i];
        p.y -= p.vy * dt;
        p.goyang += p.lajuGoyang * dt;
        p.kelip += p.lajuKelip * dt;

        /* Dorongan halus menjauhi kursor, lalu kembali pelan */
        if(kursor){
          var jx = p.x + p.dx - kursor.x, jy = p.y + p.dy - kursor.y;
          var jarak2 = jx * jx + jy * jy;
          if(jarak2 < 22500){
            var kuat = (1 - Math.sqrt(jarak2) / 150) * 60 * dt;
            var jarak = Math.sqrt(jarak2) || 1;
            p.dx += jx / jarak * kuat;
            p.dy += jy / jarak * kuat;
          }
        }
        p.dx *= 0.96; p.dy *= 0.96;

        if(p.y < -12){ partikel[i] = buatPartikel(false); continue; }
        var x = p.x + Math.sin(p.goyang) * p.amplitudo + p.dx;
        var y = p.y + p.dy;
        var alfa = p.terang * (0.55 + 0.45 * Math.sin(p.kelip));
        /* Pudar di dekat tepi atas supaya tidak terpotong tiba-tiba */
        alfa *= Math.min(1, y / (tinggi * 0.25));
        if(alfa <= 0) continue;

        var g = ctx.createRadialGradient(x, y, 0, x, y, p.r * 4);
        g.addColorStop(0, "rgba(255,226,150," + alfa.toFixed(3) + ")");
        g.addColorStop(0.35, "rgba(227,183,90," + (alfa * 0.45).toFixed(3) + ")");
        g.addColorStop(1, "rgba(227,183,90,0)");
        ctx.fillStyle = g;
        ctx.beginPath();
        ctx.arc(x, y, p.r * 4, 0, Math.PI * 2);
        ctx.fill();
      }
      ctx.globalCompositeOperation = "source-over";
      idBingkai = requestAnimationFrame(gambar);
    }

    function mulai(){
      if(idBingkai || !terlihat || document.hidden) return;
      waktuLalu = 0;
      idBingkai = requestAnimationFrame(gambar);
    }
    function berhenti(){
      if(idBingkai) cancelAnimationFrame(idBingkai);
      idBingkai = null;
    }

    ukurUlang();
    if(kurangiGerak){
      /* Tanpa gerak: cukup gambar sekali sebagai taburan diam */
      gambar(16);
      berhenti();
      return;
    }

    var tundaUkur = null;
    function jadwalkanUkur(){
      clearTimeout(tundaUkur);
      tundaUkur = setTimeout(ukurUlang, 150);
    }
    window.addEventListener("resize", jadwalkanUkur);
    /* Tinggi hero bisa berubah setelah foto carousel termuat */
    if("ResizeObserver" in window) new ResizeObserver(jadwalkanUkur).observe(hero);
    hero.addEventListener("pointermove", function(e){
      var kotak = hero.getBoundingClientRect();
      kursor = { x:e.clientX - kotak.left, y:e.clientY - kotak.top };
    });
    hero.addEventListener("pointerleave", function(){ kursor = null; });
    document.addEventListener("visibilitychange", function(){
      if(document.hidden) berhenti(); else mulai();
    });
    if("IntersectionObserver" in window){
      new IntersectionObserver(function(entries){
        terlihat = entries[0].isIntersecting;
        if(terlihat) mulai(); else berhenti();
      }).observe(hero);
    }
    mulai();
  }

  document.addEventListener("DOMContentLoaded", function(){
    initTemaBersama();
    pasangEfekLanding();
    pasangPartikelHero();
    muatHeroCarousel();
    muatWarta();
    muatProgramBeranda("programGrid", 6);
    muatArtikel();
    muatGaleri();
    pasangKontrolCarousel();
    pasangCountUp();
    pasangScrollRevealHalamanIni();
    pasangInteraksiManualGaleri();
    pasangLightboxGaleri();
    jalankanAutoScrollGaleri();
  });
})();
</script>
</body>
</html>

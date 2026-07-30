<?php
$tahun = date('Y');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PCNU Kota Pasuruan — Nahdlatul Ulama Cabang Kota Pasuruan</title>
<meta name="description" content="Situs resmi Pengurus Cabang Nahdlatul Ulama (PCNU) Kota Pasuruan. Warta kegiatan, khidmah umat, dan lembaga-lembaga NU di Kota Pasuruan.">
<link rel="icon" href="https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
/* ============================================================
   TOKENS
   ============================================================ */
:root{
  --hijau-deep:   #082921;
  --hijau:        #0E3B2E;
  --hijau-soft:   #17513F;
  --emas:         #C1932F;
  --emas-terang:  #E3B75A;
  --emas-pucat:   #F1E3C0;
  --kertas:       #F6F2E6;
  --kertas-tua:   #EFE8D6;
  --tinta:        #1C1B14;
  --tinta-lunak:  #55523F;
  --garis:        rgba(28,27,20,0.12);
  --putih:        #FFFDF7;

  --serif: "Lora", Georgia, serif;
  --sans:  "Plus Jakarta Sans", system-ui, -apple-system, sans-serif;
  --mono:  "Space Mono", monospace;

  --maxw: 1180px;
  --radius: 6px;
}

*,*::before,*::after{ box-sizing:border-box; }
html{ scroll-behavior:smooth; }
body{
  margin:0;
  font-family:var(--sans);
  color:var(--tinta);
  background:var(--kertas);
  line-height:1.6;
  -webkit-font-smoothing:antialiased;
}
img{ max-width:100%; display:block; }
a{ color:inherit; text-decoration:none; }
h1,h2,h3,h4{ font-family:var(--serif); margin:0; line-height:1.15; font-weight:600; }
p{ margin:0; }
ul{ margin:0; padding:0; list-style:none; }
button{ font-family:inherit; cursor:pointer; }

.wrap{
  max-width:var(--maxw);
  margin:0 auto;
  padding:0 24px;
}

:focus-visible{
  outline:3px solid var(--emas);
  outline-offset:2px;
}

@media (prefers-reduced-motion: reduce){
  *{ animation-duration:0.001ms !important; animation-iteration-count:1 !important; transition-duration:0.001ms !important; scroll-behavior:auto !important; }
}
.motif-star{
  display:inline-block;
  width:1em;
  height:1em;
  background: currentColor;
  clip-path: polygon(
    50% 0%, 61% 20%, 82% 8%, 78% 30%, 100% 33%, 84% 48%,
    100% 63%, 78% 68%, 82% 90%, 61% 78%, 50% 100%, 39% 78%,
    18% 90%, 22% 68%, 0% 63%, 16% 48%, 0% 33%, 22% 30%,
    18% 8%, 39% 20%
  );
}

.divider{
  display:flex;
  align-items:center;
  gap:14px;
  color:var(--emas);
  margin:0 0 18px;
}
.divider::after{
  content:"";
  height:1px;
  flex:1;
  background:linear-gradient(to right, var(--garis), transparent);
}
.divider .motif-star{ width:14px; height:14px; }
.divider span{
  font-family:var(--mono);
  font-size:12px;
  letter-spacing:.16em;
  text-transform:uppercase;
  color:var(--hijau-soft);
}
.top-strip{
  background:var(--hijau-deep);
  color:var(--emas-pucat);
  font-family:var(--mono);
  font-size:12px;
  letter-spacing:.03em;
}
.top-strip .wrap{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding-top:7px;
  padding-bottom:7px;
  gap:12px;
  flex-wrap:wrap;
}
.top-strip .meta-loc{ opacity:.85; }
.top-strip nav{ display:flex; gap:18px; }
.top-strip nav a:hover{ color:var(--emas-terang); }

header.site-header{
  position:sticky;
  top:0;
  z-index:50;
  background:var(--hijau);
  border-bottom:1px solid rgba(255,255,255,.08);
}
.site-header .wrap{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding-top:14px;
  padding-bottom:14px;
  gap:20px;
}
.brand{
  display:flex;
  align-items:center;
  gap:14px;
  color:var(--putih);
  min-width:0;
}
.brand img{
  width:46px; height:46px;
  border-radius:50%;
  object-fit:cover;
  border:2px solid var(--emas);
  background:var(--putih);
  flex-shrink:0;
}
.brand .brand-fallback{
  width:46px;height:46px;border-radius:50%;
  border:2px solid var(--emas);
  background:var(--hijau-deep);
  display:flex;align-items:center;justify-content:center;
  color:var(--emas-terang); flex-shrink:0;
}
.brand-text{ 
  min-width:0; 
  margin-top: 4px;
}
.brand-text strong{
  font-family:var(--serif);
  font-size:17px;
  font-weight:700;
  display:block;
  white-space:nowrap;
  line-height: 0.8;
}
.brand-text small{
  font-family:var(--mono);
  font-size:10.5px;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:var(--emas-pucat);
  opacity:.85;
}

nav.main-nav{ display:flex; gap:30px; }
nav.main-nav a{
  color:var(--kertas-tua);
  font-size:14.5px;
  font-weight:500;
  position:relative;
  padding:6px 0;
}
nav.main-nav a::after{
  content:"";
  position:absolute; left:0; right:0; bottom:0;
  height:2px; background:var(--emas);
  transform:scaleX(0); transform-origin:left;
  transition:transform .25s ease;
}
nav.main-nav a:hover::after{ transform:scaleX(1); }
nav.main-nav a:hover{ color:var(--putih); }

.nav-toggle{
  display:none;
  background:none; border:1px solid rgba(255,255,255,.3);
  border-radius:var(--radius);
  color:var(--putih); padding:8px 10px;
}
.hero{
  position:relative;
  background:var(--hijau-deep);
  color:var(--putih);
  overflow:hidden;
  padding:72px 0 96px;
}
.hero::before{
  content:"";
  position:absolute; inset:0;
  background-image:
    radial-gradient(circle at 15% 20%, rgba(193,147,47,.16), transparent 45%),
    radial-gradient(circle at 85% 80%, rgba(193,147,47,.10), transparent 40%);
  pointer-events:none;
}
.hero .wrap{
  position:relative;
  display:grid;
  grid-template-columns:1.05fr .95fr;
  gap:56px;
  align-items:center;
}
.eyebrow{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-family:var(--mono);
  font-size:12.5px;
  letter-spacing:.14em;
  text-transform:uppercase;
  color:var(--emas-terang);
  margin-bottom:20px;
}
.hero h1{
  font-size:clamp(32px, 4.6vw, 54px);
  color:var(--putih);
  margin-bottom:22px;
  max-width:16ch;
}
.hero h1 em{
  font-style:italic;
  color:var(--emas-terang);
}
.hero p.lead{
  font-size:17px;
  color:rgba(255,253,247,.82);
  max-width:52ch;
  margin-bottom:32px;
}
.cta-row{ display:flex; gap:14px; flex-wrap:wrap; }
.btn{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:13px 22px;
  border-radius:999px;
  font-weight:600;
  font-size:14.5px;
  border:1px solid transparent;
  transition:transform .18s ease, background .18s ease, border-color .18s ease;
}
.btn:hover{ transform:translateY(-2px); }
.btn-emas{ background:var(--emas); color:var(--hijau-deep); }
.btn-emas:hover{ background:var(--emas-terang); }
.btn-ghost{ border-color:rgba(255,255,255,.35); color:var(--putih); }
.btn-ghost:hover{ border-color:var(--emas-terang); color:var(--emas-terang); }

.hero-visual{
  position:relative;
  aspect-ratio:1/1;
  max-width:440px;
  margin:0 auto;
}
.star-frame{
  position:absolute; inset:0;
  clip-path: polygon(
    50% 0%, 61% 12%, 82% 4%, 79% 22%, 100% 25%, 87% 40%,
    100% 55%, 79% 58%, 82% 78%, 61% 68%, 50% 100%, 39% 68%,
    18% 78%, 21% 58%, 0% 55%, 13% 40%, 0% 25%, 21% 22%,
    18% 4%, 39% 12%
  );
  background:linear-gradient(135deg, var(--emas), var(--hijau-soft));
  padding:6px;
}
.star-frame .inner{
  width:100%; height:100%;
  clip-path: inherit;
  background:var(--hijau-deep);
  position:relative;
  overflow:hidden;
}
.star-frame .inner img{
  position:absolute; inset:0;
  width:100%; height:100%; object-fit:cover;
  opacity:0; transition:opacity 1.1s ease;
}
.star-frame .inner img.active{ opacity:1; }
.star-frame .inner .ph-fallback{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  color:var(--emas-terang); opacity:.4;
}
.star-frame .inner .ph-fallback svg{ width:40%; height:40%; }

.fact-strip{
  background:var(--emas-pucat);
  border-bottom:1px solid var(--garis);
}
.fact-strip .wrap{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:0;
}
.fact{
  padding:26px 20px;
  text-align:center;
  border-right:1px solid var(--garis);
}
.fact:last-child{ border-right:none; }
.fact strong{
  display:block;
  font-family:var(--serif);
  font-size:clamp(22px,3vw,32px);
  color:var(--hijau);
}
.fact span{
  font-family:var(--mono);
  font-size:11.5px;
  letter-spacing:.05em;
  color:var(--tinta-lunak);
}

section{ padding:80px 0; }
.section-head{
  max-width:640px;
  margin-bottom:44px;
}
.section-head h2{
  font-size:clamp(26px,3.4vw,38px);
  color:var(--hijau);
}
.section-head p{
  margin-top:14px;
  color:var(--tinta-lunak);
  font-size:15.5px;
}

.warta{ background:var(--kertas); }
.news-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:26px;
}
.news-card{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:var(--radius);
  overflow:hidden;
  display:flex;
  flex-direction:column;
  transition:transform .2s ease, box-shadow .2s ease;
}
.news-card:hover{
  transform:translateY(-4px);
  box-shadow:0 18px 34px -20px rgba(8,41,33,.35);
}
.news-thumb{
  aspect-ratio:16/10;
  background:var(--hijau);
  position:relative;
  overflow:hidden;
}
.news-thumb img{ width:100%; height:100%; object-fit:cover; }
.news-thumb .ph-fallback{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  color:var(--emas-terang); opacity:.55;
}
.news-thumb .ph-fallback svg{ width:26%; height:26%; }
.news-body{
  padding:20px 22px 24px;
  display:flex;
  flex-direction:column;
  gap:12px;
  flex:1;
}
.news-date{
  font-family:var(--mono);
  font-size:11px;
  letter-spacing:.06em;
  text-transform:uppercase;
  color:var(--emas);
}
.news-body h3{
  font-size:18px;
  color:var(--tinta);
  font-weight:600;
  line-height:1.35;
}
.news-body p{
  font-size:14px;
  color:var(--tinta-lunak);
  flex:1;
}
.news-link{
  font-size:13.5px;
  font-weight:700;
  color:var(--hijau);
  display:inline-flex;
  align-items:center;
  gap:6px;
  margin-top:4px;
}
.news-link svg{ width:14px; height:14px; transition:transform .18s ease; }
.news-card:hover .news-link svg{ transform:translateX(3px); }

.news-skel{
  background:linear-gradient(100deg, var(--kertas-tua) 30%, var(--putih) 50%, var(--kertas-tua) 70%);
  background-size:200% 100%;
  animation:shimmer 1.5s infinite;
}
@keyframes shimmer{
  0%{ background-position:200% 0; }
  100%{ background-position:-200% 0; }
}
.news-error{
  grid-column:1/-1;
  text-align:center;
  padding:40px 24px;
  border:1px dashed var(--garis);
  border-radius:var(--radius);
  color:var(--tinta-lunak);
}
.news-error button{
  margin-top:14px;
  background:var(--hijau);
  color:var(--putih);
  border:none;
  padding:10px 20px;
  border-radius:999px;
  font-weight:600;
  font-size:13.5px;
}

.profil{ background:var(--kertas-tua); }
.profil-grid{
  display:grid;
  grid-template-columns:1.3fr .9fr;
  gap:48px;
  align-items:start;
}
.profil-text p{
  color:var(--tinta-lunak);
  font-size:15px;
  margin-bottom:16px;
}
.profil-text strong{ color:var(--tinta); }
.profil-block{ margin-bottom:26px; }
.profil-block h3{
  font-size:15px;
  font-family:var(--sans);
  font-weight:700;
  color:var(--hijau);
  display:flex;
  align-items:center;
  gap:8px;
  margin-bottom:10px;
  letter-spacing:.01em;
}
.profil-block h3 .motif-star{ width:12px; height:12px; color:var(--emas); flex-shrink:0; }
.profil-list{ display:flex; flex-wrap:wrap; gap:8px; }
.chip{
  font-family:var(--mono);
  font-size:11.5px;
  letter-spacing:.02em;
  padding:6px 12px;
  border:1px solid var(--garis);
  border-radius:999px;
  background:var(--putih);
  color:var(--tinta-lunak);
}
.profil-side{
  position:sticky;
  top:100px;
}
.profil-card{
  background:var(--hijau-deep);
  color:var(--putih);
  border-radius:var(--radius);
  padding:26px;
  margin-bottom:18px;
}
.profil-card .label{
  font-family:var(--mono);
  font-size:11px;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:var(--emas-terang);
  display:block;
  margin-bottom:10px;
}
.profil-card address{
  font-style:normal;
  font-size:15px;
  line-height:1.55;
  margin-bottom:16px;
}
.profil-card a.map-link{
  display:inline-flex;
  align-items:center;
  gap:8px;
  font-size:13.5px;
  font-weight:700;
  color:var(--emas-terang);
  border:1px solid rgba(255,255,255,.25);
  padding:9px 16px;
  border-radius:999px;
}
.profil-card a.map-link:hover{ border-color:var(--emas-terang); }
.profil-photos{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:10px;
}
.profil-photos img{
  width:100%; height:110px; object-fit:cover;
  border-radius:var(--radius);
  border:1px solid var(--garis);
}

/* ---------- Layanan & Konsultasi (bidang) ---------- */
.layanan{ background:var(--kertas); }
.bidang-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:22px;
  margin-bottom:40px;
}
.bidang-card{
  border-radius:var(--radius);
  padding:28px 26px;
  color:var(--putih);
  position:relative;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  min-height:220px;
}
.bidang-card::after{
  content:"";
  position:absolute; right:-30px; bottom:-30px;
  width:120px; height:120px;
  opacity:.12;
  background:currentColor;
  clip-path: polygon(50% 0%, 61% 20%, 82% 8%, 78% 30%, 100% 33%, 84% 48%, 100% 63%, 78% 68%, 82% 90%, 61% 78%, 50% 100%, 39% 78%, 18% 90%, 22% 68%, 0% 63%, 16% 48%, 0% 33%, 22% 30%, 18% 8%, 39% 20%);
}
.bidang-card.v1{ background:var(--hijau-deep); }
.bidang-card.v2{ background:var(--hijau-soft); }
.bidang-card.v3{ background:#5C4420; }
.bidang-card .kategori{
  font-family:var(--mono);
  font-size:11px;
  letter-spacing:.06em;
  text-transform:uppercase;
  color:var(--emas-terang);
  margin-bottom:10px;
}
.bidang-card h3{
  font-size:16.5px;
  font-family:var(--sans);
  font-weight:800;
  line-height:1.4;
  margin-bottom:14px;
  position:relative;
}
.bidang-card .jadwal{
  font-size:13px;
  color:rgba(255,253,247,.75);
  margin-top:auto;
  margin-bottom:14px;
  position:relative;
}
.bidang-card a.selengkapnya{
  align-self:flex-start;
  font-size:13px;
  font-weight:700;
  border:1.5px solid rgba(255,255,255,.5);
  padding:9px 16px;
  border-radius:2px;
  position:relative;
}
.bidang-card a.selengkapnya:hover{ border-color:var(--emas-terang); color:var(--emas-terang); }

.unggulan-strip{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:16px;
}
.unggulan-item{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:var(--radius);
  padding:20px;
  text-align:center;
}
.unggulan-item .icon{
  width:40px;height:40px;
  margin:0 auto 12px;
  border-radius:50%;
  background:var(--emas-pucat);
  color:var(--hijau);
  display:flex;align-items:center;justify-content:center;
}
.unggulan-item .icon svg{ width:18px;height:18px; }
.unggulan-item h4{
  font-family:var(--sans);
  font-size:14px;
  font-weight:700;
  color:var(--tinta);
}

/* ---------- Kepemimpinan ---------- */
.kepemimpinan{ background:var(--kertas-tua); }
.pimpinan-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:28px;
}
.pimpinan-card{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:var(--radius);
  padding:30px;
  position:relative;
}
.pimpinan-card .motif-star{
  color:var(--emas);
  width:20px;height:20px;
  margin-bottom:16px;
}
.pimpinan-card h3{
  font-size:20px;
  color:var(--hijau);
  margin-bottom:2px;
}
.pimpinan-card .jabatan{
  font-family:var(--mono);
  font-size:11.5px;
  letter-spacing:.05em;
  text-transform:uppercase;
  color:var(--emas);
  display:block;
  margin-bottom:16px;
}
.pimpinan-card blockquote{
  font-family:var(--serif);
  font-style:italic;
  font-size:16.5px;
  color:var(--tinta);
  border-left:3px solid var(--emas);
  padding-left:16px;
  margin:0;
}

/* ---------- Program & Khidmah ---------- */
.program{ background:var(--kertas); }
.program-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:22px;
}
.program-card{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:var(--radius);
  padding:26px;
}
.program-card .icon{
  width:44px;height:44px;
  border-radius:50%;
  background:var(--hijau);
  color:var(--emas-terang);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:18px;
}
.program-card .icon svg{ width:20px; height:20px; }
.program-card h3{
  font-size:17px;
  color:var(--tinta);
  margin-bottom:8px;
}
.program-card p{
  font-size:14px;
  color:var(--tinta-lunak);
}

/* ---------- CTA banner ---------- */
.cta-banner{
  background:var(--hijau-deep);
  color:var(--putih);
  position:relative;
  overflow:hidden;
}
.cta-banner::after{
  content:"";
  position:absolute; right:-60px; top:50%; transform:translateY(-50%);
  width:280px; height:280px;
  background:var(--emas);
  opacity:.08;
  clip-path: polygon(50% 0%,61% 20%,82% 8%,78% 30%,100% 33%,84% 48%,100% 63%,78% 68%,82% 90%,61% 78%,50% 100%,39% 78%,18% 90%,22% 68%,0% 63%,16% 48%,0% 33%,22% 30%,18% 8%,39% 20%);
}
.cta-inner{
  position:relative;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:30px;
  flex-wrap:wrap;
  padding:56px 0;
}
.cta-inner h2{
  font-size:clamp(22px,3vw,30px);
  color:var(--putih);
  max-width:26ch;
}
.cta-inner p{
  color:rgba(255,253,247,.75);
  margin-top:10px;
  max-width:40ch;
  font-size:14.5px;
}

/* ============================================================
   FOOTER
   ============================================================ */
footer{
  background:var(--hijau-deep);
  color:var(--kertas-tua);
  border-top:1px solid rgba(255,255,255,.08);
}
.footer-grid{
  display:grid;
  grid-template-columns:1.4fr 1fr 1fr 1fr;
  gap:36px;
  padding:60px 0 40px;
}
.footer-brand{ display:flex; gap:14px; margin-bottom:16px; }
.footer-brand img{
  width:44px;height:44px;border-radius:50%;
  border:2px solid var(--emas); object-fit:cover;
}
.footer-brand strong{
  font-family:var(--serif); font-size:16px; color:var(--putih);
  display:block;
}
.footer-col h4{
  font-family:var(--mono);
  font-size:12px;
  letter-spacing:.1em;
  text-transform:uppercase;
  color:var(--emas-terang);
  margin-bottom:16px;
  font-weight:700;
}
.footer-col ul li{ margin-bottom:10px; font-size:14px; }
.footer-col a:hover{ color:var(--emas-terang); }
.footer-desc{ font-size:14px; color:rgba(255,253,247,.65); max-width:34ch; }
.footer-bottom{
  border-top:1px solid rgba(255,255,255,.08);
  padding:20px 0;
  display:flex;
  justify-content:space-between;
  flex-wrap:wrap;
  gap:10px;
  font-size:12.5px;
  color:rgba(255,253,247,.55);
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 980px){
  nav.main-nav{ display:none; }
  .nav-toggle{ display:inline-flex; }
  .hero .wrap{ grid-template-columns:1fr; }
  .hero-visual{ max-width:300px; }
  .news-grid, .program-grid{ grid-template-columns:repeat(2,1fr); }
  .pimpinan-grid{ grid-template-columns:1fr; }
  .fact-strip .wrap{ grid-template-columns:repeat(2,1fr); }
  .fact{ border-bottom:1px solid var(--garis); }
  .footer-grid{ grid-template-columns:1fr 1fr; }
  .profil-grid{ grid-template-columns:1fr; }
  .profil-side{ position:static; }
  .bidang-grid{ grid-template-columns:1fr 1fr; }
  .unggulan-strip{ grid-template-columns:repeat(2,1fr); }
}
@media (max-width: 620px){
  section{ padding:56px 0; }
  .news-grid, .program-grid{ grid-template-columns:1fr; }
  .footer-grid{ grid-template-columns:1fr; padding:44px 0 24px; }
  .cta-inner{ padding:44px 0; }
  .top-strip nav{ gap:12px; }
  .bidang-grid{ grid-template-columns:1fr; }
  .profil-photos{ grid-template-columns:1fr 1fr; }
}
</style>
</head>
<body>

<!-- ============ TOP STRIP ============ -->
<div class="top-strip">
  <div class="wrap">
    <span class="meta-loc">📍 Jl. Untung Suropati No.16, Kebonagung, Kota Pasuruan</span>
    <nav>
      <a href="#profil">Profil</a>
      <a href="#warta">Warta</a>
      <a href="#layanan">Layanan</a>
      <a href="#artikel">Artikel</a>
      <a href="#kontak">Kontak</a>
    </nav>
  </div>
</div>

<!-- ============ HEADER ============ -->
<header class="site-header">
  <div class="wrap">
    <a class="brand" href="#" id="brandLink">
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
      <a href="#profil">Profil</a>
      <a href="#warta">Warta</a>
      <a href="#kepemimpinan">Pengurus</a>
      <a href="#layanan">Layanan</a>
      <a href="#artikel">Artikel</a>
      <a href="#kontak">Kontak</a>
    </nav>
    <button class="nav-toggle" aria-label="Buka menu">☰</button>
  </div>
</header>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="wrap">
    <div>
      <span class="eyebrow"><span class="motif-star"></span> Pengurus Cabang Nahdlatul Ulama</span>
      <h1>Membersamai umat, <em>menjaga amanah</em> para muassis.</h1>
      <p class="lead">Situs resmi PCNU Kota Pasuruan — kabar kegiatan, khidmah lembaga, dan program kemaslahatan umat dari Nahdlatul Ulama Kota Pasuruan.</p>
      <div class="cta-row">
        <a href="#warta" class="btn btn-emas">Baca Warta Terbaru</a>
        <a href="#kepemimpinan" class="btn btn-ghost">Kenali Pengurus</a>
      </div>
    </div>
    <div class="hero-visual">
      <div class="star-frame">
        <div class="inner" id="heroVisual">
          <div class="ph-fallback">
            <svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ FACT STRIP (angka nyata dari warta PCNU) ============ -->
<div class="fact-strip">
  <div class="wrap">
    <div class="fact"><strong>16</strong><span>PONDOK PESANTREN (RMI)</span></div>
    <div class="fact"><strong>±3.000</strong><span>SISWA DI BAWAH LP MA'ARIF</span></div>
    <div class="fact"><strong>±500</strong><span>TAKMIR MASJID (LTMNU)</span></div>
    <div class="fact"><strong>2025–2030</strong><span>MASA KHIDMAT PENGURUS</span></div>
  </div>
</div>

<!-- ============ PROFIL ============ -->
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
        <h3><span class="motif-star"></span>Kepemimpinan & Khidmah</h3>
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

<!-- ============ WARTA (LIVE DARI REST API) ============ -->
<section class="warta" id="warta">
  <div class="wrap">
    <div class="divider"><span>Kabar Terkini</span></div>
    <div class="section-head">
      <h2>Warta PCNU Kota Pasuruan</h2>
      <p>Diperbarui langsung dari sistem — laporan kegiatan, kerja sama, dan khidmah lembaga di lingkungan PCNU Kota Pasuruan.</p>
    </div>
    <div class="news-grid" id="newsGrid">
      <!-- diisi JS: skeleton -> kartu berita -->
    </div>
  </div>
</section>

<!-- ============ KEPEMIMPINAN ============ -->
<section class="kepemimpinan" id="kepemimpinan">
  <div class="wrap">
    <div class="divider"><span>Masa Khidmat 2025–2030</span></div>
    <div class="section-head">
      <h2>Kepemimpinan</h2>
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

<!-- ============ LAYANAN & KONSULTASI ============ -->
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

<!-- ============ PROGRAM ============ -->
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
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z"/></svg></div>
        <h3>Huwal Habiban</h3>
        <p>Kegiatan rutin dzikir dan sholawat sebagai penjaga tradisi spiritual pengurus dan warga NU.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ ARTIKEL (LIVE DARI /wp/v2/posts) ============ -->
<section class="warta" id="artikel">
  <div class="wrap">
    <div class="divider"><span>Dari Blog</span></div>
    <div class="section-head">
      <h2>Artikel</h2>
      <p>Tulisan yang dipublikasikan lewat sistem blog situs ini — diperbarui otomatis dari sumber yang sama dengan Warta.</p>
    </div>
    <div class="news-grid" id="artikelGrid">
      <!-- diisi JS: skeleton -> kartu artikel dari /wp/v2/posts -->
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<div class="cta-banner" id="kontak">
  <div class="wrap cta-inner">
    <div>
      <h2>Ingin bersilaturahmi atau berkolaborasi dengan PCNU Kota Pasuruan?</h2>
      <p>Pengurus, lembaga, banom, hingga warga Nahdliyin dapat menghubungi kantor PCNU Kota Pasuruan untuk informasi lebih lanjut.</p>
    </div>
    <a href="https://pcnupasuruankota.id" target="_blank" rel="noopener" class="btn btn-emas">Kunjungi Situs Utama</a>
  </div>
</div>

<!-- ============ FOOTER ============ -->
<footer>
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
        <li><a href="#warta">Warta</a></li>
        <li><a href="#kepemimpinan">Kepemimpinan</a></li>
        <li><a href="#program">Program</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Lembaga</h4>
      <ul>
        <li><a href="#program">LP Ma'arif NU</a></li>
        <li><a href="#program">RMI NU</a></li>
        <li><a href="#program">LTMNU</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Tautan</h4>
      <ul>
        <li><a href="https://pcnupasuruankota.id" target="_blank" rel="noopener">Situs Resmi</a></li>
        <li><a href="https://pcnupasuruankota.id/wp-json/wp/v2/pages" target="_blank" rel="noopener">Arsip Warta</a></li>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <span>© <?php echo $tahun; ?> PCNU Kota Pasuruan.</span>
    <span>Konten diperbarui otomatis dari WordPress REST API.</span>
  </div>
</footer>

<script>
(function(){
  "use strict";

  var API_ROOT   = "https://pcnupasuruankota.id/wp-json/";
  var STAR_SVG    = '<svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg>';
  var ARROW_SVG   = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';

  function stripHtml(html){
    var tmp = document.createElement("div");
    tmp.innerHTML = html || "";
    return (tmp.textContent || tmp.innerText || "").trim();
  }

  function truncate(text, max){
    if(text.length <= max) return text;
    return text.slice(0, max).replace(/\s+\S*$/, "") + "…";
  }

  function formatTanggal(iso){
    try{
      var d = new Date(iso);
      return d.toLocaleDateString("id-ID", { day:"numeric", month:"long", year:"numeric" });
    }catch(e){ return ""; }
  }

  function decodeEntities(str){
    var ta = document.createElement("textarea");
    ta.innerHTML = str || "";
    return ta.value;
  }

  /* ---------------------------------------------------------
     1) IDENTITAS SITUS (nama, tagline, logo) — dari root API
     --------------------------------------------------------- */
  function muatIdentitasSitus(){
    fetch(API_ROOT, { headers:{ "Accept":"application/json" } })
      .then(function(res){
        if(!res.ok) throw new Error("Gagal memuat identitas situs (" + res.status + ")");
        return res.json();
      })
      .then(function(data){
        if(data.name){
          var judul = decodeEntities(data.name);
          document.getElementById("siteTitle").textContent = judul;
          document.getElementById("footerTitle").textContent = judul;
          document.title = judul + " — Nahdlatul Ulama Cabang Kota Pasuruan";
        }
        if(data.description){
          document.getElementById("footerDesc").textContent = decodeEntities(data.description);
        }
        if(data.site_logo){
          muatLogo(data.site_logo);
        }
      })
      .catch(function(err){
        console.warn("Identitas situs pakai fallback statis:", err.message);
      });
  }

  function muatLogo(mediaId){
    fetch(API_ROOT + "wp/v2/media/" + mediaId)
      .then(function(res){ if(!res.ok) throw new Error("logo tidak ditemukan"); return res.json(); })
      .then(function(media){
        var url = media && media.source_url;
        if(!url) return;
        [document.getElementById("logoImg"), document.getElementById("footerLogoImg")].forEach(function(img){
          if(!img) return;
          img.src = url;
          img.style.display = "block";
        });
        var fallback = document.getElementById("logoFallback");
        if(fallback) fallback.style.display = "none";
      })
      .catch(function(err){ console.warn("Logo pakai ikon fallback:", err.message); });
  }

  /* ---------------------------------------------------------
     2) WARTA — /wp/v2/pages?_embed  (sesuai permintaan)
     --------------------------------------------------------- */
  var heroImages = [];
  var heroIndex = 0;
  var heroTimer = null;

  function jalankanHeroSlideshow(urls){
    var container = document.getElementById("heroVisual");
    if(!container || !urls.length) return;
    heroImages = urls.slice(0, 5);

    heroImages.forEach(function(url, i){
      var img = document.createElement("img");
      img.src = url;
      img.alt = "";
      img.loading = "lazy";
      if(i === 0) img.classList.add("active");
      container.appendChild(img);
    });

    var fallback = container.querySelector(".ph-fallback");
    if(fallback) fallback.style.display = "none";

    if(heroImages.length > 1){
      heroTimer = setInterval(function(){
        var imgs = container.querySelectorAll("img");
        imgs[heroIndex].classList.remove("active");
        heroIndex = (heroIndex + 1) % imgs.length;
        imgs[heroIndex].classList.add("active");
      }, 4200);
    }
  }

  function ambilFeaturedImage(halaman){
    try{
      var media = halaman._embedded && halaman._embedded["wp:featuredmedia"] && halaman._embedded["wp:featuredmedia"][0];
      if(media && media.source_url) return media.source_url;
    }catch(e){}
    return null;
  }

  function kartuBeritaHTML(halaman, gambarUrl){
    var judul   = decodeEntities(halaman.title && halaman.title.rendered || "(Tanpa judul)");
    var excerpt = truncate(stripHtml(halaman.excerpt && halaman.excerpt.rendered || ""), 130);
    var tanggal = formatTanggal(halaman.date);
    var link    = halaman.link || "#";

    var thumb = gambarUrl
      ? '<img src="' + gambarUrl + '" alt="" loading="lazy">'
      : '<div class="ph-fallback">' + STAR_SVG + '</div>';

    return (
      '<article class="news-card">' +
        '<div class="news-thumb">' + thumb + '</div>' +
        '<div class="news-body">' +
          '<span class="news-date">' + tanggal + '</span>' +
          '<h3>' + judul + '</h3>' +
          '<p>' + excerpt + '</p>' +
          '<a class="news-link" href="' + link + '" target="_blank" rel="noopener">Baca selengkapnya ' + ARROW_SVG + '</a>' +
        '</div>' +
      '</article>'
    );
  }

  function tampilkanSkeleton(grid, jumlah){
    var html = "";
    for(var i=0; i<jumlah; i++){
      html +=
        '<article class="news-card">' +
          '<div class="news-thumb news-skel"></div>' +
          '<div class="news-body">' +
            '<div class="news-skel" style="height:11px;width:40%;border-radius:4px;"></div>' +
            '<div class="news-skel" style="height:20px;width:90%;border-radius:4px;margin-top:4px;"></div>' +
            '<div class="news-skel" style="height:14px;width:100%;border-radius:4px;margin-top:6px;"></div>' +
          '</div>' +
        '</article>';
    }
    grid.innerHTML = html;
  }

  function tampilkanErrorBerita(grid, pesan, fungsiRetry){
    grid.innerHTML =
      '<div class="news-error">' +
        '<p>' + pesan + '</p>' +
        '<button class="tombol-retry" type="button">Coba muat ulang</button>' +
      '</div>';
    var tombol = grid.querySelector(".tombol-retry");
    if(tombol) tombol.addEventListener("click", fungsiRetry);
  }

  /**
   * Fungsi umum: ambil daftar item (pages ATAU posts) dari REST API dan
   * render sebagai kartu di dalam grid tertentu. Dipakai untuk Warta
   * (endpoint wp/v2/pages) maupun Artikel (endpoint wp/v2/posts).
   */
  function muatKontenKartu(opsi){
    var grid = document.getElementById(opsi.gridId);
    if(!grid) return;
    tampilkanSkeleton(grid, opsi.jumlah || 6);

    fetch(API_ROOT + opsi.endpoint)
      .then(function(res){
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        return res.json();
      })
      .then(function(daftarItem){
        if(!Array.isArray(daftarItem) || daftarItem.length === 0){
          tampilkanErrorBerita(grid, opsi.pesanKosong, opsi.retry);
          return;
        }

        var kartuHtml = "";
        var gambarTerkumpul = [];

        daftarItem.forEach(function(item){
          var gambar = ambilFeaturedImage(item);
          if(gambar) gambarTerkumpul.push(gambar);
          kartuHtml += kartuBeritaHTML(item, gambar);
        });

        grid.innerHTML = kartuHtml;
        if(opsi.isiHeroDariGambar && gambarTerkumpul.length){
          jalankanHeroSlideshow(gambarTerkumpul);
        }
      })
      .catch(function(err){
        tampilkanErrorBerita(
          grid,
          opsi.pesanError + " (" + err.message + "). Biasanya ini terjadi kalau halaman dibuka dari domain berbeda (CORS) — pastikan file ini dijalankan di domain pcnupasuruankota.id.",
          opsi.retry
        );
      });
  }

  function muatWarta(){
    muatKontenKartu({
      gridId: "newsGrid",
      endpoint: "wp/v2/pages?_embed&per_page=6&orderby=date&order=desc",
      jumlah: 6,
      isiHeroDariGambar: true,
      pesanKosong: "Belum ada warta yang bisa ditampilkan.",
      pesanError: "Warta belum bisa dimuat",
      retry: muatWarta
    });
  }

  function muatArtikel(){
    muatKontenKartu({
      gridId: "artikelGrid",
      endpoint: "wp/v2/posts?_embed&per_page=6&orderby=date&order=desc",
      jumlah: 3,
      isiHeroDariGambar: false,
      pesanKosong: "Belum ada artikel yang dipublikasikan lewat blog.",
      pesanError: "Artikel belum bisa dimuat",
      retry: muatArtikel
    });
  }

  /* ---------------------------------------------------------
     3) Menu mobile sederhana
     --------------------------------------------------------- */
  function pasangNavToggle(){
    var toggle = document.querySelector(".nav-toggle");
    var nav = document.querySelector("nav.main-nav");
    if(!toggle || !nav) return;
    toggle.addEventListener("click", function(){
      var terbuka = nav.style.display === "flex";
      nav.style.display = terbuka ? "none" : "flex";
      nav.style.flexDirection = "column";
      nav.style.position = "absolute";
      nav.style.top = "100%";
      nav.style.left = "0";
      nav.style.right = "0";
      nav.style.background = "var(--hijau)";
      nav.style.padding = "16px 24px";
      nav.style.gap = "14px";
    });
  }

  document.addEventListener("DOMContentLoaded", function(){
    muatIdentitasSitus();
    muatWarta();
    muatArtikel();
    pasangNavToggle();
  });
})();
</script>
</body>
</html>

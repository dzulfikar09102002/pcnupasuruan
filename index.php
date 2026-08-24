<?php
$tahun = date('Y');
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
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
/* ============================================================
   TOKENS & BASE
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

/* ---------- Scroll reveal ---------- */
.reveal{
  opacity:0;
  transform:translateY(26px);
  transition:opacity .8s cubic-bezier(.16, 1, .3, 1), transform .8s cubic-bezier(.16, 1, .3, 1);
  transition-delay:var(--reveal-delay, 0ms);
}
.reveal.is-visible{
  opacity:1;
  transform:none;
}
@keyframes fadeInUp{
  from{ opacity:0; transform:translateY(18px); }
  to{ opacity:1; transform:none; }
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

header.site-header{
  position:sticky;
  top:0;
  z-index:50;
  background:var(--hijau);
  border-bottom:1px solid rgba(255,255,255,.08);
  transition: background .3s ease;
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

nav.main-nav {
  display: flex;
  gap: 30px;
  align-items: center;
}

nav.main-nav a {
  color: var(--kertas-tua);
  font-size: 14.5px;
  font-weight: 500;
  position: relative;
  padding: 6px 0;
  text-decoration: none;
}

nav.main-nav > a::after,
nav.main-nav .nav-dropdown > a::after {
  content: "";
  position: absolute; left: 0; right: 0; bottom: 0;
  height: 2px; background: var(--emas);
  transform: scaleX(0); transform-origin: left;
  transition: transform .25s ease;
}

nav.main-nav a:hover::after { transform: scaleX(1); }
nav.main-nav a:hover { color: var(--putih); }

.nav-dropdown {
  position: relative;
  display: inline-block;
}

.nav-dropdown .dropdown-content {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: var(--hijau, #1b4d3e);
  min-width: 200px;
  max-height: 350px;
  overflow-y: auto;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
  border-radius: 6px;
  z-index: 99;
  padding: 8px 0;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

/* Hover khusus Desktop */
@media (min-width: 981px) {
  .nav-dropdown:hover .dropdown-content {
    display: block;
  }
}

.nav-dropdown .dropdown-content a {
  color: var(--kertas-tua) !important;
  padding: 8px 16px;
  display: block;
  font-size: 13.5px;
  white-space: nowrap;
  text-align: left;
  transition: background 0.2s;
}

.nav-dropdown .dropdown-content a::after {
  display: none !important;
}

.nav-dropdown .dropdown-content a:hover {
  background-color: rgba(255, 255, 255, 0.08);
  color: var(--putih) !important;
}

.dropdown-content::-webkit-scrollbar {
  width: 5px;
}
.dropdown-content::-webkit-scrollbar-thumb {
  background: var(--emas, #c5a059);
  border-radius: 4px;
}

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
.hero-pattern{
  position:absolute;
  inset:-10%;
  z-index:0;
  opacity:.09;
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cg fill='%23E3B75A'%3E%3Cpath transform='translate(20,25) scale(0.9)' d='M12 0 L14.6 4.8 L19.7 1.9 L18.7 7.2 L24 7.9 L20.2 11.5 L24 15.1 L18.7 16.3 L19.7 21.6 L14.6 18.7 L12 24 L9.4 18.7 L4.3 21.6 L5.3 16.3 L0 15.1 L3.8 11.5 L0 7.9 L5.3 7.2 L4.3 1.9 L9.4 4.8 Z'/%3E%3Cpath transform='translate(95,60) scale(0.55) rotate(18 12 12)' d='M12 0 L14.6 4.8 L19.7 1.9 L18.7 7.2 L24 7.9 L20.2 11.5 L24 15.1 L18.7 16.3 L19.7 21.6 L14.6 18.7 L12 24 L9.4 18.7 L4.3 21.6 L5.3 16.3 L0 15.1 L3.8 11.5 L0 7.9 L5.3 7.2 L4.3 1.9 L9.4 4.8 Z'/%3E%3Cpath transform='translate(55,110) scale(0.7) rotate(-12 12 12)' d='M12 0 L14.6 4.8 L19.7 1.9 L18.7 7.2 L24 7.9 L20.2 11.5 L24 15.1 L18.7 16.3 L19.7 21.6 L14.6 18.7 L12 24 L9.4 18.7 L4.3 21.6 L5.3 16.3 L0 15.1 L3.8 11.5 L0 7.9 L5.3 7.2 L4.3 1.9 L9.4 4.8 Z'/%3E%3Cpath transform='translate(130,130) scale(0.4) rotate(30 12 12)' d='M12 0 L14.6 4.8 L19.7 1.9 L18.7 7.2 L24 7.9 L20.2 11.5 L24 15.1 L18.7 16.3 L19.7 21.6 L14.6 18.7 L12 24 L9.4 18.7 L4.3 21.6 L5.3 16.3 L0 15.1 L3.8 11.5 L0 7.9 L5.3 7.2 L4.3 1.9 L9.4 4.8 Z'/%3E%3C/g%3E%3C/svg%3E");
  background-size:160px 160px;
  background-repeat:repeat;
  pointer-events:none;
  animation:heroPatternDrift 90s linear infinite;
}
@keyframes heroPatternDrift{
  from{ transform:translate(0,0); }
  to{ transform:translate(-160px,-160px); }
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
  grid-template-columns:.92fr 1.08fr;
  gap:48px;
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
  transition:transform .2s cubic-bezier(.16, 1, .3, 1), background .2s ease, box-shadow .2s ease;
}
.btn:hover{ transform:translateY(-2px); }
.btn-emas{ background:var(--emas); color:var(--hijau-deep); box-shadow:0 0 0 0 rgba(227,183,90,.5); }
.btn-emas:hover{ background:var(--emas-terang); box-shadow:0 8px 24px -6px rgba(227,183,90,.65); }
.btn-ghost{ border-color:rgba(255,255,255,.35); color:var(--putih); }
.btn-ghost:hover{ border-color:var(--emas-terang); color:var(--emas-terang); }

.wrap.wrap-hero {
  max-width: 1320px; 
}
.hero-visual{
  position:relative;
  width:100%;
  max-width:600px;
  margin:0 auto;
}
.carousel-frame{
  position:relative;
  aspect-ratio:3/2;
  width:100%;
  border-radius:22px;
  overflow:hidden;
  border:3px solid var(--emas);
  background:var(--hijau-deep);
  box-shadow:0 40px 70px -30px rgba(8,41,33,.6), 0 0 0 1px rgba(227,183,90,.18), 0 0 0 8px rgba(227,183,90,.06);
  transition:box-shadow .35s ease;
  animation:frameGlow 6s ease-in-out infinite;
}
.carousel-frame:hover{
  box-shadow:0 46px 80px -28px rgba(8,41,33,.65), 0 0 0 1px rgba(227,183,90,.25), 0 0 0 10px rgba(227,183,90,.09);
}
@keyframes frameGlow{
  0%,100%{ box-shadow:0 40px 70px -30px rgba(8,41,33,.6), 0 0 0 1px rgba(227,183,90,.18), 0 0 0 8px rgba(227,183,90,.06); }
  50%{ box-shadow:0 40px 70px -30px rgba(8,41,33,.6), 0 0 0 1px rgba(227,183,90,.28), 0 0 0 14px rgba(227,183,90,.10); }
}
.carousel-track {
  display: flex;
  height: 100%;
  width: 100%;
  transition: transform 0.85s cubic-bezier(0.65, 0.05, 0.36, 1);
  will-change: transform;
}

.carousel-track .slide {
  flex: 0 0 100%;
  height: 100%;
  position: relative;
  opacity: 1;
  visibility: visible;
  transform: none;
}
.carousel-track .slide.active{
  opacity:1;
  visibility:visible;
  transform: scale(1);
  z-index: 2;
}
.carousel-track .slide img{
  width:100%; height:100%; object-fit:cover;
}
.carousel-track .slide::after{
  content:"";
  position:absolute; inset:0;
  background:linear-gradient(180deg, rgba(8,41,33,0) 55%, rgba(8,41,33,.55) 100%);
  pointer-events:none;
}
.carousel-frame .ph-fallback{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  color:var(--emas-terang); opacity:.4;
}
.carousel-frame .ph-fallback svg{ width:26%; height:26%; }

.carousel-arrow{
  position:absolute;
  top:50%;
  transform:translateY(-50%);
  width:38px; height:38px;
  border-radius:50%;
  border:1px solid rgba(255,253,247,.3);
  background:rgba(8,41,33,.45);
  backdrop-filter:blur(4px);
  color:var(--putih);
  display:flex; align-items:center; justify-content:center;
  z-index:4;
  opacity:0;
  transition:opacity .3s ease, background .2s ease, border-color .2s ease, transform .2s ease;
}
.carousel-arrow svg{ width:17px; height:17px; }
.carousel-arrow.prev{ left:14px; }
.carousel-arrow.next{ right:14px; }
.carousel-frame:hover .carousel-arrow,
.carousel-arrow:focus-visible{ opacity:1; }
.carousel-arrow:hover{
  background:var(--emas);
  color:var(--hijau-deep);
  border-color:var(--emas);
  transform:translateY(-50%) scale(1.08);
}

.carousel-dots{
  display:flex;
  justify-content:center;
  gap:9px;
  margin-top:20px;
}
.carousel-dots button{
  width:8px; height:8px;
  border-radius:50%;
  background:rgba(8,41,33,.22);
  border:none;
  padding:0;
  transition:all .35s cubic-bezier(0.4, 0, 0.2, 1);
}
.carousel-dots button.active{
  background:var(--hijau);
  width:24px;
  border-radius:6px;
}
#tahunKhidmat {
  display: inline-block;
  white-space: nowrap;
  font-family: inherit; 
  color: inherit;    
  font-size: 1em;      
}

@media (max-width: 620px) {
  #tahunKhidmat {
    font-size: 0.75em;  
    letter-spacing: -0.5px;
  }
}
.fact-strip{
  background:linear-gradient(115deg, var(--emas-pucat) 0%, #EAD9A8 55%, var(--emas-pucat) 100%);
  border-bottom:1px solid var(--garis);
  position:relative;
  overflow:hidden;
}
.fact-strip .wrap{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:0;
  position:relative;
}
.fact{
  padding:30px 20px;
  text-align:center;
  border-right:1px solid var(--garis);
  transition:transform .25s ease;
}
.fact:hover{ transform:translateY(-3px); }
.fact:last-child{ border-right:none; }
.fact strong{
  display:block;
  font-family:var(--serif);
  font-size:clamp(24px,3.2vw,34px);
  color:var(--hijau);
  font-variant-numeric:tabular-nums;
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
  border-radius:10px;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  position:relative;
  transition:transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease, border-color .3s ease;
}
.news-card::before{
  content:"";
  position:absolute; top:0; left:0; right:0; height:3px;
  background:linear-gradient(90deg, var(--emas), var(--hijau));
  transform:scaleX(0);
  transform-origin:left;
  transition:transform .35s ease;
  z-index:2;
}
.news-card:hover{
  transform:translateY(-6px);
  box-shadow:0 24px 40px -20px rgba(8,41,33,.4);
  border-color:rgba(193,147,47,.35);
}
.news-card:hover::before{ transform:scaleX(1); }
.news-thumb{
  aspect-ratio:16/10;
  background:var(--hijau);
  position:relative;
  overflow:hidden;
}
.news-thumb img{ width:100%; height:100%; object-fit:cover; transition:transform .6s cubic-bezier(0.16, 1, 0.3, 1); }
.news-card:hover .news-thumb img{ transform:scale(1.06); }
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
.news-link svg{ width:14px; height:14px; transition:transform .2s ease; }
.news-card:hover .news-link svg{ transform:translateX(4px); }

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

.profil{ background:linear-gradient(175deg, var(--kertas-tua) 0%, #E9E0C6 55%, var(--kertas-tua) 100%); }
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
  text-align: justify;
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
  transition: all 0.2s ease;
}
.profil-card a.map-link:hover{ border-color:var(--emas-terang); background: rgba(227,183,90,0.1); }
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

.layanan{ background:linear-gradient(180deg, var(--kertas) 0%, #EFE7D2 100%); }
.bidang-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:22px;
  margin-bottom:40px;
}
.bidang-card{
  border-radius:12px;
  padding:28px 26px;
  color:var(--putih);
  position:relative;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  min-height:220px;
  box-shadow:0 18px 32px -22px rgba(8,41,33,.5);
  transition:transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease;
}
.bidang-card:hover{
  transform:translateY(-6px);
  box-shadow:0 26px 42px -20px rgba(8,41,33,.55);
}
.bidang-card::after{
  content:"";
  position:absolute; right:-30px; bottom:-30px;
  width:120px; height:120px;
  opacity:.12;
  background:currentColor;
  clip-path: polygon(50% 0%, 61% 20%, 82% 8%, 78% 30%, 100% 33%, 84% 48%, 100% 63%, 78% 68%, 82% 90%, 61% 78%, 50% 100%, 39% 78%, 18% 90%, 22% 68%, 0% 63%, 16% 48%, 0% 33%, 22% 30%, 18% 8%, 39% 20%);
}
.bidang-card.v1{ background:linear-gradient(150deg, var(--hijau-deep) 0%, #0a3327 100%); }
.bidang-card.v2{ background:linear-gradient(150deg, var(--hijau-soft) 0%, #123f31 100%); }
.bidang-card.v3{ background:linear-gradient(150deg, #5C4420 0%, #4A3619 100%); }
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
  transition: all .2s ease;
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
  border-radius:10px;
  padding:20px;
  text-align:center;
  transition:transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}
.unggulan-item:hover{
  transform:translateY(-4px);
  box-shadow:0 16px 28px -18px rgba(8,41,33,.35);
  border-color:rgba(193,147,47,.3);
}
.unggulan-item .icon{
  width:40px;height:40px;
  margin:0 auto 12px;
  border-radius:50%;
  background:linear-gradient(150deg, var(--emas-pucat), #E9D6A6);
  color:var(--hijau);
  display:flex;align-items:center;justify-content:center;
  transition:transform .25s ease;
}
.unggulan-item:hover .icon{ transform:scale(1.1) rotate(-6deg); }
.unggulan-item .icon svg{ width:18px;height:18px; }
.unggulan-item h4{
  font-family:var(--sans);
  font-size:14px;
  font-weight:700;
  color:var(--tinta);
}

.kepengurusan{ background:linear-gradient(165deg, var(--kertas-tua) 0%, #E4D9B8 100%); }
.pimpinan-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:28px;
}
.pimpinan-card{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:10px;
  padding:30px;
  position:relative;
  overflow:hidden;
  transition:transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease;
}
.pimpinan-card::before{
  content:"";
  position:absolute; top:0; left:0; bottom:0; width:4px;
  background:linear-gradient(180deg, var(--emas), var(--hijau));
}
.pimpinan-card:hover{
  transform:translateY(-5px);
  box-shadow:0 22px 38px -22px rgba(8,41,33,.4);
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

.program{ background:linear-gradient(180deg, var(--kertas) 0%, #EFE7D2 55%, var(--kertas) 100%); }
.program-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:22px;
}
.program-card{
  background:var(--putih);
  border:1px solid var(--garis);
  border-radius:10px;
  padding:26px;
  transition:transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease, border-color .3s ease;
}
.program-card:hover{
  transform:translateY(-5px);
  box-shadow:0 20px 34px -20px rgba(8,41,33,.38);
  border-color:rgba(193,147,47,.3);
}
.program-card .icon{
  width:44px;height:44px;
  border-radius:50%;
  background:linear-gradient(150deg, var(--hijau), var(--hijau-deep));
  color:var(--emas-terang);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:18px;
  transition:transform .3s ease;
}
.program-card:hover .icon{ transform:scale(1.1) rotate(6deg); }
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

.cta-banner{
  background:linear-gradient(120deg, var(--hijau-deep) 0%, var(--hijau) 60%, var(--hijau-soft) 100%);
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

.galeri{ background:linear-gradient(180deg, #EFE7D2 0%, var(--kertas) 100%); overflow:hidden; }
.galeri{ 
  background:linear-gradient(180deg, #EFE7D2 0%, var(--kertas) 100%); 
  overflow:hidden; 
}

/* Wadah statis penahan efek blur / fade */
.galeri-container-outer{
  position:relative;
  width:100%;
  overflow:hidden;
}

.galeri-container-outer::before,
.galeri-container-outer::after{
  content:"";
  position:absolute;
  top:0; bottom:0;
  width:90px;
  z-index:10;
  pointer-events:none;
}

.galeri-container-outer::before{
  left:0;
  background:linear-gradient(to right, #EFE7D2, rgba(239,231,210,0));
}

.galeri-container-outer::after{
  right:0;
  background:linear-gradient(to left, var(--kertas), rgba(246,242,230,0));
}

.galeri-wrap{
  position:relative;
  overflow-x:auto;
  overflow-y:hidden;
  border-radius:var(--radius);
  cursor:grab;
  -webkit-overflow-scrolling:touch;
  scrollbar-width:none;
  -ms-overflow-style:none;
}
.galeri-wrap::-webkit-scrollbar{ display:none; height:0; }
.galeri-wrap.is-dragging{ cursor:grabbing; scroll-behavior:auto; user-select:none; }
.galeri-item img{ -webkit-user-drag:none; user-drag:none; }

.galeri-track{
  display:flex;
  gap:18px;
  width:max-content;
}

.galeri-item{
  flex:0 0 auto;
  width:280px;
  height:200px;
  border-radius:10px;
  overflow:hidden;
  border:1px solid var(--garis);
  position:relative;
  box-shadow:0 14px 26px -18px rgba(8,41,33,.35);
  cursor:pointer;
}
.galeri-item img{
  width:100%; height:100%; object-fit:cover;
  transition:transform .5s cubic-bezier(.16, 1, .3, 1);
}
.galeri-item:hover img{ transform:scale(1.08); }
.galeri-item .ph-fallback{
  position:absolute; inset:0;
  display:flex; align-items:center; justify-content:center;
  color:var(--emas-terang); opacity:.4;
  background:var(--hijau-deep);
}
.galeri-item .ph-fallback svg{ width:24%; height:24%; }
.galeri-skel{
  width:280px; height:200px;
  border-radius:10px;
  flex:0 0 auto;
  background:linear-gradient(100deg, var(--kertas-tua) 30%, var(--putih) 50%, var(--kertas-tua) 70%);
  background-size:200% 100%;
  animation:shimmer 1.5s infinite;
}

/* ---------- Lightbox foto galeri ---------- */
.lightbox{
  position:fixed;
  inset:0;
  z-index:200;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:40px;
  opacity:0;
  visibility:hidden;
  transition:opacity .3s ease, visibility .3s ease;
}
.lightbox.is-open{
  opacity:1;
  visibility:visible;
}
.lightbox-backdrop{
  position:absolute;
  inset:0;
  background:rgba(8,41,33,.9);
  backdrop-filter:blur(3px);
}
.lightbox-img{
  position:relative;
  max-width:min(90vw, 1100px);
  max-height:85vh;
  width:auto;
  height:auto;
  border-radius:10px;
  box-shadow:0 40px 80px -20px rgba(0,0,0,.65), 0 0 0 1px rgba(227,183,90,.15);
  transform:scale(.92);
  transition:transform .35s cubic-bezier(.16, 1, .3, 1);
  z-index:2;
}
.lightbox.is-open .lightbox-img{
  transform:scale(1);
}
.lightbox-close{
  position:absolute;
  top:22px;
  right:22px;
  width:44px; height:44px;
  border-radius:50%;
  border:1px solid rgba(255,253,247,.3);
  background:rgba(8,41,33,.55);
  backdrop-filter:blur(4px);
  color:var(--putih);
  display:flex; align-items:center; justify-content:center;
  z-index:3;
  transition:background .2s ease, border-color .2s ease, transform .2s ease;
}
.lightbox-close svg{ width:19px; height:19px; }
.lightbox-close:hover{
  background:var(--emas);
  color:var(--hijau-deep);
  border-color:var(--emas);
  transform:scale(1.07);
}
body.lightbox-open{ overflow:hidden; }

@media (max-width: 620px){
  .lightbox{ padding:20px; }
  .lightbox-close{ top:14px; right:14px; width:38px; height:38px; }
}

@media (max-width: 620px){
  .galeri-item{ width:220px; height:160px; }
  .galeri-skel{ width:220px; height:160px; }
}
/* ============================================================
   FOOTER
   ============================================================ */
footer{
  background:linear-gradient(180deg, var(--hijau-deep) 0%, #06201a 100%);
  color:var(--kertas-tua);
  border-top:1px solid rgba(255,255,255,.08);
  position:relative;
  overflow:hidden;
}
.footer-particles{
  position:absolute;
  inset:0;
  pointer-events:none;
  overflow:hidden;
  z-index:0;
}
.footer-particles span{
  position:absolute;
  bottom:-20px;
  display:block;
  border-radius:50%;
  background:var(--emas-terang);
  opacity:0;
  animation-name:particleRise;
  animation-timing-function:ease-in;
  animation-iteration-count:infinite;
}
@keyframes particleRise{
  0%{ transform:translateY(0) translateX(0); opacity:0; }
  10%{ opacity:.55; }
  90%{ opacity:.35; }
  100%{ transform:translateY(-420px) translateX(var(--drift, 20px)); opacity:0; }
}
.footer-grid, .footer-bottom{ position:relative; z-index:1; }
.footer-grid{
  display:grid;
  grid-template-columns:1.4fr 1fr 1fr 1fr;
  gap:36px;
  padding:64px 0 40px;
}
.footer-brand{ display:flex; gap:14px; margin-bottom:16px; align-items:center; }
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
.footer-col a{ transition:color .2s ease, padding-left .2s ease; display:inline-block; }
.footer-col a:hover{ color:var(--emas-terang); padding-left:4px; }
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

/* ---------- Tombol Back To Top ---------- */
.back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 46px;
  height: 46px;
  border-radius: 50%;
  background: var(--emas);
  color: var(--hijau-deep);
  border: none;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 99;
  opacity: 0;
  visibility: hidden;
  transform: translateY(15px) scale(0.9);
  transition: opacity .3s cubic-bezier(.16, 1, .3, 1), transform .3s cubic-bezier(.16, 1, .3, 1), visibility .3s, background .2s;
}
.back-to-top.is-visible {
  opacity: 1;
  visibility: visible;
  transform: translateY(0) scale(1);
}
.back-to-top:hover {
  background: var(--emas-terang);
  transform: translateY(-4px) scale(1.05);
}
.back-to-top svg {
  width: 20px;
  height: 20px;
}

/* ============================================================
   RESPONSIVE (MOBILE MENU IMPROVED)
   ============================================================ */
@media (max-width: 980px){
  nav.main-nav{ 
    display: none; 
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: var(--hijau-deep);
    padding: 12px 20px 24px;
    gap: 0;
    border-bottom: 3px solid var(--emas);
    box-shadow: 0 15px 30px rgba(0,0,0,0.4);
    max-height: 80vh;
    overflow-y: auto;
  }

  /* Aktifkan via JS */
  nav.main-nav.is-open {
    display: flex !important;
  }
  
  .nav-toggle{ display: inline-flex; }

  /* Style link menu utama mobile */
  nav.main-nav > a, 
  nav.main-nav .nav-dropdown > a.drop-btn {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 8px;
    font-size: 15px;
    color: var(--kertas-tua);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    width: 100%;
    text-align: left;
  }

  nav.main-nav > a::after,
  nav.main-nav .nav-dropdown > a::after {
    display: none !important;
  }

  .nav-dropdown {
    width: 100%;
    display: block;
  }

  /* Panah indikator dropdown */
  .nav-dropdown > a.drop-btn::after {
    content: "▾";
    display: inline-block;
    font-size: 12px;
    margin-left: 8px;
    color: var(--emas-terang);
    transition: transform 0.3s ease;
  }

  /* Rotasi panah saat dropdown terbuka */
  .nav-dropdown.is-active > a.drop-btn::after {
    transform: rotate(180deg);
  }

  /* Menu Sub-level (Anak Dropdown) */
  .nav-dropdown .dropdown-content {
    display: none; 
    position: static;
    background-color: rgba(0,0,0,0.25);
    border-radius: 6px;
    border: none;
    box-shadow: none;
    min-width: 100%;
    max-height: none;
    padding: 6px 0;
    margin: 6px 0;
  }

  .nav-dropdown.is-active .dropdown-content {
    display: block;
    animation: fadeInMenu 0.3s ease;
  }

  .nav-dropdown .dropdown-content a {
    padding: 10px 16px 10px 24px !important;
    font-size: 13.5px !important;
    color: rgba(255, 253, 247, 0.8) !important;
    border-bottom: 1px solid rgba(255,255,255,0.03);
  }

  .nav-dropdown .dropdown-content a:last-child {
    border-bottom: none;
  }

  @keyframes fadeInMenu {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .hero .wrap{ grid-template-columns:1fr; }
  .hero-visual{ max-width:480px; }
  .news-grid, .program-grid{ grid-template-columns:repeat(2,1fr); }
  .pimpinan-grid{ grid-template-columns:1fr; }
  .fact-strip .wrap{ grid-template-columns:repeat(2,1fr); }
  .fact{ border-bottom:1px solid var(--garis); }
  .footer-grid{ grid-template-columns:1fr 1fr; row-gap:40px; }
  .footer-grid > div:first-child{ grid-column:1 / -1; }
  .profil-grid{ grid-template-columns:1fr; }
  .profil-side{ position:static; }
  .bidang-grid{ grid-template-columns:1fr 1fr; }
  .unggulan-strip{ grid-template-columns:repeat(2,1fr); }
}

@media (max-width: 620px){
  section{ padding:56px 0; }
  .news-grid, .program-grid{ grid-template-columns:1fr; }
  .footer-grid{
    grid-template-columns:1fr;
    padding:48px 0 28px;
    text-align:center;
    row-gap:34px;
  }
  .footer-grid > div:first-child{ grid-column:auto; }
  .footer-brand{ justify-content:center; }
  .footer-desc{ margin-left:auto; margin-right:auto; }
  .profil-list{ justify-content:center; }
  .footer-bottom{
    flex-direction:column;
    align-items:center;
    text-align:center;
    gap:6px;
  }
  .cta-inner{ padding:44px 0; text-align:center; justify-content:center; }
  .cta-inner div{ margin:0 auto; }
  .bidang-grid{ grid-template-columns:1fr; }
  .profil-photos{ grid-template-columns:1fr 1fr; }
  .hero-visual{ max-width:100%; }
  .carousel-arrow{ width:34px; height:34px; opacity:1; background:rgba(8,41,33,.5); }
  .carousel-arrow svg{ width:15px; height:15px; }
  .back-to-top { bottom: 20px; right: 20px; width: 40px; height: 40px; }
}
</style>
</head>
<body>
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
      <a href="#warta">Berita</a>
      <a href="#kepengurusan">Pengurus</a>

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

      <a href="#layanan">Layanan</a>
      <a href="#artikel">Artikel</a>
      <a href="#kontak">Kontak</a>
    </nav>
    <button class="nav-toggle" aria-label="Buka menu">☰</button>
  </div>
</header>

<section class="hero">
   <div class="hero-pattern" aria-hidden="true"></div>
  <div class="wrap wrap-hero">
    <div>
      <span class="eyebrow" style="animation:fadeInUp .7s ease both;"><span class="motif-star"></span> Pengurus Cabang Nahdlatul Ulama</span>
      <h1 style="animation:fadeInUp .7s ease .1s both;">Membersamai umat, <em>menjaga amanah</em> para muassis.</h1>
      <p class="lead" style="animation:fadeInUp .7s ease .2s both;">Situs resmi PCNU Kota Pasuruan — kabar kegiatan, khidmah lembaga, dan program kemaslahatan umat dari Nahdlatul Ulama Kota Pasuruan.</p>
      <div class="cta-row" style="animation:fadeInUp .7s ease .3s both;">
        <a href="#warta" class="btn btn-emas">Berita Terbaru</a>
        <a href="#profil" class="btn btn-ghost">Tentang PCNU</a>
      </div>
    </div>


    <div class="hero-visual" style="animation:fadeInUp .8s ease .25s both;">
      <div class="carousel-frame" id="heroCarousel">
        <div class="carousel-track" id="heroCarouselTrack">
          <div class="slide active">
            <div class="ph-fallback">
              <svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg>
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
  
  <!-- Wadah Luar Penahan Efek Fade Kiri & Kanan -->
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
        <div class="icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z"/></svg></div>
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
        <li><a href="#warta">Berita</a></li>
        <li><a href="#kepengurusan">Kepengurusan</a></li>
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
  </div>
  <div class="wrap footer-bottom">
    <span>© <?php echo $tahun; ?> PCNU Kota Pasuruan. All rights reserved</span>
    <span>Powered by LTN NU Kota Pasuruan.</span>
  </div>
</footer>

<!-- Tombol Back to Top -->
<button type="button" class="back-to-top" id="btnBackToTop" aria-label="Kembali ke atas">
  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
    <path d="M18 15l-6-6-6 6"/>
  </svg>
</button>

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
          document.title = judul;
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
    fetch(API_ROOT + "wp/v2/media?search=hero-img&per_page=10")
      .then(function(res){
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        return res.json();
      })
      .then(function(daftarMedia){
        if(!Array.isArray(daftarMedia) || daftarMedia.length === 0) return;

        var gambar = daftarMedia
          .filter(function(m){ return m.media_type === "image"; })
          .sort(function(a, b){
            var judulA = (a.title && a.title.rendered) || "";
            var judulB = (b.title && b.title.rendered) || "";
            return judulA.localeCompare(judulB);
          })
          .map(function(m){
            var sizes = m.media_details && m.media_details.sizes;
            return (sizes && sizes.medium_large && sizes.medium_large.source_url)
              || (sizes && sizes.large && sizes.large.source_url)
              || m.source_url;
          })
          .filter(Boolean);

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

  function ambilFeaturedImage(halaman){
    try{
      var media = halaman._embedded && halaman._embedded["wp:featuredmedia"] && halaman._embedded["wp:featuredmedia"][0];
      if(media && media.source_url) return media.source_url;
    }catch(e){}

    try{
      if(halaman.content && halaman.content.rendered){
        var parser = new DOMParser();
        var doc = parser.parseFromString(halaman.content.rendered, 'text/html');
        var gambarPertama = doc.querySelector('img');
        if(gambarPertama && gambarPertama.src) {
          return gambarPertama.src;
        }
      }
    }catch(e){}
    return null;
  }

  var warnaTagMap = {
    "Bahtsul Masail":    { bg: "#e0f2fe", text: "#0369a1" }, 
    "Kalam":             { bg: "#fef3c7", text: "#b45309" }, 
    "Khotbah":           { bg: "#dcfce7", text: "#15803d" }, 
    "Tarbiyah Jinsiyah": { bg: "#fce7f3", text: "#be185d" }, 
    "Hikayat":           { bg: "#fef9c3", text: "#854d0e" }, 
    "Opini":             { bg: "#ede9fe", text: "#6d28d9" }, 
    "Fikrah":            { bg: "#ffedd5", text: "#c2410c" },
    "Pesantren":         { bg: "#ccfbf1", text: "#0f766e" }, 
    "Sejarah":           { bg: "#fae8ff", text: "#86198f" },
    "Sosial":            { bg: "#fee2e2", text: "#b91c1c" },
    "Ekonomi":           { bg: "#e0e7ff", text: "#3730a3" },
    "Pendidikan":        { bg: "#dbeafe", text: "#1d4ed8" },
    "default": { bg: "#ecfdf5", text: "#047857" }
  };

  function kartuBeritaHTML(halaman, gambarUrl, namaTag){
    var judul   = decodeEntities(halaman.title && halaman.title.rendered || "(Tanpa judul)");
    var excerpt = truncate(stripHtml(halaman.excerpt && halaman.excerpt.rendered || ""), 130);
    var tanggal = formatTanggal(halaman.date);
    var link    = halaman.link || "#";

    var thumb = gambarUrl
      ? '<img src="' + gambarUrl + '" alt="" loading="lazy">'
      : '<div class="ph-fallback">' + STAR_SVG + '</div>';

    var badgeHtml = "";
    if(namaTag){
      var styleW = warnaTagMap[namaTag] || warnaTagMap["default"];
      badgeHtml = '<span class="badge-tag" style="background-color: ' + styleW.bg + '; color: ' + styleW.text + '; padding: 3px 8px; border-radius: 12px; font-size: 10.5px; font-weight: 600; display: inline-block; margin-bottom: 6px;">' + namaTag + '</span>';
    }

    return (
      '<article class="news-card">' +
        '<div class="news-thumb">' + thumb + '</div>' +
        '<div class="news-body">' +
          badgeHtml +
          '<span class="news-date">' + tanggal + '</span>' +
          '<h3>' + judul + '</h3>' +
          '<p>' + excerpt + '</p>' +
          '<a class="news-link" href="' + link + '" target="_blank" rel="noopener">Baca selengkapnya ' + ARROW_SVG + '</a>' +
        '</div>' +
      '</article>'
    );
  }
function galeriKartuHTML(url){
    return '<div class="galeri-item"><img src="' + url + '" alt="Dokumentasi kegiatan PCNU Kota Pasuruan" loading="lazy" draggable="false"></div>';
}

function ambilSemuaGambarKonten(htmlContent){
    if(!htmlContent) return [];
    try{
        var parser = new DOMParser();
        var doc = parser.parseFromString(htmlContent, 'text/html');
        var imgs = doc.querySelectorAll('img');
        return Array.prototype.map.call(imgs, function(img){
            return img.getAttribute('src');
        }).filter(Boolean);
    }catch(e){
        return [];
    }
}

function fetchGambarDariMediaLibrary(query){
    return fetch(API_ROOT + "wp/v2/media?" + query)
      .then(function(res){ return res.ok ? res.json() : []; })
      .then(function(daftarMedia){
        return (Array.isArray(daftarMedia) ? daftarMedia : [])
          .filter(function(m){ return m.media_type === "image"; })
          .map(function(m){
            var sizes = m.media_details && m.media_details.sizes;
            return (sizes && sizes.medium_large && sizes.medium_large.source_url)
              || (sizes && sizes.large && sizes.large.source_url)
              || m.source_url;
          })
          .filter(Boolean);
      })
      .catch(function(){ return []; });
}

function muatGaleri(){
    var track = document.getElementById("galeriTrack");
    if(!track) return;

    var skelHtml = "";
    for(var i = 0; i < 6; i++){ skelHtml += '<div class="galeri-skel"></div>'; }
    track.innerHTML = skelHtml;
    track.style.animation = "none";

    fetch(API_ROOT + "wp/v2/pages?_embed&per_page=50&orderby=date&order=desc")
    .then(function(r){ return r.ok ? r.json() : []; })
    .catch(function(){ return []; })
    .then(function(semuaItem){
        semuaItem = Array.isArray(semuaItem) ? semuaItem : [];

        semuaItem.sort(function(a, b){
            return new Date(b.date) - new Date(a.date);
        });

        var semuaGambar = [];

        semuaItem.forEach(function(item){
            var featured = ambilFeaturedImage(item);
            if(featured) semuaGambar.push(featured);

            if(item.content && item.content.rendered){
                var gambarKonten = ambilSemuaGambarKonten(item.content.rendered);
                semuaGambar = semuaGambar.concat(gambarKonten);
            }
        });

        var gambarUnik = semuaGambar.filter(function(url, index){
            return semuaGambar.indexOf(url) === index;
        });

        if(gambarUnik.length) return gambarUnik;

        return fetchGambarDariMediaLibrary("per_page=30&media_type=image&orderby=date&order=desc");
    })
    .then(function(gambarFinal){
        if(!gambarFinal || !gambarFinal.length){
            track.innerHTML = '<div class="galeri-item"><div class="ph-fallback">' + STAR_SVG + '</div></div>';
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
        track.innerHTML = '<div class="galeri-item"><div class="ph-fallback">' + STAR_SVG + '</div></div>';
        track.style.animation = "none";
    });
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

  /* ---------------------------------------------------------
     GALERI: AUTO-SCROLL BERJALAN TERUS + BISA DISCROLL MANUAL
     --------------------------------------------------------- */
  var GALERI_DURASI_MS   = 250000; // 250 detik untuk menempuh satu set foto
  var GALERI_JEDA_RESUME = 2200;   // jeda sebelum auto-scroll lanjut lagi setelah user berinteraksi

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

      // Berhenti sejenak kalau user sedang aktif berinteraksi (drag/scroll manual)
      if(performance.now() < galeriJedaSampai) return;

      var setLebar = track.scrollWidth / 2;
      if(!setLebar || setLebar <= 0) return;

      var kecepatanPerMs = setLebar / GALERI_DURASI_MS;
      wrap.scrollLeft += kecepatanPerMs * delta;

      // Set foto digandakan 2x supaya loop terasa mulus tanpa jeda
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

    // Drag pakai mouse (klik-tahan-geser) untuk pengguna desktop
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

    // Cegah klik "nyangkut" jadi buka lightbox kalau user barusan drag/geser
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

  function tampilkanErrorBerita(grid, pesan, fungsiRetry){
    grid.innerHTML =
      '<div class="news-error">' +
        '<p>' + pesan + '</p>' +
        '<button class="tombol-retry" type="button">Coba muat ulang</button>' +
      '</div>';
    var tombol = grid.querySelector(".tombol-retry");
    if(tombol) tombol.addEventListener("click", fungsiRetry);
  }

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
        daftarItem.forEach(function(item){
          var gambar = ambilFeaturedImage(item);
          kartuHtml += kartuBeritaHTML(item, gambar);
        });

        grid.innerHTML = kartuHtml;
        daftarkanReveal(grid.querySelectorAll(".news-card"));
      })
      .catch(function(err){
        tampilkanErrorBerita(
          grid,
          opsi.pesanError + " (" + err.message + ").",
          opsi.retry
        );
      });
  }

  function muatWarta(){
    muatKontenKartu({
      gridId: "newsGrid",
      endpoint: "wp/v2/pages?_embed&per_page=9&orderby=date&order=desc",
      jumlah: 9,
      pesanKosong: "Belum ada berita yang bisa ditampilkan.",
      pesanError: "Berita belum bisa dimuat",
      retry: muatWarta
    });
  }

  function muatArtikel(){
    var grid = document.getElementById("artikelGrid");
    if(!grid) return;
    tampilkanSkeleton(grid, 6);

    Promise.all([
      fetch(API_ROOT + "wp/v2/tags").then(res => res.json()).catch(() => []),
      fetch(API_ROOT + "wp/v2/posts?_embed&categories=7&per_page=6&orderby=date&order=desc").then(res => {
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        return res.json();
      })
    ])
    .then(function(results){
      var semuaTag = results[0];
      var daftarItem = results[1];

      var tagDict = {};
      if(Array.isArray(semuaTag)){
        semuaTag.forEach(function(tag){
          tagDict[tag.id] = tag.name;
        });
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
      tampilkanErrorBerita(
        grid,
        "Artikel belum bisa dimuat (" + err.message + ").",
        muatArtikel
      );
    });
  }

  function buatPartikelFooter(){
    var wadah = document.getElementById("footerParticles");
    if(!wadah) return;
    var jumlah = 22;
    var html = "";
    for(var i = 0; i < jumlah; i++){
      var kiri = (Math.random() * 100).toFixed(1);
      var ukuran = (Math.random() * 3 + 1.5).toFixed(1);
      var durasi = (Math.random() * 10 + 9).toFixed(1);
      var jeda = (Math.random() * 14).toFixed(1);
      var geser = (Math.random() * 40 - 20).toFixed(0);
      html += '<span style="left:' + kiri + '%;width:' + ukuran + 'px;height:' + ukuran + 'px;animation-duration:' + durasi + 's;animation-delay:' + jeda + 's;--drift:' + geser + 'px;"></span>';
    }
    wadah.innerHTML = html;
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

  /* ---------------------------------------------------------
     SCROLL REVEAL & SMOOTH SCROLLING
     --------------------------------------------------------- */
  var revealObserver = null;
  function dapatkanRevealObserver(){
    if(revealObserver) return revealObserver;
    if(!("IntersectionObserver" in window)) return null;
    revealObserver = new IntersectionObserver(function(entries, obs){
      entries.forEach(function(entry){
        if(entry.isIntersecting){
          entry.target.classList.add("is-visible");
          obs.unobserve(entry.target);
        }
      });
    }, { threshold:0.12, rootMargin:"0px 0px -40px 0px" });
    return revealObserver;
  }

  function daftarkanReveal(elemenList){
    var daftar = Array.prototype.slice.call(elemenList);
    if(!daftar.length) return;
    var observer = dapatkanRevealObserver();
    daftar.forEach(function(el, i){
      el.style.setProperty("--reveal-delay", Math.min(i * 70, 350) + "ms");
      el.classList.add("reveal");
      if(observer){ observer.observe(el); }
      else { el.classList.add("is-visible"); }
    });
  }

  function pasangScrollReveal(){
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

  function pasangSmoothAnchorNav(){
    var navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(function(anchor){
      anchor.addEventListener("click", function(e){
        var href = this.getAttribute("href");
        if(href === "#" || href === "javascript:void(0)") return;
        var target = document.querySelector(href);
        if(target){
          e.preventDefault();
          var offsetHeader = 70;
          var bodyRect = document.body.getBoundingClientRect().top;
          var elementRect = target.getBoundingClientRect().top;
          var elementPosition = elementRect - bodyRect;
          var offsetPosition = elementPosition - offsetHeader;

          window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
          });

          // Tutup menu mobile ketika link navigasi diklik
          var nav = document.querySelector("nav.main-nav");
          if(window.innerWidth <= 980 && nav){
            nav.classList.remove("is-open");
          }
        }
      });
    });
  }

  /* ---------------------------------------------------------
     TOMBOL BACK TO TOP
     --------------------------------------------------------- */
  function pasangBackToTop(){
    var btn = document.getElementById("btnBackToTop");
    if(!btn) return;

    window.addEventListener("scroll", function(){
      if(window.scrollY > 350){
        btn.classList.add("is-visible");
      } else {
        btn.classList.remove("is-visible");
      }
    });

    btn.addEventListener("click", function(){
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });
  }

  /* ---------------------------------------------------------
     LOGIKA MENU & ACCORDION MOBILE (PERBAIKAN UTAMA)
     --------------------------------------------------------- */
  function pasangNavToggle(){
    var toggle = document.querySelector(".nav-toggle");
    var nav = document.querySelector("nav.main-nav");
    if(!toggle || !nav) return;

    // 1. Klik Tombol Hamburger (☰) untuk Buka/Tutup Seluruh Menu
    toggle.addEventListener("click", function(e){
      e.stopPropagation();
      nav.classList.toggle("is-open");
    });

    // 2. Klik Header Dropdown ("Badan Otonom" / "Lembaga") untuk Toggle Buka/Tutup Submenu
    var dropBtns = nav.querySelectorAll(".drop-btn");
    dropBtns.forEach(function(btn){
      btn.addEventListener("click", function(e){
        if(window.innerWidth <= 980){
          e.preventDefault();
          e.stopPropagation();
          var parentDropdown = this.closest(".nav-dropdown");
          
          if(parentDropdown){
            // Tutup dropdown lain jika sedang terbuka
            nav.querySelectorAll(".nav-dropdown").forEach(function(other){
              if(other !== parentDropdown){
                other.classList.remove("is-active");
              }
            });   
            parentDropdown.classList.toggle("is-active");
          }
        }
      });
    });

    document.addEventListener("click", function(e){
      if(window.innerWidth <= 980){
        if(!nav.contains(e.target) && !toggle.contains(e.target)){
          nav.classList.remove("is-open");
          nav.querySelectorAll(".nav-dropdown").forEach(function(drop){
            drop.classList.remove("is-active");
          });
        }
      }
    });
  }

  document.addEventListener("DOMContentLoaded", function(){
    muatIdentitasSitus();
    muatHeroCarousel();
    muatWarta();
    muatArtikel();
    muatGaleri();
    pasangNavToggle();
    pasangKontrolCarousel();
    buatPartikelFooter();
    pasangCountUp();
    pasangScrollReveal();
    pasangSmoothAnchorNav();
    pasangBackToTop();
    pasangInteraksiManualGaleri();
    pasangLightboxGaleri();
    jalankanAutoScrollGaleri();
});
})();
</script>
</body>
</html>
/* ============================================================
   COMMON.JS
   Fungsi bersama yang dipakai di index.php, news/index.php,
   dan articles/index.php supaya tema & perilaku konsisten.
   ============================================================ */
var API_ROOT  = "https://pcnupasuruankota.id/wp-json/";
var STAR_SVG  = '<svg viewBox="0 0 24 24" fill="none"><path d="M12 2l2.6 5.1 5.6.9-4 4 1 5.6L12 15l-5.2 2.6 1-5.6-4-4 5.6-.9L12 2z" fill="currentColor"/></svg>';
var ARROW_SVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';

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

function muatIdentitasSitus(){
  fetch(API_ROOT, { headers:{ "Accept":"application/json" } })
    .then(function(res){
      if(!res.ok) throw new Error("Gagal memuat identitas situs (" + res.status + ")");
      return res.json();
    })
    .then(function(data){
      if(data.name){
        var judul = decodeEntities(data.name);
        var elJudul1 = document.getElementById("siteTitle");
        var elJudul2 = document.getElementById("footerTitle");
        if(elJudul1) elJudul1.textContent = judul;
        if(elJudul2) elJudul2.textContent = judul;
        if(document.body.hasAttribute("data-keep-title") === false){
          // biarkan tiap halaman mengatur document.title sendiri kalau perlu
        }
      }
      if(data.description){
        var elDesc = document.getElementById("footerDesc");
        if(elDesc) elDesc.textContent = decodeEntities(data.description);
      }
      if(data.site_logo){
        muatLogo(data.site_logo);
      }
    })
    .catch(function(err){
      console.warn("Identitas situs pakai fallback statis:", err.message);
    });
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
      if(gambarPertama && gambarPertama.src) return gambarPertama.src;
    }
  }catch(e){}
  return null;
}

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

/* ---------------------------------------------------------
   SCROLL REVEAL
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

/* ---------------------------------------------------------
   FOOTER PARTICLES
   --------------------------------------------------------- */
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
   BACK TO TOP
   --------------------------------------------------------- */
function pasangBackToTop(){
  var btn = document.getElementById("btnBackToTop");
  if(!btn) return;

  window.addEventListener("scroll", function(){
    if(window.scrollY > 350){ btn.classList.add("is-visible"); }
    else { btn.classList.remove("is-visible"); }
  });

  btn.addEventListener("click", function(){
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
}

/* ---------------------------------------------------------
   SMOOTH ANCHOR NAV (hanya untuk link dengan hash di halaman ini)
   --------------------------------------------------------- */
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

        window.scrollTo({ top: offsetPosition, behavior: "smooth" });

        var nav = document.querySelector("nav.main-nav");
        if(window.innerWidth <= 980 && nav){
          nav.classList.remove("is-open");
        }
      }
    });
  });
}

/* ---------------------------------------------------------
   MENU & ACCORDION MOBILE
   --------------------------------------------------------- */
function pasangNavToggle(){
  var toggle = document.querySelector(".nav-toggle");
  var nav = document.querySelector("nav.main-nav");
  if(!toggle || !nav) return;

  toggle.addEventListener("click", function(e){
    e.stopPropagation();
    nav.classList.toggle("is-open");
  });

  var dropBtns = nav.querySelectorAll(".drop-btn");
  dropBtns.forEach(function(btn){
    btn.addEventListener("click", function(e){
      if(window.innerWidth <= 980){
        e.preventDefault();
        e.stopPropagation();
        var parentDropdown = this.closest(".nav-dropdown");
        if(parentDropdown){
          nav.querySelectorAll(".nav-dropdown").forEach(function(other){
            if(other !== parentDropdown){ other.classList.remove("is-active"); }
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

function initTemaBersama(){
  muatIdentitasSitus();
  pasangNavToggle();
  buatPartikelFooter();
  pasangSmoothAnchorNav();
  pasangBackToTop();
}

/* ---------------------------------------------------------
   DAFTAR BERPAGINASI (dipakai oleh /news dan /articles)
   opsi = {
     gridId, paginationId, endpoint ("wp/v2/pages" atau "wp/v2/posts?categories=7"),
     perPage, pakaiTag (bool), pesanKosong, pesanError, halamanAwal
   }
   --------------------------------------------------------- */
function muatDaftarBerpaginasi(opsi){
  var grid = document.getElementById(opsi.gridId);
  var pagWrap = opsi.paginationId ? document.getElementById(opsi.paginationId) : null;
  if(!grid) return;

  var halamanSekarang = opsi.halamanAwal || 1;
  var perPage = opsi.perPage || 12;
  var tagDict = {};
  var tagSudahDiambil = false;

  function ambilTagJikaPerlu(){
    if(!opsi.pakaiTag || tagSudahDiambil) return Promise.resolve();
    return fetch(API_ROOT + "wp/v2/tags?per_page=100")
      .then(function(r){ return r.ok ? r.json() : []; })
      .then(function(semuaTag){
        if(Array.isArray(semuaTag)){
          semuaTag.forEach(function(tag){ tagDict[tag.id] = tag.name; });
        }
        tagSudahDiambil = true;
      })
      .catch(function(){ tagSudahDiambil = true; });
  }

  function bangunPaginasi(totalPages){
    if(!pagWrap) return;
    if(totalPages <= 1){ pagWrap.innerHTML = ""; return; }

    var html = "";
    html += '<button type="button" data-hal="' + (halamanSekarang - 1) + '" ' + (halamanSekarang <= 1 ? "disabled" : "") + ' aria-label="Halaman sebelumnya">‹</button>';

    var tampilkan = [];
    for(var i = 1; i <= totalPages; i++){
      if(i === 1 || i === totalPages || Math.abs(i - halamanSekarang) <= 1){
        tampilkan.push(i);
      }
    }
    var terakhir = 0;
    tampilkan.forEach(function(i){
      if(terakhir && (i - terakhir) > 1){ html += '<span class="dots">…</span>'; }
      html += '<button type="button" class="' + (i === halamanSekarang ? "active" : "") + '" data-hal="' + i + '">' + i + '</button>';
      terakhir = i;
    });

    html += '<button type="button" data-hal="' + (halamanSekarang + 1) + '" ' + (halamanSekarang >= totalPages ? "disabled" : "") + ' aria-label="Halaman berikutnya">›</button>';
    pagWrap.innerHTML = html;

    pagWrap.querySelectorAll("button[data-hal]").forEach(function(btn){
      btn.addEventListener("click", function(){
        var hal = parseInt(this.getAttribute("data-hal"), 10);
        if(!isNaN(hal) && hal >= 1 && hal <= totalPages && hal !== halamanSekarang){
          render(hal);
        }
      });
    });
  }

  function render(halaman){
    halamanSekarang = halaman;
    tampilkanSkeleton(grid, perPage);
    if(pagWrap) pagWrap.innerHTML = "";

    ambilTagJikaPerlu().then(function(){
      var sep = opsi.endpoint.indexOf("?") > -1 ? "&" : "?";
      var url = API_ROOT + opsi.endpoint + sep + "_embed&per_page=" + perPage + "&page=" + halaman + "&orderby=date&order=desc";
      return fetch(url).then(function(res){
        if(!res.ok) throw new Error("Server merespons status " + res.status);
        var totalPages = parseInt(res.headers.get("X-WP-TotalPages") || "1", 10) || 1;
        return res.json().then(function(data){ return { data: data, totalPages: totalPages }; });
      });
    })
    .then(function(hasil){
      var daftarItem = hasil.data;
      if(!Array.isArray(daftarItem) || daftarItem.length === 0){
        tampilkanErrorBerita(grid, opsi.pesanKosong, function(){ render(1); });
        return;
      }

      var kartuHtml = "";
      daftarItem.forEach(function(item){
        var gambar = ambilFeaturedImage(item);
        var namaTag = "";
        if(opsi.pakaiTag && item.tags && item.tags.length > 0){
          namaTag = tagDict[item.tags[0]] || "";
        }
        kartuHtml += kartuBeritaHTML(item, gambar, namaTag);
      });

      grid.innerHTML = kartuHtml;
      daftarkanReveal(grid.querySelectorAll(".news-card"));
      bangunPaginasi(hasil.totalPages);
    })
    .catch(function(err){
      tampilkanErrorBerita(grid, opsi.pesanError + " (" + err.message + ").", function(){ render(halaman); });
    });
  }

  render(halamanSekarang);
}

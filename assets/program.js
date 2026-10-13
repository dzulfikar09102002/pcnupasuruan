/* ============================================================
   PROGRAM KEGIATAN (gaya Instagram)
   Sumber: WP posts dengan kategori ber-slug PROGRAM_KATEGORI_SLUG.
   - Kartu feed: slider foto (gambar unggulan + gambar di konten),
     judul, caption, hashtag (= tag WP), waktu relatif.
   - Detail dibuka sebagai modal (bukan halaman baru) lengkap
     dengan komentar WordPress; URL ikut berubah ke ?p=slug
     sehingga bisa dibagikan.
   Dipakai di index.php (beranda) dan program/index.php.
   Butuh assets/common.js.
   ============================================================ */
var PROGRAM_KATEGORI_SLUG = "program";
var PROGRAM_AKUN = "pcnu.kotapasuruan";
var PROGRAM_AVATAR = "https://pcnupasuruankota.id/wp-content/uploads/2026/07/cropped-pp-scaled-1.png";
var PROGRAM_IG_URL = "https://www.instagram.com/pcnu.kotapasuruan/";
var KUNCI_PENGOMENTAR_PROGRAM = "pcnuPengomentar"; // sama dengan assets/baca.js

var daftarProgram = {}; // slug → item WP yang sudah dimuat
var janjiKategoriProgram = null;

var IKON_KOMENTAR =
  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M20.7 12a8.7 8.7 0 01-12.8 7.7L3 21l1.3-4.9A8.7 8.7 0 1120.7 12z"/></svg>';
var IKON_BAGIKAN =
  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M22 3L9.2 10.1M22 3l-7 18-4-8.9L2 9z"/></svg>';
var IKON_KIRI =
  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>';
var IKON_KANAN =
  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M9 6l6 6-6 6"/></svg>';
var IKON_TUTUP =
  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>';

function escProgram(teks) {
  return String(teks == null ? "" : teks).replace(/[&<>"']/g, function (c) {
    return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
  });
}

/* Warna badge subkategori program (kunci = slug kategori WP).
   Subkategori baru yang belum terdaftar otomatis dapat warna dari paletCadangan. */
var warnaKategoriProgram = {
  event: { bg: "#fef3c7", text: "#b45309" },
  layanan: { bg: "#dbeafe", text: "#1d4ed8" },
};
var paletCadanganProgram = [
  { bg: "#fce7f3", text: "#be185d" },
  { bg: "#ede9fe", text: "#6d28d9" },
  { bg: "#ccfbf1", text: "#0f766e" },
  { bg: "#ffedd5", text: "#c2410c" },
  { bg: "#fee2e2", text: "#b91c1c" },
];

/* Kategori program beserta seluruh subkategorinya (Event, Layanan, …), dicari sekali saja.
   Hasil: { id, ids: [induk + turunan], anak: [kategori turunan], peta: { id: kategori turunan } }
   atau null kalau kategori program belum ada. */
var infoKategoriProgram = null;
function ambilKategoriProgram() {
  if (janjiKategoriProgram) return janjiKategoriProgram;
  janjiKategoriProgram = fetch(API_ROOT + "wp/v2/categories?per_page=100&_fields=id,name,slug,parent,count")
    .then(function (r) {
      return r.ok ? r.json() : [];
    })
    .then(function (semua) {
      semua = Array.isArray(semua) ? semua : [];
      var akar = semua.filter(function (k) {
        return k.slug === PROGRAM_KATEGORI_SLUG;
      })[0];
      if (!akar) return null;
      var info = { id: akar.id, ids: [akar.id], anak: [], peta: {} };
      // Kumpulkan turunan (semua tingkat): WP REST ?categories= tidak menyertakan anak kategori.
      var antrian = [akar.id];
      while (antrian.length) {
        var induk = antrian.shift();
        semua.forEach(function (k) {
          if (k.parent !== induk || info.peta[k.id]) return;
          k.name = decodeEntities(k.name);
          info.peta[k.id] = k;
          info.anak.push(k);
          info.ids.push(k.id);
          antrian.push(k.id);
        });
      }
      info.anak.forEach(function (k, i) {
        k.warna = warnaKategoriProgram[k.slug] || paletCadanganProgram[i % paletCadanganProgram.length];
      });
      infoKategoriProgram = info;
      return info;
    })
    .catch(function () {
      janjiKategoriProgram = null;
      return null;
    });
  return janjiKategoriProgram;
}

/* Subkategori (Event, Layanan, …) yang dicentang pada sebuah program. */
function kategoriProgram(item) {
  if (!infoKategoriProgram || !item.categories) return [];
  return item.categories
    .map(function (id) {
      return infoKategoriProgram.peta[id];
    })
    .filter(Boolean);
}

function badgeKategoriProgramHTML(item) {
  var daftar = kategoriProgram(item);
  if (!daftar.length) return "";
  return (
    '<div class="ig-badges">' +
    daftar
      .map(function (k) {
        return (
          '<a class="badge-tag" href="' + BASE_URL + "program/?kategori=" + k.id + '" style="background-color:' +
          k.warna.bg + ";color:" + k.warna.text + ';">' + escProgram(k.name) + "</a>"
        );
      })
      .join("") +
    "</div>"
  );
}

function urlProgram(item) {
  return BASE_URL + "program/?p=" + encodeURIComponent(item.slug);
}

function urlTagProgram(idTag) {
  return BASE_URL + "program/?tag=" + idTag;
}

/* Semua foto sebuah program: gambar unggulan dulu, lalu gambar di konten (tanpa duplikat). */
function gambarProgram(item) {
  var hasil = [];
  var sudah = {};
  function tambah(url) {
    if (!url) return;
    var kunci = url.replace(/-\d+x\d+(?=\.\w+$)/, "");
    if (sudah[kunci]) return;
    sudah[kunci] = true;
    hasil.push(url);
  }
  try {
    var media = item._embedded["wp:featuredmedia"][0];
    var ukuran = media.media_details && media.media_details.sizes;
    tambah((ukuran && ukuran.large && ukuran.large.source_url) || media.source_url);
  } catch (e) {}
  ambilSemuaGambarKonten(item.content && item.content.rendered).forEach(tambah);
  return hasil;
}

/* Tag WP → hashtag ala Instagram (#BahtsulMasail). */
function hashtagProgram(item) {
  var hasil = [];
  var grup = (item._embedded && item._embedded["wp:term"]) || [];
  grup.forEach(function (daftar) {
    (daftar || []).forEach(function (t) {
      if (t.taxonomy !== "post_tag") return;
      var nama = decodeEntities(t.name).replace(/[^\wÀ-ɏ]+/g, "");
      if (nama) hasil.push({ id: t.id, nama: nama });
    });
  });
  return hasil;
}

function hashtagProgramHTML(item) {
  var tags = hashtagProgram(item);
  if (!tags.length) return "";
  return (
    '<p class="ig-tags">' +
    tags
      .map(function (t) {
        return '<a href="' + urlTagProgram(t.id) + '">#' + escProgram(t.nama) + "</a>";
      })
      .join(" ") +
    "</p>"
  );
}

function jumlahKomentarTertanam(item) {
  var r = item._embedded && item._embedded.replies && item._embedded.replies[0];
  return Array.isArray(r) ? r.length : 0;
}

function waktuRelatif(iso) {
  var d = new Date(iso);
  var detik = (Date.now() - d.getTime()) / 1000;
  if (isNaN(detik)) return "";
  if (detik < 60) return "Baru saja";
  if (detik < 3600) return Math.floor(detik / 60) + " menit yang lalu";
  if (detik < 86400) return Math.floor(detik / 3600) + " jam yang lalu";
  if (detik < 86400 * 7) return Math.floor(detik / 86400) + " hari yang lalu";
  if (detik < 86400 * 30) return Math.floor(detik / (86400 * 7)) + " minggu yang lalu";
  return formatTanggal(iso);
}

function judulProgram(item) {
  return decodeEntities((item.title && item.title.rendered) || "(Tanpa judul)");
}

/* ---------------------------------------------------------
   MARKUP
   --------------------------------------------------------- */
function mediaProgramHTML(daftarGambar, judul, kelas) {
  if (!daftarGambar.length) {
    return '<div class="ig-media ' + (kelas || "") + '"><div class="ig-slides"><div class="ig-slide ig-slide-kosong">' + STAR_SVG + "</div></div></div>";
  }
  var banyak = daftarGambar.length > 1;
  var slides = daftarGambar
    .map(function (url, i) {
      return (
        '<div class="ig-slide"><img src="' + escProgram(url) + '" alt="' + escProgram(judul) + " — foto " + (i + 1) + '"' +
        (i ? ' loading="lazy"' : "") + ' draggable="false"></div>'
      );
    })
    .join("");
  var dots = "";
  if (banyak) {
    for (var i = 0; i < daftarGambar.length; i++) dots += "<span" + (i ? "" : ' class="aktif"') + "></span>";
  }
  return (
    '<div class="ig-media ' + (kelas || "") + '"' + (banyak ? ' data-slider="1"' : "") + ">" +
    '<div class="ig-slides">' + slides + "</div>" +
    (banyak
      ? '<span class="ig-hitung">1/' + daftarGambar.length + "</span>" +
        '<button type="button" class="ig-geser ig-geser-kiri" aria-label="Foto sebelumnya" hidden>' + IKON_KIRI + "</button>" +
        '<button type="button" class="ig-geser ig-geser-kanan" aria-label="Foto berikutnya">' + IKON_KANAN + "</button>" +
        '<div class="ig-dots" aria-hidden="true">' + dots + "</div>"
      : "") +
    "</div>"
  );
}

function kepalaProgramHTML(item) {
  return (
    '<header class="ig-head">' +
    '<a class="ig-head-akun" href="' + PROGRAM_IG_URL + '" target="_blank" rel="noopener" title="Instagram @' + PROGRAM_AKUN + '">' +
    '<img class="ig-avatar" src="' + PROGRAM_AVATAR + '" alt="" width="34" height="34">' +
    '<span class="ig-akun"><strong>' + PROGRAM_AKUN + "</strong><small>Kota Pasuruan</small></span>" +
    "</a>" +
    '<a class="ig-ikuti-mini" href="' + PROGRAM_IG_URL + '" target="_blank" rel="noopener">Ikuti</a>' +
    "</header>"
  );
}

function kartuProgramHTML(item) {
  daftarProgram[item.slug] = item;
  var judul = judulProgram(item);
  var caption = stripHtml((item.excerpt && item.excerpt.rendered) || "").replace(/\s*(\[…\]|\[&hellip;\]|…)\s*$/, "");
  var nKomentar = jumlahKomentarTertanam(item);
  var bolehKomentar = item.comment_status === "open";

  return (
    '<article class="ig-card" data-slug="' + escProgram(item.slug) + '">' +
    kepalaProgramHTML(item) +
    mediaProgramHTML(gambarProgram(item), judul) +
    '<div class="ig-aksi">' +
    '<button type="button" class="ig-ikon" data-buka-program aria-label="Lihat komentar">' + IKON_KOMENTAR + "</button>" +
    '<button type="button" class="ig-ikon" data-bagikan-program aria-label="Bagikan">' + IKON_BAGIKAN + "</button>" +
    "</div>" +
    // .ig-teks bertinggi tetap: badge, judul, caption & hashtag berbagi ruang (lihat rapikanTeksKartuProgram).
    '<div class="ig-body">' +
    '<div class="ig-teks">' +
    badgeKategoriProgramHTML(item) +
    '<h3 class="ig-judul"><a href="' + urlProgram(item) + '" data-buka-program>' + escProgram(judul) + "</a></h3>" +
    (caption ? '<p class="ig-caption"><strong>' + PROGRAM_AKUN + "</strong> " + escProgram(caption) + "</p>" : "") +
    hashtagProgramHTML(item) +
    '<button type="button" class="ig-lagi" data-buka-program hidden>… selengkapnya</button>' +
    "</div>" +
    (nKomentar
      ? '<button type="button" class="ig-lihat-komentar" data-buka-program>Lihat ' + (nKomentar >= 10 ? "semua " : "") + nKomentar + " komentar</button>"
      : bolehKomentar
        ? '<button type="button" class="ig-lihat-komentar" data-buka-program>Tulis komentar…</button>'
        : '<span class="ig-lihat-komentar"></span>') +
    '<time class="ig-waktu" datetime="' + escProgram(tanggalWp(item)) + '">' + waktuRelatif(tanggalWp(item)) + "</time>" +
    "</div>" +
    "</article>"
  );
}

function tampilkanSkeletonProgram(grid, jumlah) {
  var html = "";
  for (var i = 0; i < jumlah; i++) {
    html +=
      '<article class="ig-card ig-card-skel">' +
      '<div class="ig-head"><span class="ig-avatar news-skel"></span><span class="news-skel" style="height:12px;width:45%;border-radius:4px;"></span></div>' +
      '<div class="ig-media news-skel"></div>' +
      '<div class="ig-body">' +
      '<div class="news-skel" style="height:16px;width:80%;border-radius:4px;"></div>' +
      '<div class="news-skel" style="height:12px;width:100%;border-radius:4px;margin-top:10px;"></div>' +
      '<div class="news-skel" style="height:12px;width:60%;border-radius:4px;margin-top:6px;"></div>' +
      "</div></article>";
  }
  grid.innerHTML = html;
}

/* ---------------------------------------------------------
   SLIDER FOTO
   --------------------------------------------------------- */
function pasangSliderProgram(media) {
  if (!media || media.getAttribute("data-slider") !== "1" || media._sliderTerpasang) return;
  media._sliderTerpasang = true;
  var slides = media.querySelector(".ig-slides");
  var dots = media.querySelectorAll(".ig-dots span");
  var hitung = media.querySelector(".ig-hitung");
  var kiri = media.querySelector(".ig-geser-kiri");
  var kanan = media.querySelector(".ig-geser-kanan");
  var total = slides.children.length;
  var aktif = 0;

  function perbarui() {
    var idx = Math.round(slides.scrollLeft / Math.max(slides.clientWidth, 1));
    idx = Math.min(Math.max(idx, 0), total - 1);
    if (idx === aktif && hitung.textContent) return;
    aktif = idx;
    dots.forEach(function (d, i) {
      d.classList.toggle("aktif", i === idx);
    });
    hitung.textContent = idx + 1 + "/" + total;
    kiri.hidden = idx === 0;
    kanan.hidden = idx === total - 1;
  }

  media._geser = function (arah) {
    var tujuan = Math.min(Math.max(aktif + arah, 0), total - 1);
    slides.scrollTo({ left: tujuan * slides.clientWidth, behavior: "smooth" });
  };

  slides.addEventListener("scroll", perbarui, { passive: true });
  kiri.addEventListener("click", function (e) {
    e.stopPropagation();
    media._geser(-1);
  });
  kanan.addEventListener("click", function (e) {
    e.stopPropagation();
    media._geser(1);
  });
}

/* ---------------------------------------------------------
   BAGIKAN
   --------------------------------------------------------- */
function tampilkanToastProgram(pesan) {
  var toast = document.getElementById("igToast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "igToast";
    toast.className = "ig-toast";
    toast.setAttribute("role", "status");
    document.body.appendChild(toast);
  }
  toast.textContent = pesan;
  toast.classList.add("tampil");
  clearTimeout(toast._timer);
  toast._timer = setTimeout(function () {
    toast.classList.remove("tampil");
  }, 2200);
}

function bagikanProgram(item) {
  var url = new URL(urlProgram(item), window.location.href).href;
  var judul = judulProgram(item);
  if (navigator.share) {
    navigator.share({ title: judul, text: judul + " — PCNU Kota Pasuruan", url: url }).catch(function () {});
    return;
  }
  function berhasil() {
    tampilkanToastProgram("Tautan program disalin");
  }
  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(url).then(berhasil);
    return;
  }
  var ta = document.createElement("textarea");
  ta.value = url;
  ta.style.position = "fixed";
  ta.style.opacity = "0";
  document.body.appendChild(ta);
  ta.select();
  try {
    document.execCommand("copy");
    berhasil();
  } catch (e) {}
  document.body.removeChild(ta);
}

/* Area teks kartu bertinggi tetap. Judul tampil penuh selama muat; caption mengisi sisa
   ruang di bawahnya; baru dipotong "…" kalau ruangnya habis. Hashtag (1 baris) di dasar area. */
function rapikanTeksKartuProgram(kartu) {
  var zona = kartu.querySelector(".ig-teks");
  if (!zona || !zona.clientHeight) return;
  var judul = zona.querySelector(".ig-judul");
  var cap = zona.querySelector(".ig-caption");
  var tags = zona.querySelector(".ig-tags");
  var lagi = zona.querySelector(".ig-lagi");

  judul.style.webkitLineClamp = "";
  if (cap) {
    cap.hidden = false;
    cap.style.webkitLineClamp = "";
  }

  var atasZona = zona.getBoundingClientRect().top;
  var bawah = zona.clientHeight - (tags ? tags.offsetHeight + 6 : 0);
  var terpotong = false;
  var terakhir = judul;

  var lhJ = parseFloat(getComputedStyle(judul).lineHeight) || 22;
  var rJ = judul.getBoundingClientRect();
  var maksJ = Math.max(1, Math.floor((bawah - (rJ.top - atasZona)) / lhJ + 0.02));
  if (rJ.height > maksJ * lhJ + 1) {
    judul.style.webkitLineClamp = String(maksJ);
    terpotong = true;
    if (cap) cap.hidden = true;
  } else if (cap) {
    var lhC = parseFloat(getComputedStyle(cap).lineHeight) || 21;
    var rC = cap.getBoundingClientRect();
    var maksC = Math.floor((bawah - (rC.top - atasZona)) / lhC + 0.02);
    if (maksC < 1) {
      cap.hidden = true;
      terpotong = true;
    } else {
      terakhir = cap;
      if (rC.height > maksC * lhC + 1) {
        cap.style.webkitLineClamp = String(maksC);
        terpotong = true;
      }
    }
  }

  lagi.hidden = !terpotong;
  if (terpotong) {
    // "… selengkapnya" menimpa ujung baris terakhir yang terlihat (seperti Instagram).
    lagi.style.top = terakhir.offsetTop + terakhir.offsetHeight - lagi.offsetHeight + "px";
  }
}

function rapikanTeksGridProgram(grid) {
  grid.querySelectorAll(".ig-card").forEach(rapikanTeksKartuProgram);
}
/* Interaksi di dalam grid kartu (delegasi, cukup dipasang sekali per grid). */
function pasangInteraksiGridProgram(grid) {
  grid.querySelectorAll(".ig-media").forEach(pasangSliderProgram);
  rapikanTeksGridProgram(grid);
  if (grid._interaksiTerpasang) return;
  grid._interaksiTerpasang = true;

  // Ukuran teks berubah saat font web selesai dimuat / layar diubah → hitung ulang.
  var jeda = null;
  window.addEventListener("resize", function () {
    clearTimeout(jeda);
    jeda = setTimeout(function () {
      rapikanTeksGridProgram(grid);
    }, 150);
  });
  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(function () {
      rapikanTeksGridProgram(grid);
    });
  }

  grid.addEventListener("click", function (e) {
    var kartu = e.target.closest(".ig-card");
    if (!kartu) return;
    var item = daftarProgram[kartu.getAttribute("data-slug")];
    if (!item) return;

    if (e.target.closest("[data-bagikan-program]")) {
      bagikanProgram(item);
      return;
    }
    if (e.target.closest("[data-buka-program]") || e.target.closest(".ig-slide")) {
      e.preventDefault();
      bukaModalProgram(item);
    }
  });
}

/* ---------------------------------------------------------
   MODAL DETAIL
   --------------------------------------------------------- */
var modalProgram = null;
var programAktif = null;
var fokusSebelumModal = null;
var modalMendorongRiwayat = false;

function bangunModalProgram() {
  if (modalProgram) return modalProgram;
  modalProgram = document.createElement("div");
  modalProgram.className = "ig-modal";
  modalProgram.id = "igModal";
  modalProgram.setAttribute("aria-hidden", "true");
  modalProgram.innerHTML =
    '<div class="ig-modal-backdrop" data-tutup-program></div>' +
    '<button type="button" class="ig-modal-tutup" data-tutup-program aria-label="Tutup">' + IKON_TUTUP + "</button>" +
    '<div class="ig-modal-kotak" role="dialog" aria-modal="true" aria-labelledby="igModalJudul">' +
    '<div class="ig-modal-media" id="igModalMedia"></div>' +
    '<div class="ig-modal-panel">' +
    '<div class="ig-modal-kepala" id="igModalKepala"></div>' +
    '<div class="ig-modal-gulir" id="igModalGulir">' +
    '<div class="ig-modal-caption" id="igModalCaption"></div>' +
    '<ol class="ig-komentar-daftar" id="igKomentarDaftar"></ol>' +
    "</div>" +
    '<div class="ig-modal-kaki">' +
    '<div class="ig-aksi">' +
    '<button type="button" class="ig-ikon" id="igModalFokusKomentar" aria-label="Tulis komentar">' + IKON_KOMENTAR + "</button>" +
    '<button type="button" class="ig-ikon" id="igModalBagikan" aria-label="Bagikan">' + IKON_BAGIKAN + "</button>" +
    "</div>" +
    '<time class="ig-waktu" id="igModalWaktu"></time>' +
    '<div id="igModalForm"></div>' +
    "</div>" +
    "</div>" +
    "</div>";
  document.body.appendChild(modalProgram);

  modalProgram.addEventListener("click", function (e) {
    if (e.target.closest("[data-tutup-program]")) tutupModalProgram();
  });
  document.getElementById("igModalBagikan").addEventListener("click", function () {
    if (programAktif) bagikanProgram(programAktif);
  });
  document.getElementById("igModalFokusKomentar").addEventListener("click", function () {
    var ta = document.getElementById("igKomentarIsi");
    if (ta) ta.focus();
  });
  document.addEventListener("keydown", function (e) {
    if (!modalProgram.classList.contains("is-open")) return;
    if (e.key === "Escape") tutupModalProgram();
    var tag = (e.target.tagName || "").toLowerCase();
    if (tag === "textarea" || tag === "input") return;
    var media = modalProgram.querySelector(".ig-media");
    if (media && media._geser && e.key === "ArrowLeft") media._geser(-1);
    if (media && media._geser && e.key === "ArrowRight") media._geser(1);
  });
  window.addEventListener("popstate", function () {
    var slug = new URLSearchParams(window.location.search).get("p");
    modalMendorongRiwayat = false;
    if (!slug) tutupModalProgram(true);
    else if (!programAktif || programAktif.slug !== slug) bukaProgramDariSlug(slug, true);
  });
  return modalProgram;
}

function captionLengkapHTML(item) {
  var doc = new DOMParser().parseFromString((item.content && item.content.rendered) || "", "text/html");
  doc.body
    .querySelectorAll("img, figure, picture, video, audio, iframe, script, style, noscript, .wp-block-gallery, .gallery")
    .forEach(function (el) {
      el.remove();
    });
  doc.body.querySelectorAll("p, div").forEach(function (el) {
    if (!el.textContent.trim() && !el.querySelector("br")) el.remove();
  });
  doc.body.querySelectorAll("a[href^='http']").forEach(function (a) {
    a.setAttribute("target", "_blank");
    a.setAttribute("rel", "noopener");
  });
  return doc.body.innerHTML.trim();
}

function setUrlProgram(slug, dorong) {
  if (!window.history.pushState) return;
  var params = new URLSearchParams(window.location.search);
  if (slug) params.set("p", slug);
  else params.delete("p");
  var qs = params.toString();
  var url = window.location.pathname + (qs ? "?" + qs : "") + window.location.hash;
  if (dorong) window.history.pushState({ program: slug }, "", url);
  else window.history.replaceState(null, "", url);
}

function bukaModalProgram(item, dariRiwayat) {
  bangunModalProgram();
  daftarProgram[item.slug] = item;
  var sudahTerbuka = modalProgram.classList.contains("is-open");
  programAktif = item;
  var judul = judulProgram(item);

  document.getElementById("igModalMedia").innerHTML = mediaProgramHTML(gambarProgram(item), judul, "ig-media-modal");
  pasangSliderProgram(document.querySelector("#igModalMedia .ig-media"));
  document.getElementById("igModalKepala").innerHTML = kepalaProgramHTML(item);

  var caption = captionLengkapHTML(item);
  document.getElementById("igModalCaption").innerHTML =
    '<img class="ig-avatar" src="' + PROGRAM_AVATAR + '" alt="" width="34" height="34">' +
    "<div>" +
    badgeKategoriProgramHTML(item) +
    '<h2 class="ig-modal-judul" id="igModalJudul">' + escProgram(judul) + "</h2>" +
    (caption ? '<div class="ig-modal-teks">' + caption + "</div>" : "") +
    hashtagProgramHTML(item) +
    '<time class="ig-waktu-kecil">' + formatTanggal(tanggalWp(item)) + "</time>" +
    "</div>";

  var waktu = document.getElementById("igModalWaktu");
  waktu.textContent = waktuRelatif(tanggalWp(item));
  waktu.setAttribute("datetime", tanggalWp(item));
  document.getElementById("igModalGulir").scrollTop = 0;

  pasangFormKomentarProgram(item);
  muatKomentarProgram(item);

  if (!sudahTerbuka) {
    fokusSebelumModal = document.activeElement;
    modalProgram.classList.add("is-open");
    modalProgram.setAttribute("aria-hidden", "false");
    document.body.classList.add("lightbox-open");
    modalProgram.querySelector(".ig-modal-tutup").focus({ preventScroll: true });
  }
  if (!dariRiwayat) {
    var dorong = !sudahTerbuka;
    setUrlProgram(item.slug, dorong);
    if (dorong) modalMendorongRiwayat = true;
  }
  document.title = judul + " — Program PCNU Kota Pasuruan";
}

function tutupModalProgram(dariRiwayat) {
  if (!modalProgram || !modalProgram.classList.contains("is-open")) return;
  modalProgram.classList.remove("is-open");
  modalProgram.setAttribute("aria-hidden", "true");
  document.body.classList.remove("lightbox-open");
  programAktif = null;
  if (document.body.getAttribute("data-judul-asli")) document.title = document.body.getAttribute("data-judul-asli");
  if (!dariRiwayat) {
    if (modalMendorongRiwayat) window.history.back();
    else setUrlProgram(null, false);
  }
  modalMendorongRiwayat = false;
  if (fokusSebelumModal && fokusSebelumModal.focus) fokusSebelumModal.focus({ preventScroll: true });
}

/* Buka modal dari slug (link bagikan ?p=slug). */
function bukaProgramDariSlug(slug, dariRiwayat) {
  if (daftarProgram[slug]) {
    bukaModalProgram(daftarProgram[slug], dariRiwayat);
    return;
  }
  ambilKategoriProgram()
    .then(function (info) {
      return fetch(
        API_ROOT + "wp/v2/posts?_embed&slug=" + encodeURIComponent(slug) + (info ? "&categories=" + info.ids.join(",") : ""),
      );
    })
    .then(function (r) {
      return r.ok ? r.json() : [];
    })
    .then(function (data) {
      if (Array.isArray(data) && data[0]) bukaModalProgram(data[0], dariRiwayat);
      else setUrlProgram(null, false);
    })
    .catch(function () {});
}

/* ---------------------------------------------------------
   KOMENTAR DI MODAL
   --------------------------------------------------------- */
function namaPengomentar(k) {
  var nama = decodeEntities(k.author_name || "").trim();
  if (!nama) return "Anonim";
  // Akun admin WP bernama alamat email — jangan pernah ditampilkan.
  if (nama.indexOf("@") > -1) return "Redaksi PCNU Kota Pasuruan";
  return nama;
}

function komentarProgramHTML(k, opsi) {
  var nama = escProgram(opsi.nama);
  var avatar = opsi.avatar
    ? '<img class="ig-avatar ig-avatar-kecil" src="' + escProgram(opsi.avatar) + '" alt="" width="30" height="30" loading="lazy">'
    : '<span class="ig-avatar ig-avatar-kecil ig-avatar-huruf">' + escProgram(opsi.nama.charAt(0).toUpperCase()) + "</span>";
  return (
    '<li class="ig-komentar' + (opsi.baru ? " ig-komentar-baru" : "") + '" id="igk-' + (k.id || "baru") + '">' +
    avatar +
    '<div class="ig-komentar-main">' +
    '<div class="ig-komentar-isi"><strong>' + nama + "</strong> " + opsi.isi + "</div>" +
    '<div class="ig-komentar-meta">' +
    "<span>" + escProgram(opsi.waktu) + "</span>" +
    (opsi.moderasi ? '<span class="ig-moderasi">Menunggu moderasi</span>' : "") +
    (opsi.bolehBalas && k.id
      ? '<button type="button" class="ig-balas" data-id="' + k.id + '" data-nama="' + nama + '">Balas</button>'
      : "") +
    "</div>" +
    '<ol class="ig-komentar-anak"></ol>' +
    "</div>" +
    "</li>"
  );
}

function muatKomentarProgram(item) {
  var daftar = document.getElementById("igKomentarDaftar");
  var bolehBalas = item.comment_status === "open";
  daftar.innerHTML = '<li class="ig-komentar-info">Memuat komentar…</li>';

  fetch(API_ROOT + "wp/v2/comments?post=" + item.id + "&per_page=100&order=asc&orderby=date")
    .then(function (r) {
      return r.ok ? r.json() : [];
    })
    .then(function (semua) {
      if (!programAktif || programAktif.id !== item.id) return;
      semua = Array.isArray(semua) ? semua : [];
      if (!semua.length) {
        daftar.innerHTML = bolehBalas
          ? '<li class="ig-komentar-info" id="igKomentarKosong">Belum ada komentar. Jadilah yang pertama memberi tanggapan.</li>'
          : "";
        return;
      }
      // Balasan bertingkat diratakan di bawah komentar induk teratas (seperti Instagram).
      var peta = {};
      semua.forEach(function (k) {
        peta[k.id] = k;
      });
      function akar(k) {
        var n = 0;
        while (k.parent && peta[k.parent] && n++ < 20) k = peta[k.parent];
        return k;
      }
      daftar.innerHTML = "";
      semua.forEach(function (k) {
        var html = komentarProgramHTML(k, {
          nama: namaPengomentar(k),
          avatar: k.author_avatar_urls && k.author_avatar_urls["48"],
          isi: (k.content && k.content.rendered) || "",
          waktu: waktuRelatif(tanggalWp(k)),
          bolehBalas: bolehBalas,
        });
        var induk = k.parent ? akar(k) : null;
        var wadah = induk && induk.id !== k.id ? document.querySelector("#igk-" + induk.id + " > .ig-komentar-main > .ig-komentar-anak") : null;
        (wadah || daftar).insertAdjacentHTML("beforeend", html);
      });
    })
    .catch(function () {
      daftar.innerHTML = '<li class="ig-komentar-info">Komentar belum bisa dimuat.</li>';
    });
}

function bacaPengomentarProgram() {
  try {
    return JSON.parse(localStorage.getItem(KUNCI_PENGOMENTAR_PROGRAM) || "null");
  } catch (e) {
    return null;
  }
}

function simpanPengomentarProgram(data) {
  try {
    if (data) localStorage.setItem(KUNCI_PENGOMENTAR_PROGRAM, JSON.stringify(data));
    else localStorage.removeItem(KUNCI_PENGOMENTAR_PROGRAM);
  } catch (e) {}
}

function pasangFormKomentarProgram(item) {
  var wadah = document.getElementById("igModalForm");
  if (item.comment_status !== "open") {
    wadah.innerHTML = '<p class="ig-komentar-tutup">Komentar dinonaktifkan untuk program ini.</p>';
    return;
  }
  var tersimpan = bacaPengomentarProgram();
  wadah.innerHTML =
    '<form class="ig-form" id="igFormKomentar" method="post" action="' + BASE_URL + 'api/komentar.php" novalidate>' +
    '<input type="hidden" name="comment_post_ID" value="' + item.id + '">' +
    '<input type="hidden" name="comment_parent" id="igKomentarParent" value="0">' +
    '<input type="hidden" name="kembali" value="' + escProgram(window.location.pathname + window.location.search) + '">' +
    '<div class="hp-field" aria-hidden="true"><input type="text" name="situs_alt" tabindex="-1" autocomplete="off"></div>' +
    '<div class="ig-balas-info" id="igBalasInfo" hidden><span></span><button type="button" id="igBatalBalas">Batal</button></div>' +
    '<div class="ig-identitas" id="igIdentitas" hidden>' +
    '<input type="text" name="author" id="igKomentarNama" maxlength="245" autocomplete="name" placeholder="Nama *" aria-label="Nama" value="' + escProgram(tersimpan && tersimpan.nama) + '">' +
    '<input type="email" name="email" id="igKomentarEmail" maxlength="100" autocomplete="email" placeholder="Email * (privat)" aria-label="Email" value="' + escProgram(tersimpan && tersimpan.email) + '">' +
    "</div>" +
    (tersimpan && tersimpan.nama && tersimpan.email
      ? '<p class="ig-sebagai" id="igSebagai">Berkomentar sebagai <strong>' + escProgram(tersimpan.nama) + '</strong> · <button type="button" id="igGantiIdentitas">ganti</button></p>'
      : "") +
    '<div class="ig-tulis">' +
    '<textarea name="comment" id="igKomentarIsi" rows="1" maxlength="5000" placeholder="Tambahkan komentar…" aria-label="Komentar"></textarea>' +
    '<button type="submit" id="igKirimKomentar">Kirim</button>' +
    "</div>" +
    '<p class="ig-status" id="igStatusKomentar" role="status"></p>' +
    "</form>";

  var form = document.getElementById("igFormKomentar");
  var isi = document.getElementById("igKomentarIsi");
  var nama = document.getElementById("igKomentarNama");
  var email = document.getElementById("igKomentarEmail");
  var parent = document.getElementById("igKomentarParent");
  var balasInfo = document.getElementById("igBalasInfo");
  var identitas = document.getElementById("igIdentitas");
  var status = document.getElementById("igStatusKomentar");
  var tombol = document.getElementById("igKirimKomentar");
  var ganti = document.getElementById("igGantiIdentitas");

  function setStatus(pesan, jenis) {
    status.textContent = pesan || "";
    status.className = "ig-status" + (jenis ? " " + jenis : "");
  }
  function batalBalas() {
    parent.value = "0";
    balasInfo.hidden = true;
  }

  // Kolom nama/email baru muncul saat mulai menulis (kecuali sudah tersimpan).
  isi.addEventListener("focus", function () {
    if (document.getElementById("igSebagai")) return;
    identitas.hidden = false;
  });
  isi.addEventListener("input", function () {
    isi.style.height = "auto";
    isi.style.height = Math.min(isi.scrollHeight, 120) + "px";
  });
  if (ganti) {
    ganti.addEventListener("click", function () {
      identitas.hidden = false;
      document.getElementById("igSebagai").remove();
      nama.focus();
    });
  }
  document.getElementById("igBatalBalas").addEventListener("click", batalBalas);

  var daftar = document.getElementById("igKomentarDaftar");
  daftar.onclick = function (e) {
    var b = e.target.closest(".ig-balas");
    if (!b) return;
    parent.value = b.getAttribute("data-id");
    balasInfo.querySelector("span").textContent = "Membalas " + b.getAttribute("data-nama");
    balasInfo.hidden = false;
    if (isi.value.indexOf("@") !== 0) isi.value = "@" + b.getAttribute("data-nama") + " " + isi.value;
    isi.focus();
  };

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    setStatus("");
    if (!isi.value.trim()) return setStatus("Silakan tulis komentar Anda.", "gagal"), isi.focus();
    if (!nama.value.trim() || !email.value.trim() || !email.checkValidity()) {
      identitas.hidden = false;
      var sebagai = document.getElementById("igSebagai");
      if (sebagai) sebagai.remove();
      if (!nama.value.trim()) return setStatus("Nama wajib diisi.", "gagal"), nama.focus();
      return setStatus("Alamat email tidak valid.", "gagal"), email.focus();
    }
    simpanPengomentarProgram({ nama: nama.value.trim(), email: email.value.trim(), situs: "" });

    tombol.disabled = true;
    tombol.textContent = "…";
    var idProgram = item.id;

    fetch(form.getAttribute("action"), {
      method: "POST",
      headers: { Accept: "application/json" },
      body: new FormData(form),
    })
      .then(function (res) {
        return res.json().catch(function () {
          throw new Error("Respons server tidak valid (" + res.status + ")");
        });
      })
      .then(function (hasil) {
        if (!hasil.ok) return setStatus(hasil.pesan || "Komentar gagal dikirim.", "gagal");
        if (!programAktif || programAktif.id !== idProgram) return;
        var k = hasil.komentar || {};
        var html = komentarProgramHTML(
          { id: k.id },
          {
            nama: k.nama || nama.value.trim(),
            avatar: k.avatar,
            isi: k.isi || "",
            waktu: "Baru saja",
            moderasi: hasil.status === "moderasi",
            bolehBalas: hasil.status !== "moderasi",
            baru: true,
          },
        );
        var target = daftar;
        if (parent.value !== "0") {
          var li = document.getElementById("igk-" + parent.value);
          var akar = li;
          while (akar && akar.parentElement && akar.parentElement.classList.contains("ig-komentar-anak")) {
            akar = akar.parentElement.closest(".ig-komentar");
          }
          if (akar) target = akar.querySelector(".ig-komentar-anak");
        }
        var kosong = document.getElementById("igKomentarKosong");
        if (kosong) kosong.remove();
        target.insertAdjacentHTML("beforeend", html);
        var baru = target.lastElementChild;
        if (baru) baru.scrollIntoView({ behavior: "smooth", block: "nearest" });

        isi.value = "";
        isi.style.height = "";
        batalBalas();
        setStatus(hasil.pesan, "sukses");
      })
      .catch(function (err) {
        setStatus("Komentar gagal dikirim: " + err.message, "gagal");
      })
      .then(function () {
        tombol.disabled = false;
        tombol.textContent = "Kirim";
      });
  });
}

/* ---------------------------------------------------------
   PEMUAT: BERANDA & HALAMAN DAFTAR
   --------------------------------------------------------- */
function catatJudulAsli() {
  if (!document.body.getAttribute("data-judul-asli")) {
    document.body.setAttribute("data-judul-asli", document.title);
  }
}

/* Beranda: N kartu terbaru. Kurang dari N → satu baris yang bisa digeser;
   tepat N (6) → grid diam 3 + 3 (di HP tetap digeser, lihat .ig-grid-penuh di theme.css). */
function muatProgramBeranda(gridId, jumlah) {
  var grid = document.getElementById(gridId);
  if (!grid) return;
  catatJudulAsli();
  bangunModalProgram();
  tampilkanSkeletonProgram(grid, 3);

  function ulang() {
    muatProgramBeranda(gridId, jumlah);
  }

  ambilKategoriProgram()
    .then(function (info) {
      if (!info) return [];
      return fetch(API_ROOT + "wp/v2/posts?_embed&categories=" + info.ids.join(",") + "&per_page=" + jumlah + "&orderby=date&order=desc").then(
        function (res) {
          if (!res.ok) throw new Error("Server merespons status " + res.status);
          return res.json();
        },
      );
    })
    .then(function (daftarItem) {
      if (!Array.isArray(daftarItem) || !daftarItem.length) {
        tampilkanErrorBerita(grid, "Belum ada program kegiatan yang dipublikasikan.", ulang);
        return;
      }
      grid.innerHTML = daftarItem.map(kartuProgramHTML).join("");
      grid.classList.toggle("ig-grid-penuh", daftarItem.length >= jumlah);
      daftarkanReveal(grid.querySelectorAll(".ig-card"));
      pasangInteraksiGridProgram(grid);
      pasangPanahBarisProgram(grid);
    })
    .catch(function (err) {
      tampilkanErrorBerita(grid, "Program kegiatan belum bisa dimuat (" + err.message + ").", ulang);
    });

  var slug = new URLSearchParams(window.location.search).get("p");
  if (slug) bukaProgramDariSlug(slug, true);
}

/* Tombol panah untuk baris kartu yang digeser (beranda). */
function pasangPanahBarisProgram(grid) {
  var luar = grid.parentElement;
  var kiri = luar && luar.querySelector(".ig-baris-kiri");
  var kanan = luar && luar.querySelector(".ig-baris-kanan");
  if (!kiri || !kanan) return;
  function perbarui() {
    var maks = grid.scrollWidth - grid.clientWidth - 4;
    kiri.disabled = grid.scrollLeft <= 4;
    kanan.disabled = grid.scrollLeft >= maks;
    luar.classList.toggle("bisa-geser", maks > 4);
  }
  function geser(arah) {
    var kartu = grid.querySelector(".ig-card");
    var langkah = kartu ? kartu.getBoundingClientRect().width + 24 : grid.clientWidth * 0.8;
    grid.scrollBy({ left: arah * langkah, behavior: "smooth" });
  }
  if (!grid._panahTerpasang) {
    grid._panahTerpasang = true;
    kiri.addEventListener("click", function () {
      geser(-1);
    });
    kanan.addEventListener("click", function () {
      geser(1);
    });
    grid.addEventListener("scroll", perbarui, { passive: true });
    window.addEventListener("resize", perbarui);
  }
  perbarui();
}

/* Halaman /program: daftar berpaginasi (?s=, ?tag=, ?hal=) + buka ?p=slug. */
function muatHalamanProgram(opsi) {
  catatJudulAsli();
  bangunModalProgram();
  var grid = document.getElementById(opsi.gridId);

  ambilKategoriProgram().then(function (info) {
    if (!info) {
      if (grid) grid.innerHTML = '<div class="news-error"><p>Belum ada program kegiatan yang dipublikasikan.</p></div>';
      return;
    }
    // ?kategori=ID → hanya subkategori itu (beserta turunannya).
    var idFilter = parseInt(new URLSearchParams(window.location.search).get("kategori") || "0", 10) || 0;
    var kategoriAktif = info.peta[idFilter] || null;
    var ids = info.ids;
    if (kategoriAktif) {
      ids = [kategoriAktif.id];
      for (var i = 0; i < ids.length; i++) {
        info.anak.forEach(function (k) {
          if (k.parent === ids[i]) ids.push(k.id);
        });
      }
    }
    muatChipKategoriProgram(opsi.kategoriId, info, kategoriAktif);

    muatDaftarBerpaginasi({
      gridId: opsi.gridId,
      paginationId: opsi.paginationId,
      infoId: opsi.infoId,
      endpoint: "wp/v2/posts?categories=" + ids.join(","),
      perPage: opsi.perPage || 12,
      pakaiTag: true,
      pakaiUrl: true,
      pesanKosong: "Belum ada program kegiatan yang dipublikasikan.",
      pesanError: "Program kegiatan belum bisa dimuat",
      kartuHTML: kartuProgramHTML,
      skeleton: tampilkanSkeletonProgram,
      selektorKartu: ".ig-card",
      sesudahRender: pasangInteraksiGridProgram,
    });
  });

  var slug = new URLSearchParams(window.location.search).get("p");
  if (slug) bukaProgramDariSlug(slug, true);
}

/* Chip filter subkategori di halaman /program: Semua · Event · Layanan · … */
function muatChipKategoriProgram(wadahId, info, kategoriAktif) {
  var wadah = wadahId ? document.getElementById(wadahId) : null;
  if (!wadah || !info.anak.length) return;
  var params = new URLSearchParams(window.location.search);
  params.delete("p");
  params.delete("hal");
  function href(id) {
    if (id) params.set("kategori", id);
    else params.delete("kategori");
    var qs = params.toString();
    return window.location.pathname + (qs ? "?" + qs : "");
  }
  var html = '<a class="chip' + (kategoriAktif ? "" : " aktif") + '" href="' + href(0) + '">Semua</a>';
  info.anak.forEach(function (k) {
    html +=
      '<a class="chip chip-kategori' + (kategoriAktif && kategoriAktif.id === k.id ? " aktif" : "") + '" href="' + href(k.id) + '">' +
      '<span class="chip-titik" style="background:' + k.warna.text + ';"></span>' + escProgram(k.name) + "</a>";
  });
  wadah.innerHTML = html;
}
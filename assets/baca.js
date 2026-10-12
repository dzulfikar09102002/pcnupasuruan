/* ============================================================
   HALAMAN BACA (news/baca.php & articles/baca.php)
   Konten dirender di server (partials/single.php); file ini
   menambahkan interaksi: progres baca, daftar isi, lightbox,
   salin tautan, dan form komentar (balas + kirim via AJAX).
   ============================================================ */
(function () {
  "use strict";

  var KUNCI_PENGOMENTAR = "pcnuPengomentar";

  /* ---------------------------------------------------------
     PROGRES BACA
     --------------------------------------------------------- */
  function pasangProgresBaca() {
    var bar = document.getElementById("progresBaca");
    var artikel = document.getElementById("entryContent");
    if (!bar || !artikel) return;

    function perbarui() {
      var rect = artikel.getBoundingClientRect();
      var total = rect.height - window.innerHeight * 0.6;
      var sudah = -rect.top + window.innerHeight * 0.2;
      var persen = total > 0 ? Math.min(Math.max(sudah / total, 0), 1) : 0;
      bar.style.transform = "scaleX(" + persen + ")";
    }
    window.addEventListener("scroll", perbarui, { passive: true });
    window.addEventListener("resize", perbarui);
    perbarui();
  }

  /* ---------------------------------------------------------
     RAPIKAN KONTEN WORDPRESS
     --------------------------------------------------------- */
  function rapikanKonten() {
    var konten = document.getElementById("entryContent");
    if (!konten) return;

    // Tabel lebar bisa digeser di layar kecil.
    konten.querySelectorAll("table").forEach(function (tabel) {
      if (tabel.parentElement.classList.contains("tabel-scroll")) return;
      var wadah = document.createElement("div");
      wadah.className = "tabel-scroll";
      tabel.parentNode.insertBefore(wadah, tabel);
      wadah.appendChild(tabel);
    });

    // Video/embed (YouTube dll.) responsif 16:9.
    konten.querySelectorAll("iframe").forEach(function (iframe) {
      var src = iframe.getAttribute("src") || "";
      if (!/youtube|youtu\.be|vimeo|facebook\.com\/plugins\/video|google\.com\/maps/.test(src)) return;
      if (iframe.parentElement.classList.contains("embed-responsif")) return;
      var wadah = document.createElement("div");
      wadah.className = "embed-responsif";
      iframe.parentNode.insertBefore(wadah, iframe);
      wadah.appendChild(iframe);
    });

    // Link keluar dibuka di tab baru.
    konten.querySelectorAll("a[href^='http']").forEach(function (a) {
      if (a.hostname !== window.location.hostname) {
        a.setAttribute("target", "_blank");
        a.setAttribute("rel", "noopener");
      }
    });
  }

  /* ---------------------------------------------------------
     DAFTAR ISI OTOMATIS
     --------------------------------------------------------- */
  function buatSlug(teks) {
    return (
      teks
        .toLowerCase()
        .replace(/[^\w\s-]/g, "")
        .trim()
        .replace(/\s+/g, "-")
        .slice(0, 60) || "bagian"
    );
  }

  function pasangDaftarIsi() {
    var konten = document.getElementById("entryContent");
    var widget = document.getElementById("widgetToc");
    var daftar = document.getElementById("tocDaftar");
    if (!konten || !widget || !daftar) return;

    var judulList = konten.querySelectorAll("h2, h3, h4");
    if (judulList.length < 3) return;

    var dipakai = {};
    var html = "";
    judulList.forEach(function (h) {
      var teks = (h.textContent || "").trim();
      if (!teks) return;
      if (!h.id) {
        var id = buatSlug(teks);
        var n = 2;
        var dasar = id;
        while (dipakai[id] || document.getElementById(id)) id = dasar + "-" + n++;
        h.id = id;
      }
      dipakai[h.id] = true;
      html +=
        '<li class="toc-' + h.tagName.toLowerCase() + '"><a href="#' + h.id + '">' +
        teks.replace(/</g, "&lt;") +
        "</a></li>";
    });
    daftar.innerHTML = html;
    widget.hidden = false;

    if (!("IntersectionObserver" in window)) return;
    var tautan = daftar.querySelectorAll("a");
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          tautan.forEach(function (a) {
            a.classList.toggle("aktif", a.getAttribute("href") === "#" + entry.target.id);
          });
        });
      },
      { rootMargin: "-80px 0px -70% 0px" },
    );
    judulList.forEach(function (h) {
      if (h.id) observer.observe(h);
    });
  }

  /* ---------------------------------------------------------
     LIGHTBOX GAMBAR KONTEN
     --------------------------------------------------------- */
  function pasangLightboxKonten() {
    var konten = document.getElementById("isiArtikel");
    var lightbox = document.getElementById("fotoLightbox");
    var lbImg = document.getElementById("lightboxImg");
    if (!konten || !lightbox || !lbImg) return;

    function buka(src, alt) {
      lbImg.src = src;
      lbImg.alt = alt || "Pratinjau foto";
      lightbox.classList.add("is-open");
      lightbox.setAttribute("aria-hidden", "false");
      document.body.classList.add("lightbox-open");
    }
    function tutup() {
      lightbox.classList.remove("is-open");
      lightbox.setAttribute("aria-hidden", "true");
      document.body.classList.remove("lightbox-open");
    }

    konten.addEventListener("click", function (e) {
      var img = e.target.closest ? e.target.closest(".entry-content img, .baca-cover img") : null;
      if (!img) return;
      var link = img.closest("a");
      // Kalau gambar dibungkus link ke halaman lain (bukan file gambar), biarkan link bekerja.
      if (link && !/\.(jpe?g|png|gif|webp|avif)(\?.*)?$/i.test(link.getAttribute("href") || "")) return;
      e.preventDefault();
      var src = (link && link.getAttribute("href")) || img.currentSrc || img.src;
      buka(src, img.alt);
    });

    var tombolTutup = document.getElementById("lightboxClose");
    var backdrop = document.getElementById("lightboxBackdrop");
    if (tombolTutup) tombolTutup.addEventListener("click", tutup);
    if (backdrop) backdrop.addEventListener("click", tutup);
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape") tutup();
    });
  }

  /* ---------------------------------------------------------
     SALIN TAUTAN
     --------------------------------------------------------- */
  function pasangSalinTautan() {
    var tombol = document.getElementById("btnSalinTautan");
    var share = document.querySelector(".baca-share");
    if (!tombol || !share) return;
    var url = share.getAttribute("data-url") || window.location.href;
    var label = tombol.querySelector("span");

    function berhasil() {
      tombol.classList.add("tersalin");
      if (label) label.textContent = "Tersalin!";
      setTimeout(function () {
        tombol.classList.remove("tersalin");
        if (label) label.textContent = "Salin tautan";
      }, 2000);
    }

    tombol.addEventListener("click", function () {
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
    });
  }

  /* ---------------------------------------------------------
     KOMENTAR
     --------------------------------------------------------- */
  function bacaPengomentar() {
    try {
      return JSON.parse(localStorage.getItem(KUNCI_PENGOMENTAR) || "null");
    } catch (e) {
      return null;
    }
  }

  function simpanPengomentar(data) {
    try {
      if (data) localStorage.setItem(KUNCI_PENGOMENTAR, JSON.stringify(data));
      else localStorage.removeItem(KUNCI_PENGOMENTAR);
    } catch (e) {}
  }

  function escapeHtml(teks) {
    return String(teks || "").replace(/[&<>"']/g, function (c) {
      return { "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c];
    });
  }

  function komentarBaruHTML(k, menungguModerasi) {
    var nama = escapeHtml(k.nama);
    if (k.situs) {
      nama = '<a href="' + escapeHtml(k.situs) + '" rel="nofollow ugc noopener" target="_blank">' + nama + "</a>";
    }
    return (
      '<li class="komentar komentar-baru" id="comment-' + (k.id || "baru") + '">' +
      '<article class="komentar-body">' +
      '<img class="komentar-avatar" src="' + escapeHtml(k.avatar) + '" alt="" width="48" height="48">' +
      '<div class="komentar-main">' +
      '<header class="komentar-meta"><strong class="komentar-nama">' + nama + "</strong>" +
      '<span class="komentar-waktu">' + escapeHtml(k.tanggal) + "</span>" +
      (menungguModerasi ? '<span class="komentar-moderasi">Menunggu moderasi</span>' : "") +
      "</header>" +
      '<div class="komentar-isi"><p>' + k.isi + "</p></div>" +
      "</div>" +
      "</article>" +
      "</li>"
    );
  }

  function pasangKomentar() {
    var form = document.getElementById("formKomentar");
    if (!form) return;

    var wadahAsli = document.getElementById("wadahFormKomentar");
    var inputParent = document.getElementById("komentarParent");
    var judulForm = document.getElementById("judulFormKomentar");
    var tombolBatal = document.getElementById("batalBalas");
    var tombolKirim = document.getElementById("btnKirimKomentar");
    var status = document.getElementById("statusKomentar");
    var isi = document.getElementById("komentarIsi");
    var nama = document.getElementById("komentarNama");
    var email = document.getElementById("komentarEmail");
    var situs = document.getElementById("komentarUrl");
    var ingat = document.getElementById("komentarIngat");

    var tersimpan = bacaPengomentar();
    if (tersimpan) {
      nama.value = tersimpan.nama || "";
      email.value = tersimpan.email || "";
      situs.value = tersimpan.situs || "";
      ingat.checked = true;
    }

    function setStatus(pesan, jenis) {
      status.textContent = pesan || "";
      status.className = "form-status" + (jenis ? " " + jenis : "");
    }

    function batalBalas() {
      inputParent.value = "0";
      judulForm.textContent = "Tinggalkan Komentar";
      tombolBatal.hidden = true;
      if (form.parentNode !== wadahAsli) wadahAsli.appendChild(form);
    }

    document.addEventListener("click", function (e) {
      var tombol = e.target.closest ? e.target.closest(".komentar-balas") : null;
      if (!tombol) return;
      var li = tombol.closest(".komentar");
      inputParent.value = tombol.getAttribute("data-parent");
      judulForm.textContent = "Balas " + tombol.getAttribute("data-nama");
      tombolBatal.hidden = false;
      li.querySelector(".komentar-main").appendChild(form);
      setStatus("");
      isi.focus();
    });
    tombolBatal.addEventListener("click", batalBalas);

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      setStatus("");

      if (!isi.value.trim()) return setStatus("Silakan tulis komentar Anda.", "gagal"), isi.focus();
      if (!nama.value.trim()) return setStatus("Nama wajib diisi.", "gagal"), nama.focus();
      if (!email.checkValidity() || !email.value.trim()) return setStatus("Alamat email tidak valid.", "gagal"), email.focus();

      simpanPengomentar(
        ingat.checked ? { nama: nama.value.trim(), email: email.value.trim(), situs: situs.value.trim() } : null,
      );

      tombolKirim.disabled = true;
      tombolKirim.textContent = "Mengirim…";

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
          if (!hasil.ok) {
            setStatus(hasil.pesan || "Komentar gagal dikirim.", "gagal");
            return;
          }

          var parentId = inputParent.value;
          var targetList;
          if (parentId !== "0") {
            var liParent = document.getElementById("comment-" + parentId);
            targetList = liParent && liParent.querySelector(":scope > .komentar-anak");
            if (liParent && !targetList) {
              targetList = document.createElement("ol");
              targetList.className = "komentar-anak";
              liParent.appendChild(targetList);
            }
          }
          if (!targetList) targetList = document.getElementById("daftarKomentar");

          if (hasil.komentar && targetList) {
            targetList.insertAdjacentHTML("beforeend", komentarBaruHTML(hasil.komentar, hasil.status === "moderasi"));
            var kosong = document.getElementById("komentarKosong");
            if (kosong) kosong.remove();
          }

          isi.value = "";
          batalBalas();
          setStatus(hasil.pesan, "sukses");

          var baru = targetList && targetList.lastElementChild;
          if (baru) baru.scrollIntoView({ behavior: "smooth", block: "center" });
        })
        .catch(function (err) {
          setStatus("Komentar gagal dikirim: " + err.message, "gagal");
        })
        .then(function () {
          tombolKirim.disabled = false;
          tombolKirim.textContent = "Kirim Komentar";
        });
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    initTemaBersama();
    pasangProgresBaca();
    rapikanKonten();
    pasangDaftarIsi();
    pasangLightboxKonten();
    pasangSalinTautan();
    pasangKomentar();
    daftarkanReveal(document.querySelectorAll(".baca-terkait .news-card"));
  });
})();

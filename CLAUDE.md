# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

Website front-end for PCNU Kota Pasuruan (Pengurus Cabang Nahdlatul Ulama). It is a headless front-end over the WordPress REST API at `https://pcnupasuruankota.id/wp-json/`. There is no database, no build step, no package manager, and no tests. Two rendering modes coexist:

- **Client-side** (homepage, listing pages): PHP outputs static markup; vanilla JS in `assets/common.js` (`API_ROOT`) fetches content in the browser.
- **Server-side** (reading pages `news/baca.php`, `articles/baca.php`): PHP fetches WP JSON via `inc/wp.php` and renders the full article, so titles/OG meta work for sharing (WhatsApp/Facebook).

UI text, identifiers, and comments are in Indonesian (e.g. `muatArtikel`, `tampilkanSkeleton`, `kartuBeritaHTML`). Keep this convention.

## Running locally

Served by Laragon from `C:\laragon\www\pcnupasuruan` (typically `http://pcnupasuruan.test/`). Alternatively `php -S localhost:8000` from the repo root. Needs internet access (live WordPress) and the PHP `curl` extension. Lint PHP with `php -l <file>`.

## Structure

- `index.php` — homepage. Static sections plus a large inline `<script>` IIFE that loads hero carousel, news, gallery, and articles from WP.
- `news/index.php`, `articles/index.php` — listings via `muatDaftarBerpaginasi({...})`; support `?s=` (search), `?tag=` (articles only), `?hal=` (page) in the URL.
- `news/baca.php`, `articles/baca.php` — thin entry files setting `$jenis` and including `partials/single.php` (the single-post template: content, share, author box, prev/next, related posts, threaded comments, sidebar). Wrong-type slugs 301 to the right folder; unknown slugs return 404.
- `inc/wp.php` — server-side WP client: `wp_get()` / `wp_get_banyak()` (parallel `curl_multi`), file cache in `sys_get_temp_dir()/pcnu-wp-cache` (5 min TTL), plus render helpers (`kartu_berita_html`, `url_baca`, `format_tanggal_id`, `warna_tag`).
- `api/komentar.php` — comment submission proxy (see below).
- `partials/header.php`, `partials/footer.php` — shared nav/footer.
- `assets/common.js` — shared client helpers; `initTemaBersama()` must be called on each page. `assets/baca.js` — reading-page interactions (progress bar, TOC, lightbox, copy link, AJAX comment form/replies).
- `assets/theme.css` — single stylesheet; design tokens in `:root` (`--hijau`, `--emas`, `--kertas`, fonts Newsreader (serif headings) / Schibsted Grotesk (body and small uppercase labels; `--mono` is no longer monospace) / Amiri (Arabic calligraphy decoration); the same Google Fonts link is repeated in every page head). Avoid star/sun icons: `.motif-star` is now a short gold rule, image placeholders use `GAMBAR_KOSONG_HTML` (Arabic "نهضة العلماء"), and the hero background is a gold-outlined calligraphy watermark. Exception: the header brand text (`.brand-text`) deliberately keeps the old Lora / Space Mono, loaded via `family=Lora:wght@700&family=Space+Mono` in the same link. Landing-only effects in `index.php` (`pasangEfekLanding()`: cursor spotlight, 3D carousel tilt, parallax, scroll progress bar; `pasangPartikelHero()`: canvas of floating gold particles, paused when the hero is off-screen or the tab is hidden) respect `prefers-reduced-motion`. Reading-page styles are at the end.
- `indexOld.php` — legacy homepage kept for reference; not linked. Don't edit unless asked.

## Key conventions

- **`$baseUrl`**: every page sets it (`'./'` at root, `'../'` in subdirectories) before including partials; internal links and assets are prefixed with it. In JS, `BASE_URL` is derived from the `common.js` script src.
- **WordPress content mapping**:
  - "Berita" = WP **pages** (`wp/v2/pages`) → `news/baca.php?slug=…`.
  - "Artikel" = WP **posts in category 7** → `articles/baca.php?slug=…`; first tag shown as a colored badge.
  - Link building must go through `urlBaca()` (JS) / `url_baca()` (PHP), which route by `item.type`.
  - Hero images = media search `hero-img`; gallery = media search `galeri`.
  - "Program" = WP **posts in the category with slug `program`** (`PROGRAM_KATEGORI_SLUG` in `assets/program.js`, resolved to an ID at runtime). Shown Instagram-style: homepage row of 9 (`#program-kegiatan`) and `program/index.php` (paginated, `?s=`, `?tag=`, `?hal=`). There is no reading page — details open in a modal (`?p=slug` in the URL, OG meta rendered server-side in `program/index.php`), with comments loaded via REST and posted through `api/komentar.php`. Post tags become `#hashtags` linking to `program/?tag=ID`. Subcategories of Program (Event, Layanan, …) are loaded at runtime and included in every query (WP REST `categories=` does not include children); they render as colored badges (`warnaKategoriProgram` by slug, fallback palette for new ones) and as filter chips via `program/?kategori=ID`. Cards keep equal height via a fixed-height `.ig-teks` area; `rapikanTeksKartuProgram()` lets the title use all the room it needs, gives the remaining lines to the caption, and only then clamps with an "… selengkapnya" overlay (re-run on resize/font load).
- `partials/sosial.php` holds the official social accounts (`$akunSosial`); by default it renders the Instagram links (@pcnu.kotapasuruan, @mediaseputarnukota / LTN NU); included in the homepage program section, `program/index.php`, and the footer. With `$sosialFooter = true` (set by the footer) it renders the "Ikuti Kami" strip of cards instead, which also includes the YouTube channel (@seputarnukota).
- **Card markup is duplicated** in `kartuBeritaHTML()` (JS) and `kartu_berita_html()` (PHP); tag colors in `warnaTagMap` (JS) and `warna_tag()` (PHP). Change both together.
- **Comments**: WP REST rejects anonymous comments (`rest_comment_login_required`), so `api/komentar.php` forwards to `wp-comments-post.php` and interprets the redirect (`unapproved=` = awaiting moderation). It also invalidates the comments cache using `wp_query_komentar()`, which must stay the query used in `single.php`. Comments only show a form when the WP item's `comment_status` is `open` (WP pages currently default to closed).
- The WP author account name is an email address; `single.php` replaces any author name containing `@` with "Redaksi PCNU Kota Pasuruan". Never output the raw author name.
- **Dates/timezone**: the WP site timezone is UTC and the `date` field carries no offset, so never parse/display `item.date` directly. Use `tanggalWp(obj[, 'modified'])` (JS) / `tanggal_wp($obj[, 'modified'])` (PHP), which return `date_gmt + 'Z'`; display is always WIB (GMT+7): `formatTanggal()` uses `timeZone: "Asia/Jakarta"`, and `inc/wp.php` sets `date_default_timezone_set('Asia/Jakarta')`. (WP `before`/`after` query params still take the raw site-local `date`.)
- JS is ES5-style (`var`, `function`, promise chains, no modules/bundler); keep new code consistent with that.

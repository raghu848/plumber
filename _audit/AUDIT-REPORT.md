# Hydrolink Plumbing — Technical & SEO Audit
Audit date: 2026-11-26 · Scope: whole codebase · **No existing page was modified or deleted.**
Only additions: this `_audit/` folder, and a backup zip outside the project.

**Backup:** `C:\Users\Vishal\Downloads\hydrolink-backup-20261126-103256.zip` (117 MB, 1,651 entries). It holds the whole project except `.git/` (recoverable via git) and the existing `*.zip` archives.
Restore: extract the zip; the top folder is `test/`.

Supporting data: `_audit/page-inventory.csv` has one row per HTML/PHP page: family, title, description, canonical, H1 count, sitemap status and twin status.

---

## 1. Architecture and technologies

| Item | Finding |
|---|---|
| Type | Hand-maintained **static HTML site** (no CMS, no build step, no package.json at root). 606 pages in the root folder: 504 `.html`, 102 `.php`. |
| Hosting | **Ambiguous / dual config.** `.htaccess` (Apache/cPanel; error_log paths show `/home/hydro915/...`) **and** `vercel.json` (cleanUrls, rewrites `*.php`→`*.html`). The two assume different URL behaviour (see C-5). |
| Server-side | Only 5 real PHP handlers: `1send_mail.php` (PHPMailer via SMTP), `slider-form.php`, `con-slider-form.php`, `appointment-from.php`, `minify.php`. The 97 other `.php` files are copies of `.html` pages. |
| Front end | jQuery 2.2.4 (EOL), Bootstrap 3-era CSS, Owl, Fancybox, Isotope, WOW, FontAwesome 4.7 (CDN), Google Fonts. |
| CSS/JS bundles | `css/subpage.min.css` (645 KB) and `js/subpage.min.js` (620 KB) for subpages; `assets/css/home-safe.min.css` (630 KB) and `assets/js/main.min.js` (611 KB) for the home page. `css/main.min.css` is 1.8 MB. |
| Third parties | GTM `GTM-W34DWF5W`, GA4 `G-X6Z2YJ4GGV`, Google Ads `AW-18159197420`, Meta Pixel `1492995221335210`, Sophiie AI chatbot, reCAPTCHA, Zoho verify. |
| Size | 895 MB working tree; `.git` is 138 MB; about 280 MB are zip archives inside the webroot. |
| Repo | `github.com/raghu848/plumber` (visibility not checked, see C-1). 15 commits; 1,600 tracked files. |

### Templates (shared header/footer)
- There is **no live templating**. The 95 pages that mention `include/header|footer` do so as text, not as PHP includes.
  `include/header.php`, `footer.php`, `blogsaside.php` and `header-1/header.html` are fragments, and the pages are static copies.
- Consequence: any header/footer/nav/NAP change requires editing hundreds of files. The suggested way to do this is a scripted, reviewed bulk edit.
- Template families (inferred from structure):
  1. Home (`index.html`, with `index.php` and `backup_index.html` as stale copies)
  2. Core/service pages (84)
  3. Blog/article pages (69 html + php twins)
  4. Suburb pages: `plumbing-service-in-*` (262) and `plumber-*` (84)
  5. Utility pages: `contact`, `appointment`, `sitemap`, `error`

---

## 2. Findings (ranked)

### CRITICAL

**C-1 Live credentials in source (and git).**
- `1send_mail.php` contains the SMTP username and password in plain text, plus a reCAPTCHA secret.
- `slider-form.php`, `con-slider-form.php` and `appointment-from.php` each contain a reCAPTCHA secret.
- The same secret is also written into the public `error_log` (496 lines).
- `error_log` is **tracked in git**, and the repo has a GitHub remote.
- **Action:**
  1. Rotate the SMTP password and both reCAPTCHA secret keys now.
  2. Move secrets to env vars or a non-web config file.
  3. Untrack `error_log`.
  4. Consider a history purge if the repo is or was public.
- Secret values are intentionally not reproduced here.

**C-2 Titles and canonicals missing on 140 suburb pages.**
- On `plumbing-service-in-*`, pages A–C have a `<title>` and pages D–Z (140 pages) have **no `<title>` element at all**.
- They only have `<meta name="title">`, which Google ignores. Git history shows `<title>` was already absent at commit `de5cf32`.
- Counts of pages without a canonical: 142 suburb pages, 201 `.html` pages and 62 `.php` pages (263 in total).
- Without a title or canonical these pages are weak or ambiguous for indexing.

**C-3 Mass internal 404s.**

| Broken target | Linked from |
|---|---|
| `fix-drain-leaks.html` | 353 pages (the real page is `fix-drain-leaks-sydney.html`). It is also in the sitemap and in robots `Allow`. |
| `plumber-nsw.html` | 121 pages |
| `hot-water-systems-sydney.php` | 96 pages (the real page is `hot-water-systems-sydney-repairs-installations.*`) |
| `error.html` assets | 9 references to a nonexistent `skylimit-assets/` folder |

Other broken references:
- `images/resource/blog-2.webp` and `blog-3.webp` (referenced by the home `og:image` and `backup_index.html`)
- `pictures/blog/common-places-...jpg`
- `tel:0433 629 517` with a space in `sitemap.html`

### HIGH

**H-1 Duplicate `.php`/`.html` twins (97 pairs).**
- None are byte-identical (the PHP copies are older, smaller versions).
- 39 PHP twins have a canonical pointing at **themselves** (`.php`), and 57 have no canonical.
- Two blog pairs (`signs-of-a-blocked-drain-you-shouldnt-ignore`) point both versions' canonical at the `.php`.
- Meanwhile robots.txt has `Disallow: /*.php`, so the twins are blocked from crawling but their canonical signals can't be read.
- 78 pages canonicalise to a `.php` URL, which is disallowed.
- The sitemap lists 0 `.php` URLs, so the intended canonical set is the `.html` pages.
- Note: `Disallow: /*.php` also blocks the form handlers, which is fine.

**H-2 Suburb pages are near-duplicates (doorway risk).**
- 262 `plumbing-service-in-*` pages collapse to only **26 distinct body texts** once the suburb name is swapped out.
- One text template covers 137 pages and another covers 65.
- Average page size is about 41 KB, mostly boilerplate.
- 24 suburbs exist in **both** families (`plumber-X` and `plumbing-service-in-X`, for example merrylands, bankstown, bondi). These are internal keyword cannibalisation.
- 84 `plumber-*` pages hold proper titles and canonicals and look like the stronger set.

**H-3 Sitemap vs reality.**
- 389 URLs, no duplicates, and every `lastmod` is the identical timestamp `2026-11-20T21:00:00+11:00`.
- That is a signal Google learns to ignore.
- 116 `.html` pages are not in the sitemap, and one sitemap URL (`/fix-drain-leaks.html`) is a 404.
- All sitemap, robots and `og:` URLs use `www.`, but `.htaccess` 301-redirects `www`→non-`www` and the home canonical is non-`www`. This is a **host split**: every sitemap URL is a redirect on Apache.

**H-4 Titles and descriptions duplicated.**
- 233 pages share 7 titles: 121 pages are "Hydrolink plumbers Sydney | Get professional Plumber Sydney..." and 91 are "Latest Blogs - Hydrolink Plumbing".
- 82 pages share 41 meta descriptions; 136 pages have no meta description.
- 98 pages have more than one `<h1>`, and 13 have none (including `blocked-shower-drain-sydney.html` and `gas-fitters-sydney.html`).

**H-5 `.htaccess` is flawed.**
- A WordPress catch-all (`RewriteRule . /index.php [L]`) is present on a non-WordPress site.
  - Every non-existent URL is rewritten to `index.php`, which returns **200 with homepage content**, so there are no real 404s (soft-404s).
  - The `RewriteBase /`/`index.php` rule also conflicts with the HTTPS/www rules above it.
- The HTTPS redirect has no proxy/CDN awareness (it uses `%{HTTPS}`), which can loop behind Cloudflare/Vercel.
- `Cache-Control: immutable, max-age=1y` on non-fingerprinted CSS/JS (`main.min.js`, `subpage.min.css`) means returning visitors will not receive updates until files are renamed.
- `Header set Connection keep-alive` is invalid or harmless on HTTP/2.
- The empty-user-agent block targets only WordPress files that do not exist here.
- Missing: security headers (HSTS, X-Frame-Options, CSP), a custom `ErrorDocument 404 /error.html`, and a rule to hide `.zip`, `.bak`, `error_log`, `.git`.

**H-6 Sensitive and bulky files in the webroot.**
- Publicly downloadable if the host serves the folder as-is:
  - `*.zip` archives (about 280 MB, including `assets.zip` at 135 MB, `26-9-2024.zip`, `Hydrolink Plumbing.zip`)
  - `error_log` (800 KB)
  - `*.bak` and `index.php.bak` (source code of the PHP)
  - `backup_index.html` (an indexable duplicate of the home page with a non-www canonical)
  - `mail/composer.*` and `mail/vendor` (PHPMailer; `composer.lock` reveals versions)
  - `.well-known.zip` and `slider-form.php.zip`

### MEDIUM
- **M-1 Form handling is inconsistent.**
  - `1send_mail.php` (via 36 pages' JS) uses SMTP and reCAPTCHA v3.
  - `slider-form.php` uses native `mail()`.
  - `slider-form.php` and `con-slider-form.php` use `file_get_contents()` for reCAPTCHA, which the host has **disabled** (496 logged failures), so reCAPTCHA verification fails on that path.
  - `con-slider-form.php` also sends output before `header()` (553 warnings).
  - `slider-form.php` redirects to `thankyou.php` (the file exists, but it is a `.php` page that robots.txt disallows and has no `.html` twin in the sitemap).
  - The sender in `1send_mail.php` uses a **different domain** (`localgasheatersydney.com.au`, with the typo "noreplay") as SMTP user.
  - Input is not escaped in HTML emails (injection and header-injection review is needed).
  - 27 forms use `action="#"` (JS-driven).
- **M-2 Structured data is thin.** 464 of 606 pages have no JSON-LD. The home page has Organization, WebSite and WebPage but **no `LocalBusiness`/`Plumber`** type with address, phone, hours, `areaServed` or `aggregateRating`.
- **M-3 Viewport.** 250 pages have no viewport meta, mostly the `.php` twins and some handlers.
- **M-4 Accessibility/SEO.** 318 `<img>` without `alt`.
- **M-5 Orphan pages.** 104 `.html` pages are not linked from any other page. They are mostly the blog and twin set, plus `error.html` and the Google verification files.
- **M-6 Contact data inconsistency.** Phone 0433 629 517 is consistent (shown as spaced and unspaced), but there are three emails (`info@`, `admin@`, and `info@hydrolinkplumbing.com` without `.au`).
- **M-7 Weight.** Roughly 600 KB of minified JS and 650 KB of CSS per page. Heavy for mobile (the earlier commits already tackled lazy-loading).
- **M-8 Stale libraries.** jQuery 2.2.4 and an old Bootstrap have known XSS CVEs.

### LOW
- Typos in filenames (`sydney-plumbar.html` in robots, `main- water-filter.html` with a space).
- `index.php` and `index.html` both exist (with an uncommitted local change in `index.php`); `vercel.json` maps `/index.php` to `/index.html`.
- `robots.txt` has 349 `Allow` lines that do nothing (default is allow), 1 duplicate (`/plumber-windsor.html`), and 4 `Allow` entries for files that don't exist.
  Recommended content is just `Disallow` rules plus `Sitemap:`.
- Two Google-verification HTML files at the root (`google3376...html`, `google8139...html`) have no title or canonical, which is fine.
- Three `.htaccess` files (root, `assets/fonts`, `fonts`).

---

## 3. Implementation inventory (proposed work, not yet done)

| # | Task | Scope | Risk | Depends on |
|---|---|---|---|---|
| 1 | Rotate SMTP and reCAPTCHA credentials, then move them to config | 4 PHP files | Low | Owner access |
| 2 | Untrack `error_log`, `.bak`, `*.zip`; add rules to `.gitignore` and block them server-side | repo + `.htaccess` | Low | none |
| 3 | Add `<title>` to the 140 suburb pages (derive from `meta name=title`) | 140 files | Low | none |
| 4 | Add canonical, a unique description and a single `<h1>` on all indexable pages | about 400 files | Low | decide canonical host |
| 5 | Decide host: `www` or non-`www`. Align `.htaccess`, sitemap, robots, canonicals and `og:` URLs | site-wide | Medium | owner decision |
| 6 | Fix broken internal links (`fix-drain-leaks.html`, `plumber-nsw.html`, `hot-water-systems-sydney.php`) | about 570 files | Low | none |
| 7 | Resolve `.php` twins: 301 the `.php` URLs to their `.html` page, then remove or keep as redirect stubs (separate approval) | 97 pairs | Medium | #5 |
| 8 | Suburb strategy: merge the 24 overlapping suburbs (301 one family into the other) and rewrite the 26 body templates to add local detail | 346 pages | Medium/High | owner decision |
| 9 | Rebuild `sitemap.xml` (accurate `lastmod`, no 404s, only indexable canonical URLs) and simplify `robots.txt` | 2 files | Low | #5, #7 |
| 10 | Clean `.htaccess`: remove the WordPress block, add a proper 404, fix HTTPS/proxy rule, caching with fingerprints, security headers | 1 file | Medium | confirm host (Apache vs Vercel) |
| 11 | Add `Plumber`/`LocalBusiness` JSON-LD (home, contact, suburb pages with `areaServed`) | home + templates | Low | confirm NAP |
| 12 | Introduce a build script/templating for header/footer so site-wide edits are one change | tooling | Medium | none |
| 13 | Unify form handlers (single endpoint, escape input, rate limit, honeypot, `curl` for reCAPTCHA) and tidy the thank-you flow | 4 PHP files | Medium | #1 |
| 14 | Performance: fingerprint assets, drop unused CSS/JS, upgrade jQuery | site-wide | Medium | none |

Suggested order: 1, 2, 3, 6, 4, then the owner decisions (host and suburb strategy), followed by the rest.

## 4. Method and limits
- Static analysis of all 606 root HTML/PHP pages with a read-only Node script, plus manual inspection of `.htaccess`, `robots.txt`, `sitemap.xml`, `vercel.json` and the PHP handlers.
- External URLs, live HTTP status and the real production host were **not** tested (only the local PHP server was used earlier).
- Pages inside subfolders were not crawled (only `include/` and `zohoverify/` contain pages).
- "Near-duplicate" was measured by swapping the suburb name and comparing visible text exactly; real similarity may be higher.

---

## 5. Fixes applied (2026-11-26, after approval)
Rollback: the backup zip, or `git diff`/`git checkout` (nothing is committed).

| Task | Result |
|---|---|
| Secrets (C-1) | SMTP user/password and reCAPTCHA secrets moved out of the 4 PHP handlers into a new `secrets.php` (gitignored); `secrets.example.php` is the template. `php -l` passes on all. **`secrets.php` must be uploaded to the server or the forms will fail.** **Rotating the SMTP password is still required** (it is in git history). Correction to C-1: the "reCAPTCHA secret" in `slider-form.php`, `con-slider-form.php` and `appointment-from.php` is the same string as the public site key in `index.html`, so it was never a real secret and server-side verification could not have worked; check the reCAPTCHA admin for the correct secret. |
| Untrack `error_log` | `git rm --cached` done (staged); `.gitignore` now covers `secrets.php`, `error_log`, `*.bak`. |
| Suburb titles (C-2) | `<title>` added to all 140 pages (copied from their `meta name=title`; 2 pages, Darling Point and Kellyville Ridge, got a title in the same pattern). 0 suburb pages now lack a title. |
| Broken links (C-3) | `fix-drain-leaks.html` → `fix-drain-leaks-sydney.html` and `hot-water-systems-sydney.php` → `hot-water-systems-sydney-repairs-installations.html` in 444 files; the `/fix-drain-leaks.html` entry was repointed in `sitemap.xml` and `robots.txt`. |
| plumber-nsw.html | 121 links repointed to `plumber-sydney.html` (the page `plumber-nsw.html` did not exist). |
| **Not fixed** | Canonicals, host choice, duplicates and the rest of section 3 are untouched. |

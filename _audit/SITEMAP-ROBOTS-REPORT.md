# Sitemap and robots.txt

## sitemap.xml (83 -> 188 URLs)
- Every URL is HTTPS on `hydrolinkplumbing.com.au`, unique, and well formed (checked by script, no raw `&`).
- Includes `/`, all 40 approved suburb pages, the suburb hub `plumber-sydney.html`, and the two new service pages (`gas-heater.html`, `strata-property-managers.html`).
- Each URL returns 200 on the local PHP server, has no noindex tag, its canonical equals the URL, and it is not blocked by robots.txt (188/188).
- Excluded: `sitemap.html`, `privacy-policy.html`, `service-terms.html`, `terms-conditions.html`, `thankyou.html`, `error.html`, Google verification files, `backup_index.html`, every `.php` article URL, and every retired suburb URL (all redirect in `.htaccess`).
- Also excluded:
  - `main- water-filter.html` (space in filename, near-duplicate of `main-water-filter.html`).
  - `blocked-shower-drain-sydney`, `gas-fitters-sydney` and the asbestos article. They have no canonical and their `.html` files are empty or garbled; the live versions are `.php`.
- `spares-&-fittings.html` is listed as `spares-%26-fittings.html`, which matches its canonical.
- lastmod is the file modification date when the file has uncommitted changes, otherwise the last git commit date. Every page was edited today, so all show 2026-11-26.

## robots.txt
- Removed `Disallow: /*.php`, which stopped Google from following the `.php` -> `.html` redirects, and the long Allow list (it had a typo, `sydney-plumbar.html`, and added nothing).
- Now disallows only form handlers, `secrets*.php`, `minify.php`, `thankyou`, `error.html`, `/_audit/`, `/include/` and `/mail/`. CSS, JS and images stay crawlable.
- Keeps `Sitemap: https://hydrolinkplumbing.com.au/sitemap.xml`.

## HTTP check
- Local: `/robots.txt` 200 `text/plain`, `/sitemap.xml` 200 `application/xml`.
- Live site right now: both return 200, but they still serve the old files until you deploy.
- The local PHP server does not run `.htaccess`, so redirect behaviour was checked from the rules, not live.

## Follow-ups
1. Deploy, then resubmit `sitemap.xml` in Search Console.
2. Decide the three `.php`-only pages: give them a canonical and add to the sitemap, or retire them.
3. Delete or redirect `main- water-filter.html`.

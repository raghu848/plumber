# Final QA report (2026-11-26)

Backup of the site before this QA pass: `C:\Users\Vishal\Downloads\hydrolink-backups\site-pre-final-qa-20261126.tar` (outside the site folder, so it will not be uploaded).

## Results
| # | Area | Result |
|---|---|---|
| 1 | 40 approved suburb pages (+ hub plumber-sydney) | All 41 return 200, self-canonical, no noindex, one h1, no broken links or images at 390/768/1280px |
| 2 | Permanent redirects | 334 retired suburb URLs -> 301 to https://hydrolinkplumbing.com.au/areas.html in one hop. www, http, index.html/index.php, extension-less and article .php URLs all single-hop 301. 353/353 checks passed on Apache |
| 3 | Broken internal links | Crawl of 609 URLs through Apache: 0 errors; no link points at a redirect; 0 broken anchors |
| 4 | Titles and descriptions | 188 pages: 0 duplicate titles, 0 duplicate descriptions, all within length limits |
| 5 | Heading hierarchy | 0 pages without exactly one h1; 0 skipped levels |
| 6 | Canonicals | 188/188 sitemap pages canonical to themselves |
| 7 | Structured data | All JSON-LD parses. Fixed: 92 article pages and gallery had none; added Article/CollectionPage + BreadcrumbList |
| 8 | Mobile and tablet | 41 suburb pages + 15 key pages x 3 widths: no horizontal overflow, footer and phone link present, sticky call bar visible on mobile |
| 9 | Navigation and footer | Crawl follows every nav/footer link: 0 errors. Language selector on every tested page |
| 10 | Phone and quote buttons | Header/footer/sticky call and quote buttons fire the right GA4 events; quote buttons scroll to the form |
| 11 | Enquiry delivery | Handler returns correct validation and reCAPTCHA errors (422 JSON). **Real delivery NOT verified**: needs reCAPTCHA on the live domain. Fixed a bug that would have crashed the SMTP path (see below) |
| 12 | GA4 events | phone_click, sticky_call_click, quote_button_click, generate_lead, contact_interaction pass local tests; no personal data. DebugView not checked (no account access) |
| 13 | Translation | English stays default even with a French browser; no redirect; switching to Spanish translates the page, keeps tel: link, form and URL |
| 14 | Performance (mobile Lighthouse, local, median of 3) | index 90, plumber-castle-hill 93; earlier medians: gas-heater 87, parramatta 94. strata-property-managers scored 61/61/90 (TBT 0 to 1,800ms between identical runs), so treat it as unreliable until PageSpeed Insights is run live |
| 15 | Custom 404 | Missing pages return HTTP 404 with the branded error page |
| 16 | robots.txt and sitemap | robots.txt 200 text/plain with Sitemap line; sitemap.xml 200 application/xml, 188 URLs, all return 200 and are indexable |
| 17 | New service pages | gas-heater.html and strata-property-managers.html: 200, canonical, schema, in sitemap, GA4 and form tests pass |
| 18 | Business info | Phone 0433 629 517, ABN 46 669 298 668 and licence 265578C identical on all 188 pages; one email (admin@) after fix; address format unified |

## Fixed in this pass
1. 92 pages without structured data now have Article + BreadcrumbList JSON-LD (gallery.html: CollectionPage).
2. Email: 9 articles showed info@hydrolinkplumbing.com.au; now admin@ everywhere (matches the quote form's inbox).
3. Address typo "St,Parramatta" fixed.
4. 334 retired-suburb redirects now use an absolute https target, so no extra hop behind Cloudflare Flexible SSL.
5. slider-form.php: the SMTP code used a mangled class name (`PHPMailerPHPMailerPHPMailer`) and would have crashed as soon as SMTP was configured. Fixed and now catches all errors.
6. gallery.html: an inline script set `src="undefined"` on lazy images without `data-src`, which broke the four review-platform logos in the header. Fixed.
7. .htaccess: now refuses to serve secrets.php, backups (.bak, .zip), logs, reports, crawl.json, vercel.json, backup_index.html, and the `_audit`, `include`, `mail`, `.git` folders. These were all downloadable on a test Apache before.

## Outstanding (needs you)
- **Send a real test enquiry on the live site** and confirm it reaches admin@. Mail is hosted at Zoho but the SPF record only authorises Zoho, so PHP mail() may go to spam; configure SMTP in `secrets.php` (smtp_host etc., see `secrets.example.php`). The current `secrets.php` has SMTP credentials for another domain (localgasheatersydney.com.au) and no smtp_host.
- **GA4:** run DebugView on the live site and mark generate_lead, phone_click and sticky_call_click as key events. Three GA4 IDs and two GTM containers are still installed (left as you chose).
- **Run PageSpeed Insights** on the live site, especially the strata page.
- **Three pages exist only as .php** (gas-fitters-sydney, blocked-shower-drain-sydney, the asbestos article), have no canonical and are not in the sitemap. Their .html twins are empty or garbled.
- `main- water-filter.html` (space in filename) is a near-duplicate of `main-water-filter.html`; delete or redirect it.
- Confirm facts still unverified: gas-fitting licence class, insurance wording, review count, award badges, and which photos are genuine (see TRUST-REPORT and IMAGE-REPORT).
- Before uploading: do not upload the .zip, .bak, `_audit`, `.claude`, `error_log` files (now blocked anyway). Purge Cloudflare cache after deploying and resubmit sitemap.xml in Search Console.

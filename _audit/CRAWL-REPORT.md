# Broken links, assets and 404 report (2026-11-26)

Nothing is committed or deployed. Checked three ways: a file scan of every page, template and stylesheet (307 files, case-sensitive paths so it matches a Linux server); a full HTTP crawl of a local Apache using the site's own `.htaccess` (622 URLs: every page, image, script, stylesheet, font and form target reachable from the home page and sitemap); and PHP syntax checks.

## Result
- HTTP crawl: **622 URLs, 0 errors, 0 redirects reached by internal links.**
- File scan: 0 broken page links, 0 broken images, 0 malformed `tel:` links, 0 links to retired pages on live pages.

## Fixed
| Problem | Fix |
|---|---|
| **27 quote forms posted to `#`** (service pages and emergency page): the button did nothing. | Now post to `slider-form.php`, the same handler the home page uses, with the hidden form name, a Suburb field (the handler needs one) and the Google reCAPTCHA box. The reCAPTCHA script loads only when the form scrolls into view. |
| `slider-form.php` emailed the phone number as the "Service" | Now sends the selected service. Nothing else in that file touched. |
| 3 phone link formats (`tel:0433629517`, `tel:0433 629 517`, `tel:+61433629517`), 1,012 links | All use `tel:+61433629517`. |
| Mail link to `info@hydrolinkplumbing.com` (wrong domain) and an unclosed style attribute, 8 articles | Now `.com.au`; attribute closed. |
| 54 dead `href="#"` keyword links in two articles | 26 now point to the matching service page; 28 are plain text. |
| "Plumber NSW" menu items pointing to a page that does not exist (unused templates) | Removed. |
| 4 lightbox icons missing (our-work gallery) | Added `images/lightbox/*.svg` and pointed the stylesheet at them. |
| Missing preloader/award images, junk `.html` image URLs (28), missing `.avif` banner, jQuery UI sprite path | Removed or pointed at files that exist. |
| Font Awesome files referenced locally but never uploaded (30 URLs) | Point to the same version on cdnjs, which every page already loads. |
| `fonts/.htaccess` and `assets/fonts/.htaccess` used the old Apache 2.2 `Order` directive: **HTTP 500 for every icon font** if the server lacks the compatibility module | Rewritten for Apache 2.4 with a 2.2 fallback. |
| Asbestos article image that never existed | Removed the empty image block. |

## Custom 404 (`error.html`)
- Logo, "Sorry, we can't find that page", and three buttons: **Return to the home page**, **View service areas**, **Emergency call: 0433 629 517** (plus services, emergency and contact links, footer with address).
- Mobile-friendly, keyboard-focus styles, noindex, absolute paths so it works at any URL depth.
- `ErrorDocument 404 /error.html` now sits at the top of `.htaccess`, outside any module block. Tested: `/missing`, `/a/b/c`, `/missing.php` all return **HTTP 404** with this page. Retired suburb URLs still 301 to `/areas.html`.

## Needs your decision
1. **Contact and Appointment pages have no form.** The latest commit removed them, so visitors there can only call, email or use the chatbot. I did not restore them. Say if you want them back.
2. **Email addresses differ:** pages show `admin@`, enquiries are sent to `info@hydrolinkplumbing.com.au`, and 16 article links use `info@`. Confirm both mailboxes exist.
3. **Retired-suburb redirects** use a relative target, so behind Cloudflare they can first go to `http://` then be upgraded. Works, one extra hop.
4. **Not fixed:** `img/24-hr.png` is referenced only by unused templates (`include/header.html`, `header-1.html`); `backup_index.html` still links retired pages (delete it); 0-byte `blocked-shower-drain-sydney.html` and `gas-fitters-sydney.html`; `/error.html` itself returns 200 if opened directly (noindex).
5. Test the quote forms on the live site after upload: reCAPTCHA keys are tied to the domain and I could not submit one from here.

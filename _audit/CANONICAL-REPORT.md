# URL canonicalisation report (2026-11-26)

Preferred URL: `https://hydrolinkplumbing.com.au/` (https, no www, pages end in `.html`, home = `/`).
Nothing is committed or deployed.

## Redirect rules (`.htaccess`)
| Request | Result |
|---|---|
| `http://www.…` / `https://www.…` | one 301 to `https://hydrolinkplumbing.com.au/…` (query kept) |
| `http://hydrolinkplumbing.com.au/…` | 301 to https. Skipped when `X-Forwarded-Proto: https` (stops Cloudflare Flexible loops) |
| `/index.html`, `/index.php` | 301 to `/` |
| `/article.php` with a non-empty `.html` twin | 301 to `/article.html`. Form handlers, `thankyou.php`, `index.php`, asbestos article and `blocked-shower-drain-sydney.php` are excluded (still 200) |
| `/emergency` (no extension) | 301 to `/emergency.html` |
| 334 retired-suburb 301 rules | unchanged, still go to `/areas.html` |
| Unknown URL | real 404 serving `error.html` (the old catch-all that returned the home page with 200 is commented out; rollback note in file) |

Tested on a local Apache (port 8085): all cases above pass, no loops. Original `.htaccess` is backed up in `hydrolink-prerewrite-40pages-20261126\before-canonical`.

## Canonical tags
- Absolute self-referencing canonical on every indexable page (191 pages); og:url, `url` and `identifier-URL` meta match it.
- PHP article pages: `include/header.php` points the canonical at the `.html` twin (or the `.php` URL where no usable twin exists).
- No canonical on noindex pages: thankyou, error, backup_index.
- `gutter-leaks-sydney.html` had no title, description or canonical; added.
- Sitemap: 81 URLs, all on the preferred domain, all valid, self-canonical, not noindex, not redirected. `robots.txt` Sitemap line updated.
- Internal links: www/http, `index.*`, `.php` twin and extensionless links normalised. ~328 links to retired suburbs removed from `local-sydney-plumber.html` and `sydney-plumber.html`; header menu retired links removed. `sitemap.html` broken `tel:` links fixed. Broken `hot-water-systems-sydney.php` link fixed.

## Flags for you
1. Retired-suburb rules use a relative target. If Apache sees plain HTTP behind Cloudflare these redirect to `http://…/areas.html` first, then Cloudflare upgrades it (works, one extra hop). Left untouched as asked.
2. Cloudflare: turn on Always Use HTTPS and purge the cache after upload. Cloudflare serves the live robots.txt, so check it matches. Use Full (strict) SSL if possible.
3. 0-byte `blocked-shower-drain-sydney.html` and `gas-fitters-sydney.html`; UTF-16 junk `.html` twin of the asbestos article. Fix or delete.
4. Delete `backup_index.html` from the server. `vercel.json` is unused and conflicts (cleanUrls); remove if not on Vercel.
5. Water-filter product pages are now self-canonical (they previously pointed at `water-filters.html`). Check for duplicate content.
6. `robots.txt` has typo `sydney-plumbar.html` and `Disallow: /*.php`. Blog articles are not in the sitemap. `plumber-nsw.html` is linked from unused include templates only.
7. After deploy: test live with `curl -I`, resubmit the sitemap in Search Console.

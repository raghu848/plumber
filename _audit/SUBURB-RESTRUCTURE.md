# Suburb page restructure: mapping and plan
Date: 2026-11-26. **Nothing in the website was changed, created or deleted for this step.** Only files in `_audit/` were added.

Files:
- `suburb-url-mapping.csv`: one row per suburb (340 rows): existing URLs, retained URL, status, retired URLs, redirect destination, tier, content to preserve, inbound-link count.
- `redirects-proposed.htaccess`: 334 rules, not applied (Apache / cPanel).
- `redirects-proposed.vercel.json`: the same 334 redirects in Vercel format, not applied.

## 1. What exists today

| Family | Pages | Notes |
|---|---|---|
| `plumber-[suburb].html` | 83 (plus the hub `plumber-sydney.html`) | Richer template: about 6,600 words, FAQ, JSON-LD, map, self-canonical, a unique "about the suburb" paragraph. Each of the 83 is textually different. |
| `plumbing-service-in-[suburb].html` | 262 | Thin template: about 1,240 words, no FAQ or schema. Only 58 distinct bodies. The only suburb-specific part is the `<title>` and meta tags. 142 had no canonical; those that have one point at the **home page**. |
| Union of suburb slugs | 322 | 24 suburbs exist in both families. |

Two further points:
- The one unique body line on a `plumber-*` page is a descriptive paragraph that looks copied from an encyclopaedia. It needs rewriting before it is reused on new pages.
- `plumber-richmond-st.html` is a malformed duplicate of Richmond; it is retired like the other unapproved suburbs.

## 2. The 40 approved suburbs

| Status | Count | Suburbs | Action |
|---|---|---|---|
| **Exists as `plumber-X.html`** | 11 | parramatta, north-parramatta, westmead, winston-hills, carlingford, rouse-hill, epping, eastwood, denistone, north-ryde, castle-hill | Keep as is. Retire the `plumbing-service-in-` twin where there is one (castle-hill, carlingford, eastwood, denistone). |
| **Only the old `plumbing-service-in-X.html`** | 10 | baulkham-hills, bella-vista, beaumont-hills, beecroft, cherrybrook, cheltenham, dural, dundas-valley, macquarie-park, wentworth-point | Build `plumber-X.html` from the richer template, carry over the title, description and map embed, then redirect the old URL. |
| **No page at all** | 19 | oatlands, north-rocks, kellyville, glenhaven, west-pennant-hills, box-hill, glenwood, pennant-hills, ryde, west-ryde, putney, gladesville, ermington, rhodes, concord, strathfield, norwest, sydney-olympic-park, silverwater | Create new pages. Each needs a unique local paragraph, written to avoid thin or duplicate content. |

So 21 of the 40 approved suburbs have no `plumber-` page yet (10 migrations plus 19 new = 29 builds, of which 10 have an old URL to redirect).

## 3. Retired pages
- **300 suburbs** are not on the approved list. They account for **334 retired URLs**: 262 `plumbing-service-in-*` pages (14 of them are for approved suburbs and redirect to the matching `plumber-` page) and **72 `plumber-*` pages**.
- The 72 retired `plumber-*` pages are good-quality pages (for example `plumber-penrith`, `plumber-liverpool`, `plumber-hornsby`). Retiring them loses real content, so decide on them explicitly (see section 6). They are archived first, as described below.
- Redirect tiers for the retired suburbs:
  - **Tier A, 103 suburbs:** redirect to the geographically nearest approved suburb (for example `denistone-east` to `plumber-denistone.html`, `hornsby` to `plumber-pennant-hills.html`).
  - **Tier B, 237 suburbs:** no approved suburb is close, so they redirect to the hub `plumber-sydney.html`. Examples are Bondi, Campbelltown, Penrith, Blue Mountains and the Sutherland Shire.
  - The tier column in the CSV marks which is which. The nearest-suburb choices come from my knowledge of Sydney geography and are a proposal for you to review.
- All redirects are 301 (permanent). There are no duplicate sources and no redirect chains.

## 4. Preserve first, delete last (proposed order)
1. **Archive:** copy all 334 retired files to `_archive/suburbs-YYYYMMDD/` outside the webroot (the full backup zip also holds them).
2. **Build** the 29 missing `plumber-X.html` pages. Redirect destinations for 17 of the approved suburbs do not exist until this is done, so **do not apply the redirects before the pages exist**.
3. **Update internal links:** the retired URLs are linked from the shared footer or nav lists, which sit on about 152 pages, plus `areas.html` (18 links) and `sitemap.html`. Replace them with the 40 approved links, or the redirects will carry the load.
4. **Apply redirects**, then rebuild `sitemap.xml` and `robots.txt` with only the retained URLs.
5. **Delete** the retired files only after redirects are verified, and only on your go-ahead.

## 5. Hosting dependency
The `.htaccess` WordPress catch-all (finding H-5 in the main audit) currently serves the homepage for any missing URL. Redirect rules must sit above it. If the site is served from Vercel, use the `vercel.json` version, and note that `vercel.json` already has a `cleanUrls` setting, so `.html` sources may need the extensionless form as well.

## 6. Decisions needed from you
1. Confirm the Tier B policy (237 far suburbs redirect to `plumber-sydney.html`). The alternative is to keep a handful of large-keyword suburbs such as Penrith, Liverpool and Blacktown.
2. Confirm retiring the 72 high-quality `plumber-*` pages for unapproved suburbs.
3. Review the Tier A nearest-suburb choices in the CSV.
4. Confirm the host (Apache or Vercel) and the `www` or non-`www` domain, so the redirect format and canonicals are right.

---

## 7. Executed (2026-11-26): archive and build
- **Archive:** all 334 retired files were copied (not moved) to `C:\Users\Vishal\Downloads\hydrolink-archive-suburbs-20261126\` with the mapping CSV. The originals are still in place.
- **Built 29 new pages** (`plumber-[suburb].html`) from the Castle Hill page template: oatlands, north-rocks, kellyville, glenhaven, west-pennant-hills, box-hill, glenwood, pennant-hills, ryde, west-ryde, putney, gladesville, ermington, rhodes, concord, strathfield, norwest, sydney-olympic-park, silverwater, baulkham-hills, bella-vista, beaumont-hills, beecroft, cherrybrook, cheltenham, dural, dundas-valley, macquarie-park, wentworth-point.
  - Each has its own suburb title, canonical, meta description, map embed and an original local intro paragraph (written fresh, not copied).
  - The remaining 6,000+ words are shared service copy with the suburb name swapped in, the same as the existing `plumber-` pages. **Review the intro paragraphs for local accuracy** (they are general descriptions, with no population or distance figures) before publishing.
  - All 40 approved suburbs now have a `plumber-[suburb].html` page.
- **Not done yet:** redirects not applied; retired files not deleted; `sitemap.xml`, `areas.html`, `sitemap.html` and the footer/nav lists do not yet link to the 29 new pages.

## Follow-up (requirements recheck)
- Merged duplicates: sydney-plumber.html and local-sydney-plumber.html -> plumber-sydney.html; fix-drain-leaks-sydney.html -> drain-leaks.html (301 in .htaccess, removed from sitemap, internal links repointed, "Local Sydney Plumber" nav item removed). Originals kept in _audit/retired-pages/.
- "Camberland Reach" removed from areas.html text; Osborne Park (Perth) service-list items removed from 28 pages.
- sitemap.xml: 185 URLs; lastmod now taken from each page's last git commit date (2 distinct dates only, because the repo history is short; update on real edits).
- Home page headings de-stuffed ("Sydney" removed from repeated headings; "Use a Quality Arborist" -> "Quality Workmanship").

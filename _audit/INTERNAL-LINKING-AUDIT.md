# Internal linking audit (2026-11-26)

Scope: 192 indexable .html pages (sitemap-listed or live), 40 approved suburb pages, 26 service pages, 91 blog articles. Nothing is committed or deployed. Method: a script built the full link graph (every `<a href>` normalised to the preferred URL) before and after the changes.

## Before
- 25 of the 40 suburb pages were linked only from `areas.html` and `sitemap.html` (2 inbound links each). Only 15 suburbs appeared in the sitewide footer and menu.
- Suburb pages linked to services, but not to each other.
- Service pages linked to no suburb pages except through the shared footer.
- `plumber-sydney.html` linked 15 of the 40 suburbs.
- 5 pages had zero inbound links; 49 blog and product pages had one.

## Changes
| Area | Change |
|---|---|
| Suburb to service | Already present on all 40 suburb pages (8-item "Plumbing services we offer" list, all verified). No change needed. |
| Suburb to suburb | New sentence on each of the 40 suburb pages linking 3-6 genuinely nearby suburbs, using the suburb name as the anchor (for example "Castle Hill is close to ... Baulkham Hills, Bella Vista, Norwest ..."). Neighbours are my reading of Sydney geography; please review. |
| Service to area | 25 service pages (commercial, backflow, grease trap, drains, relining, gas, hot water types, residential, kitchen, bathroom, toilet, tap, rain tank, strata, gutter, leak detection) get a short "Where we provide ..." section naming 6 approved nearby suburbs plus a link to `areas.html` and the contact page. The suburb sets rotate so every suburb receives 3-4 service-page links and no page repeats the same list. |
| Areas page | Already linked all 40 suburbs in four regional groups (verified; none missing, none retired). |
| Hub | `plumber-sydney.html` now has a "Suburbs we service" list of all 40 (was 15). |
| Blog articles | 91 articles each get one closing sentence: a related service page (chosen by topic), the quote form, `areas.html`, and one related article from the same topic group. Articles in one group link round in a loop so none is left with a single inbound link. |
| Orphans fixed | `roof-plumbers-sydney.html` (from `gutter-leaks.html`), `water-filter.html` (from `water-filters.html`), `why-high-pressure-jetting-...html` (card on `blogs.html`), `gallery.html` (from `our-work.html`). |
| Retired references | Verified: no live page links a retired or redirected URL. The only ones left are in `backup_index.html` (noindex, to be deleted). |
| Navigation | Header, footer and mobile menu markup untouched. New links sit in page content in plain paragraphs and lists with real link text, so keyboard and screen-reader navigation is unchanged. |

## Anchor text
- Suburb links use the suburb name only ("Epping", "Castle Hill") inside a sentence, not "plumber Epping" repeated.
- Service links use descriptive phrases ("blocked drain clearing service", "emergency plumbing page", "full list of plumbing services").
- No new sitewide keyword links; the footer is unchanged.

## After
- Every one of the 40 suburb pages now has 8-19 inbound links from other pages (was 2 for 25 of them).
- Broken internal links: 0. Links to retired URLs on live pages: 0.
- Every suburb is linked from `areas.html`, `plumber-sydney.html`, its neighbours and 3-4 service pages.

## Still open
1. **Duplicate or junk pages with weak links:** `main- water-filter.html` (filename contains a space; near-duplicate of `main-water-filter.html`), `common-places-you-might-find-asbestos-in-your-home.html` (garbled UTF-16; the .php page is the real one and nothing links it). Merge or delete rather than promote them.
2. **Thin keyword duplicates** that a consolidation would simplify: `plumbing-services-sydney.html`, `pipe-relining-sydney.html`, `kitchen-renovation-sydney.html`, `backflow-plumbing-sydney.html`, and similar twins of service pages. They are listed only on `blogs.html`.
3. **Water-filter product pages** (caravan, filter housings, irrigation, rainwater, cartridges) have one inbound link, from `water-filters.html`. That is normal for a product group; they could also be cross-linked.
4. **Sitewide footer** lists 12 suburbs. I left it alone to avoid a 40-link sitewide block; other suburbs are reachable through "View all service areas".
5. **Retired links in `backup_index.html`** and `plumber-nsw.html` referenced by unused `include/` templates. Delete both after you confirm.
6. Review the neighbour choices and the rotation of suburbs on service pages before publishing.

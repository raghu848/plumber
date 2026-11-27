# Performance report (mobile Lighthouse, local prod-like server)

Median of 3 runs per page, simulated mobile throttling. "Before" = untouched snapshot, "After" = current site.

| Page | Score | LCP | TBT | Page weight |
|---|---|---|---|---|
| index.html | 59 -> **94** | 3.7s -> 2.9s | 2,139ms -> 6ms | 1,572 -> 429 KiB |
| gas-heater.html | 53 -> **87** | 4.9s -> 3.9s | 1,623ms -> 2ms | 1,926 -> 598 KiB |
| plumber-parramatta.html | 67 -> **94** | 3.0s -> 3.0s | 1,813ms -> 4ms | 1,800 -> 500 KiB |

CLS was 0 on all three in both runs. Mobile CLS on gallery.html fell from 5.78 to 0.0002 after image width/height were added.

## What changed
- Sophiie chatbot, reCAPTCHA and main JS load on first user interaction instead of page load (main TBT win).
- Images converted to WebP (about 19 MB -> 4.7 MB), lazy-loaded below the fold.
- CSS bundles purged of unused rules (about 650 KB -> about 270 KB each); originals in `_audit/css-backup/`.
- CSS/JS references carry `?v=20261127` so Cloudflare and browsers fetch the new files.

## Caveats
- Lighthouse is run locally with simulated throttling, so it is noisy. Real-world numbers will differ.
- PageSpeed Insights was not run (the site is not live from this machine). Run it after deploying.
- Purge the Cloudflare cache after publishing.

# Deployment and Search Console steps (HostPapa)

Status: **not deployed.** I have no access to your HostPapa account, so nothing has been uploaded and nothing has been submitted to Search Console.

## What is ready
- Upload package: `C:\Users\Vishal\Downloads\hydrolink-deploy\hydrolink-site-20261127.zip` (also unpacked in `hydrolink-deploy\site`). It excludes `secrets.php`, `secrets.example.php`, `.git`, `_audit`, `.claude`, zip/bak files, `error_log`, `crawl.json`, `backup_index.html`, `include/` and `vercel.json`.
- Pre-deploy copies of the live public files (read-only snapshot): `C:\Users\Vishal\Downloads\hydrolink-backups\live-snapshot-20261127\`.
- Local backup of the verified site before QA: `hydrolink-backups\site-pre-final-qa-20261126.tar`.
- Post-deploy checker: `node _audit/postdeploy.js` (read-only; checks 188 pages, redirects, robots, sitemap, 404, blocked private files, form endpoint, GA4).

## Finding before you deploy
- Live site today is the OLD site: its sitemap has 389 URLs and none of the new pages; the live home page has none of the new scripts.
- Live robots.txt is a Cloudflare-managed file (blocks AI crawlers, then the old Allow list and a `www` Sitemap line). Our robots.txt will replace the origin part; Cloudflare's block stays. If you want to keep AI crawlers blocked, nothing to do.
- Live server banner on blocked files is nginx behind Cloudflare. `.htaccess` redirects only work if HostPapa runs Apache/LiteSpeed behind it. The post-deploy redirect test will show this; if redirects fail, tell me.

## Step 1: fresh production backup (you, in HostPapa cPanel)
1. cPanel > Backup (or JetBackup) > create a full or home-directory backup and download it.
2. Or File Manager > select `public_html` > Compress to a zip and download it. Keep it until the checks pass.
3. Do NOT overwrite the live `secrets.php` (it holds the reCAPTCHA secret and mail settings). The package does not contain one.

## Step 2: upload
1. cPanel > File Manager > `public_html` > Upload `hydrolink-site-20261127.zip`.
2. Right-click the zip > Extract into `public_html`, overwriting existing files. Delete the zip afterwards.
3. Check `.htaccess` is present (File Manager > Settings > Show hidden files).
4. Cloudflare dashboard > Caching > Purge Everything.

## Step 3: tell me it is live
I run `postdeploy.js`, plus GA4 and form checks, and record the results.
If anything fails, restore the backup from Step 1.

## Search Console (you; no access in this session)
Sitemap URL to submit: **https://hydrolinkplumbing.com.au/sitemap.xml**
1. Open Search Console and pick the verified property (domain property `hydrolinkplumbing.com.au` or URL-prefix `https://hydrolinkplumbing.com.au/`).
2. Indexing > Sitemaps > "Add a new sitemap": enter `sitemap.xml` > Submit. Remove the old `www` sitemap entry if one is listed.
3. Wait a few minutes, then refresh. Expected: Status "Success", 188 discovered URLs.
4. URL Inspection: paste each of these, check "URL is on Google" or "Page is indexable", then "Request indexing" for new ones:
   - https://hydrolinkplumbing.com.au/
   - https://hydrolinkplumbing.com.au/gas-heater.html
   - https://hydrolinkplumbing.com.au/strata-property-managers.html
   - https://hydrolinkplumbing.com.au/plumber-parramatta.html
   - https://hydrolinkplumbing.com.au/plumber-castle-hill.html
5. Send me the sitemap status, the discovered count, and any errors, and I will add them to the report.
6. Over the following weeks watch Indexing > Pages for "Page with redirect" (expected for the 334 retired suburb URLs) and "Crawled - not indexed".
7. Optional: GA4 DebugView and marking key events (see GA4-REPORT.md).

// Read-only live checks. Run AFTER uploading:  node _audit/postdeploy.js
const H = 'https://hydrolinkplumbing.com.au';
const get = async (p, o = {}) => { try { const r = await fetch(H + p, { redirect: 'manual', headers: { 'User-Agent': 'Mozilla/5.0 hl-postdeploy' }, ...o }); return { s: r.status, loc: r.headers.get('location'), t: r.headers.get('content-type') || '', b: await r.text() }; } catch (e) { return { s: 0, b: '', loc: String(e.message) }; } };
let pass = 0, fail = 0; const bad = [];
const ok = (n, c, x) => { if (c) pass++; else { fail++; bad.push(n + (x ? ' -> ' + x : '')); } };
(async () => {
  const sm = await get('/sitemap.xml'); ok('sitemap.xml 200 xml', sm.s === 200 && /xml/.test(sm.t), sm.s + ' ' + sm.t);
  const locs = [...sm.b.matchAll(/<loc>([^<]+)<\/loc>/g)].map(m => m[1].replace(/&amp;/g, '&'));
  ok('sitemap has 188 URLs', locs.length === 188, String(locs.length));
  const rb = await get('/robots.txt'); ok('robots.txt 200 text/plain', rb.s === 200 && /text\/plain/.test(rb.t), rb.s + ' ' + rb.t);
  ok('robots has https non-www Sitemap line', /Sitemap:\s*https:\/\/hydrolinkplumbing\.com\.au\/sitemap\.xml/i.test(rb.b));
  ok('robots does not block pages/css/js', !/Disallow:\s*\/\*?\.?(html|css|js)?\s*$/im.test(rb.b.split('User-agent: *')[1] ? rb.b.split(/User-agent:/i).find(s => /^\s*\*/.test(s)) || '' : ''));
  let n = 0;
  for (const u of locs) {
    const p = u.replace(H, '') || '/'; const r = await get(p); n++;
    const can = (r.b.match(/<link[^>]+rel=["']canonical["'][^>]*href=["']([^"']*)/i) || [])[1];
    const rob = (r.b.match(/<meta[^>]+name=["']robots["'][^>]*content=["']([^"']*)/i) || [])[1] || '';
    ok('200 ' + p, r.s === 200, String(r.s)); ok('indexable ' + p, !/noindex/i.test(rob) && !/noindex/i.test(r.b.length < 400 ? r.b : '')); ok('canonical ' + p, can === u, can);
    if (r.s === 200) { ok('new alt/size markup ' + p, /<img\b[^>]*\balt=/.test(r.b)); ok('analytics script ' + p, /<form|callnowbutton/.test(r.b) ? /analytics-events\.js/.test(r.b) : true); }
  }
  // redirects
  const R = [['/index.html', '/'], ['/plumber-bondi.html', '/areas.html'], ['/blocked-drains-in-sydney-causes-prevention-and-solutions.php', '/blocked-drains-in-sydney-causes-prevention-and-solutions.html'], ['/about', '/about.html'], ['/plumber-fairfield.html', '/areas.html']];
  for (const [f, t] of R) { const r = await get(f); ok('301 ' + f, r.s === 301 && (r.loc || '').replace(H, '').replace(/\/$/, '') === t.replace(/\/$/, ''), r.s + ' ' + r.loc); }
  const w = await fetch('http://www.hydrolinkplumbing.com.au/about.html', { redirect: 'manual' }); ok('http+www -> https apex in one hop', w.status === 301 && w.headers.get('location') === H + '/about.html', w.status + ' ' + w.headers.get('location'));
  const nf = await get('/zz-not-a-page-123'); ok('404 status', nf.s === 404, String(nf.s)); ok('404 branded', /Hydrolink/i.test(nf.b));
  // private files must be blocked
  for (const p of ['/secrets.php', '/.htaccess', '/crawl.json', '/_audit/FINAL-QA-REPORT.md', '/.git/config', '/index.php.bak']) { const r = await get(p); ok('blocked ' + p, [403, 404, 301].includes(r.s) && !/return \[|RewriteEngine|\[core\]/.test(r.b), String(r.s)); }
  // form endpoint & call link
  const f = await get('/slider-form.php'); ok('slider-form GET not 5xx', f.s > 0 && f.s < 500, String(f.s));
  const home = await get('/'); ok('home has tel link', /href="tel:\+61433629517"/.test(home.b)); ok('home has quote form', /sliderForm|il-quote/.test(home.b));
  const post = await fetch(H + '/slider-form.php', { method: 'POST', headers: { 'X-Requested-With': 'fetch', Accept: 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' }, body: 'name=&email=bad' }); const pj = await post.json().catch(() => ({})); ok('form validation JSON (no send)', post.status === 422 && pj.status === false, post.status + ' ' + JSON.stringify(pj).slice(0, 80));
  ok('GA4 id on home', /G-X6Z2YJ4GGV|googletagmanager/.test(home.b));
  console.log('pages checked', n, '| PASS', pass, 'FAIL', fail); bad.slice(0, 40).forEach(b => console.log('  ' + b));
})();

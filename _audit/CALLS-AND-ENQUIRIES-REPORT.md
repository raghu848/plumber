# Calls and quote enquiries (2026-11-26)

Nothing is committed or deployed. Browser checks were made on a local copy at 390px and 1280px wide.

## Phone numbers
- 288 plain-text phone numbers on 205 pages are now links; every phone link on the site is `tel:+61433629517` (1,307 links). Numbers inside titles, meta tags, scripts, buttons and existing links were left alone.

## Mobile call bar (194 pages)
- A green call bar already existed on phones. It is now **Call Now** (darker green for readable white text) plus a **Get a Quote** button on pages that have a quote form.
- It hides itself while the quote form is on screen, while a field is focused (so it never sits above the phone keyboard) and while the menu is open. The page has bottom padding so the footer, contact details and social icons are never covered, and the Google reviews badge, social icons and reCAPTCHA badge move out of the way of the bar and the form.
- "Get a Free Quote" links in the header and hero now jump straight to the form on pages that have one.

## Quote forms
- **Found:** the quote form on all 27 service pages and the emergency page had been hidden by a CSS rule (`display:none !important`) since the speed-optimisation commit, and also posted nowhere. I removed the rule, so these forms now show above the page content. If you would rather keep them hidden, add the rule back.
- **Browser checks** (shown as messages above the button, announced to screen readers): name, valid email, valid phone, service chosen, suburb, and the "I'm not a robot" box. Errors highlight the field and focus it. The button shows "Sending…" and cannot be double-clicked.
- **Server (`slider-form.php`, rewritten):** POST only; checks every field again; checks reCAPTCHA properly (before, any non-empty token was accepted); a hidden trap field and a 30-second limit per visitor block bots; email is plain text, customer is not copied, customer details are not logged; header-injection attempts are rejected. Clear messages: success ("Thanks Sam, your enquiry has been sent…"), validation errors, and a failure message that tells the visitor to call 0433 629 517. Without JavaScript it still works (redirects to the thank-you page on success, shows an error page otherwise).

## Tests run
- 15 offline tests of validation and email building, all passed (empty fields, bad email/phone, array input, line-break injection, recipient, Reply-To, no copy to customer). Test data used: "TEST Enquiry - please ignore", test@example.com, 0400 000 000, Testville.
- Live handler over HTTP: GET redirects home; empty and invalid posts return 422 with the right message; missing captcha rejected; fake captcha token rejected by Google; trap field accepted silently.
- **Not possible from here:** a real submission. It needs a person to solve the reCAPTCHA, and the form only works on your live domain (the site key is domain-locked). I therefore **cannot confirm the inbox received an enquiry.** Please send one test from your phone after upload, with the name "TEST - please ignore", and check where it lands (inbox or spam).

## Email set-up findings (please act)
1. **Spam risk:** your mail is hosted by Zoho (MX `zoho.in`) and the SPF record only authorises `zoho.in`. The old script and this one send with PHP `mail()` from the web server, which SPF does not authorise, so enquiries are likely to land in spam. The handler now supports authenticated SMTP: add `smtp_host`, `smtp_port` and `smtp_from` to `secrets.php` (see `secrets.example.php`; for Zoho India, `smtp.zoho.in`, port 465, with the mailbox's own login and an app password). I did not touch `secrets.php`.
2. **Which inbox?** Enquiries go to `admin@hydrolinkplumbing.com.au` (what the home form used before). The older script and 16 article links use `info@`. To change the destination, set `quote_to` in `secrets.php`.
3. `1send_mail.php` (no longer used by any page) sends through `mail.localgasheatersydney.com.au`, another business's mail server, and always reports success even when sending fails. Do not re-enable it; delete it when convenient.
4. Browsers may show the old CSS for a day; Cloudflare cache should be purged.

## Not done / open
- Contact and Appointment pages still have no form (removed in your last commit); the quote bar is not shown there.
- The service pages list hundreds of retired suburb names as plain text ("Clear Blocked Drains in Abbotsbury…"). Not links, but it is keyword stuffing; worth removing in a later step.
- The chat bubble (third-party) can sit near the bottom-right corner; I did not move it.

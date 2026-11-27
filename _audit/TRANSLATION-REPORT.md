# Website translation report (2026-11-26)

## Decision: GTranslate Free (dropdown widget), not SeaText

| | SeaText free widget | GTranslate Free |
|---|---|---|
| Languages | 125 (claimed) | 104 (all enabled) |
| Default language / auto-detect | Marketed as detecting each visitor's language and translating before the page is shown. Could not confirm a way to switch this off without creating an account | `detect_browser_language: false` and `default_language: 'en'` set in code; verified in the widget source and in the browser |
| Redirects / URL changes | "Edge" script; behaviour not inspectable | None (`url_structure: 'none'`); URLs never change |
| Setup | Account/sign-up flow; closed script served from their edge | One public script, source inspectable |
| Weight | Not measurable without an account | 19 KB selector, loaded after page load; 111 KB engine only when the menu is opened or a language is already chosen |
| Vendor | AI marketing/ad-tech suite (conversion testing, bot-click refunds, "ad signal" tools) | Translation-only product |
| Cost | Free core; premium upsell | Free |

SeaText was not installed: the auto-detect behaviour conflicts with the "English default, no automatic switching" requirement, and its controls could not be verified without signing up. If the client still wants it, it needs a trial account and written confirmation that auto-detection can be disabled.

## What was implemented
- `js/translate.js` (2 KB): sets `default_language en`, `detect_browser_language false`, `url_structure none`, native language names, all 104 languages; loads GTranslate's `dwf.js` after the page has loaded (or on first interaction).
- Selector placed in the top bar of the header on 192 pages (`.il-lang`); on phones it moves to the top-right of the header bar. Space is reserved so the layout does not shift.
- CSS added to the three CSS bundles (`css/subpage.min.css`, `assets/css/home-safe.min.css`, `assets/css/main.min.css`); the widget's default fixed "bottom of screen" position is overridden so it does not collide with the sticky Call/Quote bar or the Google badge.
- Quote forms: service options now have English `value`s, so enquiries always arrive in English and "Select Service" validation still works when the page is translated.
- Emails and phone numbers marked `translate="no"` (1,468 links) so translation cannot alter contact details.

## Tests (browser, local)
- New visitor (storage cleared): page stays English, no translation engine loaded, no redirect.
- Spanish, German, Arabic: page translates in place; URL unchanged; choice persists across pages and reloads; switching back to English restores the page.
- Navigation: header menus and mobile menu work in translated mode.
- Forms: validation messages and button translate; submitted service value stays English.
- Mobile 390px and desktop 1280px: no horizontal overflow.
- Crawl: 0 broken links / assets.

## Caveats to tell the client
- Machine translation: wording, especially licence, safety and gas text, may be imperfect. It is a convenience, not a replacement for translated pages.
- Search engines do not index translated versions (URLs do not change), so this adds no multilingual SEO.
- Page text is sent to GTranslate's servers when someone chooses a language; the privacy policy should mention this. The selected language is stored in the visitor's browser.
- Right-to-left languages (Arabic, Hebrew etc.) are translated but the page layout is not mirrored.
- Not translated by design: emails, phone numbers. Business name and suburb names may be translated.
- Not tested: live submission of the quote form while translated (forms were validated; sending was tested earlier and the submitted values are unchanged).
- Not deployed to the live server: changes are in the working folder only. After publishing, purge the Cloudflare cache.

# GA4 lead tracking

## Existing setup found (not changed)
- GA4 IDs: G-X6Z2YJ4GGV (191 pages), G-2L7JXT0V8T (94 pages), G-BF8PKGJDN1 (gallery.html only).
- GTM containers: GTM-W34DWF5W (homepage), GTM-WK2JTBQ (93 subpages). Google Ads AW-18159197420 (homepage, with a call conversion). Also Facebook Pixel and trkcall.com call tracking.
- Pages with two GA4 IDs send pageviews to both. This was left as is, as you chose.
- I cannot see inside the GTM containers, so I don't know if they already send GA4 events.

## Added
- `js/analytics-events.js` on 193 pages that have the sticky bar / quote form. All events go to G-X6Z2YJ4GGV only.
- `js/quote-form.js` now fires an `il:lead` signal only after the server returns success.

| Event | Fires when | Parameters |
|---|---|---|
| phone_click | any tel: link except the sticky button | link_location |
| sticky_call_click | sticky Call Now button | link_location |
| quote_button_click | Get a (Free) Quote buttons/links | link_location, button_text |
| generate_lead | server confirms the form was sent | form_location, form_service (dropdown choice only) |
| contact_interaction | contact page: email, map or social click | interaction_type |

No names, emails, phone numbers, link URLs or typed values are sent. Validation failures and server errors do not fire generate_lead.
Pages that lacked G-X6Z2YJ4GGV (for example the homepage) get it configured with send_page_view:false, so events work without adding pageviews.

## Test results (headless Chrome, mocked server reply, local)
Pages tested: index, gas-heater, contact. All checks passed (events once each, no duplicates, no PII, one config, one gtag.js request, no event on invalid or failed submit). contact.html has no form, so form_start is untested.
Not done: GA4 DebugView / Tag Assistant need your GA account.

## Do in GA4 (I have no account access)
1. Admin > Events: mark generate_lead, phone_click and sticky_call_click as key events (optionally quote_button_click).
2. Admin > Data display > Custom definitions: add form_service, link_location, interaction_type if you want them in reports.
3. Open DebugView (or Tag Assistant), visit the live site, click a phone link, and submit a test enquiry.
4. Check the GTM containers for duplicate GA4 event tags, and that Enhanced Measurement "Form interactions" isn't double-counting.
5. Purge Cloudflare cache after deploying.

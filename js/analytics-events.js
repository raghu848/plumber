/* GA4 lead tracking for Hydrolink Plumbing.
 * One delegated listener per event type. Sends events only to the main GA4 property.
 * No names, emails, phone numbers, link URLs or form values are ever sent.
 *
 * Events:
 *   phone_click        tel: link clicked (header, footer, body)      params: link_location
 *   sticky_call_click  sticky "Call Now" button clicked              params: link_location
 *   quote_button_click "Get a (Free) Quote" button/link clicked      params: link_location, button_text
 *   generate_lead      enquiry form CONFIRMED sent by the server     params: form_location, form_service
 *   contact_interaction  contact page: email / map / social click, first form focus   params: interaction_type
 */
(function () {
  'use strict';
  if (window.__ilAnalytics) return;
  window.__ilAnalytics = true;

  var GA_ID = 'G-X6Z2YJ4GGV';
  var dl = (window.dataLayer = window.dataLayer || []);
  if (typeof window.gtag !== 'function') window.gtag = function () { dl.push(arguments); };

  // Make sure the main property is configured on this page (some pages only load other tags).
  function hasConfig() {
    for (var i = 0; i < dl.length; i++) {
      var e = dl[i];
      if (e && e[0] === 'config' && e[1] === GA_ID) return true;
    }
    return false;
  }
  var loaded = false;
  function ensureTag() {
    if (loaded) return; loaded = true;
    if (!hasConfig()) {
      window.gtag('js', new Date());
      window.gtag('config', GA_ID, { send_page_view: false }); // events only; pageviews unchanged
      if (!document.querySelector('script[src*="id=' + GA_ID + '"]')) {
        var s = document.createElement('script'); s.async = true;
        s.src = 'https://www.googletagmanager.com/gtag/js?id=' + GA_ID;
        document.head.appendChild(s);
      }
    }
  }
  ['scroll', 'mousemove', 'touchstart', 'pointerdown', 'click', 'keydown'].forEach(function (ev) {
    window.addEventListener(ev, ensureTag, { once: true, passive: true });
  });

  var last = {};
  function send(name, params) {
    var now = Date.now(), key = name + '|' + (params.link_location || params.form_location || params.interaction_type || '');
    if (last[key] && now - last[key] < 1000) return; // ignore double fires
    last[key] = now;
    ensureTag();
    params = params || {};
    params.send_to = GA_ID;
    params.transport_type = 'beacon';
    window.gtag('event', name, params);
  }

  function where(el) {
    if (el.closest('#callnowbutton, #quotenowbutton')) return 'sticky_bar';
    if (el.closest('footer, .main-footer')) return 'footer';
    if (el.closest('header, .main-header, .sticky-header, .mobile-menu')) return 'header';
    return 'page_body';
  }

  var isContact = /\/contact(\.html)?\/?$/i.test(location.pathname);

  document.addEventListener('click', function (e) {
    var a = e.target.closest ? e.target.closest('a,button') : null;
    if (!a) return;
    var href = (a.getAttribute('href') || '').toLowerCase();
    var text = (a.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 40);

    if (a.id === 'callnowbutton') return send('sticky_call_click', { link_location: 'sticky_bar' });
    if (href.indexOf('tel:') === 0) return send('phone_click', { link_location: where(a) });

    var isQuote = a.id === 'quotenowbutton' || href === '#quote' || /appointment\.html/.test(href) ||
      (a.tagName === 'A' && /\bget (a )?(free )?quote\b|\bfree quote\b/i.test(text));
    if (isQuote && !(a.type === 'submit')) {
      send('quote_button_click', { link_location: where(a), button_text: /free/i.test(text) ? 'get_free_quote' : 'get_quote' });
    }

    if (isContact) {
      if (href.indexOf('mailto:') === 0) send('contact_interaction', { interaction_type: 'email_click' });
      else if (/google\.[a-z.]+\/maps|goo\.gl\/maps|maps\.app\.goo\.gl|g\.page/.test(href)) send('contact_interaction', { interaction_type: 'map_click' });
      else if (/facebook\.com|instagram\.com|youtube\.com|tiktok\.com/.test(href)) send('contact_interaction', { interaction_type: 'social_click' });
    }
  }, true);

  // first interaction with a form on the contact page (no field values are read)
  if (isContact) {
    var started = false;
    document.addEventListener('focusin', function (e) {
      if (started || !e.target.closest || !e.target.closest('form')) return;
      started = true; send('contact_interaction', { interaction_type: 'form_start' });
    });
  }

  // Confirmed submission: fired by quote-form.js only after the server replied status:true
  document.addEventListener('il:lead', function (e) {
    var d = (e && e.detail) || {};
    send('generate_lead', { form_location: where(d.form || document.body) === 'page_body' ? 'page_form' : where(d.form), form_service: d.service || '(not_set)' });
  });
})();

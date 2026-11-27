/* Manual language selector (GTranslate free dropdown).
 * English stays the default; the visitor's browser language is never used to switch automatically,
 * and nothing redirects. The 19 KB selector loads after the page is ready, and the translation
 * engine itself only loads when someone opens the menu or has already chosen a language.
 */
(function () {
  'use strict';
  var box = document.querySelector('.il-lang');
  if (!box) return;
  window.gtranslateSettings = {
    default_language: 'en',        // English is always the starting language
    detect_browser_language: false, // never switch automatically
    url_structure: 'none',          // no redirects, no changed URLs
    native_language_names: true,    // e.g. "Español", easy to find in your own language
    flag_style: '2d',
    wrapper_selector: '.il-lang'    // all languages supported by the widget are listed
  };
  function load() {
    if (load.done) return;
    load.done = true;
    var s = document.createElement('script');
    s.src = 'https://cdn.gtranslate.net/widgets/latest/dwf.js';
    s.defer = true;
    s.setAttribute('data-gt-orig-url', location.pathname);
    document.body.appendChild(s);
  }
  function whenReady() {
    if ('requestIdleCallback' in window) requestIdleCallback(load, { timeout: 3000 });
    else setTimeout(load, 2000);
  }
  // load early on a hint of interest, otherwise once the page has settled
  ['pointerdown', 'touchstart', 'keydown', 'scroll'].forEach(function (ev) {
    window.addEventListener(ev, load, { once: true, passive: true });
  });
  if (document.readyState === 'complete') whenReady(); else window.addEventListener('load', whenReady);
})();

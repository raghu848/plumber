/* Quote forms and the mobile call / quote bar.
 * - Checks the form in the browser (the server checks again) and shows clear success / error messages.
 * - Sends the enquiry with fetch; if JavaScript is off the form still posts normally.
 * - Keeps the sticky bar from covering the form, the keyboard or the open menu.
 */
(function () {
  'use strict';
  var PHONE = '0433 629 517', TEL = 'tel:+61433629517';
  var forms = document.querySelectorAll('form.il-quote, form#sliderForm');
  var quoteBtn = document.getElementById('quotenowbutton');
  var root = document.documentElement;

  function callLink() { return ' <a href="' + TEL + '">Call ' + PHONE + '</a>'; }

  function message(form, type, text, withCall) {
    var box = form.querySelector('.il-form-msg');
    if (!box) {
      box = document.createElement('div');
      box.className = 'il-form-msg';
      var btn = form.querySelector('button[type="submit"]');
      var row = btn && (btn.closest('.form-group') || btn.parentNode);
      if (row && row.parentNode) row.parentNode.insertBefore(box, row); else form.appendChild(box);
    }
    box.className = 'il-form-msg ' + type;
    box.setAttribute('role', type === 'ok' ? 'status' : 'alert');
    box.textContent = text;
    if (withCall) box.insertAdjacentHTML('beforeend', callLink());
    box.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
  }

  function field(form, name) { return form.querySelector('[name="' + name + '"]'); }

  function validate(form) {
    var rules = [
      ['name', function (v) { return v.trim().length >= 2; }, 'Please enter your name.'],
      ['email', function (v) { return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim()); }, 'Please enter a valid email address.'],
      ['phone', function (v) { var d = v.replace(/\D/g, ''); return /^[0-9+()\s.-]+$/.test(v.trim()) && d.length >= 8 && d.length <= 15; }, 'Please enter a valid phone number.'],
      ['service', function (v) { return v !== '' && !/^select service/i.test(v); }, 'Please choose the service you need.'],
      ['suburb', function (v) { return v.trim().length >= 2; }, 'Please enter your suburb.']
    ];
    var first = null;
    rules.forEach(function (r) {
      var el = field(form, r[0]);
      if (!el) return;
      var bad = !r[1](el.value || '');
      el.setAttribute('aria-invalid', bad ? 'true' : 'false');
      if (bad && !first) first = { el: el, msg: r[2] };
    });
    return first;
  }

  function prepare(form) {
    form.setAttribute('novalidate', '');
    var labels = { name: 'Your name', email: 'Email address', phone: 'Phone number', service: 'Service needed', suburb: 'Your suburb' };
    var auto = { name: 'name', email: 'email', phone: 'tel', suburb: 'address-level2' };
    Object.keys(labels).forEach(function (n) {
      var el = field(form, n);
      if (!el) return;
      if (!el.getAttribute('aria-label')) el.setAttribute('aria-label', labels[n]);
      if (auto[n] && !el.getAttribute('autocomplete')) el.setAttribute('autocomplete', auto[n]);
      el.setAttribute('aria-required', 'true');
      el.addEventListener('input', function () { el.removeAttribute('aria-invalid'); });
    });
    var ph = field(form, 'phone'); if (ph) { ph.setAttribute('type', 'tel'); ph.setAttribute('inputmode', 'tel'); }
    var em = field(form, 'email'); if (em) em.setAttribute('inputmode', 'email');
    // hidden trap field for bots
    if (!field(form, 'website')) {
      var t = document.createElement('div');
      t.setAttribute('aria-hidden', 'true');
      t.style.cssText = 'position:absolute;left:-9999px;height:0;overflow:hidden';
      t.innerHTML = '<label>Leave this empty<input type="text" name="website" tabindex="-1" autocomplete="off"></label>';
      form.appendChild(t);
    }

    form.addEventListener('submit', function (ev) {
      var btn = form.querySelector('button[type="submit"]');
      var problem = validate(form);
      if (problem) {
        ev.preventDefault();
        message(form, 'err', problem.msg);
        try { problem.el.focus({ preventScroll: true }); } catch (e) {}
        return;
      }
      var token = form.querySelector('[name="g-recaptcha-response"]');
      if (form.querySelector('.g-recaptcha') && (!token || !token.value)) {
        ev.preventDefault();
        message(form, 'err', 'Please tick the “I’m not a robot” box before sending.');
        return;
      }
      if (!window.fetch || !window.FormData) return; // plain form post
      ev.preventDefault();
      var data = new FormData(form);
      if (btn && !data.has('submit')) data.append('submit', 'submit');
      var label = btn && btn.innerHTML;
      if (btn) { btn.disabled = true; btn.setAttribute('aria-busy', 'true'); btn.textContent = 'Sending…'; }
      message(form, 'info', 'Sending your enquiry…');
      fetch(form.getAttribute('action'), { method: 'POST', body: data, headers: { Accept: 'application/json', 'X-Requested-With': 'fetch' }, credentials: 'same-origin' })
        .then(function (r) { return r.json().catch(function () { return { status: false, message: '' }; }).then(function (j) { return { ok: r.ok, j: j }; }); })
        .then(function (res) {
          if (res.ok && res.j.status) {
            // tell analytics the server confirmed the enquiry (only the chosen service, never personal details)
            try {
              var sv = field(form, 'service'), svc = sv && sv.options && sv.selectedIndex > -1 ? sv.options[sv.selectedIndex].text : '';
              svc = /^[A-Za-z0-9 &,'\/()-]{2,40}$/.test(svc) ? svc : '';
              document.dispatchEvent(new CustomEvent('il:lead', { detail: { form: form, service: svc } }));
            } catch (e) {}
            form.reset();
            if (window.grecaptcha && window.grecaptcha.reset) try { window.grecaptcha.reset(); } catch (e) {}
            message(form, 'ok', res.j.message || 'Thanks, your enquiry has been sent.');
          } else {
            var f = res.j && res.j.field && field(form, res.j.field);
            if (f) { f.setAttribute('aria-invalid', 'true'); try { f.focus({ preventScroll: true }); } catch (e) {} }
            if (window.grecaptcha && window.grecaptcha.reset) try { window.grecaptcha.reset(); } catch (e) {}
            message(form, 'err', (res.j && res.j.message) || 'Sorry, we could not send your enquiry.', !(res.j && res.j.message));
          }
        })
        .catch(function () {
          message(form, 'err', 'Sorry, we could not send your enquiry. Please check your connection and try again, or', true);
        })
        .then(function () { if (btn) { btn.disabled = false; btn.removeAttribute('aria-busy'); btn.innerHTML = label; } });
    });
  }
  forms.forEach(prepare);

  // ---- sticky call / quote bar ----
  if (forms.length) {
    var target = forms[0].closest('section') || forms[0];
    if (!target.id) target.id = 'quote';
    // "Get a Quote" links in the header go straight to the form on pages that have one
    document.querySelectorAll('a[href="appointment.html"]').forEach(function (a) {
      if (/quote/i.test(a.textContent) && !a.closest('footer')) {
        a.setAttribute('href', '#' + target.id);
        a.addEventListener('click', function (e) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
      }
    });
    if (quoteBtn) {
      quoteBtn.hidden = false;
      quoteBtn.setAttribute('href', '#' + target.id);
      root.classList.add('il-has-quote');
      quoteBtn.addEventListener('click', function (e) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        var f = forms[0].querySelector('input[type="text"],input[type="email"]');
        setTimeout(function () { if (f) try { f.focus({ preventScroll: true }); } catch (x) {} }, 600);
      });
    }
  } else if (quoteBtn) {
    quoteBtn.parentNode.removeChild(quoteBtn);
  }
  var hide = { form: false, focus: false };
  function sync() { root.classList.toggle('il-bar-hide', hide.form || hide.focus); }
  if (forms.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (es) { hide.form = es.some(function (e) { return e.isIntersecting; }); sync(); }, { threshold: 0.05 });
    forms.forEach(function (f) { io.observe(f.querySelector('.row') || f.parentNode); });
  }
  document.addEventListener('focusin', function (e) { hide.focus = /^(INPUT|SELECT|TEXTAREA)$/.test(e.target.tagName); sync(); });
  document.addEventListener('focusout', function () { setTimeout(function () { hide.focus = /^(INPUT|SELECT|TEXTAREA)$/.test((document.activeElement || {}).tagName || ''); sync(); }, 50); });
})();

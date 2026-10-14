(function () {
  function getCurrentLanguage() {
    const params = new URLSearchParams(window.location.search);
    const queryLang = params.get('lang');
    if (queryLang && ['tr', 'en', 'ru', 'de'].includes(queryLang)) return queryLang;

    try {
      const stored = window.localStorage.getItem('lang');
      if (stored && ['tr', 'en', 'ru', 'de'].includes(stored)) return stored;
    } catch (error) {}

    return 'tr';
  }

  function setQueryValue(key, value) {
    const url = new URL(window.location.href);
    if (value && value !== 'tr') {
      url.searchParams.set(key, value);
    } else {
      url.searchParams.delete(key);
    }
    window.history.replaceState({}, '', url.toString());
  }

  function applyLanguageToLinks(lang) {
    const targetLang = lang || 'tr';
    document.querySelectorAll('a[href^="/"]').forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href || href.includes('#')) return;

      const url = new URL(href, window.location.origin);
      if (url.origin !== window.location.origin) return;

      if (targetLang === 'tr') {
        url.searchParams.delete('lang');
      } else {
        url.searchParams.set('lang', targetLang);
      }

      const nextHref = url.pathname + url.search + url.hash;
      if (nextHref !== href) {
        link.setAttribute('href', nextHref);
      }
    });
  }

  function initLanguagePicker() {
    const selectors = '#langPickerHeader, #langPickerFooter, #langSwitch, [data-lang-picker]';
    const selects = document.querySelectorAll(selectors);
    if (!selects.length) return;

    const current = getCurrentLanguage();

    selects.forEach(function (select) {
      if (select.dataset.langBound === 'true') return;
      select.dataset.langBound = 'true';
      select.value = current;

      select.addEventListener('change', function () {
        const selected = select.value || 'tr';
        setQueryValue('lang', selected);
        applyLanguageToLinks(selected);

        if (window.__applyLang && typeof window.__applyLang === 'function') {
          window.__applyLang(selected);
        } else {
          window.location.reload();
        }
      });
    });
  }

  document.addEventListener('DOMContentLoaded', function () {
    initLanguagePicker();
    const current = getCurrentLanguage();
    applyLanguageToLinks(current);
  });
})();

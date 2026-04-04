/**
 * s2f.js - Shared vanilla JS utilities for shadcn2fluid TYPO3 components.
 * Framework-free, auto-initialised on DOMContentLoaded.
 */
document.addEventListener('DOMContentLoaded', () => {
  /* ------------------------------------------------------------------ */
  /*  1. Accordion                                                       */
  /* ------------------------------------------------------------------ */
  document.querySelectorAll('[data-s2f-accordion]').forEach(root => {
    const type = root.dataset.type || 'single';

    root.addEventListener('click', e => {
      const trigger = e.target.closest('[data-s2f-accordion-trigger]');
      if (!trigger) return;

      const item = trigger.closest('[data-s2f-accordion-item]');
      const content = item?.querySelector('[data-s2f-accordion-content]');
      if (!item || !content) return;

      const isOpen = trigger.getAttribute('aria-expanded') === 'true';

      // Single mode: close every other item first.
      if (type === 'single' && !isOpen) {
        root.querySelectorAll('[data-s2f-accordion-item]').forEach(other => {
          if (other === item) return;
          other.querySelector('[data-s2f-accordion-trigger]')?.setAttribute('aria-expanded', 'false');
          other.querySelector('[data-s2f-accordion-trigger]')?.classList.remove('accordion__trigger--open');
          other.querySelector('[data-s2f-accordion-content]')?.classList.add('accordion__content--hidden');
        });
      }

      // Toggle the clicked item.
      trigger.setAttribute('aria-expanded', String(!isOpen));
      trigger.classList.toggle('accordion__trigger--open', !isOpen);
      content.classList.toggle('accordion__content--hidden', isOpen);
    });
  });

  /* ------------------------------------------------------------------ */
  /*  2. Tabs                                                            */
  /* ------------------------------------------------------------------ */
  document.querySelectorAll('[data-s2f-tabs]').forEach(root => {
    const activate = value => {
      root.querySelectorAll('[data-s2f-tabs-trigger]').forEach(t => {
        const active = t.dataset.value === value;
        t.classList.toggle('tabs__trigger--active', active);
        t.setAttribute('aria-selected', String(active));
      });
      root.querySelectorAll('[data-s2f-tabs-content]').forEach(c => {
        c.classList.toggle('tabs__content--hidden', c.dataset.value !== value);
      });
    };

    // Set initial tab.
    const defaultVal = root.dataset.default
      || root.querySelector('[data-s2f-tabs-trigger]')?.dataset.value;
    if (defaultVal) activate(defaultVal);

    root.addEventListener('click', e => {
      const trigger = e.target.closest('[data-s2f-tabs-trigger]');
      if (trigger) activate(trigger.dataset.value);
    });
  });

  /* ------------------------------------------------------------------ */
  /*  3. Dark-mode toggle                                                */
  /* ------------------------------------------------------------------ */
  const html = document.documentElement;
  if (localStorage.getItem('s2f-theme') === 'dark') html.classList.add('dark');

  document.querySelectorAll('[data-s2f-theme-toggle]').forEach(btn => {
    btn.addEventListener('click', () => {
      html.classList.toggle('dark');
      localStorage.setItem('s2f-theme', html.classList.contains('dark') ? 'dark' : 'light');
    });
  });

  /* ------------------------------------------------------------------ */
  /*  4. Scroll animations (IntersectionObserver)                        */
  /* ------------------------------------------------------------------ */
  if ('IntersectionObserver' in window) {
    const animObs = new IntersectionObserver(
      entries => entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          animObs.unobserve(e.target);
        }
      }),
      { threshold: 0.1 }
    );
    document.querySelectorAll('[data-s2f-animate]').forEach(el => animObs.observe(el));
  }

  /* ------------------------------------------------------------------ */
  /*  5. Counter                                                         */
  /* ------------------------------------------------------------------ */
  if ('IntersectionObserver' in window) {
    const counterObs = new IntersectionObserver(
      entries => entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        counterObs.unobserve(el);

        const target = parseFloat(el.dataset.target) || 0;
        const duration = parseInt(el.dataset.duration, 10) || 2000;
        const isFloat = String(el.dataset.target).includes('.');
        const start = performance.now();

        const step = now => {
          const progress = Math.min((now - start) / duration, 1);
          el.textContent = isFloat
            ? (target * progress).toFixed(1)
            : Math.floor(target * progress);
          if (progress < 1) requestAnimationFrame(step);
          else el.textContent = el.dataset.target;
        };
        requestAnimationFrame(step);
      }),
      { threshold: 0.3 }
    );
    document.querySelectorAll('[data-s2f-counter]').forEach(el => counterObs.observe(el));
  }

  /* ------------------------------------------------------------------ */
  /*  6. Click-outside                                                   */
  /* ------------------------------------------------------------------ */
  document.addEventListener('click', e => {
    document.querySelectorAll('[data-s2f-click-outside]:not(.is-hidden)').forEach(el => {
      if (!el.contains(e.target)) el.classList.add('is-hidden');
    });
  });

  /* ------------------------------------------------------------------ */
  /*  7. Mobile menu toggle                                              */
  /* ------------------------------------------------------------------ */
  document.querySelectorAll('[data-s2f-menu-toggle]').forEach(btn => {
    btn.addEventListener('click', () => {
      const targetSel = btn.dataset.s2fMenuTarget;
      const target = targetSel ? document.querySelector(targetSel) : null;
      if (!target) return;

      const expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      target.classList.toggle('is-hidden', !expanded);
    });
  });

  /* ------------------------------------------------------------------ */
  /*  8. Back to top                                                     */
  /* ------------------------------------------------------------------ */
  document.querySelectorAll('[data-s2f-back-to-top]').forEach(btn => {
    const threshold = parseInt(btn.dataset.threshold, 10) || 300;

    const toggle = () => btn.classList.toggle('is-hidden', window.scrollY < threshold);
    toggle();
    window.addEventListener('scroll', toggle, { passive: true });

    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  });
});

const menuButton = document.querySelector('[data-menu]');
const mainNav = document.getElementById('main-nav');
function closeMenu() { mainNav?.classList.remove('open'); menuButton?.setAttribute('aria-expanded', 'false'); }
menuButton?.addEventListener('click', () => { const open = mainNav.classList.toggle('open'); menuButton.setAttribute('aria-expanded', String(open)); });
mainNav?.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
document.addEventListener('keydown', event => { if (event.key === 'Escape' && mainNav?.classList.contains('open')) { closeMenu(); menuButton.focus(); } });
document.querySelectorAll('form[data-confirm]').forEach(form => form.addEventListener('submit', event => { if (!confirm(form.dataset.confirm)) event.preventDefault(); }));

if (document.body.classList.contains('public-site')) {
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (!reducedMotion.matches && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { entry.target.classList.add('revealed'); observer.unobserve(entry.target); } }), {threshold: .08});
    document.querySelectorAll('[data-reveal]').forEach(element => { element.classList.add('reveal-ready'); observer.observe(element); });
    reducedMotion.addEventListener('change', event => { if (event.matches) document.querySelectorAll('.reveal-ready').forEach(element => element.classList.add('revealed')); });
  }
  const tabs = [...document.querySelectorAll('[data-step]')];
  function activateTab(tab) {
    tabs.forEach(item => { const active = item === tab; item.classList.toggle('selected', active); item.setAttribute('aria-selected', String(active)); item.tabIndex = active ? 0 : -1; document.getElementById(item.getAttribute('aria-controls')).hidden = !active; });
  }
  tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => activateTab(tab));
    tab.addEventListener('keydown', event => {
      let next;
      if (event.key === 'ArrowDown' || event.key === 'ArrowRight') next = (index + 1) % tabs.length;
      if (event.key === 'ArrowUp' || event.key === 'ArrowLeft') next = (index - 1 + tabs.length) % tabs.length;
      if (event.key === 'Home') next = 0;
      if (event.key === 'End') next = tabs.length - 1;
      if (next !== undefined) { event.preventDefault(); activateTab(tabs[next]); tabs[next].focus(); }
    });
  });
  const header = document.querySelector('.header');
  const progress = document.querySelector('.scroll-progress');
  let scheduled = false;
  function refreshScroll() { const max = document.documentElement.scrollHeight - innerHeight; if (progress) progress.style.width = `${max > 0 ? scrollY / max * 100 : 0}%`; header?.classList.toggle('scrolled', scrollY > 20); scheduled = false; }
  addEventListener('scroll', () => { if (!scheduled) { scheduled = true; requestAnimationFrame(refreshScroll); } }, {passive: true});
  addEventListener('resize', refreshScroll, {passive: true});
  refreshScroll();
}

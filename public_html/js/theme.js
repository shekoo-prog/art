(function () {
  const KEY = 'site-theme';
  const root = document.documentElement;

  function applyTheme(theme) {
    if (theme === 'light') {
      root.classList.remove('theme-dark');
      root.classList.add('theme-light');
      root.setAttribute('data-theme', 'light');
      root.setAttribute('data-bs-theme', 'light');
    } else {
      root.classList.remove('theme-light');
      root.classList.add('theme-dark');
      root.setAttribute('data-theme', 'dark');
      root.setAttribute('data-bs-theme', 'dark');
    }
    updateToggleIcon();
  }

  function preferredTheme() {
    try {
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) return 'light';
    } catch (e) {/* ignore */ }
    return 'dark';
  }

  function currentTheme() {
    const stored = localStorage.getItem(KEY);
    if (stored) return stored;
    return preferredTheme();
  }

  function toggleTheme() {
    const theme = currentTheme() === 'light' ? 'dark' : 'light';
    localStorage.setItem(KEY, theme);
    applyTheme(theme);
  }

  function updateToggleIcon() {
    const btn = document.getElementById('themeToggle');
    if (!btn) return;
    const isLight = root.classList.contains('theme-light');
    btn.setAttribute('aria-pressed', isLight ? 'true' : 'false');
    btn.innerHTML = isLight ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
  }

  // init
  document.addEventListener('DOMContentLoaded', () => {
    applyTheme(currentTheme());

    const btn = document.getElementById('themeToggle');
    if (btn) btn.addEventListener('click', toggleTheme);
  });

  // react to system changes if no explicit preference
  if (!localStorage.getItem(KEY) && window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      applyTheme(e.matches ? 'dark' : 'light');
    });
  }
})();
document.addEventListener('DOMContentLoaded', () => {
  const userMenuButton = document.getElementById('user-menu-button');
  const userMenu = userMenuButton && document.querySelector('[aria-labelledby="user-menu-button"]');

  if (userMenuButton && userMenu) {
    userMenuButton.addEventListener('click', (e) => {
      e.stopPropagation();
      const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
      userMenuButton.setAttribute('aria-expanded', String(!isExpanded));
      userMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
        userMenu.classList.add('hidden');
        userMenuButton.setAttribute('aria-expanded', 'false');
      }
    });
  }

  const mobileMenuButton = document.querySelector('button[aria-controls="mobile-menu"]');
  const mobileMenu = document.getElementById('mobile-menu');
  const openIcon = mobileMenuButton.querySelector('svg.block');
  const closeIcon = mobileMenuButton.querySelector('svg.hidden');

  mobileMenuButton.addEventListener('click', () => {
    const isOpen = mobileMenu.classList.toggle('hidden');
    openIcon.classList.toggle('hidden');
    closeIcon.classList.toggle('hidden');
    const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
    mobileMenuButton.setAttribute('aria-expanded', String(!expanded));
  });

  const dashboardBtn = document.getElementById('dashboard-button');
  const mobileDashboardBtn = document.getElementById('mobile-dashboard-button');
  const flyout = document.getElementById('dashboard-flyout');

  if (!flyout) return;

  function toggleFlyout() {
    const isOpen = flyout.classList.contains('opacity-100');

    if (isOpen) {
      flyout.classList.remove('opacity-100', 'translate-y-0');
      flyout.classList.add('opacity-0', '-translate-y-1');
      setTimeout(() => flyout.classList.add('hidden'), 300);
    } else {
      flyout.classList.remove('hidden');
      requestAnimationFrame(() => {
        flyout.classList.remove('opacity-0', '-translate-y-1');
        flyout.classList.add('opacity-100', 'translate-y-0');
      });
    }
  }

  dashboardBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    toggleFlyout();
  });

  mobileDashboardBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    document.getElementById('mobile-menu')?.classList.add('hidden');
    toggleFlyout();
  });

  document.addEventListener('click', (e) => {
    if (!dashboardBtn?.contains(e.target) &&
        !mobileDashboardBtn?.contains(e.target) &&
        !flyout.contains(e.target)) {
      flyout.classList.remove('opacity-100', 'translate-y-0');
      flyout.classList.add('opacity-0', '-translate-y-1');
      setTimeout(() => flyout.classList.add('hidden'), 300);
    }
  });
});
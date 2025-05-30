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
});
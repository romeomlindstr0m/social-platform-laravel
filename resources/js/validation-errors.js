document.addEventListener('DOMContentLoaded', () => {
  const notification = document.querySelector('.pointer-events-auto');
  if (!notification) return;

  setTimeout(() => {
    notification.classList.add('transition', 'ease-in', 'duration-200', 'opacity-0');

    const handleTransitionEnd = (event) => {
      if (event.propertyName === 'opacity') {
        notification.removeEventListener('transitionend', handleTransitionEnd);
        notification.parentNode && notification.parentNode.removeChild(notification);
      }
    };
    notification.addEventListener('transitionend', handleTransitionEnd);
  }, 7000);
});
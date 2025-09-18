/**
 * Main JS file for CausePro
 */

document.addEventListener('DOMContentLoaded', function() {
    const siteNavigation = document.getElementById('site-navigation');
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.querySelector('.menu-toggle');
    if (!button) {
        return;
    }

    const menu = siteNavigation.querySelector('ul');
    if (!menu) {
        button.style.display = 'none';
        return;
    }

    button.addEventListener('click', function() {
        // Toggle the class on the <ul> element which the CSS uses to show/hide the menu
        menu.classList.toggle('toggled');

        // Toggle the aria-expanded attribute
        const isExpanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', !isExpanded);
    });
});

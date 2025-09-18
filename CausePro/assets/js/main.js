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
        menu.classList.toggle('toggled');
        document.body.classList.toggle('noscroll');

        const isExpanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', !isExpanded);
    });

    // Close the mobile menu on link click
    const menuLinks = menu.getElementsByTagName('a');
    for (let i = 0; i < menuLinks.length; i++) {
        menuLinks[i].addEventListener('click', function() {
            if (menu.classList.contains('toggled')) {
                menu.classList.remove('toggled');
                document.body.classList.remove('noscroll');
                button.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // --- Load More Posts ---
    const loadMoreBtn = document.getElementById('load-more-posts');
    const masonryGrid = document.getElementById('masonry-grid');

    if (loadMoreBtn && masonryGrid) {
        let loading = false;

        const loadPosts = () => {
            if (loading) return;

            let currentPage = parseInt(loadMoreBtn.dataset.page);
            const maxPages = parseInt(loadMoreBtn.dataset.maxPages);

            if (currentPage >= maxPages) {
                loadMoreBtn.style.display = 'none';
                return;
            }

            loading = true;
            loadMoreBtn.textContent = 'Loading...';

            const formData = new FormData();
            formData.append('action', 'load_more_posts');
            formData.append('page', currentPage);
            formData.append('nonce', causepro_ajax.nonce);

            fetch(causepro_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(html => {
                masonryGrid.insertAdjacentHTML('beforeend', html);
                loadMoreBtn.dataset.page = currentPage + 1;
                if (currentPage + 1 >= maxPages) {
                    loadMoreBtn.style.display = 'none';
                }
                loadMoreBtn.textContent = 'Load More';
                loading = false;
            })
            .catch(error => {
                console.error('Error loading more posts:', error);
                loading = false;
                loadMoreBtn.textContent = 'Load More';
            });
        };

        // Load more on button click
        loadMoreBtn.addEventListener('click', loadPosts);

        // Infinite scroll
        const infiniteScrollObserver = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                loadPosts();
            }
        }, { threshold: 1.0 });

        infiniteScrollObserver.observe(loadMoreBtn);
    }
});

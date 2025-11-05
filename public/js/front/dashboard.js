// School Agent - Dashboard Page JavaScript

/**
 * DOM Content Loaded Event Listener
 * Initializes all functionality when the page is fully loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initBurgerMenu();
    initStatCards();
    initConversationItems();
    initSearchAndFilter();
    initResponsiveLayout();
});

/**
 * Burger Menu Toggle
 * Handles the burger menu functionality
 */
function initBurgerMenu() {
    const burgerBtn = document.getElementById('burgerBtn');
    const burgerDropdown = document.getElementById('burgerDropdown');

    if (burgerBtn && burgerDropdown) {
        // Toggle dropdown on button click
        burgerBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            burgerDropdown.classList.toggle('show');
            burgerBtn.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.burger-menu')) {
                burgerDropdown.classList.remove('show');
                burgerBtn.classList.remove('active');
            }
        });

        // Close dropdown when clicking on a link
        const burgerItems = burgerDropdown.querySelectorAll('.burger-item');
        burgerItems.forEach(item => {
            item.addEventListener('click', () => {
                burgerDropdown.classList.remove('show');
                burgerBtn.classList.remove('active');
            });
        });
    }
}

/**
 * Stat Cards Interaction
 * Adds hover and click effects to stat cards
 */
function initStatCards() {
    const statItems = document.querySelectorAll('.stat-item');
    
    statItems.forEach((card, index) => {
        // Stagger animation on load
        card.style.animationDelay = `${index * 0.1}s`;
        
        // Add hover effect
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = 'var(--shadow-xl)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'var(--shadow-lg)';
        });

        // Click on card to view conversations
        const viewBtn = card.querySelector('.view-btn');
        if (viewBtn) {
            card.style.cursor = 'pointer';
            
            // View button already has link, so we just enhance it
            viewBtn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
}

/**
 * Conversation Items Interaction
 * Adds hover and click effects to conversation items
 */
function initConversationItems() {
    const conversationItems = document.querySelectorAll('.conversation-item');
    
    conversationItems.forEach((item, index) => {
        // Stagger animation on load
        item.style.animationDelay = `${index * 0.05}s`;
        
        // Add hover effect
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = 'var(--gray-50)';
            this.style.paddingLeft = 'var(--spacing-12)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
            this.style.paddingLeft = 'var(--spacing-6)';
        });
    });
}

/**
 * Search and Filter Functionality
 * Allows users to search through agents or conversations
 */
function initSearchAndFilter() {
    // Check if there's a search input on this page
    const searchInput = document.querySelector('input[type="search"], input[placeholder*="Rechercher"]');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            filterItems(searchTerm);
        });
    }
}

/**
 * Filter Items Based on Search Term
 * Hides/shows stat items based on search
 */
function filterItems(searchTerm) {
    const statItems = document.querySelectorAll('.stat-item');
    let visibleCount = 0;
    
    statItems.forEach(item => {
        const agentName = item.querySelector('.agent-name')?.textContent.toLowerCase() || '';
        
        if (agentName.includes(searchTerm)) {
            item.style.display = 'block';
            item.style.opacity = '1';
            visibleCount++;
        } else {
            item.style.display = 'none';
            item.style.opacity = '0';
        }
    });

    // Show empty state if no results
    const emptyState = document.querySelector('.empty-state-container');
    if (visibleCount === 0 && statItems.length > 0) {
        if (emptyState) {
            emptyState.style.display = 'block';
        }
    } else if (emptyState) {
        emptyState.style.display = 'none';
    }
}

/**
 * Responsive Layout Handler
 * Handles layout adjustments for different screen sizes
 */
function initResponsiveLayout() {
    // Check if we're on mobile
    const isMobile = window.innerWidth <= 768;
    
    if (isMobile) {
        // Adjust grid on mobile
        const statsGrid = document.querySelector('.stats-grid');
        if (statsGrid) {
            statsGrid.style.gridTemplateColumns = '1fr';
        }
    }

    // Handle window resize
    window.addEventListener('resize', debounce(function() {
        const isMobileNow = window.innerWidth <= 768;
        
        if (isMobileNow) {
            const statsGrid = document.querySelector('.stats-grid');
            if (statsGrid) {
                statsGrid.style.gridTemplateColumns = '1fr';
            }
        } else {
            const statsGrid = document.querySelector('.stats-grid');
            if (statsGrid) {
                statsGrid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(280px, 1fr))';
            }
        }
    }, 250));
}

/**
 * Debounce Function
 * Prevents function from being called too frequently
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Scroll to Top
 * Smooth scroll to top of page
 */
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

/**
 * Export functions for potential module use
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initBurgerMenu,
        initStatCards,
        initConversationItems,
        initSearchAndFilter,
        filterItems,
        initResponsiveLayout,
        debounce,
        scrollToTop
    };
}

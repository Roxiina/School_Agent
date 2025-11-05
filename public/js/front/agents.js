// School Agent - Agents Page JavaScript

/**
 * DOM Content Loaded Event Listener
 * Initializes all functionality when the page is fully loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initHeaderScroll();
    initAgentCardAnimations();
    initScrollAnimations();
    initAgentInteractions();
});

/**
 * Header background change on scroll
 * Adds/removes header styling based on scroll position
 */
function initHeaderScroll() {
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) {
            header.style.background = 'rgba(255, 255, 255, 0.98)';
            header.style.boxShadow = 'var(--shadow)';
        } else {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.boxShadow = 'none';
        }
    });
}

/**
 * Animate agent cards on page load
 * Applies staggered entrance animation to cards
 */
function initAgentCardAnimations() {
    const cards = document.querySelectorAll('.agent-card');
    cards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.6s ease-out ${index * 0.1}s backwards`;
    });
}

/**
 * Animate elements on scroll using Intersection Observer
 * Triggers fade-in animations when elements come into view
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
                // Optionally stop observing after animation
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe subject sections and coming soon section
    document.querySelectorAll('.subject-section, .coming-soon-section').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Initialize agent card interactions
 * Adds hover effects and click handlers for agent buttons
 */
function initAgentInteractions() {
    const agentCards = document.querySelectorAll('.agent-card');

    agentCards.forEach(card => {
        // Add hover effect
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });

        // Add button interactions
        const buttons = card.querySelectorAll('.agent-btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });

            // Add click effect
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(0)';
                }, 150);
            });
        });
    });
}

/**
 * Smooth scroll to top
 * Can be called when scrolling to specific sections
 */
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

/**
 * Toggle loading state on buttons
 * Shows/hides loading indicator
 */
function setButtonLoading(button, isLoading) {
    if (isLoading) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Chargement...';
    } else {
        button.disabled = false;
        button.innerHTML = '<i class="fas fa-comments"></i> Discuter';
    }
}

/**
 * Get agent details for tooltip/info
 * Fetches additional agent information
 */
function getAgentDetails(agentId) {
    // This can be extended to fetch detailed information about an agent
    console.log('Getting details for agent:', agentId);
}

/**
 * Handle agent selection
 * Could be used to track user interactions
 */
function selectAgent(agentId, agentName) {
    console.log('Selected agent:', agentName, '(ID:', agentId, ')');
    // You can add tracking or analytics here
    // Example: trackEvent('agent_selected', { agent_id: agentId, agent_name: agentName })
}

/**
 * Initialize tooltips for agent cards
 * Adds tooltips with additional agent information
 */
function initAgentTooltips() {
    const agentCards = document.querySelectorAll('.agent-card');

    agentCards.forEach(card => {
        const agentName = card.querySelector('.agent-name')?.textContent || 'Agent';
        
        // Add title attribute for native tooltip
        card.setAttribute('title', `En savoir plus sur ${agentName}`);
    });
}

/**
 * Filter agents by search term
 * Allows searching through agents
 */
function filterAgents(searchTerm) {
    const cards = document.querySelectorAll('.agent-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const name = card.querySelector('.agent-name')?.textContent?.toLowerCase() || '';
        const description = card.querySelector('.agent-description')?.textContent?.toLowerCase() || '';
        
        if (name.includes(searchTerm.toLowerCase()) || description.includes(searchTerm.toLowerCase())) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    // Show message if no results
    if (visibleCount === 0) {
        console.log('No agents found matching:', searchTerm);
    }

    return visibleCount;
}

/**
 * Reset agent filters
 * Shows all agents again
 */
function resetAgentFilters() {
    const cards = document.querySelectorAll('.agent-card');
    cards.forEach(card => {
        card.style.display = '';
    });
}

/**
 * Add active state to navigation
 * Highlights current page in navigation
 */
function setActiveNavigation() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        if (link.getAttribute('href') === '/agents' || link.href.endsWith('/agents')) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

// Initialize on page load
setActiveNavigation();

/**
 * Export functions for potential external use
 */
window.AgentsPage = {
    scrollToTop,
    setButtonLoading,
    getAgentDetails,
    selectAgent,
    filterAgents,
    resetAgentFilters
};

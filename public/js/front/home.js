// School Agent - Home Page JavaScript

/**
 * DOM Content Loaded Event Listener
 * Initializes all functionality when the page is fully loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initSmoothScrolling();
    initActiveNavigation();
    initHeaderScroll();
    initScrollAnimations();
    initWelcomeAnimation();
    initBurgerMenu();
});

/**
 * Smooth scrolling for navigation links
 * Enables smooth scroll behavior for anchor links
 */
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Active navigation link based on scroll position
 * Updates the active navigation link as user scrolls through sections
 */
function initActiveNavigation() {
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (window.scrollY >= sectionTop - 100) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
}

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
            }
        });
    }, observerOptions);

    // Observe feature cards and stat items
    document.querySelectorAll('.feature-card, .stat-item').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Welcome message animation
 * Adds a subtle scale animation to the hero title after page load
 */
function initWelcomeAnimation() {
    setTimeout(() => {
        const title = document.querySelector('.hero-title');
        if (title) {
            title.style.transform = 'scale(1.02)';
            setTimeout(() => {
                title.style.transform = 'scale(1)';
            }, 300);
        }
    }, 1000);
}

/**
 * Utility function to debounce scroll events
 * Improves performance by limiting how often scroll handlers execute
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
 * Mobile menu toggle functionality
 * Handles mobile navigation menu toggle (if needed in future updates)
 */
function toggleMobileMenu() {
    const navMenu = document.querySelector('.nav-menu');
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    
    if (navMenu && mobileMenuBtn) {
        navMenu.classList.toggle('active');
        mobileMenuBtn.classList.toggle('active');
    }
}

/**
 * Form validation utility
 * Can be used for future contact forms or user registration
 */
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Scroll to top functionality
 * Smoothly scrolls to the top of the page
 */
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

/**
 * Show/hide scroll to top button based on scroll position
 */
function initScrollToTop() {
    const scrollBtn = document.querySelector('.scroll-to-top');
    if (scrollBtn) {
        window.addEventListener('scroll', debounce(() => {
            if (window.scrollY > 300) {
                scrollBtn.classList.add('visible');
            } else {
                scrollBtn.classList.remove('visible');
            }
        }, 100));
        
        scrollBtn.addEventListener('click', scrollToTop);
    }
}

/**
 * Analytics tracking (placeholder)
 * Can be extended to track user interactions
 */
function trackEvent(eventName, eventData = {}) {
    // Placeholder for analytics tracking
    console.log(`Event: ${eventName}`, eventData);
    
    // Example: Google Analytics tracking
    // if (typeof gtag !== 'undefined') {
    //     gtag('event', eventName, eventData);
    // }
}

/**
 * Performance monitoring
 * Logs page load performance metrics
 */
function monitorPerformance() {
    window.addEventListener('load', () => {
        setTimeout(() => {
            const perfData = performance.timing;
            const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
            console.log(`Page load time: ${pageLoadTime}ms`);
            
            // Track performance if analytics is available
            trackEvent('page_load_time', {
                load_time: pageLoadTime,
                page: 'home'
            });
        }, 0);
    });
}

// Initialize performance monitoring
monitorPerformance();

/**
 * Burger Menu Toggle
 * Handles the burger menu functionality on profile and dashboard pages
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
 * Export functions for potential module use
 */
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initSmoothScrolling,
        initActiveNavigation,
        initHeaderScroll,
        initScrollAnimations,
        validateEmail,
        scrollToTop,
        trackEvent,
        initBurgerMenu
    };
}
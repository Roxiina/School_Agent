/**
 * ia.js - Interactions Ultra-Modernes
 * Effets avancés et animations fluides
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 IA Page - Ultra Modern Mode Activated');

    initParallaxEffect();
    initCardAnimations();
    initCursorEffect();
    initScrollAnimations();
    initButtonEffects();
    initParticles();
});

/**
 * Effet parallax sur le hero
 */
function initParallaxEffect() {
    const heroSection = document.querySelector('.hero-section');
    const orbs = document.querySelectorAll('.gradient-orb');
    
    if (!heroSection) return;

    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const heroHeight = heroSection.offsetHeight;
        
        if (scrolled < heroHeight) {
            const opacity = 1 - (scrolled / heroHeight);
            heroSection.style.opacity = Math.max(opacity, 0.3);
            
            orbs.forEach((orb, index) => {
                const speed = 0.3 + (index * 0.1);
                const offset = scrolled * speed;
                orb.style.transform = `translateY(${offset}px)`;
            });
        }
    });
}

/**
 * Animations des cartes d'agents
 */
function initCardAnimations() {
    const cards = document.querySelectorAll('.agent-card');
    
    cards.forEach((card, index) => {
        // Animation d'entrée échelonnée
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);

        // Effet 3D au mouvement de la souris
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 15;
            const rotateY = (centerX - x) / 15;
            
            card.style.transform = `
                translateY(-12px) 
                scale(1.02)
                perspective(1000px)
                rotateX(${rotateX}deg)
                rotateY(${rotateY}deg)
            `;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1) perspective(1000px) rotateX(0) rotateY(0)';
        });

        // Animation de l'avatar
        const avatar = card.querySelector('.agent-avatar');
        if (avatar) {
            avatar.addEventListener('click', (e) => {
                e.preventDefault();
                avatar.style.animation = 'none';
                setTimeout(() => {
                    avatar.style.animation = 'bounce 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                }, 10);
            });
        }
    });
}

/**
 * Effet de curseur personnalisé
 */
function initCursorEffect() {
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    document.body.appendChild(cursor);

    const cursorFollower = document.createElement('div');
    cursorFollower.className = 'cursor-follower';
    document.body.appendChild(cursorFollower);

    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;
    let followerX = 0, followerY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function animateCursor() {
        cursorX += (mouseX - cursorX) * 0.3;
        cursorY += (mouseY - cursorY) * 0.3;
        followerX += (mouseX - followerX) * 0.1;
        followerY += (mouseY - followerY) * 0.1;

        cursor.style.left = cursorX + 'px';
        cursor.style.top = cursorY + 'px';
        cursorFollower.style.left = followerX + 'px';
        cursorFollower.style.top = followerY + 'px';

        requestAnimationFrame(animateCursor);
    }
    animateCursor();

    const interactiveElements = document.querySelectorAll('a, button, .agent-card');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(1.5)';
            cursorFollower.style.transform = 'scale(2)';
        });
        el.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
            cursorFollower.style.transform = 'scale(1)';
        });
    });
}

/**
 * Animations au scroll
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.agent-card, .section-intro').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(40px)';
        el.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(el);
    });
}

/**
 * Effets sur les boutons
 */
function initButtonEffects() {
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });

        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            this.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px) translateY(-3px)`;
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0, 0)';
        });
    });
}

/**
 * Particules flottantes
 */
function initParticles() {
    const hero = document.querySelector('.hero-background');
    if (!hero) return;

    const particlesContainer = document.createElement('div');
    particlesContainer.className = 'particles-container';
    hero.appendChild(particlesContainer);

    for (let i = 0; i < 30; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 4 + 1;
        const left = Math.random() * 100;
        const animationDuration = Math.random() * 15 + 10;
        const delay = Math.random() * 5;
        
        particle.style.cssText = `
            width: ${size}px;
            height: ${size}px;
            left: ${left}%;
            bottom: -${size}px;
            animation: float-particle ${animationDuration}s ease-in-out ${delay}s infinite;
        `;
        
        particlesContainer.appendChild(particle);
    }
}

const dynamicStyles = document.createElement('style');
dynamicStyles.textContent = `
    .custom-cursor {
        position: fixed;
        width: 10px;
        height: 10px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.2s ease;
        mix-blend-mode: difference;
    }

    .cursor-follower {
        position: fixed;
        width: 30px;
        height: 30px;
        border: 2px solid rgba(102, 126, 234, 0.5);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        transition: transform 0.2s ease;
    }

    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    @keyframes bounce {
        0%, 100% { transform: rotate(0deg) scale(1); }
        25% { transform: rotate(-15deg) scale(1.15); }
        50% { transform: rotate(15deg) scale(1.2); }
        75% { transform: rotate(-10deg) scale(1.15); }
    }

    .particles-container {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
    }

    @keyframes float-particle {
        0% {
            transform: translateY(0) translateX(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(${Math.random() * 200 - 100}px) rotate(360deg);
            opacity: 0;
        }
    }

    .is-visible {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    @media (max-width: 768px) {
        .custom-cursor,
        .cursor-follower {
            display: none;
        }
    }
`;
document.head.appendChild(dynamicStyles);

console.log('✨ Animations ultra-modernes activées');

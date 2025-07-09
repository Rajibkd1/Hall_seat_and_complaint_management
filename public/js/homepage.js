// Initialize Enhanced Lenis Smooth Scroll
const lenis = new Lenis({
    lerp: 0.05,
    wheelMultiplier: 1.2,
    gestureOrientation: 'vertical',
    normalizeWheel: false,
    smoothTouch: false,
    touchMultiplier: 2,
    infinite: false,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
});

// Enhanced Animation Frame
function raf(time) {
    lenis.raf(time);
    requestAnimationFrame(raf);
}
requestAnimationFrame(raf);

// Enhanced Particle System with Multiple Types
function createParticles() {
    const particleContainer = document.getElementById('particles');
    const particleCount = window.innerWidth < 768 ? 15 : 25;
    const particleTypes = ['particle-1', 'particle-2', 'particle-3'];
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        const randomType = particleTypes[Math.floor(Math.random() * particleTypes.length)];
        particle.className = `particle ${randomType}`;
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 12 + 's';
        particle.style.animationDuration = (Math.random() * 8 + 8) + 's';
        particleContainer.appendChild(particle);
    }
}

// Enhanced Parallax Effect
lenis.on('scroll', (e) => {
    const scrolled = e.scroll;
    const rate = scrolled * -0.5;
    
    // Apply parallax to elements
    if (window.innerWidth > 768) {
        document.querySelectorAll('.parallax-element').forEach((element, index) => {
            const speed = (index + 1) * 0.03;
            element.style.transform = `translateY(${rate * speed}px)`;
        });
    }

    // Dynamic header background opacity
    const header = document.querySelector('header');
    const opacity = Math.min(0.98, 0.85 + (scrolled * 0.001));
    header.style.backgroundColor = `rgba(255, 255, 255, ${opacity})`;
});

// Enhanced Scroll Reveal Animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
        }
    });
}, observerOptions);

// Observe all scroll-triggered elements
document.querySelectorAll('.scroll-fade, .scroll-slide-left, .scroll-slide-right, .scroll-scale, .scroll-rotate').forEach(el => {
    observer.observe(el);
});

// Enhanced Stagger Animation
document.querySelectorAll('.stagger-animation').forEach((el, index) => {
    el.style.animationDelay = `${index * 0.4}s`;
    el.style.animation = 'fadeInUp 1.2s ease forwards';
});

// Add enhanced fadeInUp animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(60px) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
`;
document.head.appendChild(style);

// Enhanced Magnetic Effect for Buttons
document.querySelectorAll('.magnetic-effect').forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        
        btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px) scale(1.05)`;
    });
    
    btn.addEventListener('mouseleave', () => {
        btn.style.transform = '';
    });
});

// Initialize particles and effects
window.addEventListener('load', () => {
    createParticles();
    
    // Add initial reveal animation
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});

// Handle window resize
window.addEventListener('resize', () => {
    const particleContainer = document.getElementById('particles');
    particleContainer.innerHTML = '';
    createParticles();
});

// Add scroll-based background color change
window.addEventListener('scroll', () => {
    const scrollPercent = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
    const hue = Math.floor(scrollPercent * 60 + 220); // Blue to purple range
    document.body.style.filter = `hue-rotate(${hue - 220}deg)`;
});
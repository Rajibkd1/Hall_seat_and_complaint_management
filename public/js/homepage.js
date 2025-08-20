document.addEventListener("DOMContentLoaded", () => {
    const noticeCards = document.querySelectorAll(".notice-card");
    const noticeModal = document.getElementById("noticeModal");
    const closeModal = document.getElementById("closeModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalDate = document.getElementById("modalDate");
    const modalCategory = document.getElementById("modalCategory");
    const modalContent = document.getElementById("modalContent");
    const modalAuthor = document.getElementById("modalAuthor");
    const modalValidUntil = document.getElementById("modalValidUntil");
    const downloadBtn = document.getElementById("downloadBtn");

    noticeCards.forEach((card) => {
        card.addEventListener("click", () => {
            const noticeId = card.dataset.noticeId;
            fetch(`/public-notice/${noticeId}`)
                .then((response) => response.json())
                .then((data) => {
                    modalTitle.textContent = data.title;
                    modalDate.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        ${new Date(data.date_posted).toLocaleDateString(
                            "en-US",
                            { year: "numeric", month: "short", day: "numeric" }
                        )}
                    `;
                    modalCategory.textContent =
                        data.notice_type.charAt(0).toUpperCase() +
                        data.notice_type.slice(1);
                    modalContent.textContent = data.description;
                    modalAuthor.textContent = data.admin
                        ? data.admin.name
                        : "Hall Administration";

                    if (data.valid_until) {
                        modalValidUntil.innerHTML = `
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Valid until: ${new Date(
                                data.valid_until
                            ).toLocaleDateString()}
                        `;
                    } else {
                        modalValidUntil.innerHTML = "";
                    }

                    if (data.attachment) {
                        downloadBtn.style.display = "block";
                        downloadBtn.onclick = () =>
                            window.open(data.attachment, "_blank");
                    } else {
                        downloadBtn.style.display = "none";
                    }

                    noticeModal.classList.remove("hidden");
                    document.body.style.overflow = "hidden";
                });
        });
    });

    closeModal.addEventListener("click", () => {
        noticeModal.classList.add("hidden");
        document.body.style.overflow = "auto";
    });

    noticeModal.addEventListener("click", (e) => {
        if (e.target === noticeModal) {
            noticeModal.classList.add("hidden");
            document.body.style.overflow = "auto";
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && !noticeModal.classList.contains("hidden")) {
            noticeModal.classList.add("hidden");
            document.body.style.overflow = "auto";
        }
    });
});

// Counter Animation
function animateCounters() {
    const counters = document.querySelectorAll(".counter");

    counters.forEach((counter) => {
        const target = parseInt(counter.getAttribute("data-target"));
        const increment = target / 100;
        let current = 0;

        const updateCounter = () => {
            if (current < target) {
                current += increment;
                counter.textContent = Math.floor(current);
                setTimeout(updateCounter, 20);
            } else {
                counter.textContent = target;
            }
        };

        // Start animation when element is in view
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                updateCounter();
                observer.disconnect();
            }
        });

        observer.observe(counter);
    });
}

// Parallax Effect - Disabled to prevent text movement issues
function handleParallax() {
    // Parallax effect disabled as requested to prevent Quick Access text from moving
    return;
}

// Particle system removed as requested

// Smooth scrolling for anchor links
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });
}

// Enhanced scroll animations - This is the key function to make Quick Access section visible
function handleScrollAnimations() {
    const animateElements = document.querySelectorAll(
        ".scroll-fade, .scroll-scale, .scroll-slide-left, .scroll-slide-right, .scroll-rotate"
    );

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("revealed");
                }
            });
        },
        {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px",
        }
    );

    animateElements.forEach((element) => {
        observer.observe(element);
    });
}

// Enhanced notice card animations
function enhanceNoticeCards() {
    const noticeCards = document.querySelectorAll(".notice-card");

    noticeCards.forEach((card, index) => {
        // Add staggered animation delay
        card.style.animationDelay = `${index * 0.1}s`;

        // Add hover sound effect (optional)
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-8px) scale(1.02)";
        });

        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0) scale(1)";
        });
    });
}

// Homepage Notice Search and Filter functionality
class HomepageNoticeManager {
    constructor() {
        this.currentFilter = "all";
        this.allNotices = [];
        this.initializeElements();
        this.bindEvents();
        this.storeOriginalNotices();
    }

    initializeElements() {
        this.noticesContainer = document.getElementById("noticesContainer");
        this.searchInput = document.getElementById("searchInput");
        this.filterTags = document.querySelectorAll(".filter-tag");
        this.noResults = document.getElementById("noResults");
        this.searchResults = document.getElementById("searchResults");
        this.resultsCount = document.getElementById("resultsCount");
    }

    storeOriginalNotices() {
        if (this.noticesContainer) {
            this.allNotices = Array.from(
                document.querySelectorAll(".notice-card")
            ).map((card) => ({
                element: card,
                id: card.dataset.noticeId,
                type: card.dataset.noticeType,
                title: card.dataset.noticeTitle,
                description: card.dataset.noticeDescription,
            }));
        }
    }

    bindEvents() {
        if (!this.searchInput) return;

        let searchTimeout;
        this.searchInput.addEventListener("input", (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.performSearch(e.target.value);
            }, 300);
        });

        this.filterTags.forEach((tag) => {
            tag.addEventListener("click", (e) => {
                this.setActiveFilter(e.target);
                this.filterNotices(e.target.dataset.filter);
            });
        });
    }

    performSearch(query) {
        const searchLoader = document.getElementById("searchLoader");
        const searchIcon =
            this.searchInput.nextElementSibling.querySelector("svg");

        if (searchLoader && searchIcon) {
            searchLoader.classList.remove("hidden");
            searchIcon.style.display = "none";
        }

        setTimeout(() => {
            const filteredNotices = this.filterNoticesBySearch(query);
            this.displayFilteredNotices(filteredNotices);
            this.updateSearchResults(filteredNotices.length, query);

            if (searchLoader && searchIcon) {
                searchLoader.classList.add("hidden");
                searchIcon.style.display = "block";
            }
        }, 300);
    }

    filterNoticesBySearch(query) {
        if (!query.trim()) {
            return this.allNotices.filter(
                (notice) =>
                    this.currentFilter === "all" ||
                    notice.type === this.currentFilter
            );
        }

        const searchTerm = query.toLowerCase();
        return this.allNotices.filter((notice) => {
            const matchesSearch =
                notice.title.includes(searchTerm) ||
                notice.description.includes(searchTerm);
            const matchesFilter =
                this.currentFilter === "all" ||
                notice.type === this.currentFilter;
            return matchesSearch && matchesFilter;
        });
    }

    displayFilteredNotices(notices) {
        if (!this.noticesContainer) return;

        this.noticesContainer.innerHTML = "";

        if (notices.length === 0) {
            if (this.noResults) {
                this.noResults.classList.remove("hidden");
            }
            return;
        }

        if (this.noResults) {
            this.noResults.classList.add("hidden");
        }

        notices.forEach((notice, index) => {
            const clonedCard = notice.element.cloneNode(true);
            clonedCard.style.animationDelay = `${index * 0.1}s`;
            this.noticesContainer.appendChild(clonedCard);
        });

        // Re-bind notice card events
        this.bindNoticeCardEvents();
    }

    bindNoticeCardEvents() {
        document.querySelectorAll(".notice-card").forEach((card) => {
            card.addEventListener("click", (e) => {
                e.preventDefault();
                const noticeId = card.dataset.noticeId;
                this.openNoticeModal(noticeId);
            });
        });
    }

    openNoticeModal(noticeId) {
        const noticeModal = document.getElementById("noticeModal");
        const modalTitle = document.getElementById("modalTitle");
        const modalDate = document.getElementById("modalDate");
        const modalCategory = document.getElementById("modalCategory");
        const modalContent = document.getElementById("modalContent");
        const modalAuthor = document.getElementById("modalAuthor");
        const modalValidUntil = document.getElementById("modalValidUntil");
        const downloadBtn = document.getElementById("downloadBtn");

        fetch(`/public-notice/${noticeId}`)
            .then((response) => response.json())
            .then((data) => {
                modalTitle.textContent = data.title;
                modalDate.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    ${new Date(data.date_posted).toLocaleDateString("en-US", {
                        year: "numeric",
                        month: "short",
                        day: "numeric",
                    })}
                `;
                modalCategory.textContent =
                    data.notice_type.charAt(0).toUpperCase() +
                    data.notice_type.slice(1);
                modalContent.textContent = data.description;
                modalAuthor.textContent = data.admin
                    ? data.admin.name
                    : "Hall Administration";

                if (data.valid_until) {
                    modalValidUntil.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Valid until: ${new Date(
                            data.valid_until
                        ).toLocaleDateString()}
                    `;
                } else {
                    modalValidUntil.innerHTML = "";
                }

                if (data.attachment) {
                    downloadBtn.style.display = "block";
                    downloadBtn.onclick = () =>
                        window.open(data.attachment, "_blank");
                } else {
                    downloadBtn.style.display = "none";
                }

                noticeModal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            });
    }

    updateSearchResults(count, query) {
        if (query.trim()) {
            if (this.resultsCount) {
                this.resultsCount.textContent = count;
            }
            if (this.searchResults) {
                this.searchResults.classList.remove("hidden");
            }
        } else {
            if (this.searchResults) {
                this.searchResults.classList.add("hidden");
            }
        }
    }

    filterNotices(type) {
        this.currentFilter = type;
        const query = this.searchInput ? this.searchInput.value : "";
        const filteredNotices = this.filterNoticesBySearch(query);
        this.displayFilteredNotices(filteredNotices);
        this.updateSearchResults(filteredNotices.length, query);
    }

    setActiveFilter(activeTag) {
        this.filterTags.forEach((tag) => {
            tag.classList.remove(
                "active",
                "bg-gradient-to-r",
                "from-blue-500",
                "to-blue-600",
                "text-white",
                "border-blue-500"
            );
            tag.classList.add(
                "bg-white/80",
                "border-gray-200",
                "text-gray-700"
            );
        });
        activeTag.classList.add(
            "active",
            "bg-gradient-to-r",
            "from-blue-500",
            "to-blue-600",
            "text-white",
            "border-blue-500"
        );
        activeTag.classList.remove(
            "bg-white/80",
            "border-gray-200",
            "text-gray-700"
        );
    }
}

// Performance optimization for mobile
if (window.innerWidth < 768) {
    // Reduce animation complexity on mobile
    document.documentElement.style.setProperty("--animation-duration", "0.3s");
} else {
    document.documentElement.style.setProperty("--animation-duration", "0.6s");
}

// FAQ Functionality
function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other FAQ items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        });
    });
}

// Contact Form Enhancement
function initContactForm() {
    const form = document.querySelector('.contact-form-container');
    if (!form) return;
    
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Add form submission animation
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
        submitBtn.disabled = true;
        
        // Simulate form submission
        setTimeout(() => {
            submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Message Sent!';
            submitBtn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
            
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.style.background = '';
                form.reset();
            }, 2000);
        }, 1500);
    });
}

// Enhanced Section Animations
function initSectionAnimations() {
    const sections = document.querySelectorAll('.features-section, .how-it-works-section, .faq-section, .contact-section');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Animate child elements with stagger
                const children = entry.target.querySelectorAll('.feature-card, .process-step, .faq-item, .contact-info, .contact-form');
                children.forEach((child, index) => {
                    setTimeout(() => {
                        child.style.opacity = '1';
                        child.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    sections.forEach(section => {
        observer.observe(section);
        
        // Set initial state for child elements
        const children = section.querySelectorAll('.feature-card, .process-step, .faq-item, .contact-info, .contact-form');
        children.forEach(child => {
            child.style.opacity = '0';
            child.style.transform = 'translateY(30px)';
            child.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });
}

// Mobile Menu Management
class MobileMenuManager {
    constructor() {
        this.mobileMenuBtn = document.getElementById('mobileMenuBtn');
        this.mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        this.mobileMenuClose = document.getElementById('mobileMenuClose');
        this.mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        
        this.bindEvents();
    }

    bindEvents() {
        if (this.mobileMenuBtn) {
            this.mobileMenuBtn.addEventListener('click', () => this.openMenu());
        }

        if (this.mobileMenuClose) {
            this.mobileMenuClose.addEventListener('click', () => this.closeMenu());
        }

        if (this.mobileMenuOverlay) {
            this.mobileMenuOverlay.addEventListener('click', (e) => {
                if (e.target === this.mobileMenuOverlay) {
                    this.closeMenu();
                }
            });
        }

        // Close menu when clicking nav links
        this.mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                this.closeMenu();
            });
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isMenuOpen()) {
                this.closeMenu();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && this.isMenuOpen()) {
                this.closeMenu();
            }
        });
    }

    openMenu() {
        if (this.mobileMenuOverlay) {
            this.mobileMenuOverlay.classList.remove('hidden');
            this.mobileMenuOverlay.classList.add('show');
        }
        
        if (this.mobileMenuBtn) {
            this.mobileMenuBtn.classList.add('active');
        }

        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    closeMenu() {
        if (this.mobileMenuOverlay) {
            this.mobileMenuOverlay.classList.remove('show');
            setTimeout(() => {
                this.mobileMenuOverlay.classList.add('hidden');
            }, 300);
        }

        if (this.mobileMenuBtn) {
            this.mobileMenuBtn.classList.remove('active');
        }

        // Restore body scroll
        document.body.style.overflow = 'auto';
    }

    isMenuOpen() {
        return this.mobileMenuOverlay && this.mobileMenuOverlay.classList.contains('show');
    }
}

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    // Initialize all visual enhancements
    animateCounters();
    handleParallax();
    initSmoothScrolling();
    handleScrollAnimations(); // This will make the Quick Access section visible
    enhanceNoticeCards();
    
    // Initialize new enhanced features
    initFAQ();
    initContactForm();
    initSectionAnimations();

    // Initialize homepage notice search and filter functionality
    new HomepageNoticeManager();

    // Initialize mobile menu functionality
    new MobileMenuManager();

    // Initialize Lenis for smooth scrolling
    if (typeof Lenis !== "undefined") {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: "vertical",
            gestureDirection: "vertical",
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }
});

import './bootstrap';

// Mobile menu toggle & body scroll lock
const menuToggles = [...document.querySelectorAll('[data-mobile-menu-toggle]')];
const mobileMenu = document.querySelector('[data-mobile-menu]');
const mobileBackdrop = document.querySelector('#mobile-menu-backdrop');

menuToggles.forEach((menuToggle) => {
    menuToggle.addEventListener('click', () => {
        const isOpen = !mobileMenu?.classList.contains('hidden');

        mobileMenu?.classList.toggle('hidden', isOpen);
        mobileBackdrop?.classList.toggle('hidden', isOpen);
        document.body.style.overflow = isOpen ? '' : 'hidden';

        menuToggles.forEach((toggle) => {
            toggle.setAttribute('aria-expanded', String(!isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Open menu' : 'Close menu');
        });
    });
});

// Dynamic i18n Translation Engine (DE / EN)
window.getCurrentLang = () => localStorage.getItem('mehaaj-language') || 'de';

window.setLanguage = (language) => {
    const selectedLanguage = language === 'en' ? 'en' : 'de';
    const languageKey = `${selectedLanguage[0].toUpperCase()}${selectedLanguage.slice(1)}`;

    document.documentElement.lang = selectedLanguage;

    // Query dynamically so all subpage elements translate
    const translatedElements = document.querySelectorAll('[data-i18n-de][data-i18n-en]');
    translatedElements.forEach((element) => {
        const text = element.dataset[`i18n${languageKey}`];
        if (text !== undefined) {
            element.innerHTML = text;
        }
    });

    const translatedPlaceholders = document.querySelectorAll('[data-i18n-placeholder-de][data-i18n-placeholder-en]');
    translatedPlaceholders.forEach((element) => {
        const placeholder = element.dataset[`i18nPlaceholder${languageKey}`];
        if (placeholder !== undefined) {
            element.placeholder = placeholder;
        }
    });

    const languageButtons = document.querySelectorAll('[data-language-option]');
    languageButtons.forEach((button) => {
        const isActive = button.dataset.languageOption === selectedLanguage;
        button.classList.toggle('bg-[#d8b45a]', isActive);
        button.classList.toggle('text-[#120807]', isActive);
        button.classList.toggle('text-[#d8b45a]', !isActive);
    });

    localStorage.setItem('mehaaj-language', selectedLanguage);
    window.dispatchEvent(new CustomEvent('languageChanged', { detail: { lang: selectedLanguage } }));
};

document.addEventListener('click', (e) => {
    const button = e.target.closest('[data-language-option]');
    if (button) {
        window.setLanguage(button.dataset.languageOption);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    window.setLanguage(window.getCurrentLang());
});

// Hero Slider
const slider = document.querySelector('[data-hero-slider]');

if (slider) {
    const slides = [...slider.querySelectorAll('[data-hero-slide]')];
    const previous = slider.querySelector('[data-hero-prev]');
    const next = slider.querySelector('[data-hero-next]');
    let activeIndex = 0;
    let timer;

    const showSlide = (index) => {
        activeIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === activeIndex;
            slide.classList.toggle('opacity-100', isActive);
            slide.classList.toggle('opacity-0', !isActive);
            slide.classList.toggle('pointer-events-none', !isActive);
            slide.setAttribute('aria-hidden', String(!isActive));
        });
    };

    const startTimer = () => {
        clearInterval(timer);
        timer = setInterval(() => showSlide(activeIndex + 1), 5200);
    };

    previous?.addEventListener('click', () => {
        showSlide(activeIndex - 1);
        startTimer();
    });

    next?.addEventListener('click', () => {
        showSlide(activeIndex + 1);
        startTimer();
    });

    startTimer();
}

// Scrolled Navbar & Route-Aware Backdrop
const siteHeader = document.querySelector('[data-site-header]');

if (siteHeader) {
    const pathname = window.location.pathname.replace(/\/$/, '');
    const isHomePage = pathname === '' || pathname === '/home' || pathname.endsWith('index.php');

    const handleScroll = () => {
        if (!isHomePage || window.scrollY > 15) {
            siteHeader.classList.add('bg-[#0d0605]/95', 'backdrop-blur-md', 'border-b', 'border-[#d8b45a]/30', 'shadow-[0_10px_35px_rgba(0,0,0,0.6)]');
            siteHeader.classList.remove('bg-transparent');
        } else {
            siteHeader.classList.remove('bg-[#0d0605]/95', 'backdrop-blur-md', 'border-b', 'border-[#d8b45a]/30', 'shadow-[0_10px_35px_rgba(0,0,0,0.6)]');
            siteHeader.classList.add('bg-transparent');
        }
    };

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
}

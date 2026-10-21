@php
    $categoriesList = (isset($globalCategories) && $globalCategories->count() > 0)
        ? $globalCategories 
        : \App\Models\Category::where('status', 'active')->with('activeSubcategories')->orderBy('order_index', 'asc')->orderBy('name', 'asc')->get();
    $hasSlider = $categoriesList->count() > 0;

    $catTranslations = [
        'luxury-handbags' => ['en' => 'Luxury Handbags', 'de' => 'Luxus-Handtaschen'],
        'leather-wallets' => ['en' => 'Leather Wallets', 'de' => 'Leder-Geldbörsen'],
        'travel-luggage' => ['en' => 'Travel & Luggage', 'de' => 'Reisegepäck & Weekender'],
        'executive-briefcases' => ['en' => 'Executive Briefcases', 'de' => 'Business-Aktentaschen'],
        'luxury-jewelry-watches' => ['en' => 'Luxury Jewelry & Watches', 'de' => 'Luxus Schmuck & Uhren'],
        'golf-collection' => ['en' => 'Golf Collection', 'de' => 'Golf-Kollektion'],
        'signature-keychains' => ['en' => 'Signature Keychains', 'de' => 'Signatur-Schlüsselanhänger'],
        'handbags' => ['en' => 'Luxury Handbags', 'de' => 'Luxus-Handtaschen'],
        'briefcases' => ['en' => 'Executive Briefcases', 'de' => 'Business-Aktentaschen'],
        'watches-jewelry' => ['en' => 'Luxury Jewelry & Watches', 'de' => 'Luxus Schmuck & Uhren'],
    ];
@endphp

@if($categoriesList->count() > 0)
<style>
    .cat-slide-item {
        flex: 0 0 100% !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    @media (min-width: 640px) {
        .cat-slide-item {
            flex: 0 0 calc(50% - 10px) !important;
            width: calc(50% - 10px) !important;
            max-width: calc(50% - 10px) !important;
        }
    }
    @media (min-width: 1024px) {
        .cat-slide-item {
            flex: 0 0 calc(25% - 12px) !important;
            width: calc(25% - 12px) !important;
            max-width: calc(25% - 12px) !important;
        }
    }

    /* Silky Satisfying Card Hover Animation Engine */
    .cat-card-elevate {
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.45s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease !important;
        will-change: transform, box-shadow;
    }
    .cat-card-elevate:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 22px 48px rgba(120, 0, 11, 0.18), 0 8px 25px rgba(216, 180, 90, 0.28) !important;
        border-color: #d8b45a !important;
    }
    .cat-card-elevate:hover .cat-top-shimmer {
        transform: scaleX(1) !important;
    }
    .cat-card-elevate:hover .cat-bg-img {
        transform: scale(1.09) !important;
    }
    .cat-card-elevate:hover .cat-circle-btn {
        background-color: #d8b45a !important;
        color: #120807 !important;
        transform: scale(1.12) !important;
    }
    .cat-card-elevate:hover .cat-circle-icon {
        transform: rotate(45deg) !important;
    }
    .cat-card-elevate:hover .cat-accent-bar {
        width: 3.5rem !important;
        background-color: #ffd45a !important;
    }
    .cat-card-elevate:hover .cat-title {
        color: #ffd45a !important;
    }
    .cat-card-elevate:hover .cat-discover-text {
        color: #ffffff !important;
    }
    .cat-card-elevate:hover .cat-discover-arrow {
        transform: translateX(6px) !important;
    }
</style>

<!-- Compact, Ultra-Wide & Immersive Luxury Category Showcase -->
<section class="relative overflow-hidden bg-gradient-to-b from-[#f4efe6] via-[#f8f5ee] to-[#f3ece2] py-4 sm:py-6 lg:py-7 border-y border-[#dfd6c4] text-[#1c1210]" aria-labelledby="featured-categories-heading">
    <!-- Ambient Subtle Warm Light Accents -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_60%_at_50%_0%,rgba(216,180,90,0.14),transparent_75%)]"></div>

    <!-- Wide Container to Eliminate Excess Side Margins -->
    <div class="w-full max-w-[1800px] mx-auto px-3 sm:px-5 lg:px-7 relative z-10">
        <!-- Compact Section Header with Integrated Navigation Controls -->
        <div class="flex flex-row items-center justify-between gap-3 border-b border-[#dfd6c4] pb-2 sm:pb-2.5 reveal-on-scroll">
            <h2 id="featured-categories-heading" class="font-display text-xl sm:text-2xl lg:text-3xl font-medium leading-none text-[#1c1210] tracking-tight" data-i18n-en="Explore By Category" data-i18n-de="Nach Kategorie entdecken">
                Explore By Category
            </h2>

            @if($hasSlider)
                <!-- Navigation Arrows Flanking Header -->
                <div class="flex items-center gap-1.5 sm:gap-2">
                    <button 
                        type="button" 
                        id="cat-slider-prev"
                        onclick="scrollCatSlider(-1)" 
                        class="flex h-8 w-8 sm:h-9 sm:w-9 shrink-0 items-center justify-center rounded-full border border-[#d8b45a]/60 bg-white text-[#78000b] shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:border-[#78000b] cursor-pointer"
                        aria-label="Previous Categories"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button 
                        type="button" 
                        id="cat-slider-next"
                        onclick="scrollCatSlider(1)" 
                        class="flex h-8 w-8 sm:h-9 sm:w-9 shrink-0 items-center justify-center rounded-full border border-[#d8b45a]/60 bg-white text-[#78000b] shadow-xs transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:border-[#78000b] cursor-pointer"
                        aria-label="Next Categories"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Slider Track Container: Minimal Vertical Padding for Maximum Content Height -->
        <div class="relative mt-2.5 sm:mt-3 reveal-on-scroll reveal-delay-100">
            <div id="cat-slider-track" class="overflow-hidden py-1.5 -my-1.5 px-0.5 -mx-0.5 cursor-grab active:cursor-grabbing">
                <div id="cat-slider-inner" class="flex transition-transform duration-400 ease-out gap-3 sm:gap-4 py-1">
                    @foreach ($categoriesList as $index => $cat)
                        @php
                            $catName = $cat->name;
                            $catImg = $cat->image_url;
                            $catSlug = $cat->slug;
                            $catUrl = route('shop', ['category' => $catSlug]);
                            $cEn = $catTranslations[$catSlug]['en'] ?? $catName;
                            $cDe = $catTranslations[$catSlug]['de'] ?? $catName;
                        @endphp
                        <div class="cat-slide-item shrink-0">
                            <div
                                class="cat-card-elevate group relative flex min-h-[250px] sm:min-h-[275px] lg:min-h-[295px] flex-col justify-between overflow-hidden rounded-xl border border-[#d9cebc] bg-[#1a120f] shadow-[0_5px_18px_rgba(28,18,16,0.12)] outline-none focus:outline-none focus:ring-0 cursor-pointer h-full select-none transition-all duration-300"
                            >
                                <!-- Native Stretched Link: Click anywhere opens this specific category -->
                                <a
                                    href="{{ $catUrl }}"
                                    class="absolute inset-0 z-10 block"
                                    aria-label="{{ $cEn }}"
                                    data-i18n-aria-en="{{ $cEn }}"
                                    data-i18n-aria-de="{{ $cDe }}"
                                >
                                    <span class="sr-only" data-i18n-en="{{ $cEn }}" data-i18n-de="{{ $cDe }}">{{ $cEn }}</span>
                                </a>

                                <!-- Top Shimmer Gold Accent Line on Hover -->
                                <div class="cat-top-shimmer pointer-events-none absolute inset-x-0 top-0 z-30 h-1 origin-left scale-x-0 bg-gradient-to-r from-[#78000b] via-[#ffd45a] to-[#78000b] transition-transform duration-500 group-hover:scale-x-100"></div>

                                @if($catImg)
                                    <!-- Background Image with Zoom -->
                                    <img
                                        src="{{ $catImg }}"
                                        alt="{{ $cEn }}"
                                        class="cat-bg-img pointer-events-none absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-109"
                                        loading="lazy"
                                    >
                                @endif

                                <!-- Rich Gradient Overlays for High Contrast & Text Legibility -->
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#0e0705]/95 via-[#0e0705]/40 to-transparent"></div>
                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-b from-[#0e0705]/30 via-transparent to-transparent"></div>

                                <!-- Top Navigation Button -->
                                <div class="pointer-events-none relative z-20 p-2.5 sm:p-3 flex items-center justify-end">
                                    <div class="cat-circle-btn h-7 w-7 sm:h-8 sm:w-8 shrink-0 rounded-full bg-white/90 border border-white/60 backdrop-blur-md flex items-center justify-center text-[#78000b] transition-all duration-300 group-hover:bg-[#d8b45a] group-hover:text-[#120807] group-hover:scale-110 shadow-md">
                                        <svg class="cat-circle-icon h-3.5 w-3.5 transition-transform duration-300 group-hover:rotate-45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>

                                <!-- Bottom Content (Clean - Subcategories/Products Removed as requested) -->
                                <div class="pointer-events-none relative z-20 p-3.5 sm:p-4">
                                    <div class="cat-accent-bar mb-1.5 h-[2px] w-7 bg-[#d8b45a] transition-all duration-400 group-hover:w-12 group-hover:bg-[#ffd45a]"></div>
                                    <h3 class="cat-title font-display text-xl sm:text-2xl font-medium text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.85)] transition-colors duration-300 group-hover:text-[#ffd45a] leading-tight" data-i18n-en="{{ $cEn }}" data-i18n-de="{{ $cDe }}">
                                        {{ $cEn }}
                                    </h3>

                                    <div class="mt-2 flex items-center text-[0.62rem] sm:text-[0.65rem] font-bold uppercase tracking-luxury text-[#ffd45a] transition-all duration-300 group-hover:text-white">
                                        <span class="cat-discover-text" data-i18n-en="DISCOVER COLLECTION" data-i18n-de="KOLLEKTION ENTDECKEN">DISCOVER COLLECTION</span>
                                        <svg class="cat-discover-arrow ml-1.5 h-3 w-3 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                            <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($hasSlider)
            <script>
                (function() {
                    let currentCatIndex = 0;
                    const totalCats = {{ $categoriesList->count() }};
                    let autoSlideInterval = null;

                    function getVisibleCount() {
                        if (window.innerWidth >= 1024) return 4;
                        if (window.innerWidth >= 640) return 2;
                        return 1;
                    }

                    window.scrollCatSlider = function(direction) {
                        const visible = getVisibleCount();
                        const maxIndex = totalCats - visible;
                        if (maxIndex <= 0) return;

                        currentCatIndex += direction;
                        if (currentCatIndex < 0) currentCatIndex = maxIndex;
                        if (currentCatIndex > maxIndex) currentCatIndex = 0;

                        const track = document.getElementById('cat-slider-inner');
                        if (!track) return;

                        const item = track.children[0];
                        if (!item) return;
                        const stepWidth = item.getBoundingClientRect().width + 16;

                        track.style.transform = `translateX(-${currentCatIndex * stepWidth}px)`;
                    };

                    // Auto-Slide Engine (Slides faster every 1.5s, pauses on user hover)
                    function startAutoSlide() {
                        stopAutoSlide();
                        autoSlideInterval = setInterval(function() {
                            window.scrollCatSlider(1);
                        }, 1500);
                    }

                    function stopAutoSlide() {
                        if (autoSlideInterval) {
                            clearInterval(autoSlideInterval);
                            autoSlideInterval = null;
                        }
                    }

                    const trackContainer = document.getElementById('cat-slider-track');
                    if (trackContainer) {
                        trackContainer.addEventListener('mouseenter', stopAutoSlide);
                        trackContainer.addEventListener('mouseleave', startAutoSlide);

                        // Touch Swipe Support with Auto-Slide Pause/Resume
                        let touchStartX = 0;
                        let touchEndX = 0;
                        trackContainer.addEventListener('touchstart', (e) => {
                            stopAutoSlide();
                            touchStartX = e.changedTouches[0].screenX;
                        }, { passive: true });

                        trackContainer.addEventListener('touchend', (e) => {
                            touchEndX = e.changedTouches[0].screenX;
                            if (touchStartX - touchEndX > 45) {
                                window.scrollCatSlider(1);
                            } else if (touchEndX - touchStartX > 45) {
                                window.scrollCatSlider(-1);
                            }
                            startAutoSlide();
                        }, { passive: true });
                    }

                    // Start Auto-Slide on initial load
                    startAutoSlide();

                    window.addEventListener('resize', () => {
                        const track = document.getElementById('cat-slider-inner');
                        if (track) track.style.transform = 'translateX(0px)';
                        currentCatIndex = 0;
                    });
                })();
            </script>
        @endif
    </div>
</section>
@endif

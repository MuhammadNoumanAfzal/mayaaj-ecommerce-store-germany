@php
    $categoriesList = isset($globalCategories) && $globalCategories->count() > 0 ? $globalCategories : collect([]);
    $hasSlider = $categoriesList->count() > 4;
@endphp

<style>
    .cat-slide-item {
        flex: 0 0 100% !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    @media (min-width: 640px) {
        .cat-slide-item {
            flex: 0 0 calc(50% - 8px) !important;
            width: calc(50% - 8px) !important;
            max-width: calc(50% - 8px) !important;
        }
    }
    @media (min-width: 1024px) {
        .cat-slide-item {
            flex: 0 0 calc(25% - 12px) !important;
            width: calc(25% - 12px) !important;
            max-width: calc(25% - 12px) !important;
        }
    }
</style>

<section class="relative overflow-hidden bg-[#faf7f2] py-8 border-y border-[#e6decb] text-[#241a17] sm:py-10 lg:py-12" aria-labelledby="featured-categories-heading">
    <!-- Ambient Subtle Warm Light Accents -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(216,180,90,0.12),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        <!-- Compact Light Section Header -->
        <div class="flex flex-col gap-3 border-b border-[#e5dec9] pb-4 sm:flex-row sm:items-end sm:justify-between reveal-on-scroll">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-0.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-en="COLLECTION ENTRY" data-i18n-de="KOLLEKTION EINSTIEG">COLLECTION ENTRY</span>
                </div>
                <h2 id="featured-categories-heading" class="mt-2 font-display text-2xl font-medium leading-tight text-[#1c1210] sm:text-3xl lg:text-4xl" data-i18n-en="Discover Mehaaj" data-i18n-de="Entdecken Sie Mehaaj">
                    Discover Mehaaj
                </h2>
            </div>
            <p class="max-w-md text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-en="Curated categories for a quick entry into our premium selection." data-i18n-de="Kuratierte Kategorien für einen schnellen Einstieg in unsere Premium-Auswahl.">
                Curated categories for a quick entry into our premium selection.
            </p>
        </div>

        @if($categoriesList->count() > 0)
            <!-- Carousel Wrapper with Flanking Left & Right Nav Buttons -->
            <div class="relative mt-6 flex items-center gap-2 sm:gap-3 reveal-on-scroll reveal-delay-200">
                
                @if($hasSlider)
                    <!-- Left Arrow Button (Left side of start of category slider) -->
                    <button 
                        type="button" 
                        id="cat-slider-prev"
                        onclick="scrollCatSlider(-1)" 
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#d8b45a]/60 bg-white/95 text-[#78000b] shadow-md transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:border-[#78000b] cursor-pointer"
                        aria-label="Previous Categories"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                @endif

                <!-- Slider Container showing exactly 4 cards at a time on lg screens -->
                <div id="cat-slider-track" class="flex-1 overflow-hidden">
                    <div id="cat-slider-inner" class="flex transition-transform duration-500 ease-out gap-4">
                        @foreach ($categoriesList as $index => $cat)
                            @php
                                $catName = $cat->name;
                                $catDesc = $cat->description ?? '';
                                $catImg = $cat->image_url;
                                $catSlug = $cat->slug;
                            @endphp
                            <div class="cat-slide-item shrink-0">
                                <a href="/shop?category={{ $catSlug }}" class="animate-shine-sweep group relative flex min-h-[220px] sm:min-h-[240px] lg:min-h-[250px] flex-col justify-between overflow-hidden rounded-md border border-[#e5dec9] bg-white shadow-[0_4px_20px_rgba(0,0,0,0.05)] transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] outline-none focus:outline-none focus:ring-0 cursor-pointer h-full" aria-label="{{ $catName }} entdecken">
                                    
                                    <!-- Background Image with Zoom -->
                                    <img
                                        src="{{ $catImg }}"
                                        alt="{{ $catName }} Kollektion"
                                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-108"
                                        loading="lazy"
                                    >

                                    <!-- Gradient Overlays for Light Theme Readability -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#140b0a]/90 via-[#140b0a]/40 to-transparent"></div>
                                    <div class="absolute inset-0 bg-gradient-to-b from-[#140b0a]/50 via-transparent to-transparent"></div>

                                    <!-- Top Navigation Button -->
                                    <div class="relative z-10 p-3.5 sm:p-4 flex items-center justify-end">
                                        <div class="h-6 w-6 shrink-0 rounded-full bg-white/85 border border-white/50 backdrop-blur-md flex items-center justify-center text-[#78000b] transition duration-300 group-hover:bg-[#d8b45a] group-hover:text-[#120807]">
                                            <svg class="h-3 w-3 transition-transform duration-300 group-hover:rotate-45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                                <path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Bottom Content -->
                                    <div class="relative z-10 p-4 sm:p-5">
                                        <div class="mb-1.5 h-[2px] w-6 bg-[#d8b45a] transition-all duration-300 group-hover:w-12 group-hover:bg-[#f2cf75]"></div>
                                        <h3 class="font-display text-xl sm:text-2xl font-medium text-white drop-shadow-sm transition-colors duration-300 group-hover:text-[#f2cf75]">
                                            {{ $catName }}
                                        </h3>
                                        <div class="mt-3 flex items-center text-[0.62rem] font-bold uppercase tracking-luxury text-[#f2cf75] transition-colors duration-300 group-hover:text-white">
                                            <span data-i18n-en="DISCOVER" data-i18n-de="ENTDECKEN">DISCOVER</span>
                                            <svg class="ml-1.5 h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($hasSlider)
                    <!-- Right Arrow Button (Right side of end of category slider) -->
                    <button 
                        type="button" 
                        id="cat-slider-next"
                        onclick="scrollCatSlider(1)" 
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#d8b45a]/60 bg-white/95 text-[#78000b] shadow-md transition-all duration-300 hover:bg-[#78000b] hover:text-white hover:border-[#78000b] cursor-pointer"
                        aria-label="Next Categories"
                    >
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif

            </div>

            @if($hasSlider)
                <script>
                    (function() {
                        let currentCatIndex = 0;
                        const totalCats = {{ $categoriesList->count() }};
                        
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

                        window.addEventListener('resize', () => {
                            const track = document.getElementById('cat-slider-inner');
                            if (track) track.style.transform = 'translateX(0px)';
                            currentCatIndex = 0;
                        });
                    })();
                </script>
            @endif

        @else
            <div class="mt-6 p-8 text-center bg-white rounded-md border border-[#e5dec9]">
                <p class="text-sm font-medium text-[#685c54]" data-i18n-de="Aktuell sind keine Kategorien im Katalog vorhanden." data-i18n-en="No categories currently available in the catalog.">Aktuell sind keine Kategorien im Katalog vorhanden.</p>
            </div>
        @endif
    </div>
</section>

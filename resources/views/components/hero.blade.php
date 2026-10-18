@php
    $slides = [
        [
            'eyebrow_de' => 'Haute Maroquinerie • Mehaaj Atelier',
            'eyebrow_en' => 'Haute Leather Craft • Mehaaj Atelier',
            'title_de' => 'Luxus in Ihrer Tasche.',
            'title_en' => 'Luxury in your pocket.',
            'text_de' => 'Handgefertigte Leder-Geldbörsen und exquisite Taschenaccessoires, von Meisterhand aus feinstem italienischem Vollrindleder erschaffen.',
            'text_en' => 'Handcrafted Italian leather wallets and bespoke pocket accessories, sculpted by master artisans from full-grain leather for timeless sophistication.',
            'image' => '/hero_slide1.jpg',
            'alt' => 'MEHAAJ - Luxury in your pocket handcrafted leather wallet',
            'position' => 'center 12%',
            'cta_url' => '/shop?category=luxury-wallets',
            'cta_en' => 'Explore Wallets',
            'cta_de' => 'Geldbörsen entdecken',
        ],
        [
            'eyebrow_de' => 'Meisterkollektion 2026',
            'eyebrow_en' => 'Signature Collection 2026',
            'title_de' => 'Zeitlose Eleganz & Haute Handtaschen.',
            'title_en' => 'Timeless Elegance & Haute Handbags.',
            'text_de' => 'Entdecken Sie unsere ikonischen Meister-Lederhandtaschen – skulpturale Silhouetten, feinstes Kalbsleder und opulente Goldakzente.',
            'text_en' => 'Iconic artisan leather handbags, merging architectural silhouettes, 24k-gold hardware, and supple hand-selected Italian calfskin.',
            'image' => '/hero_slide2.jpg',
            'alt' => 'MEHAAJ - Designer Leather Handbags & Haute Maroquinerie',
            'position' => 'center 10%',
            'cta_url' => '/shop?category=luxury-handbags',
            'cta_en' => 'Discover Handbags',
            'cta_de' => 'Handtaschen entdecken',
        ],
        [
            'eyebrow_de' => 'Maßgefertigtes Reisegepäck • Mehaaj Atelier',
            'eyebrow_en' => 'Bespoke Travel & Accessories',
            'title_de' => 'Meisterhaftes Leder für jede Reise.',
            'title_en' => 'Artisan Leather For Every Journey.',
            'text_de' => 'Von handgenähten Leder-Weekendern bis zu eleganten Totes und Schlüsselanhängern – unvergleichliche Handwerkskunst für Generationen.',
            'text_en' => 'From hand-stitched leather weekenders to structured totes and signature keychains, elevate every moment with effortless luxury.',
            'image' => '/hero_slide3.jpg',
            'alt' => 'MEHAAJ - Bespoke Leather Travel Bags and Luxury Accessories',
            'position' => 'center 8%',
            'cta_url' => '/shop',
            'cta_en' => 'Shop Collection',
            'cta_de' => 'Kollektion ansehen',
        ],
    ];
@endphp

<!-- Hero Section: Expansive Luxury Height with Ambient Frosted Header Integration -->
<section class="-mt-16 lg:-mt-[4.75rem] pt-16 lg:pt-[4.75rem] relative w-full overflow-hidden bg-[#0c0a09] text-ivory min-h-[520px] sm:min-h-[580px] md:min-h-[640px] lg:h-[75vh] xl:h-[82vh] lg:min-h-[680px] xl:min-h-[740px] 2xl:min-h-[820px] max-h-[920px]" data-hero-slider>
    @foreach ($slides as $index => $slide)
        <article
            class="{{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }} absolute inset-0 h-full w-full transition-opacity duration-1000 ease-out"
            data-hero-slide
            aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
        >
            <img
                src="{{ asset(ltrim($slide['image'], '/')) }}"
                alt="{{ $slide['alt'] }}"
                class="hero-slide-img absolute inset-0 h-full w-full object-cover transition-transform duration-[7000ms] ease-out scale-100"
                style="object-position: {{ $slide['position'] }};"
                {{ $index === 0 ? 'fetchpriority=high' : 'loading=lazy' }}
            >
            
            <!-- Refined Luxury Gradient Overlays: Subtle left vignette for crisp text, crystal clear over model and atelier -->
            <div class="absolute inset-0 pointer-events-none z-10" style="background: linear-gradient(90deg, rgba(8, 6, 5, 0.72) 0%, rgba(8, 6, 5, 0.46) 35%, rgba(8, 6, 5, 0.12) 65%, transparent 85%) !important;"></div>
            <div class="absolute inset-0 pointer-events-none z-10" style="background: linear-gradient(180deg, rgba(8, 6, 5, 0.35) 0%, transparent 20%, transparent 75%, rgba(8, 6, 5, 0.45) 100%) !important;"></div>

            <div class="luxury-container relative z-20 flex h-full w-full items-center py-8 sm:py-10 lg:py-12 min-h-full">
                <div class="max-w-xl lg:max-w-2xl">
                    <p class="hero-anim hero-anim-eyebrow mb-2 sm:mb-2.5 text-[0.62rem] sm:text-[0.68rem] font-bold uppercase tracking-[0.22em]" style="color: #ffd45a !important; text-shadow: 0 2px 8px rgba(0,0,0,0.9);" data-i18n-de="{{ $slide['eyebrow_de'] }}" data-i18n-en="{{ $slide['eyebrow_en'] }}">{{ $slide['eyebrow_en'] }}</p>
                    <h1 class="hero-anim hero-anim-title font-display text-3xl sm:text-5xl lg:text-6xl font-normal leading-[1.04] text-white" style="color: #ffffff !important; text-shadow: 0 4px 18px rgba(0,0,0,0.95), 0 2px 4px rgba(0,0,0,0.9);" data-i18n-de="{{ $slide['title_de'] }}" data-i18n-en="{{ $slide['title_en'] }}">
                        {{ $slide['title_en'] }}
                    </h1>
                    <p class="hero-anim hero-anim-desc mt-3 sm:mt-3.5 max-w-lg text-xs sm:text-sm lg:text-[0.95rem] font-normal leading-relaxed text-[#f4efe8]" style="color: #f5f0ea !important; text-shadow: 0 2px 10px rgba(0,0,0,0.95);" data-i18n-de="{{ $slide['text_de'] }}" data-i18n-en="{{ $slide['text_en'] }}">
                        {{ $slide['text_en'] }}
                    </p>
                    <div class="hero-anim hero-anim-cta mt-5 sm:mt-6 flex flex-row flex-wrap gap-3 items-center">
                        <a href="{{ $slide['cta_url'] }}" class="button-primary cursor-pointer shadow-[0_12px_28px_rgba(120,0,11,0.5)] px-5 py-2.5 text-xs sm:text-sm text-center" data-i18n-de="{{ $slide['cta_de'] }}" data-i18n-en="{{ $slide['cta_en'] }}">{{ $slide['cta_en'] }}</a>
                        <a href="/ueber-uns" class="button-secondary cursor-pointer border-white/70 bg-[#0c0a09]/50 text-white backdrop-blur-sm hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#0c0a09] transition-all px-5 py-2.5 text-xs sm:text-sm text-center" data-i18n-de="Manufaktur ansehen" data-i18n-en="View Atelier">View Atelier</a>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    <!-- Bottom Slider Navigation & Slide Indicators -->
    <div class="luxury-container pointer-events-none absolute inset-x-0 bottom-4 sm:bottom-6 z-20 flex items-center justify-between">
        <!-- Interactive Slide Indicator Pills -->
        <div class="pointer-events-auto flex items-center gap-2">
            @foreach($slides as $i => $s)
                <button
                    type="button"
                    class="hero-dot h-1.5 transition-all duration-500 rounded-full cursor-pointer {{ $i === 0 ? 'w-8 bg-[#d8b45a] shadow-[0_0_10px_rgba(216,180,90,0.6)]' : 'w-2.5 bg-white/40 hover:bg-white/80' }}"
                    data-hero-dot="{{ $i }}"
                    aria-label="Go to slide {{ $i + 1 }}"
                ></button>
            @endforeach
        </div>

        <!-- Previous / Next Controls -->
        <div class="pointer-events-auto hidden items-center gap-2 sm:flex">
            <button class="inline-flex h-9 w-9 cursor-pointer items-center justify-center border border-white/30 bg-[#0c0a09]/70 text-white backdrop-blur-md transition-all duration-300 hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#0c0a09] rounded-full shadow-lg" type="button" data-hero-prev aria-label="Previous slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M15 5 8 12l7 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="inline-flex h-9 w-9 cursor-pointer items-center justify-center border border-white/30 bg-[#0c0a09]/70 text-white backdrop-blur-md transition-all duration-300 hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#0c0a09] rounded-full shadow-lg" type="button" data-hero-next aria-label="Next slide">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="m9 5 7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</section>





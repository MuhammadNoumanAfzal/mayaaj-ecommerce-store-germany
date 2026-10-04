@php
    $slides = [
        [
            'eyebrow_de' => 'Haute Maroquinerie 2026',
            'eyebrow_en' => 'Haute Leather Craft 2026',
            'title_de' => 'Zeitlose Eleganz & Meisterhandwerk.',
            'title_en' => 'Timeless Luxury & Master Craft.',
            'text_de' => 'Handgefertigte Lederkreationen, feinstes italienisches Handwerk und unvergleichlicher Stil für anspruchsvolle Momente.',
            'text_en' => 'Handcrafted leather creations, exquisite Italian craftsmanship, and timeless style curated for refined living.',
            'image' => '/hero_luxury.png',
            'alt' => 'MEHAAJ Haute Leather Craftsmanship & Atelier Bags',
            'position' => 'center center',
        ],
        [
            'eyebrow_de' => 'Neue Saison 2026',
            'eyebrow_en' => 'New Season 2026',
            'title_de' => 'Eleganz fuer jeden Tag.',
            'title_en' => 'Elegance for every day.',
            'text_de' => 'Ausgewaehlte Mode, Accessoires und Lifestyle-Favoriten fuer einen modernen deutschen Store.',
            'text_en' => 'Selected fashion, accessories, and lifestyle favorites for a modern German store.',
            'image' => '/hero1.png',
            'alt' => 'Elegante Modeauswahl in einer Boutique',
            'position' => 'center 18%',
        ],
        [
            'eyebrow_de' => 'Premium Auswahl',
            'eyebrow_en' => 'Premium Selection',
            'title_de' => 'Luxus, der tragbar bleibt.',
            'title_en' => 'Luxury made wearable.',
            'text_de' => 'Warme Goldakzente, tiefes Rot und klare Produktpraesentation fuer ein hochwertiges Einkaufserlebnis.',
            'text_en' => 'Warm gold accents, deep red, and refined presentation for a premium shopping experience.',
            'image' => '/hero2.png',
            'alt' => 'Fashion Editorial mit hochwertiger Kleidung',
            'position' => 'center 15%',
        ],
    ];
@endphp

<!-- Hero Section: Positioned cleanly below the navbar with distinct separation -->
<section class="relative w-full overflow-hidden bg-[#180f0d] text-ivory min-h-[calc(100vh-80px)] sm:min-h-[82vh] lg:min-h-[86vh]" data-hero-slider>
    <!-- Crisp Gold Top Separation Line -->
    <div class="absolute inset-x-0 top-0 z-30 h-[1px] bg-gradient-to-r from-transparent via-[#d8b45a]/60 to-transparent"></div>

    @foreach ($slides as $index => $slide)
        <article
            class="{{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }} absolute inset-0 h-full w-full transition-opacity duration-1000 ease-out"
            data-hero-slide
            aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
        >
            <img
                src="{{ $slide['image'] }}"
                alt="{{ $slide['alt'] }}"
                class="hero-slide-img absolute inset-0 h-full w-full object-cover transition-transform duration-[7000ms] ease-out scale-100"
                style="object-position: {{ $slide['position'] }};"
                {{ $index === 0 ? 'fetchpriority=high' : 'loading=lazy' }}
            >
            <!-- Soft atelier atmosphere overlay: readable typography while keeping ambient atelier light -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#140b09]/85 via-[#140b09]/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#140b09]/65 via-transparent to-transparent"></div>

            <div class="luxury-container relative flex h-full w-full items-center py-16 sm:py-20 lg:py-24 min-h-[calc(100vh-80px)]">
                <div class="max-w-3xl">
                    <p class="hero-anim hero-anim-eyebrow mb-4 text-[0.68rem] font-bold uppercase tracking-luxury text-[#f2cf75]" data-i18n-de="{{ $slide['eyebrow_de'] }}" data-i18n-en="{{ $slide['eyebrow_en'] }}">{{ $slide['eyebrow_en'] }}</p>
                    <h1 class="hero-anim hero-anim-title font-display text-4xl sm:text-6xl lg:text-7xl xl:text-8xl font-medium leading-[0.95] text-white drop-shadow-[0_8px_18px_rgba(0,0,0,0.85)]" data-i18n-de="{{ $slide['title_de'] }}" data-i18n-en="{{ $slide['title_en'] }}">
                        {{ $slide['title_en'] }}
                    </h1>
                    <p class="hero-anim hero-anim-desc mt-5 max-w-2xl text-sm sm:text-base lg:text-lg font-bold leading-relaxed text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)]" data-i18n-de="{{ $slide['text_de'] }}" data-i18n-en="{{ $slide['text_en'] }}">
                        {{ $slide['text_en'] }}
                    </p>
                    <div class="hero-anim hero-anim-cta mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="/shop" class="button-primary cursor-pointer shadow-[0_16px_36px_rgba(120,0,11,0.36)]" data-i18n-de="Jetzt einkaufen" data-i18n-en="Shop now">Shop now</a>
                        <a href="/ueber-uns" class="button-secondary cursor-pointer border-white/80 bg-[#120605]/28 text-white hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#120807]" data-i18n-de="Manufaktur ansehen" data-i18n-en="View Atelier">View Atelier</a>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    <!-- Bottom Slider Navigation Arrows -->
    <div class="luxury-container pointer-events-none absolute inset-x-0 bottom-6 sm:bottom-8 z-20 flex justify-end">
        <div class="pointer-events-auto hidden items-center gap-2 sm:flex">
            <button class="inline-flex h-11 w-11 cursor-pointer items-center justify-center border border-[#fbf4e8]/70 bg-[#120605]/42 text-[#fbf4e8] transition hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#120807]" type="button" data-hero-prev aria-label="Previous slide">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M15 5 8 12l7 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="inline-flex h-11 w-11 cursor-pointer items-center justify-center border border-[#fbf4e8]/70 bg-[#120605]/42 text-[#fbf4e8] transition hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#120807]" type="button" data-hero-next aria-label="Next slide">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="m9 5 7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
</section>




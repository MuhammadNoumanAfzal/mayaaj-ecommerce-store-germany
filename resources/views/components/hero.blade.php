@php
    $slides = [
        [
            'eyebrow_de' => 'Neue Saison 2026',
            'eyebrow_en' => 'New Season 2026',
            'title_de' => 'Eleganz fuer jeden Tag.',
            'title_en' => 'Elegance for every day.',
            'text_de' => 'Ausgewaehlte Mode, Accessoires und Lifestyle-Favoriten fuer einen modernen deutschen Store.',
            'text_en' => 'Selected fashion, accessories, and lifestyle favorites for a modern German store.',
            'image' => '/hero1.png',
            'alt' => 'Elegante Modeauswahl in einer Boutique',
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
        ],
        [
            'eyebrow_de' => 'Mehaaj Essentials',
            'eyebrow_en' => 'Mehaaj Essentials',
            'title_de' => 'Stilvoll einkaufen.',
            'title_en' => 'Shop in style.',
            'text_de' => 'Ein ruhiger, moderner Startpunkt fuer die kommende Kollektion Ihres E-Commerce Stores.',
            'text_en' => 'A calm, modern starting point for the upcoming collection of your e-commerce store.',
            'image' => '/hero3.png',
            'alt' => 'Lifestyle Mode in warmem Licht',
        ],
    ];
@endphp

<section class="relative min-h-screen overflow-hidden bg-[#130807] text-ivory" data-hero-slider>
    @foreach ($slides as $index => $slide)
        <article
            class="{{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }} absolute inset-0 transition-opacity duration-700 ease-out"
            data-hero-slide
            aria-hidden="{{ $index === 0 ? 'false' : 'true' }}"
        >
            <img
                src="{{ $slide['image'] }}"
                alt="{{ $slide['alt'] }}"
                class="absolute inset-0 h-full w-full object-cover"
                style="object-position: center center;"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-[#050202]/96 via-[#3a0707]/62 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#050202]/82 via-[#2a0706]/16 to-[#050202]/18"></div>
            <div class="absolute inset-y-0 left-0 w-full bg-[linear-gradient(90deg,rgba(12,3,2,0.54)_0%,rgba(70,8,10,0.34)_38%,rgba(12,3,2,0.08)_68%,transparent_100%)]"></div>

            <div class="luxury-container relative flex min-h-screen items-end pb-20 pt-28 sm:pb-24 lg:items-center lg:pb-0">
                <div class="max-w-3xl">
                    <p class="mb-4 text-[0.68rem] font-bold uppercase tracking-luxury text-[#f2cf75]" data-i18n-de="{{ $slide['eyebrow_de'] }}" data-i18n-en="{{ $slide['eyebrow_en'] }}">{{ $slide['eyebrow_de'] }}</p>
                    <h1 class="font-display text-5xl font-medium leading-[0.95] text-white drop-shadow-[0_8px_18px_rgba(0,0,0,0.85)] sm:text-6xl lg:text-8xl" data-i18n-de="{{ $slide['title_de'] }}" data-i18n-en="{{ $slide['title_en'] }}">
                        {{ $slide['title_de'] }}
                    </h1>
                    <p class="mt-6 max-w-2xl text-base font-bold leading-8 text-white drop-shadow-[0_4px_12px_rgba(0,0,0,0.85)] sm:text-lg" data-i18n-de="{{ $slide['text_de'] }}" data-i18n-en="{{ $slide['text_en'] }}">
                        {{ $slide['text_de'] }}
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="/shop" class="button-primary cursor-pointer shadow-[0_16px_36px_rgba(120,0,11,0.36)]" data-i18n-de="Jetzt einkaufen" data-i18n-en="Shop now">Jetzt einkaufen</a>
                        <a href="/ueber-uns" class="button-secondary cursor-pointer border-white/80 bg-[#120605]/28 text-white hover:border-[#d8b45a] hover:bg-[#d8b45a] hover:text-[#120807]" data-i18n-de="Manufaktur ansehen" data-i18n-en="View Atelier">Manufaktur ansehen</a>
                    </div>
                </div>
            </div>
        </article>
    @endforeach

    <div class="luxury-container pointer-events-none relative z-10 flex min-h-screen items-end justify-end pb-10">
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




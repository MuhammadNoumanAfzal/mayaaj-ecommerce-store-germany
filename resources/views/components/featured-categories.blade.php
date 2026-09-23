@php
    $categories = [
        [
            'code' => '01',
            'tag' => 'Taschen / Bags',
            'title_de' => 'Leder Taschen',
            'title_en' => 'Leather Bags',
            'text_de' => 'Handgefertigte Ledertaschen & zeitlose Reisebegleiter.',
            'text_en' => 'Handcrafted leather bags & timeless travel companions.',
            'image' => '/bag.png',
            'position' => 'center center',
        ],
        [
            'code' => '02',
            'tag' => 'Geldbörsen / Wallets',
            'title_de' => 'Geldbörsen',
            'title_en' => 'Wallets & Etuis',
            'text_de' => 'Feine Geldbörsen & Kartenetuis aus edlem Leder.',
            'text_en' => 'Fine wallets & cardholders crafted in luxury leather.',
            'image' => '/wallet.png',
            'position' => 'center center',
        ],
        [
            'code' => '03',
            'tag' => 'Accessoires',
            'title_de' => 'Accessoires',
            'title_en' => 'Accessories',
            'text_de' => 'Refinierte Details, Uhren & luxuriöse Pflege-Kits.',
            'text_en' => 'Refined details, timepieces & bespoke luxury essentials.',
            'image' => '/accessories.png',
            'position' => 'center center',
        ],
        [
            'code' => '04',
            'tag' => 'Golf & Sport',
            'title_de' => 'Golf & Lifestyle',
            'title_en' => 'Golf & Lifestyle',
            'text_de' => 'Exklusive Sport- & Executive Golf Kollektion.',
            'text_en' => 'Exclusive sports & executive golf collection.',
            'image' => '/golf.png',
            'position' => 'center center',
        ],
    ];
@endphp

<section class="relative overflow-hidden bg-[#faf7f2] py-8 border-y border-[#e6decb] text-[#241a17] sm:py-10 lg:py-12" aria-labelledby="featured-categories-heading">
    <!-- Ambient Subtle Warm Light Accents -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(216,180,90,0.12),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        <!-- Compact Light Section Header -->
        <div class="flex flex-col gap-3 border-b border-[#e5dec9] pb-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-0.5 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-de="KOLLEKTION EINSTIEG" data-i18n-en="COLLECTION ENTRY">KOLLEKTION EINSTIEG</span>
                </div>
                <h2 id="featured-categories-heading" class="mt-2 font-display text-2xl font-medium leading-tight text-[#1c1210] sm:text-3xl lg:text-4xl" data-i18n-de="Entdecken Sie Mehaaj" data-i18n-en="Discover Mehaaj">
                    Entdecken Sie Mehaaj
                </h2>
            </div>
            <p class="max-w-md text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-de="Kuratierte Kategorien für einen schnellen Einstieg in unsere Premium-Auswahl." data-i18n-en="Curated categories for a quick entry into our premium selection.">
                Kuratierte Kategorien für einen schnellen Einstieg in unsere Premium-Auswahl.
            </p>
        </div>

        <!-- Dynamic Cards Grid from Database Categories -->
        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @php
                $displayCats = (isset($globalCategories) && $globalCategories->count() > 0) 
                    ? $globalCategories 
                    : collect($categories);
            @endphp

            @foreach ($displayCats as $index => $cat)
                @php
                    $catName = is_object($cat) ? $cat->name : $cat['title_de'];
                    $catDesc = is_object($cat) ? ($cat->description ?? '') : $cat['text_de'];
                    $catImg = is_object($cat) ? $cat->image_url : $cat['image'];
                    $catSlug = is_object($cat) ? $cat->slug : 'shop';
                    $catCode = '0' . ($index + 1);
                @endphp
                <a href="/shop?category={{ $catSlug }}" class="animate-shine-sweep group relative flex min-h-[220px] sm:min-h-[240px] lg:min-h-[250px] flex-col justify-between overflow-hidden rounded-md border border-[#e5dec9] bg-white shadow-[0_4px_20px_rgba(0,0,0,0.05)] transition-all duration-500 hover:-translate-y-2 hover:border-[#d8b45a] hover:shadow-[0_0_35px_rgba(216,180,90,0.25)] outline-none focus:outline-none focus:ring-0 cursor-pointer" aria-label="{{ $catName }} entdecken">
                    
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

                    <!-- Top Glass Badge -->
                    <div class="relative z-10 p-3.5 sm:p-4 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-white/40 bg-white/85 px-2.5 py-0.5 text-[0.58rem] font-bold uppercase tracking-[0.16em] text-[#78000b] backdrop-blur-md transition duration-300 group-hover:bg-[#78000b] group-hover:text-white group-hover:border-[#78000b]">
                            <span>{{ $catCode }}</span>
                            <span class="opacity-40">/</span>
                            <span>{{ $catName }}</span>
                        </span>
                        <div class="h-6 w-6 rounded-full bg-white/85 border border-white/50 backdrop-blur-md flex items-center justify-center text-[#78000b] transition duration-300 group-hover:bg-[#d8b45a] group-hover:text-[#120807]">
                            <svg class="h-3 w-3 transition-transform duration-300 group-hover:rotate-45" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                <path d="M7 17L17 7M17 7H7M17 7V17" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Bottom Content -->
                    <div class="relative z-10 p-4 sm:p-5">
                        <div class="mb-1.5 h-[2px] w-6 bg-[#d8b45a] transition-all duration-300 group-hover:w-12 group-hover:bg-[#f2cf75]"></div>
                        <h3 class="font-display text-2xl font-medium text-white drop-shadow-sm transition-colors duration-300 group-hover:text-[#f2cf75] sm:text-3xl">
                            {{ $catName }}
                        </h3>
                        <p class="mt-1 line-clamp-1 text-xs text-white/85 transition-colors duration-300 group-hover:text-white">
                            {{ $catDesc }}
                        </p>
                        <div class="mt-3 flex items-center text-[0.62rem] font-bold uppercase tracking-luxury text-[#f2cf75] transition-colors duration-300 group-hover:text-white">
                            <span data-i18n-de="ENTDECKEN" data-i18n-en="DISCOVER">ENTDECKEN</span>
                            <svg class="ml-1.5 h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

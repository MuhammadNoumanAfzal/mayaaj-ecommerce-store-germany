@php
    $benefits = [
        [
            'title_de' => 'Kostenloser Versand',
            'title_en' => 'Free Shipping',
            'text_de' => 'Kostenlose Lieferung für alle qualifizierten Bestellungen in Deutschland.',
            'text_en' => 'Free delivery for all qualifying orders across Germany.',
            'icon' => 'shipping',
            'code' => '01',
        ],
        [
            'title_de' => 'Sichere Zahlung',
            'title_en' => 'Secure Payment',
            'text_de' => '256-Bit verschlüsselte Bezahlung für Ihren sorgenfreien Einkauf.',
            'text_en' => '256-bit encrypted checkout for your worry-free shopping.',
            'icon' => 'payment',
            'code' => '02',
        ],
        [
            'title_de' => 'Einfache Rückgabe',
            'title_en' => 'Easy Returns',
            'text_de' => '30 Tage unkompliziertes Rückgaberecht ohne Zusatzkosten.',
            'text_en' => '30 days seamless return policy with hassle-free process.',
            'icon' => 'returns',
            'code' => '03',
        ],
        [
            'title_de' => 'VIP Kundenservice',
            'title_en' => 'VIP Care',
            'text_de' => 'Persönlicher 24/7 Support für Stilberatung & Bestellfragen.',
            'text_en' => 'Personal 24/7 support for styling & order inquiries.',
            'icon' => 'support',
            'code' => '04',
        ],
    ];
@endphp

<section class="relative overflow-hidden bg-[#faf7f2] py-16 text-[#1c1210] lg:py-24 border-b border-[#e6decb]" aria-labelledby="trust-benefits-heading">
    <!-- Subtle Background Ambient Light Glow -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_100%,rgba(216,180,90,0.08),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        <!-- Section Header -->
        <div class="mx-auto max-w-2xl text-center">
            <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b] animate-pulse"></span>
                <span data-i18n-de="SERVICE VERSPRECHEN" data-i18n-en="SERVICE PROMISE">SERVICE VERSPRECHEN</span>
            </div>
            <h2 id="trust-benefits-heading" class="mt-3 font-display text-3xl font-medium leading-tight text-[#1c1210] sm:text-4xl lg:text-5xl" data-i18n-de="Luxus braucht Vertrauen." data-i18n-en="Luxury Needs Trust.">
                Luxus braucht Vertrauen.
            </h2>
            <p class="mx-auto mt-3 max-w-xl text-xs leading-relaxed text-[#685c54] sm:text-sm" data-i18n-de="Ein erstklassiges Einkaufserlebnis basiert aufTransparenz, absoluter Sicherheit und persönlicher Betreuung." data-i18n-en="A world-class shopping experience relies on transparency, total security, and personal care.">
                Ein erstklassiges Einkaufserlebnis basiert auf Transparenz, absoluter Sicherheit und persönlicher Betreuung.
            </p>
        </div>

        <!-- 4 Trust Feature Cards Grid -->
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($benefits as $benefit)
                <article class="group relative flex flex-col justify-between overflow-hidden rounded-md border border-[#e6decb] bg-white p-6 shadow-[0_4px_20px_rgba(0,0,0,0.04)] transition-all duration-500 hover:-translate-y-1.5 hover:border-[#78000b]/40 hover:shadow-[0_16px_45px_rgba(120,0,11,0.12)]">
                    
                    <!-- Top Index Tag & Icon -->
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex h-11 w-11 items-center justify-center rounded-full border border-[#78000b]/15 bg-[#78000b]/8 text-[#78000b] transition duration-500 group-hover:bg-[#78000b] group-hover:text-white group-hover:scale-105">
                                @if ($benefit['icon'] === 'shipping')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 7h11v10H3V7Z"/><path d="M14 10h3.5l3 3.5V17H14v-7Z"/><path d="M6.5 19a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3ZM17.5 19a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"/></svg>
                                @elseif ($benefit['icon'] === 'payment')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 7h16v10H4V7Z"/><path d="M4 10h16"/><path d="M7 15h4"/></svg>
                                @elseif ($benefit['icon'] === 'returns')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 7H5v3"/><path d="M5.5 10A7 7 0 1 0 8 5.7" stroke-linecap="round"/><path d="m5 7 4 4" stroke-linecap="round"/></svg>
                                @else
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 4a7 7 0 0 0-7 7v3"/><path d="M19 14v-3a7 7 0 0 0-7-7"/><path d="M5 14h3v5H5v-5ZM16 14h3v5h-3v-5Z"/><path d="M16 19c-.8 1-2.1 1.5-4 1.5" stroke-linecap="round"/></svg>
                                @endif
                            </div>
                            <span class="text-[0.62rem] font-bold text-[#d8b45a] opacity-60 transition group-hover:opacity-100">{{ $benefit['code'] }}</span>
                        </div>

                        <!-- Animated Progress Line -->
                        <div class="mt-5 h-[2px] w-7 bg-[#d8b45a] transition-all duration-500 group-hover:w-14"></div>

                        <!-- Card Title & Description -->
                        <h3 class="mt-3 font-display text-2xl font-medium text-[#1c1210] transition-colors duration-300 group-hover:text-[#78000b]" data-i18n-de="{{ $benefit['title_de'] }}" data-i18n-en="{{ $benefit['title_en'] }}">
                            {{ $benefit['title_de'] }}
                        </h3>
                        <p class="mt-2 text-xs leading-relaxed text-[#685c54]" data-i18n-de="{{ $benefit['text_de'] }}" data-i18n-en="{{ $benefit['text_en'] }}">
                            {{ $benefit['text_de'] }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

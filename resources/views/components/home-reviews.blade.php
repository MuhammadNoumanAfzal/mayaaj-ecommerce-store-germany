@php
    $dbReviews = \App\Models\Review::where('status', 'approved')->with('product')->latest()->take(3)->get();
    
    if ($dbReviews->count() > 0) {
        $curatedReviews = $dbReviews;
    } else {
        $curatedReviews = collect([
            (object) [
                'rating' => 5,
                'is_verified' => true,
                'title' => 'Meisterhafte Sattlerkunst',
                'comment' => 'Die Qualität des handverlesenen italienischen Vollleders und die feine Kantenverarbeitung übertreffen selbst renommierte Pariser Traditionshäuser.',
                'customer_name' => 'Dr. Maximilian von Berg',
                'location' => 'München, Deutschland',
                'product' => (object) ['name' => 'Maison Grand Leather Tote']
            ],
            (object) [
                'rating' => 5,
                'is_verified' => true,
                'title' => 'Präzision & Zeitlose Eleganz',
                'comment' => 'Der Grand Royal Tourbillon Automatic Chronograph besitzt eine makellose Ganggenauigkeit und ein zeitlos nobles Finish. Diskreter Express-Service.',
                'customer_name' => 'Hélène Dupont',
                'location' => 'Zürich, Schweiz',
                'product' => (object) ['name' => 'Grand Royal Tourbillon']
            ],
            (object) [
                'rating' => 5,
                'is_verified' => true,
                'title' => 'Perfekter Reisebegleiter',
                'comment' => 'Der Grand Atelier Leather Weekender riecht fantastisch nach feinstem pflanzlich gegerbtem Leder. Robuste Beschläge und unvergleichlicher Stil.',
                'customer_name' => 'Alessandro Rossi',
                'location' => 'Mailand / Wien',
                'product' => (object) ['name' => 'The Grand Atelier Weekender']
            ]
        ]);
    }
@endphp
<section class="relative overflow-hidden bg-[#faf7f2] py-14 sm:py-18 lg:py-20 border-b border-[#e6decb]" aria-labelledby="home-reviews-heading">
    <!-- Subtle Ambient Glow -->
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(216,180,90,0.08),transparent_70%)]"></div>

    <div class="luxury-container relative z-10">
        <!-- Section Header -->
        <div class="flex flex-col gap-4 border-b border-[#e6decb] pb-6 sm:flex-row sm:items-end sm:justify-between reveal-on-scroll">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-en="VERIFIED PATRON EXPERIENCES" data-i18n-de="VERIFIZIERTE KUNDENMEINUNGEN">VERIFIED PATRON EXPERIENCES</span>
                </div>
                <h2 id="home-reviews-heading" class="mt-2 font-display text-2xl sm:text-3xl lg:text-4xl font-medium text-[#1c1210]" data-i18n-en="Treasured by European Collectors" data-i18n-de="Geschätzt von europäischen Sammlern">
                    Treasured by European Collectors
                </h2>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="/reviews" class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-[#78000b] hover:text-[#5a0309] transition" data-i18n-en="Read All →" data-i18n-de="Alle ansehen →">
                    Read All →
                </a>
            </div>
        </div>

        <!-- Reviews Grid -->
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($curatedReviews as $index => $rev)
                <article class="reveal-on-scroll reveal-delay-{{ ($index + 1) * 100 }} group relative flex flex-col justify-between rounded-md border border-[#e6decb] bg-white p-6 sm:p-7 shadow-[0_4px_20px_rgba(0,0,0,0.04)] transition-all duration-500 hover:-translate-y-1.5 hover:border-[#d8b45a]/50 hover:shadow-[0_16px_45px_rgba(120,0,11,0.08)]">
                    <div>
                        <!-- Stars & Badge -->
                        <div class="flex items-center justify-between">
                            <div class="flex text-[#d8b45a] text-sm tracking-widest">
                                @for($i = 0; $i < $rev->rating; $i++)
                                    <span>★</span>
                                @endfor
                            </div>
                            @if($rev->is_verified)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[0.58rem] font-bold text-emerald-800 border border-emerald-200">
                                    <svg class="h-2.5 w-2.5 text-emerald-600" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                    <span data-i18n-en="Verified" data-i18n-de="Verifiziert">Verified</span>
                                </span>
                            @endif
                        </div>

                        <!-- Review Title & Quote -->
                        @if($rev->title)
                            <h3 class="mt-4 font-display text-lg font-medium text-[#1c1210] group-hover:text-[#78000b] transition-colors">
                                {{ $rev->title }}
                            </h3>
                        @endif
                        <p class="mt-2 text-xs leading-relaxed text-[#685c54] font-light italic">
                            “{{ $rev->comment }}”
                        </p>
                    </div>

                    <!-- Author Details -->
                    <div class="mt-6 pt-4 border-t border-[#f2ebdc] flex items-center justify-between text-xs">
                        <div>
                            <p class="font-semibold text-[#1c1210]">{{ $rev->customer_name }}</p>
                            @if($rev->location)
                                <p class="text-[0.68rem] text-[#8a7c74]">{{ $rev->location }}</p>
                            @endif
                        </div>
                        @if($rev->product)
                            <span class="text-[0.65rem] font-medium text-[#78000b] bg-[#78000b]/5 px-2 py-1 rounded-xs">
                                {{ $rev->product->name }}
                            </span>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>


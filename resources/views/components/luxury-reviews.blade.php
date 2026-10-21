@php
    $reviews = \App\Models\Review::where('status', 'approved')->with('product')->latest()->take(12)->get();
    $totalApproved = \App\Models\Review::where('status', 'approved')->count();
    $avgRating = $totalApproved > 0 ? number_format(\App\Models\Review::where('status', 'approved')->avg('rating'), 1) : '4.9';
@endphp

<!-- Continuous Auto-Scrolling Luxury Patron Impressions & Testimonials Slider -->
<section class="relative overflow-hidden bg-[#faf7f2] py-10 sm:py-14 lg:py-16 border-b border-[#e6decb]" aria-labelledby="patron-reviews-heading">
    <!-- Ambient Luxury Gold/Burgundy Glow -->
    <div class="pointer-events-none absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-[radial-gradient(ellipse_at_center,rgba(216,180,90,0.08),transparent_70%)]"></div>

    <div class="luxury-container relative z-10 mb-8 sm:mb-12">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-[#e6decb] pb-6">
            <div class="space-y-2.5">
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b] animate-pulse"></span>
                    <span data-i18n-en="VERIFIED PATRON EXPERIENCES" data-i18n-de="VERIFIZIERTE KUNDENERFAHRUNGEN">VERIFIED PATRON EXPERIENCES</span>
                </div>
                <h2 id="patron-reviews-heading" class="font-display text-2xl sm:text-3xl lg:text-4xl font-medium tracking-tight text-[#1c1210]">
                    <span data-i18n-en="Treasured by European Collectors" data-i18n-de="Geschätzt von europäischen Sammlern">Treasured by European Collectors</span>
                </h2>
                <p class="text-xs sm:text-sm text-[#685c54] max-w-xl font-light leading-relaxed" data-i18n-en="Genuine impressions on our artisanal tannage, bespoke saddle-stitching, and concierge delivery across Europe." data-i18n-de="Echte Erfahrungsberichte über unsere Gerbkunst, handgewachste Sattlernähte und Concierge-Zustellung in ganz Europa.">
                    Genuine impressions on our artisanal tannage, bespoke saddle-stitching, and concierge delivery across Europe.
                </p>
            </div>

            <!-- Stats & Navigation Controls -->
            <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                <!-- Rating Score Pill -->
                <div class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-full border border-[#e6decb] shadow-xs">
                    <div class="flex text-[#d8b45a] text-sm tracking-wider">
                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                    </div>
                    <div class="h-4 w-px bg-[#e6decb]"></div>
                    <div class="text-xs font-semibold text-[#1c1210]">
                        <span class="font-bold text-sm">{{ $avgRating }}</span><span class="text-[#8a7c74] font-normal"> / 5.0</span>
                    </div>
                    <span class="text-[0.65rem] text-[#8a7c74] hidden sm:inline">({{ $totalApproved }} <span data-i18n-en="verified" data-i18n-de="verifiziert">verified</span>)</span>
                </div>

                <!-- Slider Arrows -->
                <div class="flex items-center gap-2">
                    <button type="button" id="sliderPrevBtn" aria-label="Previous review" class="h-9 w-9 rounded-full border border-[#e6decb] bg-white text-[#1c1210] hover:bg-[#78000b] hover:text-white hover:border-[#78000b] transition-all duration-300 flex items-center justify-center shadow-xs cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button type="button" id="sliderNextBtn" aria-label="Next review" class="h-9 w-9 rounded-full border border-[#e6decb] bg-white text-[#1c1210] hover:bg-[#78000b] hover:text-white hover:border-[#78000b] transition-all duration-300 flex items-center justify-center shadow-xs cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <a href="{{ route('reviews.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#78000b] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#5a0309] transition-all duration-300 shadow-xs">
                        <span data-i18n-en="All Reviews" data-i18n-de="Alle Bewertungen">All Reviews</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Continuous Auto-Scrolling Ticker Track -->
    <div class="relative w-full overflow-hidden marquee-wrapper py-2">
        <!-- Gradient Edge Fades for Cinema Look -->
        <div class="pointer-events-none absolute left-0 top-0 bottom-0 w-12 sm:w-28 bg-gradient-to-r from-[#faf7f2] via-[#faf7f2]/80 to-transparent z-20"></div>
        <div class="pointer-events-none absolute right-0 top-0 bottom-0 w-12 sm:w-28 bg-gradient-to-l from-[#faf7f2] via-[#faf7f2]/80 to-transparent z-20"></div>

        <div id="marqueeTrack" class="marquee-track flex w-max" style="gap: 20px; display: flex;">
            <!-- First Set of Review Cards -->
            @foreach($reviews as $review)
                @include('components.review-card-item', ['review' => $review])
            @endforeach

            <!-- Seamless Duplicate Set for 100% Continuous Infinite Loop -->
            @foreach($reviews as $review)
                @include('components.review-card-item', ['review' => $review, 'isDuplicate' => true])
            @endforeach
        </div>
    </div>

    <!-- Bottom Action Ribbon -->
    <div class="luxury-container relative z-10 mt-10 sm:mt-12 text-center">
        <div class="inline-flex flex-wrap items-center justify-center gap-3 sm:gap-6 text-xs text-[#685c54]">
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                <span data-i18n-en="100% Authenticated European Orders" data-i18n-de="100% Authentifizierte europäische Bestellungen">100% Authenticated European Orders</span>
            </span>
            <span class="text-[#e6decb] hidden sm:inline">•</span>
            <span class="inline-flex items-center gap-1.5">
                <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                <span data-i18n-en="Unfiltered Client Feedback" data-i18n-de="Unverfälschte Kundenmeinungen">Unfiltered Client Feedback</span>
            </span>
            <span class="text-[#e6decb] hidden sm:inline">•</span>
            <a href="{{ route('reviews.index') }}#write" class="font-bold text-[#78000b] hover:underline" data-i18n-en="Share Your Atelier Experience →" data-i18n-de="Eigene Atelier-Erfahrung teilen →">
                Share Your Atelier Experience →
            </a>
        </div>
    </div>
</section>

<!-- Continuous Infinite Smooth Scroll Styles & Logic -->
<style>
    .marquee-wrapper {
        mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
    }

    @keyframes smoothMarqueeScroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .marquee-track {
        display: flex;
        width: max-content;
        animation: smoothMarqueeScroll 45s linear infinite;
        will-change: transform;
    }

    /* Pause smoothly on hover for reading */
    .marquee-wrapper:hover .marquee-track,
    .marquee-track:hover {
        animation-play-state: paused !important;
    }
</style>

<script>
    (function() {
        const track = document.getElementById('marqueeTrack');
        const prevBtn = document.getElementById('sliderPrevBtn');
        const nextBtn = document.getElementById('sliderNextBtn');
        if (!track) return;

        let currentOffset = 0;
        let isPaused = false;
        const cardWidth = 310 + 20; // card width (310px) + gap (20px)

        // Interactive button stepping: pause animation and smoothly translate
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', function() {
                track.style.animationPlayState = 'paused';
                const style = window.getComputedStyle(track);
                const matrix = new WebKitCSSMatrix(style.transform);
                let currentX = matrix.m41;
                let targetX = currentX + cardWidth;
                if (targetX > 0) targetX = -(track.scrollWidth / 2) + cardWidth;
                
                track.style.animation = 'none';
                track.style.transition = 'transform 0.45s cubic-bezier(0.25, 1, 0.5, 1)';
                track.style.transform = `translateX(${targetX}px)`;

                setTimeout(() => {
                    track.style.transition = '';
                    track.style.animation = 'smoothMarqueeScroll 45s linear infinite';
                    track.style.animationPlayState = 'running';
                }, 4000);
            });

            nextBtn.addEventListener('click', function() {
                track.style.animationPlayState = 'paused';
                const style = window.getComputedStyle(track);
                const matrix = new WebKitCSSMatrix(style.transform);
                let currentX = matrix.m41;
                let targetX = currentX - cardWidth;
                if (Math.abs(targetX) >= (track.scrollWidth / 2)) targetX = 0;

                track.style.animation = 'none';
                track.style.transition = 'transform 0.45s cubic-bezier(0.25, 1, 0.5, 1)';
                track.style.transform = `translateX(${targetX}px)`;

                setTimeout(() => {
                    track.style.transition = '';
                    track.style.animation = 'smoothMarqueeScroll 45s linear infinite';
                    track.style.animationPlayState = 'running';
                }, 4000);
            });
        }
    })();
</script>

@extends('layouts.app')

@section('title', 'Client Reviews & Atelier Guestbook | MEHAAJ® Official Maison')
@section('meta_description', 'Read authenticated impressions from European collectors and patrons regarding MEHAAJ bespoke leather goods, Swiss-inspired chronographs, and concierge delivery.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] py-10 sm:py-14 lg:py-18 text-[#1c1210]">
    <div class="luxury-container space-y-10 sm:space-y-12">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-[#8a7c74]" aria-label="Breadcrumb">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-en="Home" data-i18n-de="Startseite">Home</a>
            <span class="text-[#d8b45a]">•</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-en="Client Reviews" data-i18n-de="Kundenbewertungen">Client Reviews</span>
        </nav>

        <!-- Luxury Page Header / Hero -->
        <div class="relative overflow-hidden rounded-2xl border border-[#e6decb] bg-gradient-to-br from-white via-[#fcfaf7] to-[#f4eedf] p-8 sm:p-12 shadow-[0_4px_30px_rgba(28,18,16,0.03)]">
            <!-- Ambient Corner Gold Glow -->
            <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full bg-[radial-gradient(circle,rgba(216,180,90,0.15),transparent_70%)]"></div>

            <div class="relative z-10 flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="max-w-2xl space-y-3.5">
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3.5 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                        <span class="h-1.5 w-1.5 rounded-full bg-[#78000b] animate-pulse"></span>
                        <span data-i18n-en="AUTHENTIC PATRON GUESTBOOK" data-i18n-de="AUTHENTISCHES ATELIER GÄSTEBUCH">AUTHENTIC PATRON GUESTBOOK</span>
                    </div>

                    <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight text-[#1c1210] leading-tight">
                        <span data-i18n-en="Voices of European Collectors" data-i18n-de="Stimmen europäischer Sammler">Voices of European Collectors</span>
                    </h1>

                    <p class="text-xs sm:text-sm text-[#685c54] font-light leading-relaxed max-w-xl" data-i18n-en="Unfiltered reflections from discerning patrons across Munich, Zurich, Paris, and Milan celebrating our vegetable-tanned leathercraft, Swiss precision, and heirloom longevity." data-i18n-de="Unverfälschte Einblicke anspruchsvoller Kunden aus München, Zürich, Paris und Mailand über unsere vegetabile Gerbkunst, Schweizer Präzision und zeitlose Langlebigkeit.">
                        Unfiltered reflections from discerning patrons across Munich, Zurich, Paris, and Milan celebrating our vegetable-tanned leathercraft, Swiss precision, and heirloom longevity.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <button type="button" onclick="openReviewModal()" class="inline-flex items-center justify-center gap-2.5 rounded-full bg-[#78000b] px-6 py-3.5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-xl hover:-translate-y-0.5 cursor-pointer">
                        <svg class="h-4 w-4 text-[#ffd45a]" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span data-i18n-en="Write an Atelier Review" data-i18n-de="Bewertung Verfassen">Write an Atelier Review</span>
                    </button>
                    <a href="/shop" class="inline-flex items-center justify-center gap-2 rounded-full border border-[#e6decb] bg-white px-5 py-3.5 text-xs font-bold uppercase tracking-wider text-[#1c1210] hover:border-[#78000b] hover:text-[#78000b] transition-all duration-300 shadow-xs">
                        <span data-i18n-en="Explore Collection" data-i18n-de="Kollektion Entdecken">Explore Collection</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Rating Executive Dashboard -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-10 shadow-[0_4px_25px_rgba(28,18,16,0.03)]">
            <!-- Left Score (5 cols) -->
            <div class="lg:col-span-5 flex flex-col justify-center items-center text-center border-b lg:border-b-0 lg:border-r border-[#f2ebdc] pb-8 lg:pb-0 lg:pr-10">
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[0.62rem] font-bold uppercase tracking-wider mb-3">
                    <svg class="h-3 w-3 text-emerald-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    <span data-i18n-en="100% Verified Patron Purchases" data-i18n-de="100% Verifizierte Käufe">100% Verified Patron Purchases</span>
                </div>

                <div class="flex items-baseline gap-2">
                    <span class="font-display text-6xl sm:text-7xl font-bold tracking-tight text-[#1c1210]">{{ number_format($avgRating, 1) }}</span>
                    <span class="text-sm font-semibold text-[#8a7c74]">/ 5.0</span>
                </div>

                <div class="flex items-center text-[#d8b45a] text-xl my-2.5 tracking-widest">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>

                <p class="text-xs text-[#685c54]">
                    <span data-i18n-en="Based on" data-i18n-de="Basierend auf">Based on</span> <strong class="text-[#1c1210]">{{ $totalCount }}</strong> <span data-i18n-en="authenticated patron experiences" data-i18n-de="authentifizierten Kundenerfahrungen">authenticated patron experiences</span>
                </p>

                <p class="mt-4 text-[0.72rem] text-[#8a7c74] italic max-w-xs leading-relaxed">
                    „99.4% of patrons recommend MEHAAJ leather goods and timepieces for artisanal gifting and heirloom longevity.“
                </p>
            </div>

            <!-- Right Star Breakdown Bars (7 cols) -->
            <div class="lg:col-span-7 flex flex-col justify-center space-y-3 lg:pl-6">
                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-wider text-[#8a7c74] mb-1">
                    <span data-i18n-en="Rating Breakdown" data-i18n-de="Bewertungsübersicht">Rating Breakdown</span>
                    <span data-i18n-en="Satisfaction 99.4%" data-i18n-de="Zufriedenheit 99.4%">Satisfaction 99.4%</span>
                </div>

                @for($star = 5; $star >= 1; $star--)
                    @php
                        $count = $ratingCounts[$star] ?? 0;
                        $pct = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                        $isActive = request('rating') == $star;
                    @endphp
                    <a href="{{ route('reviews.index', array_merge(request()->except(['page']), ['rating' => $isActive ? null : $star])) }}" class="group flex items-center gap-3 text-xs transition-opacity hover:opacity-90">
                        <span class="w-16 font-bold flex items-center gap-1.5 {{ $isActive ? 'text-[#78000b]' : 'text-[#1c1210]' }}">
                            {{ $star }} <span class="text-[#d8b45a]">★</span>
                        </span>
                        <div class="flex-1 h-3 rounded-full bg-[#f2ebdc] overflow-hidden p-0.5">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#d8b45a] via-[#b68d37] to-[#78000b] transition-all duration-700" style="width: {{ $pct }}%;"></div>
                        </div>
                        <span class="w-16 text-right font-mono text-[0.72rem] {{ $isActive ? 'text-[#78000b] font-bold' : 'text-[#8a7c74]' }}">
                            {{ $count }} <span class="text-[0.65rem] text-[#a0948c]">({{ $pct }}%)</span>
                        </span>
                    </a>
                @endfor
            </div>
        </div>

        <!-- Filter, Sort & Search Control Bar -->
        <div class="rounded-xl border border-[#e6decb] bg-white p-4 sm:p-5 shadow-xs space-y-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                
                <!-- Rating Filter Pills -->
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('reviews.index', request()->except(['rating', 'page'])) }}" class="px-4 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ !request('rating') ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                        <span data-i18n-en="All Reviews" data-i18n-de="Alle Bewertungen">All Reviews</span> ({{ $totalCount }})
                    </a>
                    <a href="{{ route('reviews.index', array_merge(request()->except('page'), ['rating' => 5])) }}" class="px-3.5 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ request('rating') == '5' ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                        5 ★ ({{ $ratingCounts[5] ?? 0 }})
                    </a>
                    <a href="{{ route('reviews.index', array_merge(request()->except('page'), ['rating' => 4])) }}" class="px-3.5 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ request('rating') == '4' ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                        4 ★ ({{ $ratingCounts[4] ?? 0 }})
                    </a>
                    @if(($ratingCounts[3] ?? 0) > 0)
                        <a href="{{ route('reviews.index', array_merge(request()->except('page'), ['rating' => 3])) }}" class="px-3.5 py-2 rounded-full text-xs font-bold transition-all duration-200 {{ request('rating') == '3' ? 'bg-[#78000b] text-white shadow-xs' : 'bg-[#faf7f2] border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                            3 ★ ({{ $ratingCounts[3] ?? 0 }})
                        </a>
                    @endif
                </div>

                <!-- Search & Sort Controls -->
                <form method="GET" action="{{ route('reviews.index') }}" class="flex flex-wrap items-center gap-3">
                    @if(request('rating'))
                        <input type="hidden" name="rating" value="{{ request('rating') }}">
                    @endif
                    @if(request('product_id'))
                        <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                    @endif

                    <!-- Search Input -->
                    <div class="relative min-w-[200px] flex-1 sm:flex-initial">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reviews..." class="w-full h-9 pl-8 pr-3 text-xs rounded-full border border-[#e6decb] bg-[#faf7f2] outline-none focus:border-[#78000b] focus:bg-white text-[#1c1210]">
                        <svg class="h-3.5 w-3.5 text-[#8a7c74] absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Sort Select -->
                    <select name="sort" onchange="this.form.submit()" class="h-9 px-3 text-xs rounded-full border border-[#e6decb] bg-[#faf7f2] outline-none focus:border-[#78000b] text-[#1c1210] font-medium cursor-pointer">
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rated</option>
                        <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rated</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>

                    @if(request()->anyFilled(['rating', 'product_id', 'search', 'sort']))
                        <a href="{{ route('reviews.index') }}" class="text-[0.7rem] font-bold text-[#78000b] hover:underline" title="Reset all filters">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($reviews as $review)
                @php
                    $words = explode(' ', trim($review->customer_name));
                    $initials = '';
                    if (count($words) >= 2) {
                        $initials = mb_substr($words[0], 0, 1) . mb_substr(end($words), 0, 1);
                    } else {
                        $initials = mb_substr($review->customer_name, 0, 2);
                    }
                    $initials = strtoupper($initials);
                @endphp
                <article class="relative rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-7 shadow-[0_4px_20px_rgba(28,18,16,0.03)] hover:shadow-[0_16px_36px_rgba(120,0,11,0.08)] hover:border-[#d8b45a]/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    
                    <!-- Top Watermark Quote -->
                    <div class="pointer-events-none absolute right-5 top-5 text-[#f2ebdc] font-display text-6xl leading-none select-none font-serif opacity-70">
                        ”
                    </div>

                    <div class="relative z-10 space-y-4">
                        <!-- Rating and Verified Badge -->
                        <div class="flex items-center justify-between gap-2 border-b border-[#f2ebdc] pb-3">
                            <div class="flex items-center text-[#d8b45a] text-sm tracking-wider">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <span>★</span>
                                    @else
                                        <span class="text-[#e6decb]">★</span>
                                    @endif
                                @endfor
                                <span class="ml-1.5 text-[0.7rem] font-bold text-[#1c1210]">{{ number_format($review->rating, 1) }}</span>
                            </div>

                            @if($review->is_verified)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[0.58rem] font-bold text-emerald-800 border border-emerald-200">
                                    <svg class="h-2.5 w-2.5 text-emerald-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                    <span data-i18n-en="Verified Buyer" data-i18n-de="Verifizierter Käufer">Verified Buyer</span>
                                </span>
                            @endif
                        </div>

                        <!-- Review Title -->
                        @if($review->title)
                            <h3 class="font-display text-base sm:text-lg font-medium text-[#1c1210] leading-snug pr-4">
                                {{ $review->title }}
                            </h3>
                        @endif

                        <!-- Review Body -->
                        <p class="text-xs sm:text-[0.82rem] leading-relaxed text-[#544840] font-light italic">
                            “{{ $review->comment }}”
                        </p>

                        <!-- Attached Product Link if present -->
                        @if($review->product)
                            <div class="pt-3 border-t border-[#f2ebdc] flex items-center justify-between gap-3">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    @if($review->product->image)
                                        <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->name }}" class="h-9 w-9 rounded-md object-cover border border-[#e6decb] flex-shrink-0">
                                    @else
                                        <div class="h-9 w-9 rounded-md bg-[#faf7f2] border border-[#e6decb] flex items-center justify-center text-xs text-[#8a7c74] flex-shrink-0 font-display">
                                            M
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <span class="block text-[0.62rem] text-[#8a7c74] uppercase tracking-wider">Purchased Item</span>
                                        <a href="{{ route('shop.show', $review->product->slug) }}" class="text-[0.72rem] font-bold text-[#78000b] hover:underline truncate block">
                                            {{ $review->product->name }}
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('shop.show', $review->product->slug) }}" class="text-xs text-[#8a7c74] hover:text-[#78000b] flex-shrink-0" title="View product">
                                    →
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Reviewer Details & Location Footer -->
                    <div class="relative z-10 mt-6 pt-4 border-t border-[#f2ebdc] flex items-center justify-between gap-3 text-xs">
                        <div class="flex items-center gap-3 min-w-0">
                            <!-- Monogram Avatar -->
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-[#78000b] to-[#450207] text-[#ffd45a] flex items-center justify-center font-display text-xs font-bold tracking-wider shadow-xs flex-shrink-0 border border-[#d8b45a]/30">
                                {{ $initials }}
                            </div>
                            <div class="min-w-0 truncate">
                                <p class="font-semibold text-[#1c1210] text-[0.8rem] truncate">{{ $review->customer_name }}</p>
                                @if($review->location)
                                    <p class="text-[0.68rem] text-[#8a7c74] flex items-center gap-1 truncate">
                                        <span>📍</span> {{ $review->location }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <span class="text-[0.68rem] text-[#8a7c74] flex-shrink-0 font-medium">
                            {{ $review->created_at->format('M Y') }}
                        </span>
                    </div>

                </article>
            @empty
                <div class="col-span-full py-20 text-center rounded-2xl border border-dashed border-[#e6decb] bg-white p-8">
                    <div class="mx-auto h-12 w-12 rounded-full bg-[#78000b]/10 text-[#78000b] flex items-center justify-center text-xl mb-3">
                        ★
                    </div>
                    <h3 class="font-display text-xl font-medium text-[#1c1210]" data-i18n-en="No Reviews Found" data-i18n-de="Keine Bewertungen Gefunden">
                        No Reviews Found
                    </h3>
                    <p class="mt-1.5 text-xs text-[#8a7c74] max-w-sm mx-auto">
                        No reviews currently match your filter selection. Try adjusting your search or rating filters.
                    </p>
                    <div class="mt-5 flex justify-center gap-3">
                        <a href="{{ route('reviews.index') }}" class="px-4 py-2 rounded-full bg-[#1c1210] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#78000b] transition">
                            Reset Filters
                        </a>
                        <button type="button" onclick="openReviewModal()" class="px-4 py-2 rounded-full bg-[#78000b] text-white text-xs font-bold uppercase tracking-wider hover:bg-[#5a0309] transition">
                            Write First Review
                        </button>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
            <div class="pt-8 border-t border-[#e6decb] flex justify-center">
                {{ $reviews->links() }}
            </div>
        @endif

    </div>
</div>

<!-- ========================================== -->
<!-- BESPOKE LUXURY REVIEW SUBMISSION MODAL      -->
<!-- ========================================== -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="relative w-full max-w-xl rounded-2xl border border-[#e6decb] bg-white p-6 sm:p-8 shadow-2xl transition-all duration-300 transform scale-95 opacity-0" id="reviewModalContainer">
        
        <!-- Close Button -->
        <button type="button" onclick="closeReviewModal()" class="absolute right-5 top-5 h-8 w-8 rounded-full border border-[#e6decb] bg-[#faf7f2] text-[#8a7c74] hover:text-[#78000b] hover:border-[#78000b] flex items-center justify-center transition cursor-pointer" aria-label="Close modal">
            ✕
        </button>

        <!-- Header with Maison Crest -->
        <div class="text-center space-y-2 mb-6">
            <div class="inline-flex items-center gap-1.5 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-0.5 text-[0.6rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                <span data-i18n-en="ATELIER PROVENANCE" data-i18n-de="ATELIER PROVENIENZ">ATELIER PROVENANCE</span>
            </div>
            <h2 class="font-display text-2xl sm:text-3xl font-medium text-[#1c1210]" data-i18n-en="Share Your Atelier Experience" data-i18n-de="Ihre Atelier-Erfahrung Teilen">
                Share Your Atelier Experience
            </h2>
            <p class="text-xs text-[#685c54]" data-i18n-en="Your reflections guide discerning collectors and help our artisans continually refine their craft." data-i18n-de="Ihre Worte leiten anspruchsvolle Sammler und inspirieren unsere Kunsthandwerker.">
                Your reflections guide discerning collectors and help our artisans continually refine their craft.
            </p>
        </div>

        <!-- Submission Form -->
        <form id="patronReviewForm" onsubmit="handleReviewSubmit(event)" class="space-y-4 text-xs text-[#1c1210]">
            @csrf

            <!-- Interactive Star Rating Selector -->
            <div class="rounded-xl border border-[#e6decb] bg-[#faf7f2] p-4 text-center">
                <label class="block font-bold text-[#1c1210] mb-2 uppercase tracking-wider text-[0.65rem]" data-i18n-en="Overall Assessment *" data-i18n-de="Gesamteindruck *">
                    Overall Assessment *
                </label>
                <div class="flex items-center justify-center gap-2 text-3xl text-[#d8b45a] cursor-pointer" id="interactiveStarPicker">
                    <span data-star="1" class="star-btn transition-transform hover:scale-125">★</span>
                    <span data-star="2" class="star-btn transition-transform hover:scale-125">★</span>
                    <span data-star="3" class="star-btn transition-transform hover:scale-125">★</span>
                    <span data-star="4" class="star-btn transition-transform hover:scale-125">★</span>
                    <span data-star="5" class="star-btn transition-transform hover:scale-125">★</span>
                </div>
                <input type="hidden" name="rating" id="reviewRatingInput" value="5">
                <p id="starRatingLabel" class="mt-2 text-xs font-semibold text-[#78000b]">
                    ★★★★★ (5/5) — Exceptional & Exquisite Craftsmanship
                </p>
            </div>

            <!-- Two-column: Name & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-[#1c1210] mb-1.5" data-i18n-en="Full Name *" data-i18n-de="Vollständiger Name *">Full Name *</label>
                    <input type="text" id="modalCustomerName" name="customer_name" required placeholder="e.g. Dr. Maximilian von Berg" class="w-full h-10 px-3.5 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition">
                </div>
                <div>
                    <label class="block font-bold text-[#1c1210] mb-1.5" data-i18n-en="Email Address *" data-i18n-de="E-Mail-Adresse *">Email Address *</label>
                    <input type="email" id="modalCustomerEmail" name="customer_email" required placeholder="name@domain.com" class="w-full h-10 px-3.5 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition">
                    <span class="text-[0.62rem] text-[#8a7c74] mt-0.5 block">Used solely for order verification (never published).</span>
                </div>
            </div>

            <!-- Two-column: Location & Product -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-[#1c1210] mb-1.5" data-i18n-en="European City / Location" data-i18n-de="Stadt / Standort">European City / Location</label>
                    <input type="text" id="modalLocation" name="location" placeholder="e.g. Zurich, Switzerland" class="w-full h-10 px-3.5 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition">
                </div>
                <div>
                    <label class="block font-bold text-[#1c1210] mb-1.5" data-i18n-en="Acquired Masterpiece" data-i18n-de="Erworbenes Meisterstück">Acquired Masterpiece</label>
                    <select id="modalProductId" name="product_id" class="w-full h-10 px-3 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition cursor-pointer">
                        <option value="">General Maison Experience</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}" {{ request('product_id') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Review Title -->
            <div>
                <label class="block font-bold text-[#1c1210] mb-1.5" data-i18n-en="Review Headline / Title" data-i18n-de="Titel der Bewertung">Review Headline / Title</label>
                <input type="text" id="modalTitle" name="title" placeholder="e.g. Masterful saddlery craftsmanship with living patina" class="w-full h-10 px-3.5 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition">
            </div>

            <!-- Review Comments -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="font-bold text-[#1c1210]" data-i18n-en="Detailed Impression / Comments *" data-i18n-de="Erfahrungsbericht / Details *">Detailed Impression / Comments *</label>
                    <span id="charCountNotice" class="text-[0.62rem] text-[#8a7c74]">Min 10 characters</span>
                </div>
                <textarea id="modalComment" name="comment" rows="4" required minlength="10" placeholder="Please describe the leather grain, edge burnishing, packaging presentation, or concierge delivery experience..." class="w-full p-3.5 rounded-lg border border-[#e6decb] bg-white outline-none focus:border-[#78000b] focus:ring-1 focus:ring-[#78000b]/20 transition leading-relaxed"></textarea>
            </div>

            <!-- Submit Button & Disclaimer -->
            <div class="pt-2">
                <button type="submit" id="submitReviewBtn" class="w-full h-12 rounded-full bg-[#78000b] text-white font-bold uppercase tracking-[0.15em] text-xs shadow-md hover:bg-[#5a0309] hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer">
                    <span id="submitBtnText" data-i18n-en="Publish to Atelier Guestbook" data-i18n-de="Im Atelier-Gästebuch Veröffentlichen">Publish to Atelier Guestbook</span>
                    <span id="submitBtnSpinner" class="hidden animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                </button>
                <p class="text-[0.62rem] text-[#8a7c74] text-center mt-2.5">
                    By submitting, you certify that this reflection represents an authentic personal experience with MEHAAJ.
                </p>
            </div>

        </form>

    </div>
</div>

<!-- Review Scripts -->
<script>
    const starLabels = {
        5: "★★★★★ (5/5) — Exceptional & Exquisite Craftsmanship",
        4: "★★★★☆ (4/5) — Very Good & Distinctive Quality",
        3: "★★★☆☆ (3/5) — Pleasing & Well Executed",
        2: "★★☆☆☆ (2/5) — Below Haute Maroquinerie Expectations",
        1: "★☆☆☆☆ (1/5) — Unsatisfactory Experience"
    };

    function updateStarsDisplay(rating) {
        document.getElementById('reviewRatingInput').value = rating;
        const stars = document.querySelectorAll('#interactiveStarPicker .star-btn');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.style.color = '#d8b45a';
                star.textContent = '★';
            } else {
                star.style.color = '#e6decb';
                star.textContent = '★';
            }
        });
        document.getElementById('starRatingLabel').textContent = starLabels[rating] || '';
    }

    // Initialize Interactive Star Picker
    document.querySelectorAll('#interactiveStarPicker .star-btn').forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-star'));
            updateStarsDisplay(rating);
        });
    });

    function openReviewModal() {
        const modal = document.getElementById('reviewModal');
        const container = document.getElementById('reviewModalContainer');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 20);
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        const container = document.getElementById('reviewModalContainer');
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 250);
    }

    // Close on click backdrop
    document.getElementById('reviewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReviewModal();
        }
    });

    // Auto open modal if URL has hash or parameter
    if (window.location.hash === '#write' || window.location.search.includes('action=write')) {
        setTimeout(openReviewModal, 300);
    }

    // AJAX Form Submission
    async function handleReviewSubmit(e) {
        e.preventDefault();

        const form = document.getElementById('patronReviewForm');
        const submitBtn = document.getElementById('submitReviewBtn');
        const btnText = document.getElementById('submitBtnText');
        const btnSpinner = document.getElementById('submitBtnSpinner');

        const name = document.getElementById('modalCustomerName').value.trim();
        const email = document.getElementById('modalCustomerEmail').value.trim();
        const location = document.getElementById('modalLocation').value.trim();
        const productId = document.getElementById('modalProductId').value;
        const title = document.getElementById('modalTitle').value.trim();
        const comment = document.getElementById('modalComment').value.trim();
        const rating = document.getElementById('reviewRatingInput').value;

        if (!name || !email || !comment || comment.length < 10) {
            if (window.LuxurySwal) {
                window.LuxurySwal.fire({
                    icon: 'warning',
                    title: 'Incomplete Submission',
                    text: 'Please provide your Full Name, Email, and a detailed review of at least 10 characters.'
                });
            } else {
                alert('Please provide your Full Name, Email, and a review of at least 10 characters.');
            }
            return;
        }

        // Show spinner
        submitBtn.disabled = true;
        btnText.classList.add('opacity-50');
        btnSpinner.classList.remove('hidden');

        try {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            const response = await fetch("{{ route('reviews.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token || "",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    customer_name: name,
                    customer_email: email,
                    location: location,
                    product_id: productId ? productId : null,
                    title: title,
                    comment: comment,
                    rating: rating
                })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                closeReviewModal();
                form.reset();
                updateStarsDisplay(5);

                if (window.LuxurySwal) {
                    window.LuxurySwal.fire({
                        icon: 'success',
                        title: 'Published to Atelier Guestbook! 🌟',
                        text: data.message || 'Thank you! Your verified review has been published directly to our atelier guestbook.',
                        confirmButtonText: 'Explore Guestbook',
                        confirmButtonColor: '#78000b'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    alert('Thank you! Your verified review has been published to our atelier guestbook.');
                    window.location.reload();
                }
            } else {
                throw new Error(data.message || 'Validation failed. Please verify your fields.');
            }
        } catch (err) {
            console.error(err);
            if (window.LuxurySwal) {
                window.LuxurySwal.fire({
                    icon: 'error',
                    title: 'Submission Error',
                    text: err.message || 'Could not record review. Please try again or contact concierge.'
                });
            } else {
                alert(err.message || 'Could not record review. Please try again.');
            }
        } finally {
            submitBtn.disabled = false;
            btnText.classList.remove('opacity-50');
            btnSpinner.classList.add('hidden');
        }
    }
</script>
@endsection

@extends('layouts.app')

@section('title', 'Client Reviews & Testimonials - MEHAAJ Atelier')

@section('content')
<div class="min-h-screen bg-[#faf7f2] py-12 lg:py-16 text-[#241a17]">
    <div class="luxury-container space-y-12">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-[#8a7c74]" aria-label="Breadcrumb">
            <a href="/" class="hover:text-[#78000b] transition" data-i18n-en="Home" data-i18n-de="Startseite">Home</a>
            <span>/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-en="Client Reviews" data-i18n-de="Kundenbewertungen">Client Reviews</span>
        </nav>

        <!-- Hero Header -->
        <div class="border-b border-[#e6decb] pb-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-[#78000b]/20 bg-[#78000b]/5 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#78000b]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                    <span data-i18n-en="VERIFIED ATELIER EXPERIENCES" data-i18n-de="VERIFIZIERTE ATELIER ERFAHRUNGEN">VERIFIED ATELIER EXPERIENCES</span>
                </div>
                <h1 class="mt-3 font-display text-3xl sm:text-4xl lg:text-5xl font-medium text-[#1c1210]" data-i18n-en="Client Reviews & Testimonials" data-i18n-de="Kundenbewertungen & Erfahrungen">
                    Client Reviews & Testimonials
                </h1>
                <p class="mt-2 text-xs sm:text-sm text-[#685c54] max-w-2xl leading-relaxed" data-i18n-en="Read genuine impressions from collectors and patrons across Europe regarding our bespoke craftsmanship, packaging and concierge delivery." data-i18n-de="Lesen Sie echte Eindrücke von Sammlern und Kunden aus ganz Europa zu unserer Handwerkskunst, Verpackung und Lieferung.">
                    Read genuine impressions from collectors and patrons across Europe regarding our bespoke craftsmanship, packaging and concierge delivery.
                </p>
            </div>

            <div>
                <button type="button" onclick="openReviewModal()" class="inline-flex items-center gap-2 rounded-sm bg-[#78000b] px-6 py-3.5 text-xs font-bold uppercase tracking-[0.14em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-lg cursor-pointer">
                    <svg class="h-4 w-4 text-[#ffd45a]" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <span data-i18n-en="Write a Review" data-i18n-de="Bewertung Abgeben">Write a Review</span>
                </button>
            </div>
        </div>

        <!-- Rating Overview Statistics -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 bg-white rounded-md border border-[#e6decb] p-6 sm:p-8 shadow-xs">
            
            <!-- Left Score (4 cols) -->
            <div class="lg:col-span-4 flex flex-col justify-center items-center text-center border-b lg:border-b-0 lg:border-r border-[#f2ebdc] pb-6 lg:pb-0 lg:pr-8">
                <span class="font-display text-6xl font-bold text-[#1c1210]">{{ number_format($avgRating, 1) }}</span>
                <div class="flex items-center text-[#d8b45a] text-lg my-2 tracking-widest">
                    ★ ★ ★ ★ ★
                </div>
                <p class="text-xs font-semibold text-[#685c54]">
                    <span data-i18n-en="Based on" data-i18n-de="Basierend auf">Based on</span> <strong class="text-[#1c1210]">{{ $totalCount }}</strong> <span data-i18n-en="verified client reviews" data-i18n-de="verifizierten Kundenbewertungen">verified client reviews</span>
                </p>
                <div class="mt-4 inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[0.65rem] font-bold uppercase tracking-wider">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                    <span data-i18n-en="100% Verified Purchases" data-i18n-de="100% Verifizierte Käufe">100% Verified Purchases</span>
                </div>
            </div>

            <!-- Right Breakdown Bars (8 cols) -->
            <div class="lg:col-span-8 flex flex-col justify-center space-y-2.5">
                @for($star = 5; $star >= 1; $star--)
                    @php
                        $count = $ratingCounts[$star] ?? 0;
                        $pct = $totalCount > 0 ? round(($count / $totalCount) * 100) : 0;
                    @endphp
                    <div class="flex items-center gap-3 text-xs">
                        <span class="w-14 font-semibold text-[#1c1210] flex items-center gap-1">
                            {{ $star }} <span class="text-[#d8b45a]">★</span>
                        </span>
                        <div class="flex-1 h-2.5 rounded-full bg-[#f2ebdc] overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#d8b45a] to-[#78000b] transition-all duration-500" style="width: {{ $pct }}%;"></div>
                        </div>
                        <span class="w-12 text-right font-mono text-[#8a7c74] text-[0.7rem]">{{ $count }} ({{ $pct }}%)</span>
                    </div>
                @endfor
            </div>

        </div>

        <!-- Filter Bar -->
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-[#e6decb] pb-4">
            <div class="flex items-center gap-2">
                <a href="{{ route('reviews.index') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ !request('rating') ? 'bg-[#78000b] text-white' : 'bg-white border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                    <span data-i18n-en="All Reviews" data-i18n-de="Alle Bewertungen">All Reviews</span> ({{ $totalCount }})
                </a>
                <a href="{{ route('reviews.index', ['rating' => 5]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ request('rating') == '5' ? 'bg-[#78000b] text-white' : 'bg-white border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                    5 ★ ({{ $ratingCounts[5] ?? 0 }})
                </a>
                <a href="{{ route('reviews.index', ['rating' => 4]) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition {{ request('rating') == '4' ? 'bg-[#78000b] text-white' : 'bg-white border border-[#e6decb] text-[#685c54] hover:border-[#78000b]' }}">
                    4 ★ ({{ $ratingCounts[4] ?? 0 }})
                </a>
            </div>

            <span class="text-xs text-[#8a7c74]">
                <span data-i18n-en="Showing" data-i18n-de="Zeigt">Showing</span> {{ $reviews->count() }} <span data-i18n-en="reviews" data-i18n-de="Bewertungen">reviews</span>
            </span>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reviews as $rev)
                <div class="bg-white rounded-md border border-[#e6decb] p-6 shadow-xs flex flex-col justify-between hover:shadow-md transition duration-300">
                    <div>
                        <!-- Header: Stars & Verified Badge -->
                        <div class="flex items-center justify-between gap-2 border-b border-[#f2ebdc] pb-3">
                            <div class="flex items-center text-[#d8b45a] text-sm tracking-wider">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $rev->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <span class="inline-flex items-center gap-1 text-[0.6rem] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                ✓ <span data-i18n-en="Verified Buyer" data-i18n-de="Verifizierter Käufer">Verified Buyer</span>
                            </span>
                        </div>

                        <!-- Review Title -->
                        @if($rev->title)
                            <h3 class="mt-3.5 font-display text-base font-bold text-[#1c1210] leading-snug">
                                "{{ $rev->title }}"
                            </h3>
                        @endif

                        <!-- Review Body -->
                        <p class="mt-2 text-xs leading-relaxed text-[#544840]">
                            {{ $rev->comment }}
                        </p>

                        <!-- Product Link if present -->
                        @if($rev->product)
                            <div class="mt-4 pt-3 border-t border-[#f2ebdc] flex items-center gap-2.5">
                                @if($rev->product->image)
                                    <img src="{{ asset('storage/' . $rev->product->image) }}" alt="{{ $rev->product->name }}" class="h-8 w-8 rounded object-cover border border-[#e6decb]">
                                @endif
                                <a href="/shop/{{ $rev->product->slug }}" class="text-[0.68rem] font-bold text-[#78000b] hover:underline truncate">
                                    {{ $rev->product->name }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Reviewer Details & Location -->
                    <div class="mt-5 pt-3 border-t border-[#f2ebdc] flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-[#1c1210] text-[0.78rem]">{{ $rev->customer_name }}</p>
                            @if($rev->location)
                                <p class="text-[0.65rem] text-[#8a7c74]">📍 {{ $rev->location }}</p>
                            @endif
                        </div>
                        <span class="text-[0.65rem] text-[#8a7c74]">
                            {{ $rev->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-[#8a7c74] text-xs">
                    <p class="font-display text-xl text-[#1c1210]" data-i18n-en="No reviews found for this selection." data-i18n-de="Keine Bewertungen für diese Auswahl gefunden.">No reviews found for this selection.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
            <div class="pt-6 border-t border-[#e6decb] flex justify-center">
                {{ $reviews->links() }}
            </div>
        @endif

    </div>
</div>

<!-- Review Modal Component -->
<script>
    function openReviewModal() {
        const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'en') === 'en';
        
        let productsOptions = `<option value="">${isEn ? 'General Atelier Experience' : 'Allgemeine Atelier-Erfahrung'}</option>`;
        @foreach($products as $prod)
            productsOptions += `<option value="{{ $prod->id }}">{{ addslashes($prod->name) }}</option>`;
        @endforeach

        LuxurySwal.fire({
            title: isEn ? 'Submit Verified Review' : 'Bewertung Abgeben',
            html: `
                <div class="text-left space-y-3.5 text-xs text-[#241a17] mt-3">
                    <div>
                        <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Your Overall Rating *' : 'Ihre Gesamtbewertung *'}</label>
                        <select id="review-rating" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b] font-bold text-[#d8b45a]">
                            <option value="5">★★★★★ (5 Stars - Exceptional)</option>
                            <option value="4">★★★★☆ (4 Stars - Very Good)</option>
                            <option value="3">★★★☆☆ (3 Stars - Average)</option>
                            <option value="2">★★☆☆☆ (2 Stars - Below Expectations)</option>
                            <option value="1">★☆☆☆☆ (1 Star - Poor)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Your Full Name *' : 'Ihr Vollständiger Name *'}</label>
                            <input id="review-name" type="text" placeholder="e.g. Dr. Sophia Lindner" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]">
                        </div>
                        <div>
                            <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Email Address *' : 'E-Mail Adresse *'}</label>
                            <input id="review-email" type="email" placeholder="sophia@example.com" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'City / Location' : 'Stadt / Standort'}</label>
                            <input id="review-location" type="text" placeholder="e.g. Munich, Germany" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]">
                        </div>
                        <div>
                            <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Product Reviewed' : 'Bewertetes Produkt'}</label>
                            <select id="review-product" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]">
                                ${productsOptions}
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Review Headline / Title' : 'Titel der Bewertung'}</label>
                        <input id="review-title" type="text" placeholder="e.g. Unrivaled horological execution" class="w-full h-10 px-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]">
                    </div>

                    <div>
                        <label class="block font-bold text-[#1c1210] mb-1">${isEn ? 'Your Experience / Comments *' : 'Ihr Erfahrungsbericht *'}</label>
                        <textarea id="review-comment" rows="3" placeholder="${isEn ? 'Describe the craftsmanship, delivery and packaging...' : 'Beschreiben Sie die Handwerkskunst, Lieferung und Verpackung...'}" class="w-full p-3 rounded border border-[#e6decb] bg-white outline-none focus:border-[#78000b]"></textarea>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: isEn ? 'Submit Review' : 'Bewertung Absenden',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            focusConfirm: false,
            preConfirm: () => {
                const name = document.getElementById('review-name').value.trim();
                const email = document.getElementById('review-email').value.trim();
                const comment = document.getElementById('review-comment').value.trim();
                const rating = document.getElementById('review-rating').value;
                const location = document.getElementById('review-location').value.trim();
                const title = document.getElementById('review-title').value.trim();
                const productId = document.getElementById('review-product').value;

                if (!name || !email || !comment) {
                    Swal.showValidationMessage(isEn ? 'Please fill in Name, Email and Comment.' : 'Bitte füllen Sie Name, E-Mail und Kommentar aus.');
                    return false;
                }

                return {
                    customer_name: name,
                    customer_email: email,
                    comment: comment,
                    rating: rating,
                    location: location,
                    title: title,
                    product_id: productId ? productId : null
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                fetch('{{ route('reviews.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(result.value)
                })
                .then(res => res.json())
                .then(data => {
                    LuxurySwal.fire({
                        icon: 'success',
                        title: isEn ? 'Thank you for your review! 🌟' : 'Vielen Dank für Ihre Bewertung! 🌟',
                        text: isEn ? 'Your verified feedback has been published to our atelier journal.' : 'Ihr verifiziertes Feedback wurde veröffentlicht.',
                        confirmButtonText: isEn ? 'Continue' : 'Weiter'
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch(err => {
                    console.error(err);
                    LuxuryToast.fire({
                        icon: 'error',
                        title: isEn ? 'Could not submit review.' : 'Bewertung konnte nicht gesendet werden.'
                    });
                });
            }
        });
    }
</script>
@endsection

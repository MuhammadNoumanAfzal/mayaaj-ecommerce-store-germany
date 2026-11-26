@extends('layouts.app')
@section('title', 'Exclusive Deals & Curated Bundles | MEHAAJ® Official Maison')
@section('meta_description', 'Discover curated luxury sets and limited-time bundle promotions. Handcrafted leather goods paired together with exclusive savings.')

@section('content')
<div class="min-h-screen bg-[#faf7f2] text-[#1c1210] py-8 sm:py-12">

    <div class="luxury-container">

        <!-- Breadcrumb Navigation -->
        <nav class="mb-5 flex items-center gap-2 text-xs text-[#685c54]">
            <a href="{{ url('/') }}" class="hover:text-[#78000b] transition" data-i18n-de="Startseite" data-i18n-en="Home">Startseite</a>
            <span class="text-[#c5baaa]">/</span>
            <span class="text-[#1c1210] font-semibold" data-i18n-de="Angebote & Bundles" data-i18n-en="Deals & Bundles">Angebote & Bundles</span>
        </nav>

        <!-- Luxury Hero Banner -->
        <div class="relative overflow-hidden rounded-2xl bg-[#1c1210] p-8 sm:p-12 text-white shadow-xl mb-10 border border-[#42332c]">
            <div class="relative z-10 max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full bg-[#78000b] px-3 py-1 text-[0.65rem] font-bold uppercase tracking-[0.2em] text-white">
                    <span class="h-1.5 w-1.5 rounded-full bg-white animate-ping"></span>
                    <span data-i18n-de="KURATIERTE ATELIER SETS" data-i18n-en="CURATED ATELIER SETS">KURATIERTE ATELIER SETS</span>
                </div>
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-medium tracking-tight" data-i18n-de="Kombinieren & Sparen" data-i18n-en="Curated Pairings & Savings">
                    Kombinieren & Sparen
                </h1>
                <p class="text-xs sm:text-sm text-[#e0d6cb] leading-relaxed max-w-xl" data-i18n-de="Perfekt aufeinander abgestimmte Leder-Kreationen zu exklusiven Vorzugspreisen. Handgefertigt in meisterhafter Atelier-Tradition." data-i18n-en="Masterfully paired handcrafted leather creations at exclusive bundle rates. Complete your ensemble with significant savings.">
                    Perfekt aufeinander abgestimmte Leder-Kreationen zu exklusiven Vorzugspreisen. Handgefertigt in meisterhafter Atelier-Tradition.
                </p>
            </div>
            <!-- Decorative Accent -->
            <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-[#78000b]/20 blur-3xl pointer-events-none"></div>
        </div>

        @if($deals->isEmpty())
            <!-- Empty State -->
            <div class="py-16 text-center rounded-2xl bg-white border border-[#e6decb] p-8 max-w-md mx-auto space-y-3 shadow-2xs">
                <div class="w-14 h-14 rounded-2xl bg-[#faf7f2] border border-[#e6decb] mx-auto flex items-center justify-center text-[#78000b]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <h3 class="font-display text-lg font-bold" data-i18n-de="Aktuell keine aktiven Bundles" data-i18n-en="No Active Deals at the Moment">
                    Aktuell keine aktiven Bundles
                </h3>
                <p class="text-xs text-[#685c54]" data-i18n-de="Besuchen Sie unsere Kollektion für handgefertigte Einzelstücke." data-i18n-en="Explore our collection for individual master-crafted leather pieces.">
                    Besuchen Sie unsere Kollektion für handgefertigte Einzelstücke.
                </p>
                <a href="{{ route('shop') }}" class="btn-primary inline-flex items-center gap-2 mt-2">
                    <span data-i18n-de="Zur Kollektion" data-i18n-en="Explore Collection">Zur Kollektion</span>
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                </a>
            </div>
        @else
            <!-- Deals Grid -->
            <div class="space-y-12">
                @foreach($deals as $deal)
                    <div class="rounded-2xl border border-[#e6decb] bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                        
                        <!-- Bundle Header Strip -->
                        <div class="bg-[#f7f3eb] border-b border-[#e6decb] px-6 py-4 flex flex-wrap items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5">
                                <span class="px-3 py-1 rounded-full text-[0.62rem] font-extrabold uppercase tracking-widest bg-[#78000b] text-white">
                                    {{ $deal->formatted_badge }}
                                </span>
                                @if($deal->is_flash)
                                    <div class="inline-flex items-center gap-1 text-[0.68rem] font-bold text-[#b45309] bg-amber-50 border border-amber-200 px-2.5 py-0.5 rounded-full" id="timer-box-{{ $deal->id }}">
                                        <svg class="w-3.5 h-3.5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span data-ends-at="{{ $deal->ends_at->toISOString() }}" class="countdown-span">Endet bald</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Savings Pill -->
                            @if($deal->savings_amount > 0)
                                <div class="text-xs font-bold text-[#2e683a] bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-lg">
                                    <span data-i18n-de="Sie sparen:" data-i18n-en="You Save:">Sie sparen:</span>
                                    <span class="font-extrabold">{{ number_format($deal->savings_amount, 2, ',', '.') }} € ({{ $deal->savings_percentage }}%)</span>
                                </div>
                            @endif
                        </div>

                        <!-- Bundle Content: Products & Call-to-Action -->
                        <div class="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                            
                            <!-- Left: Bundled Items Visual Row (8 Cols) -->
                            <div class="lg:col-span-8">
                                <div class="mb-4">
                                    <h2 class="font-display text-xl sm:text-2xl font-medium text-[#1c1210]">
                                        {{ $deal->title }}
                                    </h2>
                                    @if($deal->description)
                                        <p class="text-xs text-[#685c54] mt-1 line-clamp-2">{{ $deal->description }}</p>
                                    @endif
                                </div>

                                <!-- Products Flow (Card + Plus Sign + Card) -->
                                <div class="flex flex-wrap sm:flex-nowrap items-center gap-3 overflow-x-auto pb-2">
                                    @foreach($deal->products as $pIdx => $product)
                                        <div class="flex-1 min-w-[200px] p-3.5 rounded-xl border border-[#e6decb] bg-[#faf7f2] flex items-center gap-3">
                                            <a href="{{ route('shop.show', $product->slug) }}" class="shrink-0">
                                                <img
                                                    src="{{ $product->image_url }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-16 h-16 rounded-lg border border-[#e6decb] object-cover bg-white shadow-2xs hover:scale-105 transition-transform"
                                                >
                                            </a>
                                            <div class="flex-1 min-w-0">
                                                <span class="text-[0.6rem] font-mono text-[#8a7c74] block">{{ $product->sku ?? 'MHJ' }}</span>
                                                <a href="{{ route('shop.show', $product->slug) }}" class="font-display text-xs font-medium text-[#1c1210] hover:text-[#78000b] truncate block">
                                                    {{ $product->name }}
                                                </a>
                                                <div class="mt-1 flex items-baseline gap-1.5">
                                                    <span class="text-xs font-bold text-[#1c1210]">
                                                        {{ number_format(($product->sale_price ?: $product->price), 2, ',', '.') }} €
                                                    </span>
                                                    @if($product->sale_price && $product->sale_price < $product->price)
                                                        <span class="text-[0.62rem] text-stone-400 line-through">
                                                            {{ number_format($product->price, 2, ',', '.') }} €
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        @if(!$loop->last)
                                            <div class="h-8 w-8 rounded-full bg-[#1c1210] text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                                                +
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right: Pricing Box & Action (4 Cols) -->
                            <div class="lg:col-span-4 rounded-xl border border-[#e6decb] bg-[#faf7f2] p-5 space-y-4">
                                <div class="border-b border-[#e6decb] pb-3">
                                    <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#685c54] block">
                                        Paket-Gesamtpreis
                                    </span>
                                    <div class="flex items-baseline gap-2 mt-1">
                                        <span class="font-display text-2xl sm:text-3xl font-bold text-[#78000b]">
                                            EUR {{ number_format($deal->bundle_price, 2, ',', '.') }}
                                        </span>
                                        <span class="text-xs text-[#8a7c74] line-through">
                                            EUR {{ number_format($deal->regular_total, 2, ',', '.') }}
                                        </span>
                                    </div>
                                    <p class="text-[0.65rem] text-[#685c54] mt-0.5">Inkl. 19% MwSt. & kostenloser Expressversand</p>
                                </div>

                                <button
                                    type="button"
                                    onclick="addBundleToBag({{ $deal->id }}, this)"
                                    class="w-full h-11 flex items-center justify-center gap-2 rounded-lg bg-[#78000b] hover:bg-[#5a0309] text-white text-xs font-bold uppercase tracking-[0.14em] shadow-md transition-all active:scale-95 cursor-pointer"
                                >
                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                    <span data-i18n-de="SET IN DEN WARENKORB" data-i18n-en="ADD SET TO BAG">SET IN DEN WARENKORB</span>
                                </button>

                                <div class="flex items-center justify-center gap-3 text-[0.62rem] text-[#685c54]">
                                    <span>✓ Sofort lieferbar</span>
                                    <span>•</span>
                                    <span>30 Tage Rückgaberecht</span>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>

</div>

<script>
    function addBundleToBag(dealId, btnEl) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const origContent = btnEl.innerHTML;
        btnEl.disabled = true;
        btnEl.innerHTML = '<span class="animate-pulse">Wird hinzugefügt...</span>';

        fetch(window.mehaajUrl('/cart/add-bundle'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ deal_id: dealId })
        })
        .then(res => res.json())
        .then(data => {
            btnEl.disabled = false;
            btnEl.innerHTML = origContent;

            if (data.success) {
                if (typeof openCartDrawer === 'function') {
                    openCartDrawer();
                    if (typeof fetchAndUpdateCartDrawer === 'function') fetchAndUpdateCartDrawer(false);
                }
                LuxuryToast.fire({
                    icon: 'success',
                    title: data.message
                });
            } else {
                LuxurySwal.fire({
                    icon: 'error',
                    title: 'Bundle konnte nicht hinzugefügt werden',
                    text: data.message
                });
            }
        })
        .catch(err => {
            btnEl.disabled = false;
            btnEl.innerHTML = origContent;
            LuxurySwal.fire({
                icon: 'error',
                title: 'Netzwerkfehler',
                text: 'Bitte versuchen Sie es erneut.'
            });
        });
    }

    // Live Countdown Timers for Flash Deals
    document.addEventListener('DOMContentLoaded', function() {
        const countdowns = document.querySelectorAll('.countdown-span');
        if (countdowns.length === 0) return;

        function updateTimers() {
            const now = new Date().getTime();
            countdowns.forEach(el => {
                const target = new Date(el.dataset.endsAt).getTime();
                const diff = target - now;

                if (diff <= 0) {
                    el.innerText = 'Angebot beendet';
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const secs = Math.floor((diff % (1000 * 60)) / 1000);

                if (days > 0) {
                    el.innerText = `Endet in: ${days}T ${hours}h ${mins}m`;
                } else {
                    el.innerText = `Endet in: ${hours.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
                }
            });
        }

        updateTimers();
        setInterval(updateTimers, 1000);
    });
</script>
@endsection

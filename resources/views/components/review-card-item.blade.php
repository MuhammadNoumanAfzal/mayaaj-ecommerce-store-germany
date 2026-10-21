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

<article 
    class="flex-shrink-0 relative rounded-2xl border border-[#e6decb] bg-white p-5 shadow-[0_4px_20px_rgba(28,18,16,0.04)] transition-all duration-300 hover:border-[#d8b45a]/80 hover:shadow-[0_12px_32px_rgba(120,0,11,0.08)] hover:-translate-y-1 flex flex-col justify-between select-none"
    style="width: 310px; min-width: 310px; max-width: 310px; min-height: 215px; box-sizing: border-box;"
>
    <div class="relative z-10 space-y-2.5">
        <!-- Top Row: Rating Stars & Verified Pill -->
        <div class="flex items-center justify-between gap-2">
            <div class="flex items-center text-[#d8b45a] text-sm tracking-tight">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $review->rating)
                        <span>★</span>
                    @else
                        <span class="text-[#e6decb]">★</span>
                    @endif
                @endfor
                <span class="ml-1.5 text-xs font-bold text-[#1c1210]">{{ number_format($review->rating, 1) }}</span>
            </div>

            @if($review->is_verified)
                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[0.6rem] font-bold text-emerald-800 border border-emerald-200 shrink-0">
                    <svg class="h-2.5 w-2.5 text-emerald-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    <span data-i18n-en="Verified Buyer" data-i18n-de="Verifizierter Käufer">Verified Buyer</span>
                </span>
            @endif
        </div>

        <!-- Headline / Title -->
        @if($review->title)
            <h3 class="font-display text-sm font-semibold text-[#1c1210] leading-snug line-clamp-1" title="{{ $review->title }}">
                {{ $review->title }}
            </h3>
        @endif

        <!-- Review Body -->
        <p class="text-xs text-[#544840] leading-relaxed italic line-clamp-3 font-light">
            “{{ $review->comment }}”
        </p>
    </div>

    <!-- Bottom Author Section -->
    <div class="relative z-10 mt-4 pt-3 border-t border-[#f2ebdc] flex items-center justify-between gap-2.5 text-xs">
        <div class="flex items-center gap-2.5 min-w-0">
            <!-- Monogram Initial Avatar -->
            <div class="h-7 w-7 rounded-full bg-gradient-to-br from-[#78000b] to-[#450207] text-[#ffd45a] flex items-center justify-center font-display text-[0.62rem] font-bold tracking-wider shadow-2xs flex-shrink-0 border border-[#d8b45a]/30">
                {{ $initials }}
            </div>
            <div class="min-w-0 truncate">
                <p class="font-semibold text-[#1c1210] text-xs leading-none truncate">{{ $review->customer_name }}</p>
                @if($review->location)
                    <p class="text-[0.62rem] text-[#8a7c74] mt-1 flex items-center gap-0.5 truncate">
                        <span>📍</span> {{ $review->location }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Attached Product Tag Link -->
        @if($review->product)
            <a href="{{ route('shop.show', $review->product->slug) }}" class="flex-shrink-0 text-[0.6rem] font-semibold text-[#78000b] bg-[#78000b]/8 hover:bg-[#78000b] hover:text-white px-2.5 py-1 rounded-full transition-all duration-200 border border-[#78000b]/15 max-w-[110px] truncate" title="{{ $review->product->name }}">
                {{ $review->product->name }}
            </a>
        @endif
    </div>
</article>

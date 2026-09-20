@props(['product'])

<article class="luxury-panel group h-full overflow-hidden p-2 transition duration-500 hover:border-champagne/28">
    <div class="relative aspect-[4/5] overflow-hidden bg-[#2a1a15]">
        <img
            src="{{ $product['image'] }}"
            alt="{{ $product['name'] }}"
            class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035]"
            loading="lazy"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-espresso/36 via-transparent to-transparent opacity-80"></div>
        <button class="absolute right-4 top-4 inline-flex h-9 w-9 items-center justify-center border border-champagne/20 bg-espresso/72 text-ivory transition duration-300 hover:border-champagne/70 hover:text-champagne" type="button" aria-label="{{ $product['name'] }} zur Wunschliste hinzufügen">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.35" aria-hidden="true">
                <path d="M12 20s-7-4.3-7-10a4 4 0 0 1 7-2.7A4 4 0 0 1 19 10c0 5.7-7 10-7 10Z" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <div class="px-3 pb-4 pt-5">
        <p class="mb-2 text-[0.66rem] font-semibold uppercase tracking-luxury text-champagne/78">{{ $product['category'] }}</p>
        <div class="flex items-start justify-between gap-4">
            <h3 class="font-display text-2xl font-medium leading-tight text-ivory">{{ $product['name'] }}</h3>
            <p class="shrink-0 pt-1 text-sm font-medium text-ivory/78">{{ $product['price'] }}</p>
        </div>
    </div>
</article>

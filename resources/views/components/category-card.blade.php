@props(['category'])

<a href="#" class="group block h-full">
    <div class="luxury-panel relative h-full overflow-hidden p-2 transition duration-500 hover:border-champagne/28">
        <div class="relative aspect-[5/6] overflow-hidden bg-espresso sm:aspect-[4/5]">
            <img
                src="{{ $category['image'] }}"
                alt="{{ $category['title'] }}"
                class="h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                loading="lazy"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-espresso/82 via-espresso/16 to-transparent"></div>
            <div class="absolute left-5 top-5 h-8 w-px bg-champagne/70"></div>
            <div class="absolute inset-x-0 bottom-0 p-5 sm:p-6">
                <p class="text-[0.66rem] font-semibold uppercase tracking-luxury text-champagne/90">MEHAAJ</p>
                <h3 class="mt-2 font-display text-3xl font-medium text-ivory sm:text-4xl">{{ $category['title'] }}</h3>
            </div>
        </div>
    </div>
</a>

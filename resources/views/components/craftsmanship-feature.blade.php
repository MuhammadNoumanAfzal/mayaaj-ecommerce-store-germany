@props(['title', 'text', 'icon'])

<article class="border-t border-charcoal/14 pt-7">
    <div class="mb-8 text-burgundy">
        @if ($icon === 'leather')
            <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                <path d="M8 25c6-2 13-2 16 0 2-6 1-13-3-18-3 2-7 2-10 0-4 5-5 12-3 18Z" />
                <path d="M12 13c2 1 6 1 8 0M11 18c3 1.2 7 1.2 10 0" stroke-linecap="round" />
            </svg>
        @elseif ($icon === 'design')
            <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                <path d="M8 8h16v16H8z" />
                <path d="M12 12h8v8h-8zM8 16h4M20 16h4M16 8v4M16 20v4" />
            </svg>
        @else
            <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                <circle cx="16" cy="16" r="9" />
                <path d="M16 9v7l4 3" stroke-linecap="round" />
            </svg>
        @endif
    </div>
    <h3 class="font-display text-3xl font-medium text-charcoal">{{ $title }}</h3>
    <p class="mt-4 max-w-sm text-sm leading-7 text-charcoal/66">{{ $text }}</p>
</article>

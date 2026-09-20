@props(['eyebrow' => null, 'heading', 'subheading' => null, 'align' => 'center', 'tone' => 'light'])

@php
    $isDark = $tone === 'dark';
    $wrapClass = $align === 'left' ? 'max-w-3xl' : 'mx-auto max-w-3xl text-center';
    $eyebrowClass = $isDark ? 'text-champagne/85' : 'text-burgundy';
    $headingClass = $isDark ? 'text-ivory' : 'text-charcoal';
    $subheadingClass = $isDark ? 'text-ivory/68' : 'text-charcoal/65';
@endphp

<div {{ $attributes->merge(['class' => $wrapClass]) }}>
    @if ($eyebrow)
        <p class="mb-4 text-[0.7rem] font-medium uppercase tracking-luxury {{ $eyebrowClass }}">{{ $eyebrow }}</p>
    @endif
    <h2 class="font-display text-4xl font-medium leading-tight {{ $headingClass }} sm:text-5xl lg:text-6xl">{{ $heading }}</h2>
    @if ($subheading)
        <p class="mt-4 text-base leading-7 {{ $subheadingClass }} sm:text-lg">{{ $subheading }}</p>
    @endif
</div>

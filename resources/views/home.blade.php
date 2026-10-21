@extends('layouts.app')
@section('title', 'MEHAAJ® Official Maison | Luxury Fashion, Leather Craft & Haute Horlogerie')
@section('meta_description', 'Discover MEHAAJ: Haute Maroquinerie, genuine Italian leather bags, Swiss-inspired precision chronographs, and curated European fashion. Handcrafted in Europe with insured DHL Express shipping.')

@section('content')
    <!-- 1. Hero Grand Entrance Banner -->
    <x-hero />

    <!-- 2. Curated Categories Showcase -->
    <x-featured-categories />

    <!-- 3. Featured Masterpieces (8 Curated Products) -->
    <x-featured-products />

    <!-- 4. Bespoke Editorial Spotlight: The Maison Philosophy -->
    <x-editorial-spotlight />

    <!-- 5. Artisanal Craftsmanship & Leather Pillars -->
    <x-craft-heritage />

    <!-- 6. Verified European Patron Impressions & Reviews -->
    <x-luxury-reviews />

    <!-- 7. Maison Private Circle VIP Club -->
    <x-private-circle />
@endsection

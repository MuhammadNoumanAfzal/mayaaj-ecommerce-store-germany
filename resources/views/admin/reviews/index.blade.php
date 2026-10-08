@extends('layouts.admin')
@section('title', 'Customer Reviews Moderation - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-6 max-w-full overflow-hidden">

    <!-- Hero Header Banner (Pink-Salt Terracotta Gradient) -->
    <div class="rounded-2xl p-5 sm:p-7 bg-gradient-to-r from-[#964B42] to-[#803D35] shadow-sm text-white">
        <!-- Banner Top: Title & Description -->
        <div>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <span data-i18n-en="ATELIER REPUTATION & CURATION" data-i18n-de="ATELIER REPUTATION & BEWERTUNGEN">ATELIER REPUTATION & CURATION</span>
            </div>
            <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Customer Reviews & Moderation" data-i18n-de="Kundenbewertungen & Freigabe">
                Customer Reviews & Moderation
            </h1>
            <p class="mt-1.5 text-xs sm:text-sm text-rose-100 max-w-2xl leading-relaxed" data-i18n-en="Moderate customer reviews. Click Detail on any entry to inspect client ratings, title, and full comments." data-i18n-de="Verwalten Sie Kundenbewertungen. Klicken Sie auf Detail, um Bewertung, Titel und den vollständigen Kommentar einzusehen.">
                Moderate customer reviews. Click Detail on any entry to inspect client ratings, title, and full comments.
            </p>
        </div>

        <!-- Metric KPI Cards (100% Fluid Responsive Grid) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-white/20">
            
            <!-- Pending Card -->
            <a href="{{ route('admin.reviews', ['status' => 'pending']) }}" class="bg-white/10 hover:bg-white/20 transition-all backdrop-blur-md rounded-xl p-3 sm:p-4 border {{ $pendingCount > 0 ? 'border-amber-300 ring-2 ring-amber-400/40 bg-amber-500/15' : 'border-white/20' }} text-center flex flex-col justify-center">
                <div class="flex items-center justify-center gap-1.5">
                    @if($pendingCount > 0)
                        <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                    @endif
                    <span class="block text-2xl sm:text-3xl font-bold font-serif text-white">{{ $pendingCount }}</span>
                </div>
                <span class="text-[0.65rem] sm:text-xs font-bold text-amber-200 uppercase tracking-wider block mt-1" data-i18n-en="Pending" data-i18n-de="Ausstehend">Pending</span>
            </a>

            <!-- Approved Card -->
            <a href="{{ route('admin.reviews', ['status' => 'approved']) }}" class="bg-white/10 hover:bg-white/20 transition-all backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-emerald-300">{{ $approvedCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1" data-i18n-en="Approved" data-i18n-de="Freigegeben">Approved</span>
            </a>

            <!-- Rejected Card -->
            <a href="{{ route('admin.reviews', ['status' => 'rejected']) }}" class="bg-white/10 hover:bg-white/20 transition-all backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-rose-300">{{ $rejectedCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1" data-i18n-en="Rejected" data-i18n-de="Abgelehnt">Rejected</span>
            </a>

            <!-- Live Average Rating Card -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <div class="flex items-center justify-center gap-1 text-[#ffd45a]">
                    <span class="text-2xl sm:text-3xl font-bold font-serif text-white">{{ number_format($avgApprovedRating, 1) }}</span>
                    <span class="text-base sm:text-lg">★</span>
                </div>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1" data-i18n-en="Live Avg" data-i18n-de="Live Schnitt">Live Avg</span>
            </div>

        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Control Bar (Filter Pills & Search/Rating) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-4 sm:p-5 shadow-xs space-y-4">
        
        <!-- Quick Status Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 border-b border-stone-200/60 pb-3.5">
            <a href="{{ route('admin.reviews') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ !request('status') || request('status') === 'all' ? 'bg-[#964B42] text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                <span data-i18n-en="All Reviews" data-i18n-de="Alle Bewertungen">All Reviews</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ !request('status') || request('status') === 'all' ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-700' }}">{{ $totalCount }}</span>
            </a>

            <a href="{{ route('admin.reviews', array_merge(request()->query(), ['status' => 'pending'])) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('status') === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100' }}">
                <svg class="h-3 w-3 {{ request('status') === 'pending' ? 'text-white' : 'text-amber-600' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span data-i18n-en="Pending Approval" data-i18n-de="Ausstehend">Pending Approval</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('status') === 'pending' ? 'bg-white/20 text-white' : 'bg-amber-200 text-amber-900' }}">{{ $pendingCount }}</span>
            </a>

            <a href="{{ route('admin.reviews', array_merge(request()->query(), ['status' => 'approved'])) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('status') === 'approved' ? 'bg-emerald-700 text-white shadow-xs' : 'bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-100' }}">
                <svg class="h-3 w-3 {{ request('status') === 'approved' ? 'text-white' : 'text-emerald-600' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                <span data-i18n-en="Approved (Live)" data-i18n-de="Freigegeben (Live)">Approved (Live)</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('status') === 'approved' ? 'bg-white/20 text-white' : 'bg-emerald-200 text-emerald-900' }}">{{ $approvedCount }}</span>
            </a>

            <a href="{{ route('admin.reviews', array_merge(request()->query(), ['status' => 'rejected'])) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('status') === 'rejected' ? 'bg-rose-700 text-white shadow-xs' : 'bg-rose-50 text-rose-800 border border-rose-200 hover:bg-rose-100' }}">
                <svg class="h-3 w-3 {{ request('status') === 'rejected' ? 'text-white' : 'text-rose-600' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                <span data-i18n-en="Rejected (Hidden)" data-i18n-de="Abgelehnt (Ausgeblendet)">Rejected (Hidden)</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('status') === 'rejected' ? 'bg-white/20 text-white' : 'bg-rose-200 text-rose-900' }}">{{ $rejectedCount }}</span>
            </a>
        </div>

        <!-- Search & Rating Form -->
        <form action="{{ route('admin.reviews') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch md:items-center justify-between">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div class="flex-1 relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by customer name, email, comment, or product..."
                    data-i18n-placeholder-en="Search by customer name, email, comment, or product..."
                    data-i18n-placeholder-de="Suche nach Kundenname, E-Mail, Text oder Produkt..."
                    class="w-full h-11 rounded-xl pl-10 pr-4 text-xs text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <div class="flex flex-wrap items-center gap-2 sm:gap-3 shrink-0">
                <select name="rating" onchange="this.form.submit()" class="h-11 rounded-xl px-3 sm:px-4 text-xs font-semibold text-stone-800 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white cursor-pointer shadow-2xs flex-1 sm:flex-none">
                    <option value="" data-i18n-en="All Star Ratings" data-i18n-de="Alle Sterne">All Star Ratings</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 ★ (Exceptional)</option>
                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 ★ (Very Good)</option>
                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 ★ (Good)</option>
                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 ★ (Fair)</option>
                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 ★ (Poor)</option>
                </select>

                <button type="submit" class="h-11 px-4 sm:px-5 rounded-xl text-xs font-semibold flex items-center justify-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span data-i18n-en="FILTER" data-i18n-de="FILTERN">FILTER</span>
                </button>

                @if(request('search') || request('rating') || (request('status') && request('status') !== 'all'))
                    <a href="{{ route('admin.reviews') }}" class="h-11 px-3 sm:px-4 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 transition" title="Clear Filters">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <span data-i18n-en="Reset" data-i18n-de="Zurücksetzen">Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Reviews Table Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        
        <!-- Table Header -->
        <div class="p-4 sm:p-5 bg-[#FBF6F4] flex flex-wrap items-center justify-between gap-3 border-b border-[#E5DED5]">
            <div>
                <h3 class="font-serif font-bold text-base text-stone-900" data-i18n-en="Atelier Client Reviews" data-i18n-de="Atelier Kundenbewertungen">
                    Atelier Client Reviews
                </h3>
                <p class="text-xs text-stone-500" data-i18n-en="Submitted reviews overview. Click Detail to view rating and comments." data-i18n-de="Klicken Sie auf Detail, um Bewertung und Volltext einzusehen.">
                    Submitted reviews overview. Click Detail to view rating and comments.
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                {{ $reviews->total() }} <span data-i18n-en="{{ $reviews->total() === 1 ? 'Review' : 'Reviews' }}" data-i18n-de="{{ $reviews->total() === 1 ? 'Bewertung' : 'Bewertungen' }}">{{ $reviews->total() === 1 ? 'Review' : 'Reviews' }}</span>
            </span>
        </div>

        @if($reviews->count() > 0)

            <!-- 1. DESKTOP VIEW: Clean 4-column table that fits 100% width with NO horizontal scroll -->
            <div class="hidden lg:block">
                <table class="w-full text-left border-collapse table-auto">
                    <thead>
                        <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                            <th class="px-4 py-3.5 w-44">ID & CLIENT</th>
                            <th class="px-4 py-3.5" data-i18n-en="PRODUCT" data-i18n-de="PRODUKT">PRODUCT</th>
                            <th class="px-4 py-3.5 w-36" data-i18n-en="STATUS" data-i18n-de="STATUS">STATUS</th>
                            <th class="px-4 py-3.5 text-right w-56" data-i18n-en="ACTIONS" data-i18n-de="AKTIONEN">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5DED5] text-xs">
                        @foreach($reviews as $rev)
                            @php
                                $modalData = [
                                    'id' => $rev->id,
                                    'customer_name' => $rev->customer_name,
                                    'customer_email' => $rev->customer_email,
                                    'location' => $rev->location,
                                    'rating' => $rev->rating,
                                    'title' => $rev->title,
                                    'comment' => $rev->comment,
                                    'status' => $rev->status,
                                    'is_verified' => $rev->is_verified,
                                    'date' => $rev->created_at ? $rev->created_at->format('d.m.Y H:i') : '—',
                                    'time_ago' => $rev->created_at ? $rev->created_at->diffForHumans() : '',
                                    'product_name' => $rev->product ? $rev->product->name : null,
                                    'product_image' => $rev->product ? $rev->product->image_url : null,
                                    'product_price' => $rev->product ? number_format($rev->product->price, 2, ',', '.') : null,
                                    'product_url' => $rev->product ? route('products.detail', $rev->product->slug) : null,
                                ];
                            @endphp
                            <tr id="review-row-desktop-{{ $rev->id }}" class="hover:bg-stone-50/70 transition-colors {{ $rev->status === 'pending' ? 'bg-amber-50/40' : '' }}">
                                
                                <!-- ID & Client -->
                                <td class="px-4 py-3.5 align-middle">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-mono text-xs font-bold text-stone-700">#{{ $rev->id }}</span>
                                        <span class="font-bold text-stone-900 text-xs truncate max-w-[150px]" title="{{ $rev->customer_name }}">{{ $rev->customer_name }}</span>
                                    </div>
                                    <div class="text-[0.68rem] text-stone-400 mt-0.5 whitespace-nowrap">
                                        {{ $rev->created_at ? $rev->created_at->format('d.m.Y H:i') : '—' }} ({{ $rev->created_at ? $rev->created_at->diffForHumans() : '' }})
                                    </div>
                                </td>

                                <!-- Product -->
                                <td class="px-4 py-3.5 align-middle">
                                    @if($rev->product)
                                        <div class="flex items-center gap-2.5">
                                            @if($rev->product->image_url)
                                                <img src="{{ $rev->product->image_url }}" alt="{{ $rev->product->name }}" class="h-9 w-9 rounded-lg object-cover border border-stone-200 shrink-0">
                                            @endif
                                            <div class="min-w-0">
                                                <a href="{{ route('products.detail', $rev->product->slug) }}" target="_blank" class="font-semibold text-stone-900 hover:text-[#964B42] transition truncate block max-w-[200px]" title="{{ $rev->product->name }}">
                                                    {{ $rev->product->name }}
                                                </a>
                                                <span class="text-[0.65rem] text-stone-400 font-mono block">EUR {{ number_format($rev->product->price, 2, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-[0.7rem] font-semibold text-stone-600 bg-stone-100 px-2.5 py-1 rounded-md border border-stone-200">
                                            <svg class="h-3 w-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                                            <span data-i18n-en="General Atelier Review" data-i18n-de="Allgemeine Bewertung">General Atelier Review</span>
                                        </span>
                                    @endif
                                </td>

                                <!-- Status Badge -->
                                <td class="px-4 py-3.5 align-middle whitespace-nowrap">
                                    @if($rev->status === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-2xs">
                                            <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                            <span data-i18n-en="Approved (Live)" data-i18n-de="Freigegeben (Live)">Approved (Live)</span>
                                        </span>
                                    @elseif($rev->status === 'rejected')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-800 border border-rose-200 shadow-2xs">
                                            <span class="h-2 w-2 rounded-full bg-rose-600"></span>
                                            <span data-i18n-en="Rejected (Hidden)" data-i18n-de="Abgelehnt (Ausgeblendet)">Rejected (Hidden)</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-300 shadow-2xs">
                                            <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span data-i18n-en="Pending Approval" data-i18n-de="Ausstehend">Pending Approval</span>
                                        </span>
                                    @endif
                                </td>

                                <!-- Moderation Actions (with Detail Button) -->
                                <td class="px-4 py-3.5 align-middle text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5 justify-end">
                                        
                                        <!-- Detail Button -->
                                        <button
                                            type="button"
                                            onclick='openReviewDetailModal(@json($modalData))'
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-stone-100 hover:bg-[#964B42] hover:text-white text-stone-700 px-3 py-1.5 text-xs font-bold transition shadow-2xs border border-stone-200 cursor-pointer"
                                            title="View Rating & Comment Details"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            <span data-i18n-en="Detail" data-i18n-de="Details">Detail</span>
                                        </button>

                                        <!-- Approve Button (if not approved) -->
                                        @if($rev->status !== 'approved')
                                            <button
                                                type="button"
                                                onclick="moderateReview({{ $rev->id }}, 'approved')"
                                                class="inline-flex items-center gap-1 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white px-2.5 py-1.5 text-xs font-bold transition shadow-2xs cursor-pointer"
                                                title="Approve Review"
                                            >
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                                <span data-i18n-en="Approve" data-i18n-de="Freigeben">Approve</span>
                                            </button>
                                        @endif

                                        <!-- Reject Button (if not rejected) -->
                                        @if($rev->status !== 'rejected')
                                            <button
                                                type="button"
                                                onclick="moderateReview({{ $rev->id }}, 'rejected')"
                                                class="inline-flex items-center gap-1 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-2.5 py-1.5 text-xs font-bold transition shadow-2xs cursor-pointer"
                                                title="Reject Review"
                                            >
                                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                                <span data-i18n-en="Reject" data-i18n-de="Ablehnen">Reject</span>
                                            </button>
                                        @endif

                                        <!-- Delete Button -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteReview({{ $rev->id }}, '{{ addslashes($rev->customer_name) }}')"
                                            class="p-1.5 rounded-lg text-stone-400 hover:text-rose-700 hover:bg-rose-50 transition cursor-pointer"
                                            title="Delete Review permanently"
                                        >
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- 2. MOBILE VIEW: Touch-friendly cards with Detail button -->
            <div class="block lg:hidden divide-y divide-[#E5DED5]">
                @foreach($reviews as $rev)
                    @php
                        $modalData = [
                            'id' => $rev->id,
                            'customer_name' => $rev->customer_name,
                            'customer_email' => $rev->customer_email,
                            'location' => $rev->location,
                            'rating' => $rev->rating,
                            'title' => $rev->title,
                            'comment' => $rev->comment,
                            'status' => $rev->status,
                            'is_verified' => $rev->is_verified,
                            'date' => $rev->created_at ? $rev->created_at->format('d.m.Y H:i') : '—',
                            'time_ago' => $rev->created_at ? $rev->created_at->diffForHumans() : '',
                            'product_name' => $rev->product ? $rev->product->name : null,
                            'product_image' => $rev->product ? $rev->product->image_url : null,
                            'product_price' => $rev->product ? number_format($rev->product->price, 2, ',', '.') : null,
                            'product_url' => $rev->product ? route('products.detail', $rev->product->slug) : null,
                        ];
                    @endphp
                    <div id="review-row-mobile-{{ $rev->id }}" class="p-4 sm:p-5 space-y-3.5 transition-colors {{ $rev->status === 'pending' ? 'bg-amber-50/40' : '' }}">
                        
                        <!-- Customer & Status -->
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-stone-500">#{{ $rev->id }}</span>
                                    <h4 class="font-bold text-stone-900 text-sm">{{ $rev->customer_name }}</h4>
                                </div>
                                <div class="text-[0.7rem] text-stone-500 mt-0.5">
                                    {{ $rev->customer_email }}
                                    @if($rev->location) • {{ $rev->location }} @endif
                                </div>
                                <div class="text-[0.65rem] text-stone-400 mt-0.5 font-mono">
                                    {{ $rev->created_at ? $rev->created_at->format('d.m.Y H:i') : '' }}
                                </div>
                            </div>

                            <!-- Mobile Status Pill -->
                            <div>
                                @if($rev->status === 'approved')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-en="Live" data-i18n-de="Live">Live</span>
                                    </span>
                                @elseif($rev->status === 'rejected')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-rose-50 text-rose-800 border border-rose-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                        <span data-i18n-en="Hidden" data-i18n-de="Versteckt">Hidden</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold bg-amber-50 text-amber-800 border border-amber-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span data-i18n-en="Pending" data-i18n-de="Ausstehend">Pending</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Product info -->
                        @if($rev->product)
                            <div class="flex items-center gap-2 p-2 bg-stone-50 rounded-xl border border-stone-200/60 text-xs">
                                @if($rev->product->image_url)
                                    <img src="{{ $rev->product->image_url }}" alt="{{ $rev->product->name }}" class="h-8 w-8 rounded object-cover border border-stone-200 shrink-0">
                                @endif
                                <span class="font-semibold text-stone-700 truncate text-[0.75rem]">{{ $rev->product->name }}</span>
                            </div>
                        @endif

                        <!-- Action Buttons including Detail -->
                        <div class="flex items-center gap-2 pt-1 border-t border-stone-200/50">
                            <!-- Detail Button -->
                            <button
                                type="button"
                                onclick='openReviewDetailModal(@json($modalData))'
                                class="flex-1 py-2 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-800 font-bold text-xs flex items-center justify-center gap-1.5 border border-stone-200 cursor-pointer"
                            >
                                <svg class="h-4 w-4 text-stone-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                <span data-i18n-en="View Detail" data-i18n-de="Details ansehen">View Detail</span>
                            </button>

                            @if($rev->status !== 'approved')
                                <button
                                    type="button"
                                    onclick="moderateReview({{ $rev->id }}, 'approved')"
                                    class="py-2 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1 shadow-xs cursor-pointer"
                                    title="Approve"
                                >
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    <span data-i18n-en="Approve" data-i18n-de="Freigeben">Approve</span>
                                </button>
                            @endif

                            @if($rev->status !== 'rejected')
                                <button
                                    type="button"
                                    onclick="moderateReview({{ $rev->id }}, 'rejected')"
                                    class="py-2 px-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs flex items-center justify-center gap-1 shadow-xs cursor-pointer"
                                    title="Reject"
                                >
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    <span data-i18n-en="Reject" data-i18n-de="Ablehnen">Reject</span>
                                </button>
                            @endif

                            <button
                                type="button"
                                onclick="confirmDeleteReview({{ $rev->id }}, '{{ addslashes($rev->customer_name) }}')"
                                class="p-2 rounded-xl text-stone-400 hover:text-rose-700 hover:bg-rose-50 border border-stone-200 transition cursor-pointer"
                                title="Delete Review"
                            >
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>

        @else
            <!-- Empty State -->
            <div class="px-5 py-16 text-center">
                <div class="max-w-sm mx-auto space-y-3">
                    <div class="h-12 w-12 rounded-full bg-stone-100 text-stone-400 mx-auto flex items-center justify-center">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-900" data-i18n-en="No Reviews Found" data-i18n-de="Keine Bewertungen Gefunden">
                        No Reviews Found
                    </h4>
                    <p class="text-xs text-stone-500" data-i18n-en="No client reviews currently match your selected status or filter parameters." data-i18n-de="Derzeit entsprechen keine Kundenbewertungen den ausgewählten Filtern.">
                        No client reviews currently match your selected status or filter parameters.
                    </p>
                    <a href="{{ route('admin.reviews') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold bg-[#964B42] text-white hover:bg-[#803D35] transition">
                        <span data-i18n-en="Clear All Filters" data-i18n-de="Filter Zurücksetzen">Clear All Filters</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Pagination Footer -->
        @if($reviews->hasPages())
            <div class="p-4 bg-[#FBF6F4] border-t border-[#E5DED5]">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Luxury Review Detail Modal -->
<div id="review-detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-900/60 backdrop-blur-xs hidden transition-all duration-300">
    <div class="relative w-full max-w-2xl bg-white rounded-2xl border border-[#E5DED5] shadow-2xl overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="review-detail-dialog">
        
        <!-- Modal Header -->
        <div class="p-5 sm:p-6 bg-gradient-to-r from-[#964B42] to-[#803D35] text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-white/15 backdrop-blur-md flex items-center justify-center font-bold text-base text-[#ffd45a]">
                    ★
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="font-serif font-bold text-lg text-white" id="modal-review-id">Review Details</h3>
                        <span id="modal-status-pill" class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold"></span>
                    </div>
                    <p class="text-xs text-rose-100" id="modal-review-date">—</p>
                </div>
            </div>

            <button type="button" onclick="closeReviewDetailModal()" class="p-2 rounded-xl bg-white/10 hover:bg-white/20 text-white transition cursor-pointer" aria-label="Close modal">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-5 sm:p-6 space-y-5 max-h-[75vh] overflow-y-auto">
            
            <!-- Patron & Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Patron Information Card -->
                <div class="p-4 rounded-xl bg-[#F8F5EF] border border-[#E5DED5] space-y-1.5">
                    <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-en="CLIENT DETAILS" data-i18n-de="KUNDENDATEN">CLIENT DETAILS</span>
                    <h4 class="font-bold text-stone-900 text-sm" id="modal-customer-name">—</h4>
                    <p class="text-xs text-stone-600 font-mono truncate" id="modal-customer-email">—</p>
                    <p class="text-xs text-stone-500 flex items-center gap-1" id="modal-customer-location">
                        <svg class="h-3.5 w-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span id="modal-customer-location-text">—</span>
                    </p>
                </div>

                <!-- Product Reference Card -->
                <div class="p-4 rounded-xl bg-[#F8F5EF] border border-[#E5DED5] space-y-1.5" id="modal-product-box">
                    <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-en="PRODUCT REVIEWED" data-i18n-de="BEWERTETES PRODUKT">PRODUCT REVIEWED</span>
                    <div class="flex items-center gap-3">
                        <img id="modal-product-img" src="" alt="Product" class="h-11 w-11 rounded-lg object-cover border border-stone-200 shrink-0 hidden">
                        <div class="min-w-0">
                            <h4 class="font-bold text-stone-900 text-xs truncate" id="modal-product-name">General Atelier Review</h4>
                            <p class="text-[0.7rem] text-stone-500 font-mono" id="modal-product-price"></p>
                            <a id="modal-product-link" href="#" target="_blank" class="text-[0.68rem] text-[#964B42] hover:underline font-bold inline-flex items-center gap-1 mt-0.5">
                                <span data-i18n-en="View live product" data-i18n-de="Produkt im Shop ansehen">View live product</span> →
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Rating & Verified Badge -->
            <div class="p-4 rounded-xl bg-white border border-[#E5DED5] flex flex-wrap items-center justify-between gap-3 shadow-2xs">
                <div class="flex items-center gap-3">
                    <div class="flex text-[#d8b45a] text-xl tracking-tight" id="modal-star-icons">
                        ★★★★★
                    </div>
                    <span class="font-serif font-bold text-lg text-stone-900" id="modal-rating-score">5.0 / 5.0</span>
                </div>
                <div id="modal-verified-badge" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full">
                    ✓ Verified Customer
                </div>
            </div>

            <!-- Review Title & Comment -->
            <div class="p-5 rounded-xl bg-[#faf7f2] border border-[#e6decb] space-y-3 relative">
                <svg class="h-8 w-8 text-[#d8b45a]/30 absolute top-4 right-4" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                
                <h3 class="font-serif font-bold text-base text-stone-900 leading-snug pr-8" id="modal-review-title">
                    Review Headline
                </h3>

                <div class="text-xs sm:text-sm text-stone-700 leading-relaxed whitespace-pre-line" id="modal-review-comment">
                    Review comment text goes here...
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 sm:p-5 bg-[#FBF6F4] border-t border-[#E5DED5] flex flex-wrap items-center justify-between gap-3">
            <button type="button" onclick="closeReviewDetailModal()" class="px-4 py-2.5 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-xs transition cursor-pointer">
                <span data-i18n-en="Close" data-i18n-de="Schließen">Close</span>
            </button>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    id="modal-approve-btn"
                    onclick=""
                    class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5 transition shadow-xs cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    <span data-i18n-en="Approve & Publish" data-i18n-de="Freigeben & Veröffentlichen">Approve & Publish</span>
                </button>

                <button
                    type="button"
                    id="modal-reject-btn"
                    onclick=""
                    class="px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 font-bold text-xs flex items-center gap-1.5 transition shadow-xs cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    <span data-i18n-en="Reject & Hide" data-i18n-de="Ablehnen">Reject & Hide</span>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Interactive Moderation Script -->
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Open Detail Modal
    function openReviewDetailModal(data) {
        const isEn = typeof getCurrentLang === 'function' && getCurrentLang() === 'en';
        
        document.getElementById('modal-review-id').textContent = `Review #${data.id}`;
        document.getElementById('modal-review-date').textContent = `${data.date} (${data.time_ago})`;
        
        // Status Pill
        const statusPill = document.getElementById('modal-status-pill');
        if (data.status === 'approved') {
            statusPill.className = 'px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-100 text-emerald-900';
            statusPill.textContent = isEn ? '✓ Live (Approved)' : '✓ Freigegeben';
        } else if (data.status === 'rejected') {
            statusPill.className = 'px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-rose-100 text-rose-900';
            statusPill.textContent = isEn ? '✕ Hidden (Rejected)' : '✕ Abgelehnt';
        } else {
            statusPill.className = 'px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-amber-100 text-amber-900';
            statusPill.textContent = isEn ? '⏳ Pending Approval' : '⏳ Ausstehend';
        }

        // Customer Info
        document.getElementById('modal-customer-name').textContent = data.customer_name || '—';
        document.getElementById('modal-customer-email').textContent = data.customer_email || '—';
        const locBox = document.getElementById('modal-customer-location');
        const locText = document.getElementById('modal-customer-location-text');
        if (data.location) {
            locText.textContent = data.location;
            locBox.classList.remove('hidden');
        } else {
            locBox.classList.add('hidden');
        }

        // Product Info
        const prodImg = document.getElementById('modal-product-img');
        const prodName = document.getElementById('modal-product-name');
        const prodPrice = document.getElementById('modal-product-price');
        const prodLink = document.getElementById('modal-product-link');

        if (data.product_name) {
            prodName.textContent = data.product_name;
            prodPrice.textContent = data.product_price ? `EUR ${data.product_price}` : '';
            if (data.product_image) {
                prodImg.src = data.product_image;
                prodImg.classList.remove('hidden');
            } else {
                prodImg.classList.add('hidden');
            }
            if (data.product_url) {
                prodLink.href = data.product_url;
                prodLink.classList.remove('hidden');
            } else {
                prodLink.classList.add('hidden');
            }
        } else {
            prodName.textContent = isEn ? 'General Atelier Review' : 'Allgemeine Bewertung';
            prodPrice.textContent = '';
            prodImg.classList.add('hidden');
            prodLink.classList.add('hidden');
        }

        // Star Rating
        let starsHtml = '';
        const rating = parseInt(data.rating) || 5;
        for (let i = 1; i <= 5; i++) {
            starsHtml += i <= rating ? '★' : '☆';
        }
        document.getElementById('modal-star-icons').innerHTML = starsHtml;
        document.getElementById('modal-rating-score').textContent = `${rating}.0 / 5.0`;

        // Verified Badge
        const verifiedBadge = document.getElementById('modal-verified-badge');
        if (data.is_verified) {
            verifiedBadge.classList.remove('hidden');
            verifiedBadge.textContent = isEn ? '✓ Verified Customer' : '✓ Verifizierter Kunde';
        } else {
            verifiedBadge.classList.add('hidden');
        }

        // Title & Comment
        const titleEl = document.getElementById('modal-review-title');
        if (data.title) {
            titleEl.textContent = `“${data.title}”`;
            titleEl.classList.remove('hidden');
        } else {
            titleEl.classList.add('hidden');
        }
        document.getElementById('modal-review-comment').textContent = data.comment || '';

        // Modal Action Buttons
        const approveBtn = document.getElementById('modal-approve-btn');
        const rejectBtn = document.getElementById('modal-reject-btn');

        if (data.status === 'approved') {
            approveBtn.classList.add('hidden');
        } else {
            approveBtn.classList.remove('hidden');
            approveBtn.onclick = () => {
                closeReviewDetailModal();
                moderateReview(data.id, 'approved');
            };
        }

        if (data.status === 'rejected') {
            rejectBtn.classList.add('hidden');
        } else {
            rejectBtn.classList.remove('hidden');
            rejectBtn.onclick = () => {
                closeReviewDetailModal();
                moderateReview(data.id, 'rejected');
            };
        }

        // Display Modal
        const modal = document.getElementById('review-detail-modal');
        const dialog = document.getElementById('review-detail-dialog');
        modal.classList.remove('hidden');
        setTimeout(() => {
            dialog.classList.remove('scale-95', 'opacity-0');
            dialog.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeReviewDetailModal() {
        const modal = document.getElementById('review-detail-modal');
        const dialog = document.getElementById('review-detail-dialog');
        dialog.classList.remove('scale-100', 'opacity-100');
        dialog.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Close on backdrop click
    document.getElementById('review-detail-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeReviewDetailModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeReviewDetailModal();
        }
    });

    function moderateReview(reviewId, newStatus) {
        const isEn = typeof getCurrentLang === 'function' && getCurrentLang() === 'en';
        const actionWord = newStatus === 'approved' 
            ? (isEn ? 'Approve' : 'Freigeben') 
            : (isEn ? 'Reject' : 'Ablehnen');

        LuxurySwal.fire({
            title: isEn ? `${actionWord} this review?` : `Bewertung ${actionWord}?`,
            text: newStatus === 'approved'
                ? (isEn ? 'This review will become immediately visible on the storefront.' : 'Diese Bewertung wird sofort im Shop sichtbar.')
                : (isEn ? 'This review will be hidden from all storefront visitors.' : 'Diese Bewertung wird für alle Shop-Besucher ausgeblendet.'),
            icon: newStatus === 'approved' ? 'question' : 'warning',
            showCancelButton: true,
            confirmButtonText: isEn ? `Yes, ${actionWord}` : `Ja, ${actionWord}`,
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            confirmButtonColor: newStatus === 'approved' ? '#059669' : '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/reviews/${reviewId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        LuxuryToast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    } else {
                        LuxuryToast.fire({
                            icon: 'error',
                            title: data.message || (isEn ? 'Error updating review status.' : 'Fehler beim Aktualisieren.')
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    LuxuryToast.fire({
                        icon: 'error',
                        title: isEn ? 'Server connection error.' : 'Verbindungsfehler.'
                    });
                });
            }
        });
    }

    function confirmDeleteReview(reviewId, customerName) {
        const isEn = typeof getCurrentLang === 'function' && getCurrentLang() === 'en';

        LuxurySwal.fire({
            title: isEn ? `Delete review by ${customerName}?` : `Bewertung von ${customerName} löschen?`,
            text: isEn ? 'This action is irreversible.' : 'Diese Aktion kann nicht rückgängig gemacht werden.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            confirmButtonColor: '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/reviews/${reviewId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        LuxuryToast.fire({
                            icon: 'success',
                            title: data.message
                        });
                        const desktopRow = document.getElementById(`review-row-desktop-${reviewId}`);
                        const mobileRow = document.getElementById(`review-row-mobile-${reviewId}`);
                        if (desktopRow) desktopRow.remove();
                        if (mobileRow) mobileRow.remove();
                        setTimeout(() => {
                            window.location.reload();
                        }, 400);
                    } else {
                        LuxuryToast.fire({
                            icon: 'error',
                            title: data.message || (isEn ? 'Could not delete review.' : 'Löschen fehlgeschlagen.')
                        });
                    }
                })
                .catch(err => {
                    console.error(err);
                    LuxuryToast.fire({
                        icon: 'error',
                        title: isEn ? 'Server connection error.' : 'Verbindungsfehler.'
                    });
                });
            }
        });
    }
</script>
@endsection

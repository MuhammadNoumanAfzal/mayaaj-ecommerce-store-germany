@extends('layouts.admin')
@section('title', 'Deals & Curated Bundles - MEHAAJ Atelier Admin')

@section('admin-styles')
<style>
    /* Full Page Modal Blur & Hide Scrollbars Across All Browsers */
    html.modal-open, body.modal-open {
        overflow: hidden !important;
        height: 100vh !important;
    }
    .modal-scroll-clean {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    .modal-scroll-clean::-webkit-scrollbar,
    #view-deal-modal .modal-scroll-clean::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    select.filter-select,
    select.appearance-none {
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        background-image: none !important;
    }
    select.filter-select::-ms-expand,
    select.appearance-none::-ms-expand {
        display: none !important;
    }
</style>
@endsection

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Colorful Executive KPI Metric Cards (Matching Categories, Subcategories & Products) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        
        <!-- 1. Total Bundles -->
        <a href="{{ route('admin.deals') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fcf9f5] to-[#f7ece0] rounded-2xl border border-[#ebdccb] p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="View all bundles">
            <span class="text-[0.68rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Gesamte Bundles" data-i18n-en="Total Bundles">Total Bundles</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-[#1c1210] tracking-tight leading-none group-hover:text-[#78000b] transition-colors">{{ $stats['total'] }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-5 h-5 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.deals', ['status' => 'active']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f2faf5] to-[#e4f7ec] rounded-2xl border border-emerald-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Filter by Active">
            <span class="text-[0.68rem] font-bold text-emerald-800 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-emerald-950 tracking-tight leading-none group-hover:text-emerald-700 transition-colors">{{ $stats['active'] }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #059669 0%, #064e3b 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </a>

        <!-- 3. Flash Deals (Countdown Timer) -->
        <a href="{{ route('admin.deals', ['status' => 'flash']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fdf9f2] to-[#f9edd9] rounded-2xl border border-amber-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Filter by Flash Deals">
            <span class="text-[0.68rem] font-bold text-amber-800 uppercase tracking-wider block" data-i18n-de="Flash Deals (Timer)" data-i18n-en="Flash Deals (Timer)">Flash Deals (Timer)</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-amber-950 tracking-tight leading-none group-hover:text-amber-700 transition-colors">{{ $stats['flash'] }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #d97706 0%, #78350f 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </a>

        <!-- 4. Avg Patron Savings -->
        <div class="cursor-pointer group block bg-gradient-to-br from-white via-[#faf5ff] to-[#f3e8ff] rounded-2xl border border-purple-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" title="Average savings per bundle">
            <span class="text-[0.68rem] font-bold text-purple-800 uppercase tracking-wider block" data-i18n-de="Ø Kundenersparnis" data-i18n-en="Avg Patron Savings">Avg Patron Savings</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-purple-950 tracking-tight leading-none group-hover:text-purple-700 transition-colors">€{{ number_format($stats['avg_savings'], 2) }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #9333ea 0%, #581c87 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Main Deals Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-xs relative overflow-hidden border-t-4 border-t-[#78000b]">
        
        <!-- Header with Action Button (Matching Categories & Products) -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Deals & Produkt-Bundles" data-i18n-en="Deals & Bundles Directory">
                        Deals & Bundles Directory
                    </h2>
                </div>
            </div>
            
            <a href="{{ route('admin.deals.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0 active:scale-95">
                <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Neues Bundle Anlegen" data-i18n-en="Create New Bundle">Create New Bundle</span>
            </a>
        </div>

        <!-- Filter, Sort & Search Toolbar Form (Single-Line Clean Layout) -->
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-[#faf7f2] via-[#f5ede2] to-[#faf7f2] border-b border-[#ebdccb] relative z-30">
            <form action="{{ route('admin.deals') }}" method="GET" id="dealsFilterForm" class="flex flex-wrap lg:flex-nowrap items-center gap-2 text-xs font-semibold text-stone-700 w-full">
                
                <!-- Left: Search Box with Live Auto-Suggestions -->
                <div class="relative flex-1 min-w-[180px]">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="dealSearchInput"
                            value="{{ request('search', request('q')) }}"
                            autocomplete="off"
                            placeholder="Search bundle by title, badge or product..."
                            data-i18n-placeholder-de="Bundle nach Name, Badge oder Produkt suchen..."
                            data-i18n-placeholder-en="Search bundle by title, badge or product..."
                            class="h-10 w-full pl-9 pr-8 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs placeholder:text-stone-400 placeholder:font-normal transition"
                        >
                        <!-- Search Icon -->
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">
                            <svg class="h-4 w-4 text-[#8a7267]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        
                        <!-- Clear Search Button -->
                        <button 
                            type="button" 
                            id="dealSearchClearBtn" 
                            onclick="clearDealSearch()" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 h-5 w-5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-400 hover:text-stone-700 transition flex items-center justify-center text-[0.65rem] cursor-pointer {{ request('search', request('q')) ? '' : 'hidden' }}"
                            title="Clear search"
                        >✕</button>
                    </div>

                    <!-- Live Floating Suggestions Dropdown -->
                    <div 
                        id="dealSuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white rounded-2xl border border-[#ebdccb] shadow-2xl overflow-hidden"
                    >
                        <div class="px-4 py-2 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-[#ebdccb] flex items-center justify-between text-[0.68rem] font-bold text-stone-400 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 text-stone-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                                <span>Suggested Bundles</span>
                            </span>
                            <span id="deal-suggestions-count-badge" class="font-mono text-stone-500 font-bold"></span>
                        </div>
                        <div id="dealSuggestionsList" class="max-h-72 overflow-y-auto divide-y divide-stone-100">
                            <!-- Populated via JavaScript -->
                        </div>
                        <div class="px-4 py-2 bg-[#FAF7F2] border-t border-[#ebdccb] flex items-center justify-between text-[0.68rem] text-stone-500">
                            <span>Click suggestion or press <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">↵ Enter</kbd> to search</span>
                            <span><kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">Esc</kbd></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Sleek, Unified Filter Pills with Leading Icons (In Same Line) -->
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                    
                    <!-- Discount Type Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        <select 
                            name="discount_type" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Type: All</option>
                            <option value="percentage_discount" {{ request('discount_type') === 'percentage_discount' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed_discount" {{ request('discount_type') === 'fixed_discount' ? 'selected' : '' }}>Fixed Euro (€)</option>
                            <option value="bundle_fixed_price" {{ request('discount_type') === 'bundle_fixed_price' ? 'selected' : '' }}>Fixed Price (€)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Status: All ({{ $stats['total'] }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active ({{ $stats['active'] }})</option>
                            <option value="flash" {{ request('status') === 'flash' ? 'selected' : '' }}>Flash Timer ({{ $stats['flash'] }})</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        <select 
                            name="sort" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="order_asc" {{ request('sort', 'order_asc') === 'order_asc' ? 'selected' : '' }}>Sort: Default</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="discount_desc" {{ request('sort') === 'discount_desc' ? 'selected' : '' }}>Top Discount</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Name A→Z</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Per Page Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        <select 
                            name="per_page" 
                            onchange="this.form.submit()" 
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 / page</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / page</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'q', 'discount_type', 'status', 'sort']))
                        <a href="{{ route('admin.deals') }}" class="h-10 px-3 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-[#ebdccb] hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1 cursor-pointer shrink-0" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container (Fully Responsive, Fluid, ZERO Horizontal Scrollbar) -->
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs table-auto">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-4 font-black" data-i18n-de="Bundle Name" data-i18n-en="Bundle Name">Bundle Name</th>
                        <th class="py-3 px-3 font-black text-center w-28" data-i18n-de="Artikel" data-i18n-en="Items">Items</th>
                        <th class="py-3 px-3 font-black text-center w-36" data-i18n-de="Preise & Ersparnis" data-i18n-en="Pricing & Savings">Pricing & Savings</th>
                        <th class="py-3 px-3 font-black text-center w-24" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-4 font-black text-center w-36" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($deals as $deal)
                        @php
                            $dealModalData = [
                                'id' => $deal->id,
                                'title' => $deal->title,
                                'title_en' => $deal->title_en,
                                'title_de' => $deal->title_de,
                                'slug' => $deal->slug,
                                'badge_text' => $deal->formatted_badge,
                                'description' => $deal->description,
                                'description_en' => $deal->description_en ?? '',
                                'description_de' => $deal->description_de ?? '',
                                'discount_type' => $deal->discount_type,
                                'discount_value' => (float)$deal->discount_value,
                                'regular_total' => (float)$deal->regular_total,
                                'bundle_price' => (float)$deal->bundle_price,
                                'savings_amount' => (float)$deal->savings_amount,
                                'savings_percentage' => (int)$deal->savings_percentage,
                                'is_active' => (bool)$deal->is_active,
                                'is_flash' => (bool)$deal->is_flash,
                                'is_expired' => (bool)$deal->is_expired,
                                'starts_at' => $deal->starts_at ? $deal->starts_at->format('d.m.Y H:i') : null,
                                'ends_at' => $deal->ends_at ? $deal->ends_at->format('d.m.Y H:i') : null,
                                'time_remaining' => $deal->ends_at && !$deal->is_expired ? $deal->ends_at->diffForHumans(['parts' => 1]) : null,
                                'products_count' => (int)$deal->products_count,
                                'products' => $deal->products->map(function ($p) {
                                    $effective = ($p->sale_price && $p->sale_price < $p->price) ? (float)$p->sale_price : (float)$p->price;
                                    return [
                                        'id' => $p->id,
                                        'name' => $p->name,
                                        'sku' => $p->sku ?? 'N/A',
                                        'price' => (float)$p->price,
                                        'effective_price' => $effective,
                                        'image_url' => $p->image_url,
                                        'edit_url' => route('admin.products.edit', $p->id),
                                    ];
                                })->values(),
                                'store_url' => route('deals') . '#' . $deal->slug,
                                'edit_url' => route('admin.deals.edit', $deal->id),
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="deal-row-{{ $deal->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($deals->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Bundle Title (Clean, Clickable to View Modal) -->
                            <td class="py-3 px-4">
                                <div class="cursor-pointer group inline-block" onclick='openViewDealModal(@json($dealModalData))' title="Click to view bundle details">
                                    <span class="font-bold text-[#1c1210] text-sm tracking-tight group-hover:text-[#78000b] transition-colors">
                                        {{ $deal->title }}
                                    </span>
                                </div>
                            </td>

                            <!-- 3. Bundled Items Count (Clean Badge Pill, No Avatars) -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#FAF7F2] text-[#78000b] border border-[#ebdccb] shadow-2xs cursor-pointer hover:bg-[#ebdccb]/40 transition" onclick='openViewDealModal(@json($dealModalData))' title="View bundled items">
                                    {{ $deal->products_count }} {{ Str::plural('Item', $deal->products_count) }}
                                </span>
                            </td>

                            <!-- 4. Pricing & Savings -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <div class="inline-flex flex-col items-center leading-tight">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-extrabold text-sm text-[#78000b]">
                                            €{{ number_format($deal->bundle_price, 2) }}
                                        </span>
                                        <span class="text-xs text-stone-400 line-through">
                                            €{{ number_format($deal->regular_total, 2) }}
                                        </span>
                                    </div>
                                    @if($deal->savings_amount > 0)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[0.62rem] font-extrabold bg-emerald-50 text-emerald-800 border border-emerald-300 mt-1">
                                            Save €{{ number_format($deal->savings_amount, 2) }} ({{ $deal->savings_percentage }}%)
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- 5. Status Toggle Badge (Interactive AJAX Toggle) -->
                            <td class="py-3 px-3 text-center">
                                <button 
                                    type="button" 
                                    onclick="toggleDealStatus({{ $deal->id }}, this)" 
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 {{ $deal->is_active ? 'bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100' : 'bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100' }}"
                                    title="Click to toggle status (Active / Inactive)"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $deal->is_active ? 'bg-emerald-600 animate-pulse' : 'bg-amber-500' }}"></span>
                                    <span>{{ $deal->is_active ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- 6. Actions (View, Edit, Delete with Cursors) - Clean & Spaced -->
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Quick View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewDealModal(@json($dealModalData))'
                                        class="h-7 px-2 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="View Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.deals.edit', $deal->id) }}"
                                        class="h-7 px-2 rounded-lg border border-blue-200 bg-blue-50/70 text-blue-700 hover:bg-blue-600 hover:text-white hover:border-blue-600 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Edit Bundle"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteDeal({{ $deal->id }}, '{{ addslashes($deal->title) }}')"
                                        class="h-7 px-2 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Delete Bundle"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-deal-form-{{ $deal->id }}" action="{{ route('admin.deals.destroy', $deal->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-16 px-6 text-center text-stone-500 text-xs">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="h-12 w-12 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Produkt-Bundles gefunden" data-i18n-en="No product bundles found">No product bundles found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Kombinieren Sie 2 oder mehr Artikel zu einem rabattierten Set." data-i18n-en="Pair 2 or more luxury items into a curated set with special package pricing.">
                                        Pair 2 or more luxury items into a curated set with special package pricing.
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.deals.create') }}" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs">
                                            <span>+</span> <span data-i18n-de="Erstes Bundle Erstellen" data-i18n-en="Create First Bundle">Create First Bundle</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Proper Production Pagination Footer (Matching Categories & Products) -->
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-[#faf7f2] via-[#f7eee3] to-[#faf7f2] border-t border-[#ebdccb] flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-stone-600">
            <div>
                @if($deals->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span> 
                    <strong class="text-stone-900 font-mono">{{ $deals->firstItem() }}</strong> 
                    <span data-i18n-de="bis" data-i18n-en="to">to</span> 
                    <strong class="text-stone-900 font-mono">{{ $deals->lastItem() }}</strong> 
                    <span data-i18n-de="von" data-i18n-en="of">of</span> 
                    <strong class="text-stone-900 font-mono">{{ $deals->total() }}</strong> 
                    <span data-i18n-de="Bundles" data-i18n-en="bundles">bundles</span>
                @else
                    <span data-i18n-de="0 Bundles gelistet" data-i18n-en="0 bundles listed">0 bundles listed</span>
                @endif
            </div>

            <div>
                {{ $deals->links() }}
            </div>
        </div>

    </div>

</div>

<!-- Luxury Wide Executive Bundle Quick View Modal (Wide Landscape, Modern Split 50/50 Layout) -->
<div 
    id="view-deal-modal" 
    class="fixed inset-0 flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.78) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important; margin: 0 !important;" 
    onclick="closeViewDealModal()"
>
    <div 
        class="relative w-full bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden my-auto transform transition-all" 
        style="max-width: 780px !important; width: 100% !important; background: #ffffff !important; border-radius: 1.5rem !important; border: 1px solid #ebdccb !important; box-shadow: 0 25px 50px -12px rgba(120, 0, 11, 0.25) !important;"
        onclick="event.stopPropagation()"
    >
        <!-- Luxury Gold & Wine Top Accent Strip -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Modal Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-bottom: 1px solid #ebdccb;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 34px; height: 34px; border-radius: 0.65rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: linear-gradient(135deg, #78000b 0%, #4a0207 100%); color: #d8b45a; border: 1px solid rgba(216, 180, 90, 0.45); box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                    <svg style="width: 16px; height: 16px; color: #d8b45a;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <h3 style="font-family: 'Cormorant Garamond', Georgia, serif; font-size: 1.1rem; font-weight: 700; color: #1c1210; line-height: 1.2; margin: 0;" data-i18n-de="Bundle & Deal Details" data-i18n-en="Bundle & Deal Details">Bundle & Deal Details</h3>
                    <p style="font-size: 0.62rem; color: #8a7267; font-family: monospace; margin: 0; line-height: 1;" id="deal-view-slug">/deals#slug</p>
                </div>
            </div>
            <button type="button" onclick="closeViewDealModal()" style="width: 28px; height: 28px; border-radius: 0.65rem; background: #ffffff; color: #6b7280; border: 1px solid #ebdccb; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;" title="Close" data-i18n-title-de="Schließen" data-i18n-title-en="Close">
                <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content: Robust 2-Column Grid (Guaranteed 50/50 Split) -->
        <div style="padding: 1.25rem; box-sizing: border-box; max-height: 80vh; overflow-y: auto;">
            
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem; width: 100%; box-sizing: border-box; align-items: stretch;">
                
                <!-- Left Side: Identity & Financial 2x2 Matrix (50% Width) -->
                <div style="display: flex; flex-direction: column; gap: 0.75rem; min-width: 0; width: 100%;">
                    
                    <!-- Hero Info Card -->
                    <div style="padding: 0.85rem; border-radius: 0.85rem; background: linear-gradient(to right, #FAF8F5, #ffffff, #FAF8F5); border: 1px solid #ebdccb; display: flex; flex-direction: column; gap: 0.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.65rem;">
                            <div style="width: 36px; height: 36px; border-radius: 0.65rem; background: linear-gradient(135deg, #78000b 0%, #4a0207 100%); border: 1px solid rgba(216, 180, 90, 0.4); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #d8b45a;">
                                <svg style="width: 18px; height: 18px; color: #d8b45a;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V3m0 5l4.5-4.5M12 8L7.5 3.5M3 12h18M5 12a2 2 0 012-2h10a2 2 0 012 2v7a2 2 0 01-2 2H7a2 2 0 01-2-2v-7z"/>
                                </svg>
                            </div>
                            <div style="min-width: 0; flex: 1;">
                                <h4 id="deal-view-title" style="font-family: 'Cormorant Garamond', Georgia, serif; font-weight: 700; font-size: 1.05rem; color: #1c1210; margin: 0; line-height: 1.2; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></h4>
                                <div style="display: flex; align-items: center; gap: 0.35rem; flex-wrap: wrap; margin-top: 0.2rem;">
                                    <span id="deal-view-status-badge"></span>
                                    <span id="deal-view-badge-text" class="hidden" style="display: inline-flex; align-items: center; padding: 0.1rem 0.4rem; border-radius: 0.25rem; font-size: 0.58rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; background: rgba(120, 0, 11, 0.08); color: #78000b; border: 1px solid rgba(120, 0, 11, 0.2);"></span>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 0.4rem; border-top: 1px solid #f1e6da; font-size: 0.65rem; color: #6b7280;">
                            <span style="font-family: monospace; font-weight: 700; color: #1f2937; background: #FAF7F2; padding: 0.15rem 0.45rem; border-radius: 0.4rem; border: 1px solid #ebdccb;">
                                ID: <strong id="deal-view-id" style="color: #111827;">#0</strong>
                            </span>
                            <span style="font-family: monospace; font-weight: 700; color: #1f2937; background: #FAF7F2; padding: 0.15rem 0.45rem; border-radius: 0.4rem; border: 1px solid #ebdccb;">
                                <span data-i18n-de="Enthalten:" data-i18n-en="Included:">Included:</span> <strong id="deal-view-items-count" style="color: #78000b;">0</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Pricing & Financial Metrics (2x2 Grid) -->
                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 0.5rem; width: 100%;">
                        <div style="padding: 0.65rem; border-radius: 0.75rem; background: linear-gradient(135deg, #FAF8F5, #F5ECE1); border: 1px solid #ebdccb;">
                            <span style="font-size: 0.58rem; font-weight: 700; color: #8a7267; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Regulärer Gesamtpreis" data-i18n-en="Regular Total">Regular Total</span>
                            <span id="deal-view-regular-total" style="font-weight: 800; font-size: 0.95rem; color: #1c1210; display: block; margin-top: 0.15rem;">€0.00</span>
                        </div>

                        <div style="padding: 0.65rem; border-radius: 0.75rem; background: linear-gradient(135deg, #fff5f5, #fde8e8); border: 1px solid rgba(254, 205, 211, 0.9);">
                            <span style="font-size: 0.58rem; font-weight: 700; color: #9f1239; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Bundle-Preis" data-i18n-en="Bundle Price">Bundle Price</span>
                            <span id="deal-view-bundle-price" style="font-weight: 800; font-size: 0.95rem; color: #78000b; display: block; margin-top: 0.15rem;">€0.00</span>
                        </div>

                        <div style="padding: 0.65rem; border-radius: 0.75rem; background: linear-gradient(135deg, #f2faf5, #e4f7ec); border: 1px solid rgba(187, 247, 208, 0.9);">
                            <span style="font-size: 0.58rem; font-weight: 700; color: #065f46; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Kundenersparnis" data-i18n-en="Customer Savings">Customer Savings</span>
                            <span id="deal-view-savings-amount" style="font-weight: 800; font-size: 0.95rem; color: #064e3b; display: block; margin-top: 0.15rem;">€0.00</span>
                        </div>

                        <div style="padding: 0.65rem; border-radius: 0.75rem; background: linear-gradient(135deg, #f2faf5, #e4f7ec); border: 1px solid rgba(187, 247, 208, 0.9);">
                            <span style="font-size: 0.58rem; font-weight: 700; color: #065f46; text-transform: uppercase; letter-spacing: 0.05em; display: block;" data-i18n-de="Rabatt-Satz" data-i18n-en="Discount Rate">Discount Rate</span>
                            <span id="deal-view-savings-pct" style="font-weight: 800; font-size: 0.95rem; color: #064e3b; display: block; margin-top: 0.15rem;">0%</span>
                        </div>
                    </div>

                    <!-- Flash Sale Countdown Bar -->
                    <div id="deal-view-timer-section" class="hidden" style="padding: 0.6rem; border-radius: 0.75rem; background: linear-gradient(to right, #fffbeb, #fff7ed); border: 1px solid #fde68a; display: flex; align-items: center; justify-content: space-between; font-size: 0.68rem;">
                        <div style="display: flex; align-items: center; gap: 0.4rem; min-width: 0;">
                            <svg style="width: 14px; height: 14px; color: #d97706; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div style="min-width: 0;">
                                <span style="font-weight: 700; font-size: 0.68rem; color: #78350f; display: block; line-height: 1.1;" id="deal-view-timer-status" data-i18n-de="Flash Sale" data-i18n-en="Flash Sale">Flash Sale</span>
                                <span style="font-size: 0.58rem; color: #b45309; font-family: monospace; display: block;" id="deal-view-timer-range"></span>
                            </div>
                        </div>
                        <span id="deal-view-timer-countdown" style="padding: 0.15rem 0.45rem; border-radius: 0.35rem; font-size: 0.62rem; font-weight: 800; background: #f59e0b; color: #ffffff; flex-shrink: 0;"></span>
                    </div>

                    <!-- Description -->
                    <div id="deal-view-desc-wrapper" class="hidden" style="padding: 0.65rem; border-radius: 0.75rem; background: #FAF8F5; border: 1px solid #ebdccb; font-size: 0.68rem;">
                        <span style="display: block; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.58rem; color: #8a7267; margin-bottom: 0.2rem;" data-i18n-de="Atelier Notizen" data-i18n-en="Atelier Notes">Atelier Notes</span>
                        <div id="deal-view-desc" style="color: #292524; line-height: 1.4;"></div>
                    </div>

                </div>

                <!-- Right Side: Items in this Bundle (50% Width) -->
                <div style="display: flex; flex-direction: column; justify-content: space-between; gap: 0.75rem; min-width: 0; width: 100%;">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.4rem; border-bottom: 1px solid #f1e6da; margin-bottom: 0.5rem;">
                            <span style="font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.65rem; color: #8a7267;" data-i18n-de="Artikel in diesem Bundle" data-i18n-en="Items in this Bundle">Items in this Bundle</span>
                            <span style="font-size: 0.6rem; font-weight: 700; color: #78000b; background: #FAF7F2; padding: 0.15rem 0.45rem; border-radius: 9999px; border: 1px solid #ebdccb;" data-i18n-de="Kuratiertes Set" data-i18n-en="Curated Set">Curated Set</span>
                        </div>
                        
                        <div id="deal-view-products-list" style="border-radius: 0.85rem; background: #ffffff; border: 1px solid #ebdccb; overflow: hidden; max-height: 240px; overflow-y: auto;">
                            <!-- Populated dynamically via JS -->
                        </div>
                    </div>

                    <div style="padding: 0.55rem 0.75rem; border-radius: 0.75rem; background: linear-gradient(to right, #FAF8F5, #ffffff); border: 1px solid #ebdccb; display: flex; align-items: center; justify-content: space-between; font-size: 0.65rem; color: #57534e;">
                        <span data-i18n-de="Alle Artikel werden automatisch im Warenkorb gebündelt" data-i18n-en="All items are bundled automatically in patron cart">All items are bundled automatically in patron cart</span>
                        <span style="font-weight: 700; color: #065f46;" data-i18n-de="✓ Sofort-Rabatt" data-i18n-en="✓ Instant Discount">✓ Instant Discount</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1.25rem; background: linear-gradient(to right, #fdfbf8, #f7eee4, #fbf5ef); border-top: 1px solid #ebdccb; gap: 0.75rem;">
            <a id="deal-view-store-btn" href="#" target="_blank" style="font-size: 0.75rem; font-weight: 700; color: #78000b; text-decoration: none; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer;">
                <span data-i18n-de="Im Store ansehen" data-i18n-en="View on Storefront">View on Storefront</span>
                <svg style="width: 14px; height: 14px; color: #78000b;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>

            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <button type="button" onclick="closeViewDealModal()" class="btn-exec-secondary" style="border-radius: 0.75rem; padding: 0.45rem 1rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;">
                    <span data-i18n-de="Schließen" data-i18n-en="Close">Close</span>
                </button>
                <a id="deal-view-edit-btn" href="#" class="btn-exec-primary" style="border-radius: 0.75rem; padding: 0.45rem 1rem; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.35rem; cursor: pointer; text-decoration: none;">
                    <svg style="width: 14px; height: 14px; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span data-i18n-de="Bundle Bearbeiten" data-i18n-en="Edit Bundle">Edit Bundle</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    // Ensure modal is attached directly to document.body so full screen blur is 100% complete
    function ensureModalTeleported(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        ensureModalTeleported('view-deal-modal');
    });

    // Dataset for instant autocomplete search suggestions (Scoped to prevent global lexical conflicts)
    (function() {
        const ALL_DEALS = @json($allDealsForSuggestions ?? []);

        const searchInput = document.getElementById('dealSearchInput');
        const suggestionsPanel = document.getElementById('dealSuggestionsPanel');
        const suggestionsList = document.getElementById('dealSuggestionsList');
        const suggestionsCountBadge = document.getElementById('deal-suggestions-count-badge');
        const clearBtn = document.getElementById('dealSearchClearBtn');
        const filterForm = document.getElementById('dealsFilterForm');
        let selectedSuggestionIndex = -1;

        function clearDealSearch() {
            if (searchInput) {
                searchInput.value = '';
                if (clearBtn) clearBtn.classList.add('hidden');
                if (suggestionsPanel) suggestionsPanel.classList.add('hidden');
                if (filterForm) filterForm.submit();
            }
        }
        window.clearDealSearch = clearDealSearch;

        if (searchInput && suggestionsPanel && suggestionsList) {
            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            }

            function highlightMatch(text, query) {
                if (!query) return escapeHtml(text);
                const escapedText = escapeHtml(text);
                const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                return escapedText.replace(regex, '<span class="bg-[#ebdccb] text-[#78000b] font-black px-0.5 rounded">$1</span>');
            }

            function renderSuggestions(query) {
                const trimmed = query.trim().toLowerCase();
                selectedSuggestionIndex = -1;

                if (clearBtn) {
                    if (trimmed) clearBtn.classList.remove('hidden');
                    else clearBtn.classList.add('hidden');
                }

                if (!trimmed) {
                    suggestionsPanel.classList.add('hidden');
                    suggestionsList.innerHTML = '';
                    return;
                }

                const matches = ALL_DEALS.filter(d => {
                    return (d.title && d.title.toLowerCase().includes(trimmed)) ||
                           (d.title_en && d.title_en.toLowerCase().includes(trimmed)) ||
                           (d.title_de && d.title_de.toLowerCase().includes(trimmed)) ||
                           (d.badge_text && d.badge_text.toLowerCase().includes(trimmed)) ||
                           (d.slug && d.slug.toLowerCase().includes(trimmed));
                }).slice(0, 6);

                if (matches.length === 0) {
                    if (suggestionsCountBadge) suggestionsCountBadge.textContent = '0';
                    suggestionsList.innerHTML = `
                        <div class="px-4 py-4 text-xs text-stone-400 text-center flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <span>No bundle matches found for "<strong>${escapeHtml(query)}</strong>"</span>
                        </div>
                    `;
                    suggestionsPanel.classList.remove('hidden');
                    return;
                }

                if (suggestionsCountBadge) suggestionsCountBadge.textContent = matches.length;

                let html = '';
                matches.forEach((d, idx) => {
                    const imgHtml = d.first_image 
                        ? `<img src="${d.first_image}" class="h-full w-full object-cover">`
                        : `<svg class="w-3.5 h-3.5 text-[#78000b]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>`;
                    
                    const statusBadge = d.is_active
                        ? `<span class="text-[0.6rem] font-bold text-emerald-800 bg-emerald-50 border border-emerald-300 px-1.5 py-0.5 rounded-full">ACTIVE</span>`
                        : `<span class="text-[0.6rem] font-bold text-amber-800 bg-amber-50 border border-amber-300 px-1.5 py-0.5 rounded-full">DRAFT</span>`;

                    html += `
                        <div 
                            class="suggestion-item px-3.5 py-2 hover:bg-[#FAF7F2] cursor-pointer flex items-center justify-between gap-3 transition" 
                            data-index="${idx}"
                            data-name="${escapeHtml(d.title)}"
                            data-id="${d.id}"
                        >
                            <div class="flex items-center gap-2 min-w-0">
                                <div class="h-7 w-7 rounded-lg overflow-hidden bg-[#FAF7F2] border border-[#ebdccb] flex items-center justify-center shrink-0">
                                    ${imgHtml}
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs font-bold text-[#1c1210] truncate">
                                        ${highlightMatch(d.title, trimmed)}
                                    </div>
                                    <div class="text-[0.62rem] text-stone-500 font-medium truncate flex items-center gap-1.5">
                                        <span class="text-[#78000b] font-semibold">${escapeHtml(d.badge_text)}</span>
                                        <span>•</span>
                                        <span>${d.products_count} items</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <span class="text-xs font-extrabold text-[#78000b]">
                                    €${d.bundle_price.toFixed(2)}
                                </span>
                                ${statusBadge}
                            </div>
                        </div>
                    `;
                });

                suggestionsList.innerHTML = html;
                suggestionsPanel.classList.remove('hidden');

                suggestionsList.querySelectorAll('.suggestion-item').forEach(item => {
                    item.addEventListener('click', function() {
                        const name = this.getAttribute('data-name');
                        searchInput.value = name;
                        suggestionsPanel.classList.add('hidden');
                        filterForm.submit();
                    });
                });
            }

            let debounceTimer;
            searchInput.addEventListener('input', function(e) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    renderSuggestions(e.target.value);
                }, 120);
            });

            searchInput.addEventListener('keydown', function(e) {
                const items = suggestionsList.querySelectorAll('.suggestion-item');
                if (items.length === 0 || suggestionsPanel.classList.contains('hidden')) {
                    return;
                }

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    selectedSuggestionIndex = (selectedSuggestionIndex + 1) % items.length;
                    updateSuggestionHighlight(items);
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    selectedSuggestionIndex = (selectedSuggestionIndex - 1 + items.length) % items.length;
                    updateSuggestionHighlight(items);
                } else if (e.key === 'Enter') {
                    if (selectedSuggestionIndex >= 0 && items[selectedSuggestionIndex]) {
                        e.preventDefault();
                        const name = items[selectedSuggestionIndex].getAttribute('data-name');
                        searchInput.value = name;
                        suggestionsPanel.classList.add('hidden');
                        filterForm.submit();
                    }
                } else if (e.key === 'Escape') {
                    suggestionsPanel.classList.add('hidden');
                }
            });

            function updateSuggestionHighlight(items) {
                items.forEach((item, idx) => {
                    if (idx === selectedSuggestionIndex) {
                        item.classList.add('bg-[#FAF7F2]', 'ring-1', 'ring-[#78000b]/30');
                        item.scrollIntoView({ block: 'nearest' });
                    } else {
                        item.classList.remove('bg-[#FAF7F2]', 'ring-1', 'ring-[#78000b]/30');
                    }
                });
            }

            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsPanel.contains(e.target)) {
                    suggestionsPanel.classList.add('hidden');
                }
            });
        }
    })();

    // Modal Handling with ensureModalTeleported & Body Scroll Lock
    function openViewDealModal(data) {
        ensureModalTeleported('view-deal-modal');
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('deal-view-title').textContent = data.title;
        document.getElementById('deal-view-slug').textContent = '/deals#' + data.slug;
        document.getElementById('deal-view-id').textContent = '#' + data.id;
        document.getElementById('deal-view-items-count').textContent = data.products_count + ' items';

        // Badge Text
        const badgeEl = document.getElementById('deal-view-badge-text');
        if (data.badge_text) {
            badgeEl.textContent = data.badge_text;
            badgeEl.classList.remove('hidden');
        } else {
            badgeEl.classList.add('hidden');
        }

        // Status Badge
        const statusBadgeEl = document.getElementById('deal-view-status-badge');
        if (data.is_active) {
            statusBadgeEl.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-300';
            statusBadgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'ACTIVE' : 'AKTIV'}</span>`;
        } else {
            statusBadgeEl.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-300';
            statusBadgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'DRAFT' : 'ENTWURF'}</span>`;
        }

        // Pricing Cards
        document.getElementById('deal-view-regular-total').textContent = '€' + data.regular_total.toFixed(2);
        document.getElementById('deal-view-bundle-price').textContent = '€' + data.bundle_price.toFixed(2);
        document.getElementById('deal-view-savings-amount').textContent = '€' + data.savings_amount.toFixed(2);
        document.getElementById('deal-view-savings-pct').textContent = data.savings_percentage + '%';

        // Flash Timer Section
        const timerSec = document.getElementById('deal-view-timer-section');
        const timerStatus = document.getElementById('deal-view-timer-status');
        const timerRange = document.getElementById('deal-view-timer-range');
        const timerCountdown = document.getElementById('deal-view-timer-countdown');

        if (data.ends_at) {
            timerSec.classList.remove('hidden');
            if (data.is_expired) {
                timerStatus.textContent = isEn ? 'Expired Flash Deal' : 'Abgelaufener Flash Deal';
                timerRange.textContent = 'Ended: ' + data.ends_at;
                timerCountdown.textContent = isEn ? 'Expired' : 'Beendet';
                timerCountdown.className = 'px-2 py-0.5 rounded text-[0.62rem] font-extrabold bg-rose-600 text-white';
            } else {
                timerStatus.textContent = isEn ? 'Active Flash Sale Deal' : 'Aktives Flash-Angebot';
                timerRange.textContent = (data.starts_at ? data.starts_at + ' → ' : '') + data.ends_at;
                timerCountdown.textContent = data.time_remaining ? 'Ends in ' + data.time_remaining : 'Active';
                timerCountdown.className = 'px-2 py-0.5 rounded text-[0.62rem] font-extrabold bg-amber-500 text-white shadow-2xs';
            }
        } else {
            timerSec.classList.add('hidden');
        }

        // Bundled Products List (Compact Rows)
        const productsList = document.getElementById('deal-view-products-list');
        productsList.innerHTML = '';
        if (data.products && data.products.length > 0) {
            data.products.forEach(p => {
                const itemDiv = document.createElement('div');
                itemDiv.style.cssText = 'display: flex; align-items: center; justify-content: space-between; padding: 0.65rem 0.75rem; border-bottom: 1px solid #f1e6da; gap: 0.75rem; background: #ffffff; transition: background 0.2s;';
                itemDiv.innerHTML = `
                    <div style="display: flex; align-items: center; gap: 0.65rem; min-width: 0; flex: 1;">
                        <img src="${p.image_url}" alt="${p.name}" style="width: 38px; height: 38px; border-radius: 0.5rem; object-fit: cover; border: 1px solid #ebdccb; flex-shrink: 0;">
                        <div style="min-width: 0; flex: 1;">
                            <span style="font-weight: 700; font-size: 0.75rem; color: #1c1210; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block;">${p.name}</span>
                            <span style="font-size: 0.62rem; color: #8a7267; font-family: monospace;">SKU: ${p.sku}</span>
                        </div>
                    </div>
                    <div style="text-align: right; flex-shrink: 0;">
                        <span style="font-weight: 800; font-size: 0.75rem; color: #78000b; display: block;">€${p.effective_price.toFixed(2)}</span>
                        <a href="${p.edit_url}" target="_blank" style="font-size: 0.62rem; color: #8a7267; text-decoration: underline; cursor: pointer;">Edit</a>
                    </div>
                `;
                productsList.appendChild(itemDiv);
            });
        }

        // Description (Hide if empty)
        const descWrap = document.getElementById('deal-view-desc-wrapper');
        const descEl = document.getElementById('deal-view-desc');
        if (data.description && data.description.trim()) {
            descEl.textContent = data.description;
            descWrap.classList.remove('hidden');
        } else {
            descWrap.classList.add('hidden');
        }

        // Action links
        document.getElementById('deal-view-store-btn').href = data.store_url;
        document.getElementById('deal-view-edit-btn').href = data.edit_url;

        // Show modal and lock body scroll completely
        document.documentElement.classList.add('modal-open');
        document.body.classList.add('modal-open');
        document.getElementById('view-deal-modal').classList.remove('hidden');
    }

    function closeViewDealModal() {
        document.documentElement.classList.remove('modal-open');
        document.body.classList.remove('modal-open');
        const modal = document.getElementById('view-deal-modal');
        if (modal) modal.classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewDealModal();
        }
    });

    // Toggle Deal Status via AJAX
    function toggleDealStatus(dealId, buttonElement) {
        const originalHtml = buttonElement.innerHTML;
        buttonElement.disabled = true;
        buttonElement.style.opacity = '0.6';

        fetch(`/admin/deals/${dealId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network error');
            return response.json();
        })
        .then(data => {
            buttonElement.disabled = false;
            buttonElement.style.opacity = '1';

            if (data.success) {
                if (data.is_active) {
                    buttonElement.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100';
                    buttonElement.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>Active</span>';
                } else {
                    buttonElement.className = 'inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100';
                    buttonElement.innerHTML = '<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>Draft</span>';
                }

                if (window.LuxuryToast) {
                    LuxuryToast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            } else {
                buttonElement.innerHTML = originalHtml;
                if (window.LuxuryToast) {
                    LuxuryToast.fire({
                        icon: 'error',
                        title: data.message || 'Status update failed.'
                    });
                }
            }
        })
        .catch(err => {
            buttonElement.disabled = false;
            buttonElement.style.opacity = '1';
            buttonElement.innerHTML = originalHtml;
            if (window.LuxuryToast) {
                LuxuryToast.fire({
                    icon: 'error',
                    title: 'Server connection error.'
                });
            }
        });
    }

    // Delete confirmation with SweetAlert2
    function confirmDeleteDeal(id, title) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        if (window.LuxurySwal) {
            LuxurySwal.fire({
                title: isEn ? 'Delete Bundle?' : 'Bundle löschen?',
                text: isEn 
                    ? `Are you sure you want to permanently delete bundle "${title}"?` 
                    : `Möchten Sie das Bundle "${title}" wirklich unwiderruflich löschen?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-deal-form-' + id).submit();
                }
            });
        } else {
            if (confirm(`Are you sure you want to delete ${title}?`)) {
                document.getElementById('delete-deal-form-' + id).submit();
            }
        }
    }
</script>
@endsection

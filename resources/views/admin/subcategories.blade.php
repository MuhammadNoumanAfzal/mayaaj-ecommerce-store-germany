@extends('layouts.admin')
@section('title', 'Subcategories Management - MEHAAJ Atelier Admin')

@section('admin-styles')
<style>
    /* Full Page Modal Blur & Hide Scrollbars Across All Browsers */
    .modal-scroll-clean {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    .modal-scroll-clean::-webkit-scrollbar,
    #view-subcategory-modal .modal-scroll-clean::-webkit-scrollbar,
    #add-subcategory-modal .modal-scroll-clean::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }
</style>
@endsection

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Colorful Executive KPI Metric Cards (Ultra-Clean, Minimalist, Clickable with Cursor Pointer) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        
        <!-- 1. Total Subcategories -->
        <a href="{{ route('admin.subcategories') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fcf9f5] to-[#f7ece0] rounded-2xl border border-[#ebdccb] p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Gesamte Unterkategorien" data-i18n-en="Total Subcategories">Total Subcategories</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-[#1c1210] tracking-tight leading-none group-hover:text-[#78000b] transition-colors">{{ $totalCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-5 h-5 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.subcategories', ['status' => 'active']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f2faf5] to-[#e4f7ec] rounded-2xl border border-emerald-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-emerald-800 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-emerald-950 tracking-tight leading-none group-hover:text-emerald-700 transition-colors">{{ $activeCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #059669 0%, #064e3b 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </a>

        <!-- 3. Draft / Inactive -->
        <a href="{{ route('admin.subcategories', ['status' => 'draft']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fdf9f2] to-[#f9edd9] rounded-2xl border border-amber-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-amber-800 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-amber-950 tracking-tight leading-none group-hover:text-amber-700 transition-colors">{{ $draftCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #d97706 0%, #78350f 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </div>
            </div>
        </a>

        <!-- 4. Linked Products -->
        <a href="{{ route('admin.products') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f0f5fc] to-[#e1effe] rounded-2xl border border-blue-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-blue-800 uppercase tracking-wider block" data-i18n-de="Verknüpfte Produkte" data-i18n-en="Linked Products">Linked Products</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-blue-950 tracking-tight leading-none group-hover:text-blue-700 transition-colors">{{ $totalProducts }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>
        </a>

    </div>

    <!-- Main Subcategories Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-xs relative overflow-hidden border-t-4 border-t-[#78000b]">
        
        <!-- Header with Action Button (Clean Atelier Style) -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Unterkategorien Übersicht" data-i18n-en="Subcategories Directory">
                        Subcategories Directory
                    </h2>
                </div>
            </div>
            
            <button type="button" onclick="openAddSubcategoryModal()" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0 active:scale-95">
                <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Add Subcategory</span>
            </button>
        </div>

        <!-- Filter, Sort & Search Toolbar Form -->
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-[#faf7f2] via-[#f5ede2] to-[#faf7f2] border-b border-[#ebdccb] relative z-30">
            <form action="{{ route('admin.subcategories') }}" method="GET" id="subcategoriesFilterForm" class="flex flex-wrap lg:flex-nowrap items-center gap-2 text-xs font-semibold text-stone-700 w-full">
                
                <!-- Left: Search Box with Live Auto-Suggestions -->
                <div class="relative flex-1 min-w-[160px]">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="subcategorySearchInput"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            placeholder="Search subcategory by name, slug or parent..."
                            data-i18n-placeholder-de="Unterkategorie suchen..."
                            data-i18n-placeholder-en="Search subcategory by name, slug or parent..."
                            class="h-10 w-full pl-9 pr-8 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs placeholder:text-stone-400 placeholder:font-normal transition"
                        >
                        <!-- Search Icon -->
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">
                            <svg class="h-4 w-4 text-[#8a7267]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        
                        <!-- Clear Search Button -->
                        <button 
                            type="button" 
                            id="subcategorySearchClearBtn" 
                            onclick="clearSubcategorySearch()" 
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 h-5 w-5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-400 hover:text-stone-700 transition flex items-center justify-center text-[0.65rem] cursor-pointer {{ request('search') ? '' : 'hidden' }}"
                            title="Clear search"
                        >✕</button>
                    </div>

                    <!-- Live Floating Suggestions Dropdown -->
                    <div 
                        id="subcategorySuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white rounded-2xl border border-[#ebdccb] shadow-2xl overflow-hidden"
                    >
                        <div class="px-4 py-2.5 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-[#ebdccb] flex items-center justify-between text-[0.68rem] font-bold text-stone-400 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 text-stone-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                                <span>Suggested Subcategories</span>
                            </span>
                            <span id="sub-suggestions-count-badge" class="font-mono text-stone-500 font-bold"></span>
                        </div>
                        <div id="subcategorySuggestionsList" class="max-h-72 overflow-y-auto divide-y divide-stone-100">
                            <!-- Populated via JavaScript -->
                        </div>
                        <div class="px-4 py-2 bg-[#FAF7F2] border-t border-[#ebdccb] flex items-center justify-between text-[0.68rem] text-stone-500">
                            <span>Click suggestion or press <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">↵ Enter</kbd> to search</span>
                            <span><kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">Esc</kbd></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Sleek, Unified Filter Pills with Leading Icons (In Same Line, No Overlapping) -->
                <style>
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
                <div class="flex items-center gap-2 shrink-0 flex-wrap sm:flex-nowrap">
                    
                    <!-- Parent Category Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        <select 
                            name="category_id" 
                            onchange="this.form.submit()" 
                            style="padding-left: 34px !important; padding-right: 26px !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Category: All</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    Category: {{ $cat->name }} ({{ $cat->subcategories_count }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            style="padding-left: 34px !important; padding-right: 26px !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Status: All ({{ $totalCount }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Status: Active ({{ $activeCount }})</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Status: Draft ({{ $draftCount }})</option>
                        </select>
                        <div class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        <select 
                            name="sort" 
                            onchange="this.form.submit()" 
                            style="padding-left: 34px !important; padding-right: 26px !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="name_asc" {{ request('sort', 'name_asc') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="products_desc" {{ request('sort') === 'products_desc' ? 'selected' : '' }}>Sort: Most Products</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Sort: Oldest First</option>
                        </select>
                        <div class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Per Page Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        <select 
                            name="per_page" 
                            onchange="this.form.submit()" 
                            style="padding-left: 34px !important; padding-right: 26px !important; -webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 / page</option>
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 / page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / page</option>
                        </select>
                        <div class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 flex items-center text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'category_id', 'status', 'sort']))
                        <a href="{{ route('admin.subcategories') }}" class="h-10 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-[#ebdccb] hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5 shrink-0" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container (Fluid, Zero Horizontal Scrollbar) -->
        <div class="w-full overflow-x-auto lg:overflow-x-visible">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#483732] font-black uppercase tracking-wider text-[0.68rem] border-y border-[#ebdccb]">
                        <th class="py-3 px-3 font-black w-12 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3 px-3 font-black" data-i18n-de="Unterkategorie" data-i18n-en="Subcategory">Subcategory</th>
                        <th class="py-3 px-3 font-black" data-i18n-de="Hauptkategorie" data-i18n-en="Parent Category">Parent Category</th>
                        <th class="py-3 px-2 font-black text-center w-24" data-i18n-de="Produkte" data-i18n-en="Products">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Products</span>
                            </span>
                        </th>
                        <th class="py-3 px-2 font-black text-center w-24" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3 px-3 font-black text-center w-40" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6da] font-medium bg-white">
                    @forelse($subcategories as $subcategory)
                        @php
                            $subModalData = [
                                'id' => $subcategory->id,
                                'name' => $subcategory->name,
                                'slug' => $subcategory->slug,
                                'category_id' => $subcategory->category_id,
                                'category_name' => $subcategory->category ? $subcategory->category->name : 'N/A',
                                'category_slug' => $subcategory->category ? $subcategory->category->slug : '',
                                'description' => $subcategory->description ?? '',
                                'image_url' => $subcategory->image_url,
                                'status' => $subcategory->status,
                                'products_count' => $subcategory->products_count ?? 0,
                                'store_url' => route('shop', ['subcategory' => $subcategory->slug]),
                                'edit_url' => route('admin.subcategories.edit', $subcategory->id),
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="subcategory-row-{{ $subcategory->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $loop->iteration + ($subcategories->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Subcategory Name (Clean, Clickable opens Quick View) -->
                            <td class="py-3.5 px-3">
                                <div class="cursor-pointer group inline-flex items-center gap-2" onclick='openViewSubcategoryModal(@json($subModalData))' title="Click to view details">
                                    <span class="font-bold text-[#1c1210] text-xs sm:text-sm tracking-tight group-hover:text-[#78000b] transition-colors cursor-pointer">
                                        {{ $subcategory->name }}
                                    </span>
                                </div>
                            </td>

                            <!-- 3. Parent Category Binding Pill -->
                            <td class="py-3 px-3 whitespace-nowrap">
                                @if($subcategory->category)
                                    <a href="{{ route('admin.subcategories', ['category_id' => $subcategory->category_id]) }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-xs font-semibold bg-[#FAF7F2] text-[#78000b] border border-[#ebdccb] hover:bg-[#78000b] hover:text-white transition-all shadow-2xs cursor-pointer group/cat" title="Filter by {{ $subcategory->category->name }}">
                                        <svg class="w-3.5 h-3.5 text-[#78000b] group-hover/cat:text-white shrink-0 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                        <span>{{ $subcategory->category->name }}</span>
                                    </a>
                                @else
                                    <span class="text-xs text-stone-400 italic">Unassigned</span>
                                @endif
                            </td>

                            <!-- 4. Products Count Badge -->
                            <td class="py-3 px-2 text-center">
                                <a href="{{ route('admin.products', ['subcategory_id' => $subcategory->id]) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold bg-[#fcf4ec] text-[#78000b] border border-[#ebdccb] hover:bg-[#78000b] hover:text-white transition-all shadow-2xs cursor-pointer group/prod" title="{{ $subcategory->products_count }} Products">
                                    <svg class="w-3.5 h-3.5 text-[#78000b] group-hover/prod:text-white shrink-0 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    <span>{{ $subcategory->products_count }}</span>
                                </a>
                            </td>

                            <!-- 5. Status Toggle Badge -->
                            <td class="py-3 px-2 text-center">
                                <button 
                                    type="button" 
                                    onclick="toggleSubcategoryStatus({{ $subcategory->id }}, this)" 
                                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 {{ $subcategory->status === 'active' ? 'bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100' : 'bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100' }}"
                                    title="Click to toggle status (Active / Draft)"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $subcategory->status === 'active' ? 'bg-emerald-600 animate-pulse' : 'bg-amber-500' }}"></span>
                                    <span>{{ $subcategory->status === 'active' ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- 6. Actions (View, Edit, Delete) -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <!-- Quick View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewSubcategoryModal(@json($subModalData))'
                                        class="h-7 px-2.5 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="View Details"
                                    >
                                        <svg class="h-3 w-3 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                        class="h-7 px-2.5 rounded-lg border border-blue-200 bg-blue-50/70 text-blue-700 hover:bg-blue-600 hover:text-white hover:border-blue-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="Edit"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteSubcategory({{ $subcategory->id }}, '{{ addslashes($subcategory->name) }}', {{ $subcategory->products_count }})"
                                        class="h-7 px-2.5 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="Delete"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-subcategory-form-{{ $subcategory->id }}" action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST" class="hidden">
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
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Unterkategorien gefunden" data-i18n-en="No subcategories found">No subcategories found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Passen Sie Ihre Filter an oder erstellen Sie eine neue Unterkategorie." data-i18n-en="Adjust your search filters or create a new subcategory to expand your catalog.">
                                        Adjust your search filters or create a new subcategory to expand your catalog.
                                    </p>
                                    <div class="pt-2">
                                        <button type="button" onclick="openAddSubcategoryModal()" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs cursor-pointer">
                                            <span>+</span> <span data-i18n-de="Neue Unterkategorie Anlegen" data-i18n-en="Create New Subcategory">Create New Subcategory</span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Proper Production Pagination Footer -->
        <div class="p-4 sm:p-5 bg-gradient-to-r from-[#faf7f2] via-[#f7eee3] to-[#faf7f2] border-t border-[#ebdccb] flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-600">
            <div>
                @if($subcategories->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span> 
                    <strong class="text-stone-900 font-mono">{{ $subcategories->firstItem() }}</strong> 
                    <span data-i18n-de="bis" data-i18n-en="to">to</span> 
                    <strong class="text-stone-900 font-mono">{{ $subcategories->lastItem() }}</strong> 
                    <span data-i18n-de="von" data-i18n-en="of">of</span> 
                    <strong class="text-stone-900 font-mono">{{ $subcategories->total() }}</strong> 
                    <span data-i18n-de="Unterkategorien" data-i18n-en="subcategories">subcategories</span>
                @else
                    <span data-i18n-de="0 Unterkategorien gefunden" data-i18n-en="0 subcategories found">0 subcategories found</span>
                @endif
            </div>

            <div>
                {{ $subcategories->links() }}
            </div>
        </div>

    </div>

</div>

<!-- Subcategory Quick View Executive Modal (100% Full Page Blur, Wide Luxury Card, Compact Height, No Scrollbar) -->
<div 
    id="view-subcategory-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.72) !important; backdrop-filter: blur(12px) saturate(180%) !important; -webkit-backdrop-filter: blur(12px) saturate(180%) !important;" 
    onclick="closeViewSubcategoryModal()"
>
    <div 
        class="relative w-full max-w-2xl bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden my-auto transform transition-all" 
        onclick="event.stopPropagation()"
    >
        
        <!-- Luxury Gold & Wine Top Accent Strip -->
        <div class="h-1.5 w-full bg-gradient-to-r from-[#78000b] via-[#d8b45a] to-[#78000b]"></div>

        <!-- Modal Header (Compact) -->
        <div class="px-5 py-3 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0 shadow-xs" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-serif text-base font-bold text-[#1c1210] tracking-tight leading-tight">Subcategory Details</h3>
                    <p class="text-[0.65rem] text-stone-500 font-mono" id="sub-view-slug">/slug</p>
                </div>
            </div>
            <button type="button" onclick="closeViewSubcategoryModal()" class="w-7 h-7 rounded-lg bg-white hover:bg-stone-100 text-stone-500 hover:text-stone-900 border border-[#ebdccb] transition flex items-center justify-center cursor-pointer text-xs font-bold shadow-2xs active:scale-95" title="Close">
                ✕
            </button>
        </div>

        <!-- Modal Body Content (Compact Height, Hidden Scrollbar) -->
        <div class="p-4 sm:p-5 space-y-3 text-xs max-h-[72vh] overflow-y-auto modal-scroll-clean" style="scrollbar-width: none !important; -ms-overflow-style: none !important;">
            
            <!-- Hero Info (No Image) -->
            <div class="p-3.5 rounded-2xl bg-gradient-to-r from-[#FAF8F5] via-white to-[#FAF8F5] border border-[#ebdccb]">
                <div class="space-y-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="sub-view-name" class="font-serif font-bold text-lg text-[#1c1210] tracking-tight leading-snug"></h4>
                        <span id="sub-view-status-badge"></span>
                    </div>

                    <div class="flex items-center gap-2 text-[0.68rem] text-stone-500 font-medium">
                        <span class="inline-flex items-center gap-1 font-bold text-[#78000b] bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            Category: <strong id="sub-view-parent-cat">N/A</strong>
                        </span>
                        <span class="inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            ID: <strong id="sub-view-id" class="text-stone-900">#0</strong>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Overview Cards (Compact 2-Tile Strip) -->
            <div class="grid grid-cols-2 gap-2.5">
                <div class="p-2.5 sm:p-3 rounded-xl bg-gradient-to-br from-[#FAF8F5] to-[#F5ECE1] border border-[#ebdccb] flex items-center justify-between">
                    <div>
                        <span class="text-[0.62rem] font-bold text-[#8a7267] uppercase tracking-wider block">Parent Category</span>
                        <span id="sub-view-parent-cat-name" class="font-bold text-sm text-[#78000b] leading-tight truncate block">N/A</span>
                    </div>
                    <div class="w-7 h-7 rounded-lg bg-[#78000b]/10 text-[#78000b] flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    </div>
                </div>

                <div class="p-2.5 sm:p-3 rounded-xl bg-gradient-to-br from-[#f2faf5] to-[#e4f7ec] border border-emerald-200/80 flex items-center justify-between">
                    <div>
                        <span class="text-[0.62rem] font-bold text-emerald-800 uppercase tracking-wider block">Assigned Products</span>
                        <span id="sub-view-prods-count" class="font-bold text-base text-emerald-900 leading-tight">0</span>
                    </div>
                    <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]">Description</span>
                <div id="sub-view-desc" class="p-2.5 sm:p-3 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] text-stone-700 leading-relaxed text-xs"></div>
            </div>

        </div>

        <!-- Modal Footer Actions (Compact) -->
        <div class="px-5 py-2.5 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-t border-[#ebdccb] flex items-center justify-between gap-3">
            <a id="sub-view-store-btn" href="#" target="_blank" class="text-xs font-bold text-[#78000b] hover:underline inline-flex items-center gap-1 transition cursor-pointer">
                <span>View in Live Store</span>
                <span>↗</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewSubcategoryModal()" class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition cursor-pointer shadow-2xs active:scale-95">
                    Close
                </button>
                <a id="sub-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-3.5 py-1.5 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-md active:scale-95">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Subcategory</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Add Subcategory Popup Modal Dialog (100% Full Page Blur, Compact Height, Cursor Pointers) -->
<div 
    id="add-subcategory-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.75) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important;" 
    onclick="closeAddSubcategoryModal()"
>
    <div 
        class="relative w-full max-w-xl bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden p-5 sm:p-6 space-y-3.5 my-auto transform transition-all" 
        onclick="event.stopPropagation()"
    >
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-[#f0e8de] pb-3">
            <div>
                <h3 class="font-serif text-lg font-bold text-[#8B4513] tracking-tight">Add Subcategory</h3>
            </div>
            <button type="button" onclick="closeAddSubcategoryModal()" class="w-7 h-7 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer text-xs font-bold border border-stone-200 active:scale-95" title="Close">
                ✕
            </button>
        </div>

        <!-- Form (Compact) -->
        <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs">
            @csrf
            <input type="hidden" name="status" value="active">

            <!-- Parent Category Select -->
            <div>
                <label for="modal_sub_category_id" class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Parent Category <span class="text-[#78000b]">*</span>
                </label>
                <div class="relative">
                    <select 
                        name="category_id" 
                        id="modal_sub_category_id" 
                        required 
                        class="w-full h-10 px-3.5 pr-8 rounded-xl border border-stone-200 bg-stone-50/60 text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs appearance-none cursor-pointer"
                    >
                        <option value="">Select Parent Collection...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (string)request('category_id') === (string)$cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-stone-400">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </div>
                </div>
            </div>

            <!-- Subcategory Title -->
            <div>
                <label for="modal_sub_name" class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Subcategory Title <span class="text-[#78000b]">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="modal_sub_name" 
                    required 
                    placeholder="e.g. Crossbody & Saddle Bags"
                    class="w-full h-10 px-3.5 rounded-xl border border-stone-200 bg-stone-50/60 text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                >
            </div>

            <!-- Tagline / Description -->
            <div>
                <label for="modal_sub_desc" class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Description
                </label>
                <input 
                    type="text" 
                    name="description" 
                    id="modal_sub_desc" 
                    placeholder="Brief description for catalog display"
                    class="w-full h-10 px-3.5 rounded-xl border border-stone-200 bg-stone-50/60 text-xs font-medium text-stone-900 outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                >
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end gap-2.5 pt-1.5">
                <button type="button" onclick="closeAddSubcategoryModal()" class="text-xs font-semibold text-[#8a7c74] hover:text-[#1c1210] px-3 py-1.5 transition cursor-pointer active:scale-95">
                    Cancel
                </button>
                <button type="submit" class="h-9 px-5 rounded-xl bg-[#181210] hover:bg-[#78000b] text-white text-xs font-bold transition shadow-md active:scale-95 cursor-pointer">
                    Create Subcategory
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Teleport modals to document.body so fixed overlay covers 100% of screen without container clipping
    function ensureSubModalTeleported(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
    }

    function openViewSubcategoryModal(data) {
        ensureSubModalTeleported('view-subcategory-modal');
        document.getElementById('sub-view-id').textContent = '#' + data.id;
        document.getElementById('sub-view-name').textContent = data.name;
        document.getElementById('sub-view-slug').textContent = '/' + (data.category_slug ? data.category_slug + '/' : '') + data.slug;
        document.getElementById('sub-view-parent-cat').textContent = data.category_name;
        document.getElementById('sub-view-parent-cat-name').textContent = data.category_name;
        document.getElementById('sub-view-prods-count').textContent = data.products_count || 0;

        // Status badge
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        const badgeEl = document.getElementById('sub-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-300';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-300';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
        }

        // Description
        const descEl = document.getElementById('sub-view-desc');
        if (data.description && data.description.trim()) {
            descEl.textContent = data.description;
            descEl.classList.remove('italic', 'text-stone-400');
        } else {
            descEl.textContent = isEn ? 'No description available for this subcategory.' : 'Keine Beschreibung für diese Unterkategorie verfügbar.';
            descEl.classList.add('italic', 'text-stone-400');
        }

        // Action links
        document.getElementById('sub-view-store-btn').href = data.store_url;
        document.getElementById('sub-view-edit-btn').href = data.edit_url;

        // Show modal
        document.body.classList.add('overflow-hidden');
        document.getElementById('view-subcategory-modal').classList.remove('hidden');
    }

    function closeViewSubcategoryModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('view-subcategory-modal').classList.add('hidden');
    }

    function openAddSubcategoryModal() {
        ensureSubModalTeleported('add-subcategory-modal');
        document.body.classList.add('overflow-hidden');
        document.getElementById('add-subcategory-modal').classList.remove('hidden');
        setTimeout(() => document.getElementById('modal_sub_name')?.focus(), 50);
    }

    function closeAddSubcategoryModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('add-subcategory-modal').classList.add('hidden');
        if (window.location.hash === '#add-subcategory' || window.location.hash === '#add') {
            history.replaceState(null, null, ' ');
        }
    }

    // Auto-open if #add-subcategory in URL & Ensure modals are attached to body immediately
    window.addEventListener('DOMContentLoaded', function() {
        ensureSubModalTeleported('view-subcategory-modal');
        ensureSubModalTeleported('add-subcategory-modal');
        if (window.location.hash === '#add-subcategory' || window.location.hash === '#add') {
            openAddSubcategoryModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewSubcategoryModal();
            closeAddSubcategoryModal();
        }
    });

    // Quick Status Toggle via AJAX
    function toggleSubcategoryStatus(id, btn) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/admin/subcategories/${id}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const isEn = (window.__mehaaj_lang || 'en') === 'en';
                if (data.status === 'active') {
                    btn.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
                } else {
                    btn.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
                }

                if (window.LuxuryToast) {
                    LuxuryToast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            }
        })
        .catch(err => {
            console.error('Error toggling status:', err);
            if (window.LuxurySwal) {
                LuxurySwal.fire({
                    icon: 'error',
                    title: 'Action Failed',
                    text: 'Could not toggle subcategory status. Please try again.'
                });
            }
        });
    }

    // SweetAlert2 Confirmation for Deleting Subcategory
    function confirmDeleteSubcategory(id, name, productsCount) {
        if (!window.LuxurySwal) {
            if (confirm(`Are you sure you want to delete "${name}"?`)) {
                document.getElementById('delete-subcategory-form-' + id).submit();
            }
            return;
        }

        let warningHtml = `Are you sure you want to remove <strong class="text-stone-900">"${name}"</strong> from catalog?`;
        if (productsCount > 0) {
            warningHtml += `<br><span class="text-xs text-amber-700 font-semibold mt-2 block">⚠️ This subcategory has <strong>${productsCount}</strong> assigned products that will be unlinked.</span>`;
        }

        LuxurySwal.fire({
            title: 'Delete Subcategory?',
            html: warningHtml,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#78000b'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-subcategory-form-' + id).submit();
            }
        });
    }

    // Autocomplete Search Suggestions
    const allSubcategoriesData = @json($allSubcategoriesForSuggestions ?? []);
    const subSearchInput = document.getElementById('subcategorySearchInput');
    const subSuggestionsPanel = document.getElementById('subcategorySuggestionsPanel');
    const subSuggestionsList = document.getElementById('subcategorySuggestionsList');
    const subSuggestionsCount = document.getElementById('sub-suggestions-count-badge');
    const subClearBtn = document.getElementById('subcategorySearchClearBtn');

    if (subSearchInput && subSuggestionsPanel) {
        subSearchInput.addEventListener('input', function() {
            const val = this.value.trim().toLowerCase();
            if (subClearBtn) {
                subClearBtn.classList.toggle('hidden', val.length === 0);
            }

            if (val.length < 1) {
                subSuggestionsPanel.classList.add('hidden');
                return;
            }

            const matched = allSubcategoriesData.filter(sub => {
                return sub.name.toLowerCase().includes(val) || 
                       sub.slug.toLowerCase().includes(val) ||
                       (sub.category_name && sub.category_name.toLowerCase().includes(val));
            }).slice(0, 7);

            if (matched.length === 0) {
                subSuggestionsList.innerHTML = `<div class="px-4 py-3 text-stone-400 italic text-xs text-center">No matching subcategories found</div>`;
                subSuggestionsCount.textContent = '0';
                subSuggestionsPanel.classList.remove('hidden');
                return;
            }

            subSuggestionsCount.textContent = matched.length;
            subSuggestionsList.innerHTML = matched.map(sub => `
                <div class="px-4 py-2.5 hover:bg-[#FAF7F2] transition flex items-center justify-between cursor-pointer group" onclick="selectSubcategorySuggestion('${sub.name.replace(/'/g, "\\'")}')">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-7 h-7 rounded-lg bg-[#FAF7F2] border border-[#ebdccb] flex items-center justify-center shrink-0 text-[#78000b]">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                        <div class="truncate">
                            <span class="font-bold text-[#1c1210] group-hover:text-[#78000b] transition block leading-tight text-xs">${sub.name}</span>
                            <span class="text-[0.62rem] text-stone-500 font-mono">/${sub.slug} · <span class="text-[#78000b]">${sub.category_name}</span></span>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.6rem] font-bold uppercase ${sub.status === 'active' ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-amber-50 text-amber-800 border border-amber-200'}">
                        ${sub.status}
                    </span>
                </div>
            `).join('');

            subSuggestionsPanel.classList.remove('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!subSearchInput.contains(e.target) && !subSuggestionsPanel.contains(e.target)) {
                subSuggestionsPanel.classList.add('hidden');
            }
        });
    }

    function selectSubcategorySuggestion(name) {
        if (subSearchInput) {
            subSearchInput.value = name;
            subSuggestionsPanel.classList.add('hidden');
            document.getElementById('subcategoriesFilterForm').submit();
        }
    }

    function clearSubcategorySearch() {
        if (subSearchInput) {
            subSearchInput.value = '';
            if (subClearBtn) subClearBtn.classList.add('hidden');
            subSuggestionsPanel.classList.add('hidden');
            document.getElementById('subcategoriesFilterForm').submit();
        }
    }
</script>
@endsection

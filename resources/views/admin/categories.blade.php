@extends('layouts.admin')
@section('title', 'Categories Management - MEHAAJ Atelier Admin')

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
    #view-category-modal .modal-scroll-clean::-webkit-scrollbar,
    #add-category-modal .modal-scroll-clean::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }
</style>
@endsection

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Colorful Executive KPI Metric Cards (Ultra-Clean, Minimalist, No Extra Text, Clickable with Cursor Pointer) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
        
        <!-- 1. Total Categories -->
        <a href="{{ route('admin.categories') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fcf9f5] to-[#f7ece0] rounded-2xl border border-[#ebdccb] p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-[#8a7267] uppercase tracking-wider block" data-i18n-de="Gesamte Kategorien" data-i18n-en="Total Categories">Total Categories</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-[#1c1210] tracking-tight leading-none group-hover:text-[#78000b] transition-colors">{{ $totalCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-5 h-5 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </div>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.categories', ['status' => 'active']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f2faf5] to-[#e4f7ec] rounded-2xl border border-emerald-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-emerald-800 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-emerald-950 tracking-tight leading-none group-hover:text-emerald-700 transition-colors">{{ $activeCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #059669 0%, #064e3b 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </a>

        <!-- 3. Draft / Inactive -->
        <a href="{{ route('admin.categories', ['status' => 'draft']) }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#fdf9f2] to-[#f9edd9] rounded-2xl border border-amber-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-amber-800 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-amber-950 tracking-tight leading-none group-hover:text-amber-700 transition-colors">{{ $draftCount }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #d97706 0%, #78350f 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                </div>
            </div>
        </a>

        <!-- 4. Subcategories -->
        <a href="{{ route('admin.subcategories') }}" class="cursor-pointer group block bg-gradient-to-br from-white via-[#f0f5fc] to-[#e1effe] rounded-2xl border border-blue-200/90 p-4 shadow-2xs hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
            <span class="text-[0.68rem] font-bold text-blue-800 uppercase tracking-wider block" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Subcategories</span>
            <div class="mt-2.5 flex items-center justify-between">
                <span class="font-extrabold text-2xl sm:text-3xl text-blue-950 tracking-tight leading-none group-hover:text-blue-700 transition-colors">{{ $totalSubcategories }}</span>
                <div class="h-10 w-10 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-200 group-hover:scale-110" style="background: linear-gradient(135deg, #2563eb 0%, #1e3a8a 100%) !important; color: #ffffff !important;">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                </div>
            </div>
        </a>

    </div>

    <!-- Main Categories Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-xs relative overflow-hidden border-t-4 border-t-[#78000b]">
        
        <!-- Header with Action Button (Clean, No Extra Subtitle) -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Kategorien Übersicht" data-i18n-en="Categories Directory">
                        Categories Directory
                    </h2>
                </div>
            </div>
            
            <button type="button" onclick="openAddCategoryModal()" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0 active:scale-95">
                <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
            </button>
        </div>

        <!-- Filter, Sort & Search Toolbar Form -->
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-[#faf7f2] via-[#f5ede2] to-[#faf7f2] border-b border-[#ebdccb] relative z-30">
            <form action="{{ route('admin.categories') }}" method="GET" id="categoryFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3 text-xs font-semibold text-stone-700">
                
                <!-- Left: Search Box with Live Auto-Suggestions -->
                <div class="relative flex-1 min-w-[280px] max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="categorySearchInput"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            placeholder="Search category by name or slug..."
                            data-i18n-placeholder-de="Kategorie nach Name oder Slug suchen..."
                            data-i18n-placeholder-en="Search category by name or slug..."
                            class="h-10 w-full pl-9 pr-9 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs placeholder:text-stone-400 placeholder:font-normal transition"
                        >
                        <!-- Search Icon -->
                        <div class="absolute left-3 top-3 text-stone-400 pointer-events-none">
                            <svg class="h-4 w-4 text-[#8a7267]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        
                        <!-- Clear Search Button -->
                        <button 
                            type="button" 
                            id="categorySearchClearBtn" 
                            onclick="clearCategorySearch()" 
                            class="absolute right-2.5 top-2.5 h-5 w-5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-400 hover:text-stone-700 transition flex items-center justify-center text-[0.65rem] cursor-pointer {{ request('search') ? '' : 'hidden' }}"
                            title="Clear search"
                        >✕</button>
                    </div>

                    <!-- Live Floating Suggestions Dropdown -->
                    <div 
                        id="categorySuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white rounded-2xl border border-[#ebdccb] shadow-2xl overflow-hidden"
                    >
                        <div class="px-4 py-2.5 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-[#ebdccb] flex items-center justify-between text-[0.68rem] font-bold text-stone-400 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 text-stone-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#78000b]"></span>
                                <span>Suggested Categories</span>
                            </span>
                            <span id="suggestions-count-badge" class="font-mono text-stone-500 font-bold"></span>
                        </div>
                        <div id="categorySuggestionsList" class="max-h-72 overflow-y-auto divide-y divide-stone-100">
                            <!-- Populated via JavaScript -->
                        </div>
                        <div class="px-4 py-2 bg-[#FAF7F2] border-t border-[#ebdccb] flex items-center justify-between text-[0.68rem] text-stone-500">
                            <span>Click suggestion or press <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">↵ Enter</kbd> to search</span>
                            <span><kbd class="px-1.5 py-0.5 rounded-md bg-white border border-[#ebdccb] font-mono text-stone-700 font-bold shadow-2xs">Esc</kbd></span>
                        </div>
                    </div>
                </div>

                <!-- Right: Sleek, Unified Filter Pills with Leading Icons -->
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
                <div class="flex flex-wrap items-center gap-2.5">
                    
                    <!-- Status Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Status: All ({{ $totalCount }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Status: Active ({{ $activeCount }})</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Status: Draft ({{ $draftCount }})</option>
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
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="order_asc" {{ request('sort', 'order_asc') === 'order_asc' ? 'selected' : '' }}>Sort: Default Order</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="products_desc" {{ request('sort') === 'products_desc' ? 'selected' : '' }}>Sort: Most Products</option>
                            <option value="subs_desc" {{ request('sort') === 'subs_desc' ? 'selected' : '' }}>Sort: Most Subcategories</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Sort: Oldest First</option>
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
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-10 pl-8 pr-7 rounded-xl bg-white border border-[#ebdccb] text-xs font-bold text-stone-700 hover:border-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="5" {{ request('per_page', 5) == 5 ? 'selected' : '' }}>5 / page</option>
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 / page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 / page</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'status', 'sort']))
                        <a href="{{ route('admin.categories') }}" class="h-10 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-[#ebdccb] hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5" title="Reset all filters">
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
                        <th class="py-3 px-3 font-black" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-3 px-2 font-black text-center w-28" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                <span>Subcategories</span>
                            </span>
                        </th>
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
                    @forelse($categories as $category)
                        @php
                            $catModalData = [
                                 'id' => $category->id,
                                 'name' => $category->name,
                                 'slug' => $category->slug,
                                 'description' => $category->description ?? '',
                                 'image_url' => $category->image ? asset('storage/' . $category->image) : null,
                                 'status' => $category->status,
                                 'order_index' => $category->order_index ?? 0,
                                 'subcategories_count' => $category->subcategories_count ?? 0,
                                 'products_count' => $category->products_count ?? 0,
                                 'subcategories' => $category->subcategories ? $category->subcategories->map(function($s) {
                                     return ['id' => $s->id, 'name' => $s->name, 'slug' => $s->slug];
                                 })->values() : [],
                                 'store_url' => route('shop', ['category' => $category->slug]),
                                 'edit_url' => route('admin.categories.edit', $category->id),
                            ];
                        @endphp
                        <tr class="hover:bg-[#faf7f2] transition-colors duration-150" id="category-row-{{ $category->id }}">
                            
                            <!-- 1. Order Index Pill -->
                            <td class="py-3 px-3 text-center">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-lg bg-[#FAF7F2] font-mono font-bold text-[#78000b] text-xs border border-[#ebdccb] shadow-2xs">
                                    {{ $category->order_index }}
                                </span>
                            </td>

                            <!-- 2. Image & Category Name (Clickable with Pointer opens View Modal) -->
                            <td class="py-3 px-3">
                                <div class="flex items-center gap-3 cursor-pointer group" onclick='openViewCategoryModal(@json($catModalData))' title="Click to view details">
                                    <div class="h-10 w-10 rounded-xl overflow-hidden bg-[#F8F5EF] border border-[#ebdccb] shadow-2xs flex items-center justify-center shrink-0 relative transition-transform duration-200 group-hover:scale-105 group-hover:border-[#78000b]">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                            <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-[#FAF7F2]">
                                                <span class="font-serif font-bold text-[#78000b] text-sm">{{ mb_substr($category->name, 0, 1) }}</span>
                                            </div>
                                        @else
                                            <div class="text-[#78000b] flex items-center justify-center w-full h-full bg-[#FAF7F2] font-serif font-bold text-base">
                                                {{ mb_substr($category->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <span class="font-bold text-[#1c1210] text-sm tracking-tight truncate block group-hover:text-[#78000b] transition-colors cursor-pointer">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- 3. Subcategories Count Badge (Clickable with Pointer) -->
                            <td class="py-3 px-2 text-center">
                                <a href="{{ route('admin.subcategories', ['category_id' => $category->id]) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold bg-blue-50/80 text-blue-800 border border-blue-200/90 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all shadow-2xs cursor-pointer group/sub" title="View {{ $category->subcategories_count }} Subcategories">
                                    <svg class="w-3.5 h-3.5 text-blue-600 group-hover/sub:text-white shrink-0 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    <span>{{ $category->subcategories_count }}</span>
                                </a>
                            </td>

                            <!-- 4. Products Count Badge (Clickable with Pointer) -->
                            <td class="py-3 px-2 text-center">
                                <a href="{{ route('admin.products', ['category_id' => $category->id]) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold bg-[#fcf4ec] text-[#78000b] border border-[#ebdccb] hover:bg-[#78000b] hover:text-white transition-all shadow-2xs cursor-pointer group/prod" title="{{ $category->products_count }} Products">
                                    <svg class="w-3.5 h-3.5 text-[#78000b] group-hover/prod:text-white shrink-0 transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    <span>{{ $category->products_count }}</span>
                                </a>
                            </td>

                            <!-- 5. Status Toggle Badge (Clickable with Pointer) -->
                            <td class="py-3 px-2 text-center">
                                <button 
                                    type="button" 
                                    onclick="toggleCategoryStatus({{ $category->id }}, this)" 
                                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer active:scale-95 {{ $category->status === 'active' ? 'bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100' : 'bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100' }}"
                                    title="Click to toggle status (Active / Draft)"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $category->status === 'active' ? 'bg-emerald-600 animate-pulse' : 'bg-amber-500' }}"></span>
                                    <span>{{ $category->status === 'active' ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- 6. Actions (View, Edit, Delete with Cursors) - Sleek, Compact -->
                            <td class="py-3 px-3 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <!-- Quick View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewCategoryModal(@json($catModalData))'
                                        class="h-7 px-2.5 rounded-lg border border-stone-200 bg-white text-stone-700 hover:text-[#78000b] hover:border-[#78000b] hover:bg-[#FAF7F2] text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer active:scale-95"
                                        title="View Details"
                                    >
                                        <svg class="h-3 w-3 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span>View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="h-7 px-2 rounded-lg border border-blue-200 bg-blue-50/70 text-blue-700 hover:bg-blue-600 hover:text-white hover:border-blue-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Edit"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span>Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}', {{ $category->products_count }}, {{ $category->subcategories_count }})"
                                        class="h-7 px-2 rounded-lg border border-rose-200 bg-rose-50/70 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-rose-600 text-[0.7rem] font-bold transition shadow-2xs inline-flex items-center gap-1 cursor-pointer"
                                        title="Delete"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Delete</span>
                                    </button>

                                    <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
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
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Kategorien gefunden" data-i18n-en="No categories found">No categories found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Passen Sie Ihre Filter an oder erstellen Sie eine neue Kategorie." data-i18n-en="Adjust your search filters or create a new category to expand your catalog.">
                                        Adjust your search filters or create a new category to expand your catalog.
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.categories.create') }}" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs">
                                            <span>+</span> <span data-i18n-de="Neue Kategorie Anlegen" data-i18n-en="Create New Category">Create New Category</span>
                                        </a>
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
                @if($categories->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span> 
                    <strong class="text-stone-900 font-mono">{{ $categories->firstItem() }}</strong> 
                    <span data-i18n-de="bis" data-i18n-en="to">to</span> 
                    <strong class="text-stone-900 font-mono">{{ $categories->lastItem() }}</strong> 
                    <span data-i18n-de="von" data-i18n-en="of">of</span> 
                    <strong class="text-stone-900 font-mono">{{ $categories->total() }}</strong> 
                    <span data-i18n-de="Kategorien" data-i18n-en="categories">categories</span>
                @else
                    <span data-i18n-de="0 Kategorien gefunden" data-i18n-en="0 categories found">0 categories found</span>
                @endif
            </div>

            <div>
                {{ $categories->links() }}
            </div>
        </div>

    </div>

</div>

<!-- Category Quick View Executive Modal (100% Full Page Blur, Wide Luxury Card, Compact Height, No Scrollbar) -->
<div 
    id="view-category-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.72) !important; backdrop-filter: blur(12px) saturate(180%) !important; -webkit-backdrop-filter: blur(12px) saturate(180%) !important;" 
    onclick="closeViewCategoryModal()"
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
                    <h3 class="font-serif text-base font-bold text-[#1c1210] tracking-tight leading-tight">Category Details</h3>
                    <p class="text-[0.65rem] text-stone-500 font-mono" id="cat-view-slug">/slug</p>
                </div>
            </div>
            <button type="button" onclick="closeViewCategoryModal()" class="w-7 h-7 rounded-lg bg-white hover:bg-stone-100 text-stone-500 hover:text-stone-900 border border-[#ebdccb] transition flex items-center justify-center cursor-pointer text-xs font-bold shadow-2xs active:scale-95" title="Close">
                ✕
            </button>
        </div>

        <!-- Modal Body Content (Compact Height, Hidden Scrollbar) -->
        <div class="p-4 sm:p-5 space-y-3 text-xs max-h-[72vh] overflow-y-auto modal-scroll-clean" style="scrollbar-width: none !important; -ms-overflow-style: none !important;">
            
            <!-- Hero Info & Image -->
            <div class="flex items-center gap-3.5 p-3 rounded-2xl bg-gradient-to-r from-[#FAF8F5] via-white to-[#FAF8F5] border border-[#ebdccb]">
                <div class="w-14 h-14 rounded-xl overflow-hidden bg-[#FAF7F2] border border-[#ebdccb] shadow-xs shrink-0 flex items-center justify-center">
                    <img id="cat-view-img" src="" alt="Category Image" class="w-full h-full object-cover hidden">
                    <div id="cat-view-no-img" class="text-[#78000b] flex items-center justify-center w-full h-full font-serif font-bold text-xl">
                        M
                    </div>
                </div>

                <div class="space-y-1 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="cat-view-name" class="font-serif font-bold text-lg text-[#1c1210] tracking-tight leading-snug"></h4>
                        <span id="cat-view-status-badge"></span>
                    </div>

                    <div class="flex items-center gap-2 text-[0.68rem] text-stone-500 font-medium">
                        <span class="inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            Order: <strong id="cat-view-order" class="text-[#78000b]">0</strong>
                        </span>
                        <span class="inline-flex items-center gap-1 font-mono text-[0.65rem] font-bold text-stone-700 bg-[#FAF7F2] px-2 py-0.5 rounded-lg border border-[#ebdccb]">
                            ID: <strong id="cat-view-id" class="text-stone-900">#0</strong>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Stats Overview Cards (Compact 2-Tile Strip) -->
            <div class="grid grid-cols-2 gap-2.5">
                <div class="p-2.5 sm:p-3 rounded-xl bg-gradient-to-br from-[#FAF8F5] to-[#F5ECE1] border border-[#ebdccb] flex items-center justify-between">
                    <div>
                        <span class="text-[0.62rem] font-bold text-[#8a7267] uppercase tracking-wider block">Subcategories</span>
                        <span id="cat-view-subs-count" class="font-bold text-base text-[#78000b] leading-tight">0</span>
                    </div>
                    <div class="w-7 h-7 rounded-lg bg-[#78000b]/10 text-[#78000b] flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    </div>
                </div>

                <div class="p-2.5 sm:p-3 rounded-xl bg-gradient-to-br from-[#f2faf5] to-[#e4f7ec] border border-emerald-200/80 flex items-center justify-between">
                    <div>
                        <span class="text-[0.62rem] font-bold text-emerald-800 uppercase tracking-wider block">Assigned Products</span>
                        <span id="cat-view-prods-count" class="font-bold text-base text-emerald-900 leading-tight">0</span>
                    </div>
                    <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]">Description</span>
                <div id="cat-view-desc" class="p-2.5 sm:p-3 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] text-stone-700 leading-relaxed text-xs"></div>
            </div>

            <!-- Attached Subcategories -->
            <div class="space-y-1">
                <span class="block font-bold uppercase tracking-wider text-[0.62rem] text-[#8a7267]">Attached Subcategories</span>
                <div id="cat-view-subs-list" class="flex flex-wrap gap-1.5 p-2.5 rounded-xl bg-[#FAF8F5] border border-[#ebdccb] min-h-[38px] items-center">
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions (Compact) -->
        <div class="px-5 py-2.5 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-t border-[#ebdccb] flex items-center justify-between gap-3">
            <a id="cat-view-store-btn" href="#" target="_blank" class="text-xs font-bold text-[#78000b] hover:underline inline-flex items-center gap-1 transition cursor-pointer">
                <span>View in Live Store</span>
                <span>↗</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewCategoryModal()" class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition cursor-pointer shadow-2xs active:scale-95">
                    Close
                </button>
                <a id="cat-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-3.5 py-1.5 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-md active:scale-95">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span>Edit Category</span>
                </a>
            </div>
        </div>

    </div>
</div>

<!-- Add Collection Category Popup Modal Dialog (100% Full Page Blur, Compact Height, Cursor Pointers) -->
<div 
    id="add-category-modal" 
    class="fixed inset-0 z-[99999] flex items-center justify-center p-3 sm:p-5 hidden transition-all duration-300" 
    style="z-index: 99999 !important; position: fixed !important; top: 0 !important; left: 0 !important; right: 0 !important; bottom: 0 !important; width: 100vw !important; height: 100vh !important; background-color: rgba(15, 12, 11, 0.75) !important; backdrop-filter: blur(14px) saturate(180%) !important; -webkit-backdrop-filter: blur(14px) saturate(180%) !important;" 
    onclick="closeAddCategoryModal()"
>
    <div 
        class="relative w-full max-w-xl bg-white rounded-3xl border border-[#ebdccb] shadow-2xl overflow-hidden p-5 sm:p-6 space-y-3.5 my-auto transform transition-all" 
        onclick="event.stopPropagation()"
    >
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-[#f0e8de] pb-3">
            <div>
                <h3 class="font-serif text-lg font-bold text-[#8B4513] tracking-tight">Add Collection Category</h3>
            </div>
            <button type="button" onclick="closeAddCategoryModal()" class="w-7 h-7 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer text-xs font-bold border border-stone-200 active:scale-95" title="Close">
                ✕
            </button>
        </div>

        <!-- Form (Compact) -->
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs">
            @csrf
            <input type="hidden" name="status" value="active">

            <!-- Category Title -->
            <div>
                <label for="modal_cat_name" class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Category Title <span class="text-[#78000b]">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="modal_cat_name" 
                    required 
                    placeholder="e.g. Travel Duffles & Luggage"
                    class="w-full h-10 px-3.5 rounded-xl border border-stone-200 bg-stone-50/60 text-xs font-semibold text-stone-900 outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                >
            </div>

            <!-- Tagline -->
            <div>
                <label for="modal_cat_tagline" class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Tagline
                </label>
                <input 
                    type="text" 
                    name="description" 
                    id="modal_cat_tagline" 
                    placeholder="Brief poetic description of the collection"
                    class="w-full h-10 px-3.5 rounded-xl border border-stone-200 bg-stone-50/60 text-xs font-medium text-stone-900 outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                >
            </div>

            <!-- Banner Image Box -->
            <div>
                <label class="block font-bold text-[0.7rem] text-[#685c54] uppercase tracking-wider mb-1 cursor-pointer">
                    Banner Image
                </label>
                
                <div class="rounded-2xl border border-[#ebdccb] bg-[#FAF7F2] p-3 flex items-center gap-3">
                    <!-- Image Icon / Preview Thumbnail -->
                    <div id="modal_banner_preview_box" class="w-11 h-11 rounded-xl bg-stone-200/70 border border-stone-300 flex items-center justify-center text-stone-400 shrink-0 overflow-hidden shadow-2xs">
                        <img id="modal_banner_preview_img" src="" class="hidden w-full h-full object-cover">
                        <svg id="modal_banner_placeholder_svg" class="w-5 h-5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>

                    <!-- Upload Button & Hint -->
                    <div class="space-y-0.5">
                        <input type="file" name="image" id="modal_cat_file" accept="image/*" class="hidden" onchange="previewModalBanner(this)">
                        <button 
                            type="button" 
                            onclick="document.getElementById('modal_cat_file').click()" 
                            class="h-8 px-3.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer active:scale-95"
                            style="background: #181210 !important; color: #ffffff !important;"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: #ffffff !important;"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span style="color: #ffffff !important;">Upload from Computer</span>
                        </button>
                        <p id="modal_banner_filename" class="text-[0.65rem] text-[#8a7c74]">PNG, JPG, WEBP up to 10MB</p>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end gap-2.5 pt-1.5">
                <button type="button" onclick="closeAddCategoryModal()" class="text-xs font-semibold text-[#8a7c74] hover:text-[#1c1210] px-3 py-1.5 transition cursor-pointer active:scale-95">
                    Cancel
                </button>
                <button type="submit" class="h-9 px-5 rounded-xl bg-[#181210] hover:bg-[#78000b] text-white text-xs font-bold transition shadow-md active:scale-95 cursor-pointer">
                    Create Category
                </button>
            </div>
        </form>

    </div>
</div>
                    Create Category
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Teleport modals to document.body so fixed overlay covers 100% of screen without container clipping
    function ensureModalTeleported(modalId) {
        const modal = document.getElementById(modalId);
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
    }

    function openViewCategoryModal(data) {
        ensureModalTeleported('view-category-modal');
        document.getElementById('cat-view-id').textContent = '#' + data.id;
        document.getElementById('cat-view-name').textContent = data.name;
        document.getElementById('cat-view-slug').textContent = '/' + data.slug;
        const slugBadge = document.getElementById('cat-view-slug-badge');
        if (slugBadge) {
            slugBadge.textContent = '/' + data.slug;
        }
        const storeInline = document.getElementById('cat-view-store-inline');
        if (storeInline) {
            storeInline.href = data.store_url;
        }
        document.getElementById('cat-view-order').textContent = data.order_index;
        document.getElementById('cat-view-subs-count').textContent = data.subcategories_count || 0;
        document.getElementById('cat-view-prods-count').textContent = data.products_count || 0;

        // Image handling
        const imgEl = document.getElementById('cat-view-img');
        const noImgEl = document.getElementById('cat-view-no-img');
        if (data.image_url) {
            imgEl.src = data.image_url;
            imgEl.classList.remove('hidden');
            noImgEl.classList.add('hidden');
        } else {
            imgEl.src = '';
            imgEl.classList.add('hidden');
            noImgEl.classList.remove('hidden');
            noImgEl.textContent = data.name ? data.name.charAt(0) : 'M';
        }

        // Status badge
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        const badgeEl = document.getElementById('cat-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-300';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-300';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
        }

        // Description
        const descEl = document.getElementById('cat-view-desc');
        if (data.description && data.description.trim()) {
            descEl.textContent = data.description;
            descEl.classList.remove('italic', 'text-stone-400');
        } else {
            descEl.textContent = isEn ? 'No description available for this category.' : 'Keine Beschreibung für diese Kategorie verfügbar.';
            descEl.classList.add('italic', 'text-stone-400');
        }

        // Subcategories tags
        const subsList = document.getElementById('cat-view-subs-list');
        subsList.innerHTML = '';
        if (data.subcategories && data.subcategories.length > 0) {
            data.subcategories.forEach(sub => {
                const tag = document.createElement('span');
                tag.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-xs font-semibold bg-white text-stone-800 border border-[#ebdccb] shadow-2xs hover:border-[#78000b] hover:text-[#78000b] transition cursor-pointer';
                tag.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-[#78000b]"></span> <span>${sub.name}</span>`;
                subsList.appendChild(tag);
            });
        } else {
            subsList.innerHTML = `<span class="text-stone-400 italic text-xs">${isEn ? 'No subcategories assigned.' : 'Keine Unterkategorien zugewiesen.'}</span>`;
        }

        // Action links
        document.getElementById('cat-view-store-btn').href = data.store_url;
        document.getElementById('cat-view-edit-btn').href = data.edit_url;

        // Show modal
        document.body.classList.add('overflow-hidden');
        document.getElementById('view-category-modal').classList.remove('hidden');
    }

    function closeViewCategoryModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('view-category-modal').classList.add('hidden');
    }

    function openAddCategoryModal() {
        ensureModalTeleported('add-category-modal');
        document.body.classList.add('overflow-hidden');
        document.getElementById('add-category-modal').classList.remove('hidden');
        setTimeout(() => document.getElementById('modal_cat_name')?.focus(), 50);
    }

    function closeAddCategoryModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('add-category-modal').classList.add('hidden');
        if (window.location.hash === '#add-category' || window.location.hash === '#add') {
            history.replaceState(null, null, ' ');
        }
    }

    function previewModalBanner(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('modal_banner_preview_img');
                const svg = document.getElementById('modal_banner_placeholder_svg');
                const fn = document.getElementById('modal_banner_filename');
                if (img) { img.src = e.target.result; img.classList.remove('hidden'); }
                if (svg) { svg.classList.add('hidden'); }
                if (fn) {
                    fn.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                    fn.className = 'text-[0.65rem] text-emerald-700 font-bold';
                }
            };
            reader.readAsDataURL(file);
        }
    }

    // Auto-open if #add-category in URL & Ensure modals are attached to body immediately
    window.addEventListener('DOMContentLoaded', function() {
        ensureModalTeleported('view-category-modal');
        ensureModalTeleported('add-category-modal');
        if (window.location.hash === '#add-category' || window.location.hash === '#add') {
            openAddCategoryModal();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewCategoryModal();
            closeAddCategoryModal();
        }
    });

    // Quick Status Toggle via AJAX
    function toggleCategoryStatus(id, btn) {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/admin/categories/${id}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': token || '',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const isEn = (window.__mehaaj_lang || 'en') === 'en';
                if (data.status === 'active') {
                    btn.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
                } else {
                    btn.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-100';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
                }

                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            }
        })
        .catch(err => {
            console.error(err);
            if (window.LuxuryToast) {
                window.LuxuryToast.fire({
                    icon: 'error',
                    title: 'Could not update category status.'
                });
            }
        });
    }

    // Production-Ready Delete with Counts Warning
    function confirmDeleteCategory(id, name, productsCount, subcategoriesCount) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        
        let warningText = isEn 
            ? `Are you sure you want to delete "${name}"?` 
            : `Möchten Sie "${name}" wirklich löschen?`;

        if (productsCount > 0 || subcategoriesCount > 0) {
            warningText += isEn 
                ? `\n\nNotice: This category has ${subcategoriesCount} subcategories and ${productsCount} assigned products. Subcategories will be deleted and product links will be unassigned.`
                : `\n\nHinweis: Diese Kategorie enthält ${subcategoriesCount} Unterkategorien und ${productsCount} zugewiesene Produkte.`;
        }

        LuxurySwal.fire({
            title: isEn ? 'Delete Category?' : 'Kategorie löschen?',
            text: warningText,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete Category' : 'Ja, Kategorie Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-category-form-' + id).submit();
            }
        });
    }

    // ==========================================
    // Live Search Auto-Suggestions System
    // ==========================================
    const allCategoriesSuggestions = @json($allCategoriesForSuggestions ?? []);
    const catSearchInput = document.getElementById('categorySearchInput');
    const searchClearBtn = document.getElementById('categorySearchClearBtn');
    const suggestionsPanel = document.getElementById('categorySuggestionsPanel');
    const suggestionsList = document.getElementById('categorySuggestionsList');
    const suggestionsCountBadge = document.getElementById('suggestions-count-badge');
    const filterForm = document.getElementById('categoryFilterForm');
    let highlightedIndex = -1;

    function renderSuggestions(query) {
        if (!query || query.trim().length === 0) {
            if (suggestionsPanel) suggestionsPanel.classList.add('hidden');
            if (searchClearBtn) searchClearBtn.classList.add('hidden');
            return;
        }

        if (searchClearBtn) searchClearBtn.classList.remove('hidden');
        const q = query.trim().toLowerCase();
        
        const matches = allCategoriesSuggestions.filter(cat => {
            return (cat.name && cat.name.toLowerCase().includes(q)) || 
                   (cat.slug && cat.slug.toLowerCase().includes(q));
        });

        if (!suggestionsList || !suggestionsPanel) return;
        suggestionsList.innerHTML = '';
        highlightedIndex = -1;

        if (matches.length === 0) {
            if (suggestionsCountBadge) suggestionsCountBadge.textContent = '0 found';
            suggestionsList.innerHTML = `
                <div class="p-4 text-center text-xs text-stone-400">
                    <p class="font-medium text-stone-600">No categories matching "<span class="font-bold text-stone-900">${escapeHtml(query)}</span>"</p>
                    <p class="text-[0.68rem] text-stone-400 mt-0.5">Press Enter to perform database search</p>
                </div>
            `;
            suggestionsPanel.classList.remove('hidden');
            return;
        }

        if (suggestionsCountBadge) suggestionsCountBadge.textContent = `${matches.length} found`;

        matches.slice(0, 6).forEach((cat, idx) => {
            const item = document.createElement('div');
            item.className = 'suggestion-item px-3.5 py-2.5 flex items-center justify-between gap-3 hover:bg-[#F9F6F0] cursor-pointer transition group';
            item.setAttribute('data-index', idx);
            item.setAttribute('data-name', cat.name);

            const highlightedName = highlightMatch(cat.name, q);

            item.innerHTML = `
                <div class="flex items-center gap-3 min-w-0">
                    <div class="h-9 w-9 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 shrink-0 flex items-center justify-center">
                        ${cat.image_url 
                            ? `<img src="${cat.image_url}" alt="${escapeHtml(cat.name)}" class="h-full w-full object-cover">`
                            : `<span class="font-bold text-xs text-stone-500">${cat.name.charAt(0)}</span>`
                        }
                    </div>
                    <div class="min-w-0">
                        <div class="text-xs font-bold text-stone-800 group-hover:text-saltora-terracotta transition truncate">
                            ${highlightedName}
                        </div>
                        <div class="text-[0.68rem] text-stone-400 font-mono">
                            /${cat.slug} • <span class="text-stone-500 font-sans">${cat.products_count} items</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold uppercase tracking-wider ${cat.status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-stone-100 text-stone-600 border border-stone-200'}">
                        <span class="h-1.5 w-1.5 rounded-full ${cat.status === 'active' ? 'bg-emerald-600' : 'bg-stone-400'}"></span>
                        ${cat.status === 'active' ? 'Active' : 'Draft'}
                    </span>
                    <span class="text-stone-300 group-hover:text-saltora-terracotta text-xs font-bold transition">↵</span>
                </div>
            `;

            item.addEventListener('click', () => {
                selectSuggestion(cat.name);
            });

            suggestionsList.appendChild(item);
        });

        suggestionsPanel.classList.remove('hidden');
    }

    function highlightMatch(text, query) {
        if (!query) return escapeHtml(text);
        const idx = text.toLowerCase().indexOf(query.toLowerCase());
        if (idx === -1) return escapeHtml(text);
        const before = escapeHtml(text.substring(0, idx));
        const match = escapeHtml(text.substring(idx, idx + query.length));
        const after = escapeHtml(text.substring(idx + query.length));
        return `${before}<mark class="bg-saltora-blush text-saltora-terracotta font-extrabold px-1 py-0.2 rounded">${match}</mark>${after}`;
    }

    function escapeHtml(string) {
        const div = document.createElement('div');
        div.textContent = string;
        return div.innerHTML;
    }

    function selectSuggestion(name) {
        if (catSearchInput) {
            catSearchInput.value = name;
        }
        if (suggestionsPanel) {
            suggestionsPanel.classList.add('hidden');
        }
        if (filterForm) {
            filterForm.submit();
        }
    }

    function clearCategorySearch() {
        if (catSearchInput) {
            catSearchInput.value = '';
            catSearchInput.focus();
        }
        if (searchClearBtn) {
            searchClearBtn.classList.add('hidden');
        }
        if (suggestionsPanel) {
            suggestionsPanel.classList.add('hidden');
        }
        if (window.location.search.includes('search=')) {
            filterForm.submit();
        }
    }

    if (catSearchInput) {
        catSearchInput.addEventListener('input', (e) => {
            renderSuggestions(e.target.value);
        });

        catSearchInput.addEventListener('focus', () => {
            if (catSearchInput.value.trim().length > 0) {
                renderSuggestions(catSearchInput.value);
            }
        });

        catSearchInput.addEventListener('keydown', (e) => {
            if (!suggestionsPanel || suggestionsPanel.classList.contains('hidden')) {
                return;
            }

            const items = suggestionsList ? suggestionsList.querySelectorAll('.suggestion-item') : [];
            if (items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                highlightedIndex = (highlightedIndex + 1) % items.length;
                updateHighlightedSuggestion(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                highlightedIndex = (highlightedIndex - 1 + items.length) % items.length;
                updateHighlightedSuggestion(items);
            } else if (e.key === 'Enter') {
                if (highlightedIndex >= 0 && items[highlightedIndex]) {
                    e.preventDefault();
                    selectSuggestion(items[highlightedIndex].getAttribute('data-name'));
                }
            } else if (e.key === 'Escape') {
                suggestionsPanel.classList.add('hidden');
            }
        });
    }

    function updateHighlightedSuggestion(items) {
        items.forEach((item, idx) => {
            if (idx === highlightedIndex) {
                item.classList.add('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
                item.scrollIntoView({ block: 'nearest' });
            } else {
                item.classList.remove('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
            }
        });
    }

    // Close suggestions dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (suggestionsPanel && !suggestionsPanel.contains(e.target) && e.target !== catSearchInput) {
            suggestionsPanel.classList.add('hidden');
        }
    });
</script>
@endsection

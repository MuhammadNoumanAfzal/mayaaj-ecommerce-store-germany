@extends('layouts.admin')
@section('title', 'Categories Management - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 3 Compact Executive KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 lg:gap-4">
        
        <!-- 1. Total Categories -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Gesamte Kategorien" data-i18n-en="Total Categories">Total Categories</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $totalCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200/80 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-saltora-blush group-hover:text-saltora-terracotta transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <!-- 2. Active in Store -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $activeCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 3. Draft / Inactive -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $draftCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50/70 text-amber-700 border border-amber-200/70 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-amber-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>

    </div>

    <!-- Main Categories Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Action Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span data-i18n-de="Kategorien Übersicht & Steuerung" data-i18n-en="Categories Directory & Ordering">Categories Directory & Ordering</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Reihenfolge, Sichtbarkeit und Hierarchien für den Storefront." data-i18n-en="Control sorting order, visibility, and product linkages across the MEHAAJ storefront.">
                    Control sorting order, visibility, and product linkages across the MEHAAJ storefront.
                </p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
            </a>
        </div>

        <!-- Filter, Sort & Search Toolbar Form -->
        <div class="p-4 sm:p-5 bg-[#FCFAF7] border-b border-stone-200/80 relative z-30">
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
                            class="h-11 w-full pl-10 pr-9 rounded-xl border border-stone-200/90 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs hover:border-stone-300 placeholder:text-stone-400 placeholder:font-normal transition"
                        >
                        <!-- Search Icon -->
                        <div class="absolute left-3.5 top-3.5 text-stone-400 pointer-events-none">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        
                        <!-- Clear Search Button -->
                        <button 
                            type="button" 
                            id="categorySearchClearBtn" 
                            onclick="clearCategorySearch()" 
                            class="absolute right-2.5 top-3 h-5 w-5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-400 hover:text-stone-700 transition flex items-center justify-center text-[0.65rem] cursor-pointer {{ request('search') ? '' : 'hidden' }}"
                            title="Clear search"
                        >✕</button>
                    </div>

                    <!-- Live Floating Suggestions Dropdown -->
                    <div 
                        id="categorySuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-white rounded-2xl border border-stone-200 shadow-2xl overflow-hidden"
                    >
                        <div class="px-4 py-2.5 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between text-[0.68rem] font-bold text-stone-400 uppercase tracking-wider">
                            <span class="flex items-center gap-1.5 text-stone-600">
                                <span class="h-1.5 w-1.5 rounded-full bg-saltora-terracotta"></span>
                                <span>Suggested Categories</span>
                            </span>
                            <span id="suggestions-count-badge" class="font-mono text-stone-500 font-bold"></span>
                        </div>
                        <div id="categorySuggestionsList" class="max-h-72 overflow-y-auto divide-y divide-stone-100">
                            <!-- Populated via JavaScript -->
                        </div>
                        <div class="px-4 py-2.5 bg-stone-50/80 border-t border-stone-100 flex items-center justify-between text-[0.68rem] text-stone-400">
                            <span>Click suggestion or press <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-stone-200 font-mono text-stone-600 font-bold shadow-2xs">↵ Enter</kbd> to search</span>
                            <span><kbd class="px-1.5 py-0.5 rounded-md bg-white border border-stone-200 font-mono text-stone-600 font-bold shadow-2xs">Esc</kbd></span>
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
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        <select 
                            name="status" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Status: All ({{ $totalCount }})</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Status: Active ({{ $activeCount }})</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Status: Draft ({{ $draftCount }})</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Sort Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                        <select 
                            name="sort" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="order_asc" {{ request('sort', 'order_asc') === 'order_asc' ? 'selected' : '' }}>Sort: Default Order</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="products_desc" {{ request('sort') === 'products_desc' ? 'selected' : '' }}>Sort: Most Products</option>
                            <option value="subs_desc" {{ request('sort') === 'subs_desc' ? 'selected' : '' }}>Sort: Most Subcategories</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Sort: Oldest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'status', 'sort']))
                        <a href="{{ route('admin.categories') }}" class="h-11 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-stone-200/90 hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container -->
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-3.5 px-4 font-black w-16 text-center" data-i18n-de="Index" data-i18n-en="Order">Order</th>
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-3.5 px-3 font-black text-center w-28" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Subcategories</th>
                        <th class="py-3.5 px-3 font-black text-center w-28" data-i18n-de="Produkte" data-i18n-en="Products">Products</th>
                        <th class="py-3.5 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-4 font-black text-center w-52" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($categories as $category)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80" id="category-row-{{ $category->id }}">
                            
                            <!-- 1. Order Index Pill -->
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center justify-center h-7 w-7 rounded-lg bg-stone-100 font-mono font-bold text-stone-700 text-xs border border-stone-200 shadow-2xs">
                                    {{ $category->order_index }}
                                </span>
                            </td>

                            <!-- 2. Image & Name (Slug moved to Detail modal) -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="h-11 w-11 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0 group relative">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                            <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                                <span class="font-display font-bold text-stone-500 text-sm">{{ mb_substr($category->name, 0, 1) }}</span>
                                            </div>
                                        @else
                                            <div class="text-stone-400 flex items-center justify-center w-full h-full bg-stone-100 font-display font-bold text-stone-600 text-base">
                                                {{ mb_substr($category->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="min-w-0">
                                        <span class="font-extrabold text-stone-900 text-sm tracking-tight truncate block">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <!-- 3. Subcategories Count -->
                            <td class="py-3.5 px-3 text-center">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-stone-100 text-stone-800 border border-stone-200">
                                    {{ $category->subcategories_count }}
                                </span>
                            </td>

                            <!-- 4. Products Count -->
                            <td class="py-3.5 px-3 text-center">
                                <a href="{{ route('admin.products', ['category_id' => $category->id]) }}" class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-extrabold bg-saltora-blush/80 text-saltora-terracotta border border-saltora-terracotta/20 hover:bg-saltora-terracotta hover:text-white transition shadow-2xs" title="Filter products by this category">
                                    <span>{{ $category->products_count }}</span>
                                    <span class="text-[0.65rem] font-normal">items</span>
                                </a>
                            </td>

                            <!-- 5. Status Toggle Badge -->
                            <td class="py-3.5 px-3 text-center">
                                <button 
                                    type="button" 
                                    onclick="toggleCategoryStatus({{ $category->id }}, this)" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer {{ $category->status === 'active' ? 'badge-active hover:bg-emerald-100' : 'badge-draft hover:bg-stone-200' }}"
                                    title="Click to toggle status (Active / Draft)"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full {{ $category->status === 'active' ? 'bg-emerald-600 animate-pulse' : 'bg-stone-400' }}"></span>
                                    <span>{{ $category->status === 'active' ? 'Active' : 'Draft' }}</span>
                                </button>
                            </td>

                            <!-- 6. Actions (View, Edit, Delete) -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
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

                                    <!-- Quick View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewCategoryModal(@json($catModalData))'
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Category Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs hover:border-blue-600 hover:text-blue-600"
                                        title="Edit Category"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}', {{ $category->products_count }}, {{ $category->subcategories_count }})"
                                        class="btn-exec-danger rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Delete Category"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
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
        <div class="p-5 sm:p-6 bg-stone-50/70 border-t border-stone-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-600">
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

<!-- Category Quick View Executive Modal (Full-Screen Soft Blur Background Covering Header) -->
<div id="view-category-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden transition-all duration-300" style="z-index: 9999 !important; background-color: rgba(28, 25, 23, 0.15) !important; backdrop-filter: blur(3px) !important; -webkit-backdrop-filter: blur(3px) !important;" onclick="closeViewCategoryModal()">
    <div class="relative w-full max-w-lg bg-white rounded-2xl border border-stone-200/90 shadow-2xl overflow-hidden border-t-4 border-t-saltora-terracotta" onclick="event.stopPropagation()">
        
        <!-- Modal Top Banner / Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-sm shadow-2xs border border-saltora-terracotta/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-stone-900 text-sm tracking-tight" data-i18n-de="Kategorie-Details" data-i18n-en="Category Details">Category Details</h3>
                    <p class="text-[0.68rem] text-stone-400 font-medium font-mono" id="cat-view-slug">/slug</p>
                </div>
            </div>
            <button type="button" onclick="closeViewCategoryModal()" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 text-xs max-h-[75vh] modal-scroll-clean">
            
            <!-- Category Hero Info & Image -->
            <div class="flex items-start gap-4 p-4 rounded-xl bg-stone-50/70 border border-stone-200/70">
                <div class="w-20 h-20 min-w-[5rem] min-h-[5rem] max-w-[5rem] max-h-[5rem] rounded-xl overflow-hidden bg-white border border-stone-200 shadow-2xs shrink-0 flex items-center justify-center">
                    <img id="cat-view-img" src="" alt="Category Image" class="w-full h-full object-cover hidden">
                    <div id="cat-view-no-img" class="text-stone-300 flex items-center justify-center w-full h-full font-display font-bold text-2xl text-stone-400">
                        M
                    </div>
                </div>

                <div class="space-y-2 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="cat-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="cat-view-status-badge"></span>
                    </div>

                    <!-- Direct Slug & Storefront Link in Detail -->
                    <div class="flex items-center gap-2 pt-0.5 flex-wrap">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-stone-100 border border-stone-200 font-mono text-stone-800 text-[0.72rem] font-bold">
                            <span class="text-stone-400 font-sans font-extrabold text-[0.62rem] uppercase tracking-wider">Slug:</span>
                            <span id="cat-view-slug-badge">/slug</span>
                        </span>
                        <a id="cat-view-store-inline" href="#" target="_blank" class="inline-flex items-center gap-1 text-[0.72rem] font-bold text-saltora-terracotta hover:underline bg-saltora-blush/60 px-2.5 py-1 rounded-lg border border-saltora-terracotta/20 transition hover:bg-saltora-blush" title="Open this category live on storefront">
                            <span data-i18n-de="Im Shop ansehen" data-i18n-en="Storefront Link">Storefront Link</span>
                            <span>↗</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-3 text-[0.7rem] text-stone-500 font-medium pt-0.5">
                        <span><span class="text-stone-400 font-bold uppercase tracking-wider" data-i18n-de="Sortierung:" data-i18n-en="Sort Order:">Sort Order:</span> <strong id="cat-view-order" class="text-stone-800 font-mono">0</strong></span>
                        <span>•</span>
                        <span><span class="text-stone-400 font-bold uppercase tracking-wider" data-i18n-de="ID:" data-i18n-en="ID:">ID:</span> <strong id="cat-view-id" class="text-stone-800 font-mono">#0</strong></span>
                    </div>
                </div>
            </div>

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-2 gap-3">
                <div class="p-3.5 rounded-xl bg-saltora-blush/40 border border-saltora-terracotta/15 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-saltora-terracotta/10 text-saltora-terracotta flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Subcategories</span>
                        <span id="cat-view-subs-count" class="font-extrabold text-base text-stone-900 leading-none">0</span>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-200/60 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Produkte" data-i18n-en="Assigned Products">Assigned Products</span>
                        <span id="cat-view-prods-count" class="font-extrabold text-base text-emerald-800 leading-none">0</span>
                    </div>
                </div>
            </div>

            <!-- Full Description Section -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500" data-i18n-de="Beschreibung" data-i18n-en="Description">Description</label>
                </div>
                <div id="cat-view-desc" class="p-4 rounded-xl bg-stone-50/80 border border-stone-200/80 text-stone-700 leading-relaxed min-h-[60px] whitespace-pre-line text-xs font-normal"></div>
            </div>

            <!-- Subcategories Listing -->
            <div>
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-2" data-i18n-de="Zugehörige Unterkategorien" data-i18n-en="Attached Subcategories">Attached Subcategories</label>
                <div id="cat-view-subs-list" class="flex flex-wrap gap-1.5 p-3 rounded-xl bg-stone-50 border border-stone-200/70 min-h-[42px] items-center">
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-between gap-3">
            <a id="cat-view-store-btn" href="#" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta">
                <svg class="w-3.5 h-3.5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span data-i18n-de="Im Shop ansehen" data-i18n-en="View in Store">View in Store</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewCategoryModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer shadow-2xs" data-i18n-de="Schließen" data-i18n-en="Close">Close</button>
                <a id="cat-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span data-i18n-de="Bearbeiten" data-i18n-en="Edit Category">Edit Category</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    function openViewCategoryModal(data) {
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
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-active';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-draft';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
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
                tag.className = 'inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-bold bg-white text-stone-800 border border-stone-200 shadow-2xs';
                tag.innerHTML = `<span class="text-saltora-terracotta">↳</span> ${sub.name}`;
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewCategoryModal();
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
                    btn.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer badge-active hover:bg-emerald-100';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600 animate-pulse"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
                } else {
                    btn.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider transition-all shadow-2xs cursor-pointer badge-draft hover:bg-stone-200';
                    btn.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-stone-400"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
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
    const searchInput = document.getElementById('categorySearchInput');
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
        if (searchInput) {
            searchInput.value = name;
        }
        if (suggestionsPanel) {
            suggestionsPanel.classList.add('hidden');
        }
        if (filterForm) {
            filterForm.submit();
        }
    }

    function clearCategorySearch() {
        if (searchInput) {
            searchInput.value = '';
            searchInput.focus();
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

    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            renderSuggestions(e.target.value);
        });

        searchInput.addEventListener('focus', () => {
            if (searchInput.value.trim().length > 0) {
                renderSuggestions(searchInput.value);
            }
        });

        searchInput.addEventListener('keydown', (e) => {
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
        if (suggestionsPanel && !suggestionsPanel.contains(e.target) && e.target !== searchInput) {
            suggestionsPanel.classList.add('hidden');
        }
    });
</script>
@endsection

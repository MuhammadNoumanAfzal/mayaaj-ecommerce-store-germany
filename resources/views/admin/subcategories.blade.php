@extends('layouts.admin')
@section('title', 'Subcategories Management - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 3 Compact Executive KPI Metric Cards (Clickable Filter Shortcuts with Cursor Pointer) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 lg:gap-4">
        
        <!-- 1. Total Subcategories -->
        <a href="{{ route('admin.subcategories') }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-stone-400 transition-all duration-150 flex items-center justify-between cursor-pointer" title="View all subcategories">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Gesamte Unterkategorien" data-i18n-en="Total Subcategories">Total Subcategories</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $totalCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200/80 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-saltora-blush group-hover:text-saltora-terracotta transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </a>

        <!-- 2. Active in Store -->
        <a href="{{ route('admin.subcategories', ['status' => 'active']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-emerald-300 transition-all duration-150 flex items-center justify-between cursor-pointer" title="Filter by Active">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $activeCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-emerald-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </a>

        <!-- 3. Draft / Inactive -->
        <a href="{{ route('admin.subcategories', ['status' => 'draft']) }}" class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs hover:border-amber-300 transition-all duration-150 flex items-center justify-between cursor-pointer" title="Filter by Draft">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Entwurf / Versteckt" data-i18n-en="Draft / Inactive">Draft / Inactive</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $draftCount }}</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50/70 text-amber-700 border border-amber-200/70 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 group-hover:bg-amber-100 transition-all duration-150">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </a>

    </div>

    <!-- Main Subcategories Management Card -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Action Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    <span data-i18n-de="Unterkategorien Übersicht & Zuordnung" data-i18n-en="Subcategories Directory & Linkages">Subcategories Directory & Linkages</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Unterkategorien und deren Bindung an Hauptkategorien." data-i18n-en="Manage subcategories, catalog classifications, and parent category bindings.">
                    Manage subcategories, catalog classifications, and parent category bindings.
                </p>
            </div>
            
            <a href="{{ route('admin.subcategories.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Neue Unterkategorie" data-i18n-en="Add Subcategory">Add Subcategory</span>
            </a>
        </div>

        <!-- Sleek Search & Filters Toolbar -->
        <div class="p-4 sm:p-5 bg-stone-50/70 border-b border-stone-200/80 relative z-30">
            <form action="{{ route('admin.subcategories') }}" method="GET" id="subcategoriesFilterForm" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-3">
                
                <!-- Left: Search with Instant Suggestions Dropdown -->
                <div class="relative flex-1 max-w-xl">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            id="subcategorySearchInput"
                            value="{{ request('search') }}"
                            autocomplete="off"
                            placeholder="Search subcategory by name, slug or parent category..."
                            data-i18n-placeholder-de="Unterkategorie nach Name, Slug oder Hauptkategorie suchen..."
                            data-i18n-placeholder-en="Search subcategory by name, slug or parent category..."
                            class="h-11 w-full pl-10 pr-9 rounded-xl border border-stone-200/90 bg-white text-xs font-semibold text-stone-900 placeholder:text-stone-400 placeholder:font-normal focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none transition"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-3 top-3.5 text-stone-400 hover:text-stone-600 transition" title="Clear search">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>

                    <!-- Floating Instant Suggestions Panel -->
                    <div 
                        id="subcategorySuggestionsPanel" 
                        class="hidden absolute left-0 right-0 top-full mt-1.5 bg-white rounded-xl border border-stone-200 shadow-xl overflow-hidden z-50 divide-y divide-stone-100 max-h-80 overflow-y-auto"
                    >
                        <!-- Dynamic items injected via JS -->
                    </div>
                </div>

                <!-- Right: Sleek Filter Pills with Single Clean Chevron -->
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
                    
                    <!-- Parent Category Filter -->
                    <div class="relative">
                        <svg class="w-3.5 h-3.5 text-stone-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        <select 
                            name="category_id" 
                            onchange="this.form.submit()" 
                            style="-webkit-appearance: none !important; -moz-appearance: none !important; appearance: none !important; background-image: none !important;"
                            class="filter-select h-11 pl-9 pr-8 rounded-xl bg-white border border-stone-200/90 text-xs font-bold text-stone-700 hover:border-stone-400 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs outline-none cursor-pointer transition appearance-none"
                        >
                            <option value="">Category: All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    Category: {{ $cat->name }} ({{ $cat->subcategories_count }})
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

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
                            <option value="name_asc" {{ request('sort', 'name_asc') === 'name_asc' ? 'selected' : '' }}>Sort: Name (A → Z)</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Sort: Name (Z → A)</option>
                            <option value="products_desc" {{ request('sort') === 'products_desc' ? 'selected' : '' }}>Sort: Most Products</option>
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Sort: Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Sort: Oldest First</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-stone-400">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </div>
                    </div>

                    <!-- Reset Filters Button -->
                    @if(request()->anyFilled(['search', 'category_id', 'status', 'sort']))
                        <a href="{{ route('admin.subcategories') }}" class="h-11 px-3.5 rounded-xl text-xs font-bold text-stone-600 hover:text-rose-600 bg-white hover:bg-rose-50 border border-stone-200/90 hover:border-rose-200 transition shadow-2xs inline-flex items-center gap-1.5" title="Reset all filters">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                        </a>
                    @endif

                </div>

            </form>
        </div>

        <!-- Table Container (Clean, Modern, No Horizontal Scroll) -->
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-3.5 px-4 font-black w-14 text-center" data-i18n-de="#" data-i18n-en="#">#</th>
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Unterkategorie" data-i18n-en="Subcategory">Subcategory</th>
                        <th class="py-3.5 px-4 font-black" data-i18n-de="Hauptkategorie" data-i18n-en="Parent Category">Parent Category</th>
                        <th class="py-3.5 px-3 font-black text-center w-28" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-4 font-black text-center w-52" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($subcategories as $subcategory)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80" id="subcategory-row-{{ $subcategory->id }}">
                            
                            <!-- 1. Row Index -->
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center justify-center h-7 w-7 rounded-lg bg-stone-100 font-mono font-bold text-stone-700 text-xs border border-stone-200 shadow-2xs">
                                    {{ $loop->iteration + ($subcategories->firstItem() - 1) }}
                                </span>
                            </td>

                            <!-- 2. Subcategory Name (Pic field removed as requested) -->
                            <td class="py-3.5 px-4">
                                <span class="font-extrabold text-stone-900 text-sm tracking-tight block">
                                    {{ $subcategory->name }}
                                </span>
                            </td>

                            <!-- 3. Parent Category Binding Pill (Guaranteed Single Line) -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($subcategory->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs whitespace-nowrap">
                                        {{ $subcategory->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-stone-400 italic">Unassigned</span>
                                @endif
                            </td>

                            <!-- 4. Status Badge -->
                            <td class="py-3.5 px-3 text-center">
                                @if($subcategory->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        <span data-i18n-de="AKTIV" data-i18n-en="ACTIVE">ACTIVE</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/80 shadow-2xs">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        <span data-i18n-de="ENTWURF" data-i18n-en="DRAFT">DRAFT</span>
                                    </span>
                                @endif
                            </td>

                            <!-- 6. Actions (View, Edit, Delete) -->
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    
                                    @php
                                        $subModalData = [
                                            'id' => $subcategory->id,
                                            'name' => $subcategory->name,
                                            'slug' => $subcategory->slug,
                                            'category_name' => $subcategory->category ? $subcategory->category->name : 'N/A',
                                            'category_slug' => $subcategory->category ? $subcategory->category->slug : '',
                                            'description' => $subcategory->description ?? '',
                                            'image_url' => $subcategory->image ? asset('storage/' . $subcategory->image) : null,
                                            'status' => $subcategory->status,
                                            'products_count' => $subcategory->products_count ?? 0,
                                            'store_url' => route('shop', ['subcategory' => $subcategory->slug]),
                                            'edit_url' => route('admin.subcategories.edit', $subcategory->id),
                                        ];
                                    @endphp

                                    <!-- View / Detail Modal Button -->
                                    <button
                                        type="button"
                                        onclick='openViewSubcategoryModal(@json($subModalData))'
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Subcategory Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                        class="btn-exec-secondary rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Edit Subcategory"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteSubcategory({{ $subcategory->id }}, '{{ addslashes($subcategory->name) }}', {{ $subcategory->products_count }})"
                                        class="btn-exec-danger rounded-xl px-2.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                        title="Delete Subcategory"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
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
                            <td colspan="5" class="py-16 px-6 text-center text-stone-500 text-xs">
                                <div class="max-w-sm mx-auto space-y-3">
                                    <div class="h-12 w-12 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                    </div>
                                    <p class="text-base font-bold text-stone-800" data-i18n-de="Keine Unterkategorien gefunden" data-i18n-en="No subcategories found">No subcategories found</p>
                                    <p class="text-stone-500 text-xs" data-i18n-de="Passen Sie Ihre Filter an oder legen Sie eine neue Unterkategorie an." data-i18n-en="Adjust your search filters or create a new subcategory to expand your catalog.">
                                        Adjust your search filters or create a new subcategory to expand your catalog.
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ route('admin.subcategories.create') }}" class="btn-exec-primary inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold shadow-xs">
                                            <span>+</span> <span data-i18n-de="Neue Unterkategorie Anlegen" data-i18n-en="Create New Subcategory">Create New Subcategory</span>
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
        <div class="p-4 sm:p-5 bg-stone-50/70 border-t border-stone-200/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-600">
            <div>
                @if($subcategories->total() > 0)
                    <span data-i18n-de="Zeige" data-i18n-en="Showing">Showing</span>
                    <strong class="text-stone-900 font-extrabold">{{ $subcategories->firstItem() }}</strong>
                    <span data-i18n-de="bis" data-i18n-en="to">to</span>
                    <strong class="text-stone-900 font-extrabold">{{ $subcategories->lastItem() }}</strong>
                    <span data-i18n-de="von" data-i18n-en="of">of</span>
                    <strong class="text-stone-900 font-extrabold">{{ $subcategories->total() }}</strong>
                    <span data-i18n-de="Unterkategorien" data-i18n-en="subcategories">subcategories</span>
                @else
                    <span data-i18n-de="0 Unterkategorien gelistet" data-i18n-en="0 subcategories listed">0 subcategories listed</span>
                @endif
            </div>

            @if($subcategories->hasPages())
                <div class="pagination-luxury">
                    {{ $subcategories->links() }}
                </div>
            @endif
        </div>

    </div>

</div>

<!-- Subcategory Detail / Quick View Modal (Full-Screen Soft Blur Background Covering Header) -->
<div id="view-subcategory-modal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden transition-all duration-300" style="z-index: 9999 !important; background-color: rgba(28, 25, 23, 0.15) !important; backdrop-filter: blur(3px) !important; -webkit-backdrop-filter: blur(3px) !important;" onclick="closeViewSubcategoryModal()">
    <div class="relative w-full max-w-lg bg-white rounded-2xl border border-stone-200/90 shadow-2xl overflow-hidden border-t-4 border-t-saltora-terracotta" onclick="event.stopPropagation()">
        
        <!-- Modal Top Banner / Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-sm shadow-2xs border border-saltora-terracotta/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-stone-900 text-sm tracking-tight" data-i18n-de="Unterkategorie-Details" data-i18n-en="Subcategory Details">Subcategory Details</h3>
                    <p class="text-[0.68rem] text-stone-400 font-medium font-mono" id="sub-view-slug">/slug</p>
                </div>
            </div>
            <button type="button" onclick="closeViewSubcategoryModal()" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 text-xs max-h-[75vh] modal-scroll-clean">
            
            <!-- Hero Info & Image -->
            <div class="flex items-start gap-4 p-4 rounded-xl bg-stone-50/70 border border-stone-200/70">
                <div class="w-20 h-20 min-w-[5rem] min-h-[5rem] max-w-[5rem] max-h-[5rem] rounded-xl overflow-hidden bg-white border border-stone-200 shadow-2xs shrink-0 flex items-center justify-center">
                    <img id="sub-view-img" src="" alt="Subcategory Image" class="w-full h-full object-cover hidden">
                    <div id="sub-view-no-img" class="text-stone-400 flex items-center justify-center w-full h-full font-display font-bold text-2xl bg-stone-100">
                        <span id="sub-view-letter">S</span>
                    </div>
                </div>

                <div class="space-y-1.5 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="sub-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="sub-view-status-badge"></span>
                    </div>
                    
                    <div class="pt-1 flex items-center gap-2">
                        <span class="text-stone-400 font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Hauptkategorie:" data-i18n-en="Parent Category:">Parent Category:</span>
                        <span id="sub-view-parent-cat" class="inline-flex items-center px-2 py-0.5 rounded-md text-[0.7rem] font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20"></span>
                    </div>

                    <div class="text-[0.7rem] text-stone-400 font-medium">
                        <span>Database ID: <strong id="sub-view-id" class="text-stone-800 font-mono">#0</strong></span>
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
                        <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Kategorie-Zuordnung" data-i18n-en="Category Binding">Category Binding</span>
                        <span id="sub-view-cat-label" class="font-extrabold text-xs text-stone-900 leading-tight block truncate max-w-[130px]"></span>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-emerald-50/60 border border-emerald-200/60 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div>
                        <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Zugewiesene Produkte" data-i18n-en="Assigned Products">Assigned Products</span>
                        <span id="sub-view-prods-count" class="font-extrabold text-base text-emerald-800 leading-none">0</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Beschreibung" data-i18n-en="Description">Description</label>
                <div id="sub-view-desc" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[50px] whitespace-pre-line"></div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-between gap-3">
            <a id="sub-view-store-btn" href="#" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta">
                <svg class="w-3.5 h-3.5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span data-i18n-de="Im Shop ansehen" data-i18n-en="View in Store">View in Store</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewSubcategoryModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer shadow-2xs" data-i18n-de="Schließen" data-i18n-en="Close">Close</button>
                <a id="sub-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span data-i18n-de="Bearbeiten" data-i18n-en="Edit Subcategory">Edit Subcategory</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    // Dataset for instant autocomplete search suggestions
    const ALL_SUBCATEGORIES = @json($allSubcategoriesForSuggestions ?? []);

    const searchInput = document.getElementById('subcategorySearchInput');
    const suggestionsPanel = document.getElementById('subcategorySuggestionsPanel');
    const filterForm = document.getElementById('subcategoriesFilterForm');
    let selectedSuggestionIndex = -1;

    if (searchInput && suggestionsPanel) {
        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function highlightMatch(text, query) {
            if (!query) return escapeHtml(text);
            const escapedText = escapeHtml(text);
            const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
            return escapedText.replace(regex, '<span class="bg-amber-100 text-amber-900 font-black px-0.5 rounded">$1</span>');
        }

        function renderSuggestions(query) {
            const trimmed = query.trim().toLowerCase();
            selectedSuggestionIndex = -1;

            if (!trimmed) {
                suggestionsPanel.classList.add('hidden');
                suggestionsPanel.innerHTML = '';
                return;
            }

            const matches = ALL_SUBCATEGORIES.filter(sub => {
                return (sub.name && sub.name.toLowerCase().includes(trimmed)) ||
                       (sub.slug && sub.slug.toLowerCase().includes(trimmed)) ||
                       (sub.category_name && sub.category_name.toLowerCase().includes(trimmed));
            }).slice(0, 6);

            if (matches.length === 0) {
                suggestionsPanel.innerHTML = `
                    <div class="px-4 py-3 text-xs text-stone-400 text-center flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <span>No subcategory matches found for "<strong>${escapeHtml(query)}</strong>"</span>
                    </div>
                `;
                suggestionsPanel.classList.remove('hidden');
                return;
            }

            let html = `
                <div class="px-3 py-1.5 bg-stone-50 text-[0.65rem] font-bold uppercase tracking-wider text-stone-400 flex items-center justify-between">
                    <span>Quick Suggestions (${matches.length})</span>
                    <span class="text-[0.6rem] text-stone-400">↑↓ Navigate • Enter to Filter</span>
                </div>
            `;

            matches.forEach((sub, idx) => {
                const imgHtml = sub.image_url 
                    ? `<img src="${sub.image_url}" class="h-full w-full object-cover">`
                    : `<span class="font-display font-bold text-xs text-stone-500">${escapeHtml(sub.name.charAt(0))}</span>`;
                
                const statusBadge = sub.status === 'active'
                    ? `<span class="text-[0.6rem] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded-md">ACTIVE</span>`
                    : `<span class="text-[0.6rem] font-bold text-amber-700 bg-amber-50 border border-amber-200 px-1.5 py-0.5 rounded-md">DRAFT</span>`;

                html += `
                    <div 
                        class="suggestion-item px-3.5 py-2.5 hover:bg-stone-50 cursor-pointer flex items-center justify-between gap-3 transition" 
                        data-index="${idx}"
                        data-name="${escapeHtml(sub.name)}"
                        data-id="${sub.id}"
                    >
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div class="h-8 w-8 rounded-lg overflow-hidden bg-stone-100 border border-stone-200 flex items-center justify-center shrink-0">
                                ${imgHtml}
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-extrabold text-stone-900 truncate">
                                    ${highlightMatch(sub.name, trimmed)}
                                </div>
                                <div class="text-[0.65rem] text-stone-400 font-medium truncate flex items-center gap-1.5">
                                    <span class="text-saltora-terracotta font-semibold">${escapeHtml(sub.category_name)}</span>
                                    <span>•</span>
                                    <span class="font-mono">/${escapeHtml(sub.slug)}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="text-[0.65rem] font-bold text-stone-500 bg-stone-100 px-1.5 py-0.5 rounded-md border border-stone-200">
                                ${sub.products_count || 0} products
                            </span>
                            ${statusBadge}
                        </div>
                    </div>
                `;
            });

            suggestionsPanel.innerHTML = html;
            suggestionsPanel.classList.remove('hidden');

            // Click handling on suggestions
            suggestionsPanel.querySelectorAll('.suggestion-item').forEach(item => {
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
            const items = suggestionsPanel.querySelectorAll('.suggestion-item');
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
                    item.classList.add('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
                    item.scrollIntoView({ block: 'nearest' });
                } else {
                    item.classList.remove('bg-saltora-blush/60', 'ring-1', 'ring-saltora-terracotta/30');
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !suggestionsPanel.contains(e.target)) {
                suggestionsPanel.classList.add('hidden');
            }
        });
    }

    // Modal Handling
    function openViewSubcategoryModal(data) {
        document.getElementById('sub-view-id').textContent = '#' + data.id;
        document.getElementById('sub-view-name').textContent = data.name;
        document.getElementById('sub-view-slug').textContent = '/' + data.slug;
        document.getElementById('sub-view-parent-cat').textContent = data.category_name;
        document.getElementById('sub-view-cat-label').textContent = data.category_name;
        document.getElementById('sub-view-prods-count').textContent = data.products_count || 0;

        // Image handling
        const imgEl = document.getElementById('sub-view-img');
        const noImgEl = document.getElementById('sub-view-no-img');
        const letterEl = document.getElementById('sub-view-letter');
        
        if (data.image_url) {
            imgEl.src = data.image_url;
            imgEl.classList.remove('hidden');
            noImgEl.classList.add('hidden');
        } else {
            imgEl.src = '';
            imgEl.classList.add('hidden');
            noImgEl.classList.remove('hidden');
            letterEl.textContent = (data.name || 'S').charAt(0);
        }

        // Status badge
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        const badgeEl = document.getElementById('sub-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span><span>${isEn ? 'ACTIVE' : 'AKTIV'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200/80';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span><span>${isEn ? 'DRAFT' : 'ENTWURF'}</span>`;
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

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewSubcategoryModal();
        }
    });

    function confirmDeleteSubcategory(id, name, productsCount) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        const warning = (productsCount && productsCount > 0)
            ? (isEn ? ` Note: This subcategory currently has ${productsCount} assigned products.` : ` Hinweis: Dieser Unterkategorie sind derzeit ${productsCount} Produkte zugewiesen.`)
            : '';

        Swal.fire({
            title: isEn ? 'Delete Subcategory?' : 'Unterkategorie löschen?',
            text: (isEn 
                ? `Are you sure you want to delete "${name}"?` 
                : `Möchten Sie "${name}" wirklich löschen?`) + warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-xl font-bold px-4 py-2',
                cancelButton: 'rounded-xl font-bold px-4 py-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-subcategory-form-' + id).submit();
            }
        });
    }
</script>
@endsection

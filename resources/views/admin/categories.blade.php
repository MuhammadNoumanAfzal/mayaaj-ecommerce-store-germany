@extends('layouts.admin')
@section('title', 'Categories Management - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamt Kategorien:" data-i18n-en="Total Categories:">Total Categories:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ count($categories) }}</span>
        </div>
    </div>

    <!-- Main Categories Executive Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Clean White Card Header with Terracotta Add Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span data-i18n-de="Kategorien Übersichtsleiste" data-i18n-en="Categories Overview Bar">Categories Overview Bar</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Shop-Kategorien und Produkt-Hierarchien." data-i18n-en="Manage store categories and product hierarchies.">Manage store categories and product hierarchies.</p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
            </a>
        </div>

        <!-- Table Filters & Search Bar Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-700">
                
                <!-- Left: Full Width Search Form -->
                <form action="{{ route('admin.categories') }}" method="GET" class="flex items-center gap-2.5 w-full sm:flex-1 sm:max-w-md">
                    <div class="relative w-full">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search category by name or description..."
                            data-i18n-placeholder-de="Kategorie nach Name oder Beschreibung suchen..."
                            data-i18n-placeholder-en="Search category by name or description..."
                            class="h-10 w-full pl-10 pr-4 rounded-xl border border-stone-200 bg-white text-xs font-medium text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs placeholder:text-stone-400"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search'))
                        <a href="{{ route('admin.categories') }}" class="btn-exec-secondary px-3.5 py-2 rounded-xl text-xs transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

                <!-- Right: Show Entries Selector -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-stone-600 font-bold" data-i18n-de="Zeige" data-i18n-en="Show">Show</span>
                    <select class="h-9 px-3 rounded-xl border border-stone-200 bg-white text-stone-900 font-semibold outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-stone-600 font-bold" data-i18n-de="Einträge" data-i18n-en="entries">entries</span>
                </div>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-4 px-6 font-black" data-i18n-de="Kategorie Name" data-i18n-en="Category Name">Category Name</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Beschreibung" data-i18n-en="Description">Description</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Logo / Bild" data-i18n-en="Image">Image</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-4 px-6 font-black text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($categories as $category)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-stone-900 text-sm tracking-tight block">
                                    {{ $category->name }}
                                </span>
                                <span class="text-[0.68rem] text-stone-400 font-mono">/{{ $category->slug }}</span>
                            </td>
                            <td class="py-4 px-6 text-stone-700 font-medium max-w-sm">
                                @if($category->description)
                                    {{ $category->description }}
                                @else
                                    <span class="text-stone-400 italic" data-i18n-de="Keine Beschreibung" data-i18n-en="No description">No description</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="h-12 w-12 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0 group">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                        <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <div class="text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($category->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-active">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Aktiv" data-i18n-en="Active">Active</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-draft">
                                        <span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span>
                                        <span data-i18n-de="Entwurf" data-i18n-en="Draft">Draft</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
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

                                    <!-- View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewCategoryModal(@json($catModalData))'
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Category Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        class="btn-exec-danger rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
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
                            <td colspan="5" class="py-12 px-6 text-center text-stone-500 text-xs">
                                <p class="text-base font-bold text-stone-700 mb-1" data-i18n-de="Keine Kategorien gefunden" data-i18n-en="No categories found">No categories found</p>
                                <p data-i18n-de="Erstellen Sie Ihre erste Kategorie über den Button oben." data-i18n-en="Create your first category using the button above.">Create your first category using the button above.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- Category Quick View Executive Modal -->
<div id="view-category-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop-luxury hidden transition-all duration-300" onclick="closeViewCategoryModal()">
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
                    <img id="cat-view-img" src="" alt="Category Image" class="w-full h-full object-cover hidden" style="width: 100%; height: 100%; object-fit: cover;">
                    <div id="cat-view-no-img" class="text-stone-300 flex items-center justify-center w-full h-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <div class="space-y-1.5 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="cat-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="cat-view-status-badge"></span>
                    </div>
                    <div class="flex items-center gap-3 text-[0.7rem] text-stone-500 font-medium pt-1">
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

            <!-- Description -->
            <div>
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Beschreibung" data-i18n-en="Description">Description</label>
                <div id="cat-view-desc" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[50px] whitespace-pre-line"></div>
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

    function confirmDeleteCategory(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Category?' : 'Kategorie löschen?',
            text: isEn 
                ? `Are you sure you want to delete "${name}"? All assigned subcategories will also be deleted.` 
                : `Möchten Sie "${name}" wirklich löschen? Alle zugewiesenen Unterkategorien werden ebenfalls gelöscht.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-category-form-' + id).submit();
            }
        });
    }
</script>
@endsection

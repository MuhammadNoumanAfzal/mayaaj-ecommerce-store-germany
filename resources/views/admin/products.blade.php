@extends('layouts.admin')
@section('title', 'Product Catalog Management - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Produkte Katalog" data-i18n-en="Product Catalog">Product Catalog</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamt Produkte:" data-i18n-en="Total Products:">Total Products:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ count($products) }}</span>
        </div>
    </div>

    <!-- Main Products Executive Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-xs overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Clean White Card Header with Terracotta Add Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span data-i18n-de="Produkte Katalog Übersichtsleiste" data-i18n-en="Product Catalog Overview Bar">Product Catalog Overview Bar</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Ihr gesamtes Luxusproduktsortiment, Preise und Lagerbestände." data-i18n-en="Manage your full luxury product collection, prices and inventory.">Manage your full luxury product collection, prices and inventory.</p>
            </div>
            
            <a href="{{ route('admin.products.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Add Product</span>
            </a>
        </div>

        <!-- Table Filters & Controls Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80 space-y-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-700">
                
                <!-- Filters & Search Form -->
                <form action="{{ route('admin.products') }}" method="GET" class="flex flex-wrap items-center gap-2.5 w-full lg:flex-1 lg:max-w-2xl">
                    <!-- Search Input -->
                    <div class="relative flex-1 min-w-[220px]">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search product by name or SKU..."
                            data-i18n-placeholder-de="Produkt nach Name oder SKU suchen..."
                            data-i18n-placeholder-en="Search product by name or SKU..."
                            class="h-10 w-full pl-10 pr-4 rounded-xl border border-stone-200 bg-white text-xs font-medium text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs placeholder:text-stone-400"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    <!-- Category Filter -->
                    <select name="category_id" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="" data-i18n-de="Alle Kategorien" data-i18n-en="All Categories">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="" data-i18n-de="Status: Alle" data-i18n-en="Status: All">Status: All</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv" data-i18n-en="Active">Active</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf" data-i18n-en="Draft">Draft</option>
                    </select>

                    @if(request('search') || request('category_id') || request('status'))
                        <a href="{{ route('admin.products') }}" class="btn-exec-secondary px-3.5 py-2 rounded-xl text-xs transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

                <!-- Show Entries Selector -->
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
                        <th class="py-4 px-6 font-black" data-i18n-de="Produkt" data-i18n-en="Product">Product</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Preis" data-i18n-en="Price">Price</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Lagerbestand" data-i18n-en="Stock">Stock</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-4 px-6 font-black text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($products as $product)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80">
                            <!-- Product Image & Title -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0 group">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                            <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @else
                                            <div class="text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-extrabold text-stone-900 text-sm tracking-tight block">
                                            {{ $product->name }}
                                        </span>
                                        <span class="text-[0.68rem] text-stone-400 font-mono">SKU: {{ $product->sku ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Category / Subcategory -->
                            <td class="py-4 px-6">
                                <div class="space-y-0.5">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20">
                                        {{ $product->category ? $product->category->name : 'Unassigned' }}
                                    </span>
                                    @if($product->subcategory)
                                        <span class="block text-[0.68rem] text-stone-400 font-medium pl-1">
                                            ↳ {{ $product->subcategory->name }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Price -->
                            <td class="py-4 px-6 font-bold text-stone-900">
                                @if($product->sale_price)
                                    <div>
                                        <span class="text-saltora-terracotta text-sm">€{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="text-stone-400 line-through text-[0.68rem] ml-1">€{{ number_format($product->price, 2) }}</span>
                                    </div>
                                @else
                                    <span class="text-sm">€{{ number_format($product->price, 2) }}</span>
                                @endif
                            </td>

                            <!-- Stock -->
                            <td class="py-4 px-6">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700">
                                        <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                        {{ $product->stock }} <span data-i18n-de="auf Lager" data-i18n-en="in stock">in stock</span>
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700">
                                        <span class="h-2 w-2 rounded-full bg-amber-600 animate-pulse"></span>
                                        {{ $product->stock }} <span data-i18n-de="Geringer Bestand" data-i18n-en="Low stock">Low stock</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-rose-700">
                                        <span class="h-2 w-2 rounded-full bg-rose-600"></span>
                                        <span data-i18n-de="Ausverkauft" data-i18n-en="Out of stock">Out of stock</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-6">
                                @if($product->status === 'active')
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

                            <!-- Actions -->
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @php
                                        $galleryUrls = [];
                                        if (!empty($product->gallery_images) && is_array($product->gallery_images)) {
                                            foreach ($product->gallery_images as $gImg) {
                                                $galleryUrls[] = asset('storage/' . $gImg);
                                            }
                                        }

                                        $productModalData = [
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'slug' => $product->slug,
                                            'sku' => $product->sku ?? 'N/A',
                                            'price' => (float)$product->price,
                                            'sale_price' => $product->sale_price ? (float)$product->sale_price : null,
                                            'cost_price' => $product->cost_price ? (float)$product->cost_price : null,
                                            'stock' => (int)$product->stock,
                                            'status' => $product->status,
                                            'is_featured' => (bool)$product->is_featured,
                                            'category_name' => $product->category ? $product->category->name : 'N/A',
                                            'subcategory_name' => $product->subcategory ? $product->subcategory->name : null,
                                            'image_url' => $product->image ? asset('storage/' . $product->image) : null,
                                            'gallery_urls' => $galleryUrls,
                                            'variations' => is_array($product->variations) ? $product->variations : [],
                                            'accordion_tabs' => is_array($product->accordion_tabs) ? $product->accordion_tabs : [],
                                            'description' => $product->description ?? '',
                                            'craftsmanship' => $product->craftsmanship ?? '',
                                            'store_url' => route('shop.show', $product->slug),
                                            'edit_url' => route('admin.products.edit', $product->id),
                                        ];
                                    @endphp

                                    <!-- View Button -->
                                    <button
                                        type="button"
                                        onclick='openViewProductModal(@json($productModalData))'
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta"
                                        title="View Product Details"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <span data-i18n-de="Ansehen" data-i18n-en="View">View</span>
                                    </button>

                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="btn-exec-danger rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
                                    </button>

                                    <form id="delete-product-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-stone-500 text-xs">
                                <p class="text-base font-bold text-stone-700 mb-1" data-i18n-de="Keine Produkte gefunden" data-i18n-en="No products found">No products found</p>
                                <p data-i18n-de="Erstellen Sie Ihr erstes Produkt über den Button oben." data-i18n-en="Create your first product using the button above.">Create your first product using the button above.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- Product Quick View Executive Modal -->
<div id="view-product-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 modal-backdrop-luxury hidden transition-all duration-300" onclick="closeViewProductModal()">
    <div class="relative w-full max-w-2xl bg-white rounded-2xl border border-stone-200/90 shadow-2xl overflow-hidden border-t-4 border-t-saltora-terracotta" onclick="event.stopPropagation()">
        
        <!-- Modal Top Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-stone-50 via-white to-stone-50 border-b border-stone-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center font-bold text-sm shadow-2xs border border-saltora-terracotta/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-extrabold text-stone-900 text-sm tracking-tight" data-i18n-de="Produkt-Details" data-i18n-en="Product Details">Product Details</h3>
                    <p class="text-[0.68rem] text-stone-400 font-mono" id="prod-view-sku">SKU: ---</p>
                </div>
            </div>
            <button type="button" onclick="closeViewProductModal()" class="w-8 h-8 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-800 transition flex items-center justify-center cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div class="p-6 space-y-4 text-xs max-h-[75vh] modal-scroll-clean">
            
            <!-- Hero Product Banner: Image + Key Details -->
            <div class="flex flex-col sm:flex-row items-start gap-4 p-4 rounded-xl bg-stone-50/70 border border-stone-200/70">
                <!-- Main Product Image -->
                <div class="w-24 h-24 min-w-[6rem] min-h-[6rem] max-w-[6rem] max-h-[6rem] rounded-xl overflow-hidden bg-white border border-stone-200 shadow-2xs shrink-0 flex items-center justify-center">
                    <img id="prod-view-img" src="" alt="Product Image" class="w-full h-full object-cover hidden" style="width: 100%; height: 100%; object-fit: cover;">
                    <div id="prod-view-no-img" class="text-stone-300 flex items-center justify-center w-full h-full">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>

                <div class="space-y-2 flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 id="prod-view-name" class="font-extrabold text-base text-stone-900 tracking-tight leading-snug"></h4>
                        <span id="prod-view-status-badge"></span>
                        <span id="prod-view-featured-badge" class="hidden inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-amber-50 text-amber-800 border border-amber-200 shadow-2xs">
                            ⭐ Featured
                        </span>
                    </div>

                    <!-- Category & Subcategory -->
                    <div class="flex items-center gap-2 text-[0.72rem] text-stone-600 font-medium">
                        <span class="text-stone-400 font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Kategorie:" data-i18n-en="Category:">Category:</span>
                        <span id="prod-view-category" class="font-bold text-stone-800"></span>
                        <span id="prod-view-subcat-divider" class="text-stone-300">›</span>
                        <span id="prod-view-subcat" class="text-stone-500 font-medium"></span>
                    </div>

                    <div class="text-[0.68rem] text-stone-400 font-mono">
                        Slug: <span id="prod-view-slug" class="text-stone-600"></span>
                    </div>
                </div>
            </div>

            <!-- Gallery Thumbnails (if any) -->
            <div id="prod-view-gallery-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Bildergalerie" data-i18n-en="Gallery Photos">Gallery Photos</label>
                <div id="prod-view-gallery" class="flex items-center gap-2 overflow-x-auto pb-1">
                </div>
            </div>

            <!-- Pricing & Financial Metrics Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Regulärer Preis" data-i18n-en="Regular Price">Regular Price</span>
                    <span id="prod-view-regular-price" class="font-extrabold text-sm text-stone-900 mt-0.5 block">€0.00</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Angebotspreis" data-i18n-en="Sale Price">Sale Price</span>
                    <span id="prod-view-sale-price" class="font-extrabold text-sm text-saltora-terracotta mt-0.5 block">N/A</span>
                </div>

                <div class="p-3 rounded-xl bg-stone-50 border border-stone-200/80">
                    <span class="text-[0.62rem] font-bold text-stone-400 uppercase tracking-wider block" data-i18n-de="Einkaufspreis" data-i18n-en="Cost Price">Cost Price</span>
                    <span id="prod-view-cost-price" class="font-extrabold text-sm text-stone-700 mt-0.5 block">€0.00</span>
                </div>

                <div class="p-3 rounded-xl bg-emerald-50/70 border border-emerald-200/80">
                    <span class="text-[0.62rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Marge / Gewinn" data-i18n-en="Gross Margin">Gross Margin</span>
                    <span id="prod-view-margin" class="font-extrabold text-sm text-emerald-800 mt-0.5 block">0%</span>
                </div>
            </div>

            <!-- Inventory Stock Indicator -->
            <div class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/80 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-stone-400 font-bold uppercase tracking-wider text-[0.65rem]" data-i18n-de="Lagerbestand:" data-i18n-en="Inventory Stock:">Inventory Stock:</span>
                    <span id="prod-view-stock-count" class="font-extrabold text-sm text-stone-900">0 units</span>
                </div>
                <div id="prod-view-stock-badge"></div>
            </div>

            <!-- Variations Finishes (if any) -->
            <div id="prod-view-variations-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Produktvariationen / Ausführungen" data-i18n-en="Product Variations / Finishes">Product Variations / Finishes</label>
                <div id="prod-view-variations" class="flex flex-wrap gap-2 p-3 rounded-xl bg-stone-50 border border-stone-200/70">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Product Description</label>
                <div id="prod-view-desc" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[50px] whitespace-pre-line"></div>
            </div>

            <!-- Craftsmanship -->
            <div id="prod-view-craftsmanship-section">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1" data-i18n-de="Handwerk & Material" data-i18n-en="Craftsmanship & Atelier Notes">Craftsmanship & Atelier Notes</label>
                <div id="prod-view-craftsmanship" class="p-3.5 rounded-xl bg-stone-50 border border-stone-200/70 text-stone-700 leading-relaxed min-h-[40px] whitespace-pre-line"></div>
            </div>

            <!-- Accordion Tabs (if any) -->
            <div id="prod-view-tabs-section" class="hidden">
                <label class="block font-bold uppercase tracking-wider text-[0.65rem] text-stone-500 mb-1.5" data-i18n-de="Spezifikationen & Reitertabs" data-i18n-en="Specification Tabs">Specification Tabs</label>
                <div id="prod-view-tabs" class="space-y-1.5">
                </div>
            </div>

        </div>

        <!-- Modal Footer Actions -->
        <div class="p-4 bg-stone-50 border-t border-stone-200/80 flex items-center justify-between gap-3">
            <a id="prod-view-store-btn" href="#" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs hover:border-saltora-terracotta hover:text-saltora-terracotta">
                <svg class="w-3.5 h-3.5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span data-i18n-de="Im Shop ansehen" data-i18n-en="View in Store">View in Store</span>
            </a>

            <div class="flex items-center gap-2">
                <button type="button" onclick="closeViewProductModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer shadow-2xs" data-i18n-de="Schließen" data-i18n-en="Close">Close</button>
                <a id="prod-view-edit-btn" href="#" class="btn-exec-primary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs">
                    <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span data-i18n-de="Bearbeiten" data-i18n-en="Edit Product">Edit Product</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    function openViewProductModal(data) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';

        document.getElementById('prod-view-name').textContent = data.name;
        document.getElementById('prod-view-sku').textContent = 'SKU: ' + (data.sku || 'N/A');
        document.getElementById('prod-view-slug').textContent = '/' + data.slug;
        document.getElementById('prod-view-category').textContent = data.category_name || 'N/A';
        
        // Subcategory
        const subcatEl = document.getElementById('prod-view-subcat');
        const dividerEl = document.getElementById('prod-view-subcat-divider');
        if (data.subcategory_name) {
            subcatEl.textContent = data.subcategory_name;
            subcatEl.classList.remove('hidden');
            dividerEl.classList.remove('hidden');
        } else {
            subcatEl.textContent = '';
            subcatEl.classList.add('hidden');
            dividerEl.classList.add('hidden');
        }

        // Image
        const imgEl = document.getElementById('prod-view-img');
        const noImgEl = document.getElementById('prod-view-no-img');
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
        const badgeEl = document.getElementById('prod-view-status-badge');
        if (data.status === 'active') {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-active';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span><span>${isEn ? 'Active' : 'Aktiv'}</span>`;
        } else {
            badgeEl.className = 'inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-draft';
            badgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span><span>${isEn ? 'Draft' : 'Entwurf'}</span>`;
        }

        // Featured badge
        const featEl = document.getElementById('prod-view-featured-badge');
        if (data.is_featured) {
            featEl.classList.remove('hidden');
        } else {
            featEl.classList.add('hidden');
        }

        // Prices & Margin
        document.getElementById('prod-view-regular-price').textContent = '€' + data.price.toFixed(2);
        const saleEl = document.getElementById('prod-view-sale-price');
        if (data.sale_price) {
            saleEl.textContent = '€' + data.sale_price.toFixed(2);
            saleEl.classList.remove('text-stone-400');
            saleEl.classList.add('text-saltora-terracotta');
        } else {
            saleEl.textContent = '—';
            saleEl.classList.remove('text-saltora-terracotta');
            saleEl.classList.add('text-stone-400');
        }

        const effectivePrice = data.sale_price || data.price;
        const effectiveCost = data.cost_price || (data.price * 0.45);
        document.getElementById('prod-view-cost-price').textContent = '€' + effectiveCost.toFixed(2);

        const marginPercent = effectivePrice > 0 ? Math.round(((effectivePrice - effectiveCost) / effectivePrice) * 100) : 0;
        document.getElementById('prod-view-margin').textContent = marginPercent + '%';

        // Stock
        document.getElementById('prod-view-stock-count').textContent = data.stock + (isEn ? ' in stock' : ' auf Lager');
        const stockBadgeEl = document.getElementById('prod-view-stock-badge');
        if (data.stock > 5) {
            stockBadgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200';
            stockBadgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span><span>${isEn ? 'Available' : 'Verfügbar'}</span>`;
        } else if (data.stock > 0) {
            stockBadgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold text-amber-800 bg-amber-50 border border-amber-200';
            stockBadgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-amber-600 animate-pulse"></span><span>${isEn ? 'Low Stock' : 'Geringer Bestand'}</span>`;
        } else {
            stockBadgeEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[0.68rem] font-bold text-rose-700 bg-rose-50 border border-rose-200';
            stockBadgeEl.innerHTML = `<span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span><span>${isEn ? 'Out of Stock' : 'Ausverkauft'}</span>`;
        }

        // Gallery
        const gallerySection = document.getElementById('prod-view-gallery-section');
        const galleryContainer = document.getElementById('prod-view-gallery');
        galleryContainer.innerHTML = '';
        if (data.gallery_urls && data.gallery_urls.length > 0) {
            gallerySection.classList.remove('hidden');
            data.gallery_urls.forEach(url => {
                const thumb = document.createElement('div');
                thumb.className = 'w-12 h-12 rounded-lg overflow-hidden border border-stone-200 shadow-2xs shrink-0 cursor-pointer hover:opacity-80 transition';
                thumb.innerHTML = `<img src="${url}" class="w-full h-full object-cover">`;
                thumb.onclick = () => { imgEl.src = url; };
                galleryContainer.appendChild(thumb);
            });
        } else {
            gallerySection.classList.add('hidden');
        }

        // Variations
        const variationsSection = document.getElementById('prod-view-variations-section');
        const variationsContainer = document.getElementById('prod-view-variations');
        variationsContainer.innerHTML = '';
        if (data.variations && data.variations.length > 0) {
            variationsSection.classList.remove('hidden');
            data.variations.forEach(v => {
                const vItem = document.createElement('div');
                vItem.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-white border border-stone-200 shadow-2xs';
                vItem.innerHTML = `<span class="h-3 w-3 rounded-full border border-stone-300 shrink-0" style="background-color: ${v.color || '#1c1210'};"></span>
                                   <span>${v.name || 'Finish'}</span>
                                   ${v.stock !== undefined ? `<span class="text-saltora-terracotta font-mono font-bold">(${v.stock})</span>` : ''}`;
                variationsContainer.appendChild(vItem);
            });
        } else {
            variationsSection.classList.add('hidden');
        }

        // Descriptions
        const descEl = document.getElementById('prod-view-desc');
        if (data.description && data.description.trim()) {
            descEl.textContent = data.description;
            descEl.classList.remove('italic', 'text-stone-400');
        } else {
            descEl.textContent = isEn ? 'No description available.' : 'Keine Beschreibung verfügbar.';
            descEl.classList.add('italic', 'text-stone-400');
        }

        const craftEl = document.getElementById('prod-view-craftsmanship');
        if (data.craftsmanship && data.craftsmanship.trim()) {
            craftEl.textContent = data.craftsmanship;
            craftEl.classList.remove('italic', 'text-stone-400');
        } else {
            craftEl.textContent = isEn ? 'No craftsmanship notes recorded.' : 'Keine Handwerksnotizen hinterlegt.';
            craftEl.classList.add('italic', 'text-stone-400');
        }

        // Tabs
        const tabsSection = document.getElementById('prod-view-tabs-section');
        const tabsContainer = document.getElementById('prod-view-tabs');
        tabsContainer.innerHTML = '';
        if (data.accordion_tabs && data.accordion_tabs.length > 0) {
            tabsSection.classList.remove('hidden');
            data.accordion_tabs.forEach(tab => {
                const tabEl = document.createElement('div');
                tabEl.className = 'p-2.5 rounded-lg bg-stone-50 border border-stone-200/70 text-xs';
                tabEl.innerHTML = `<strong class="text-stone-900 block mb-0.5">${tab.title || 'Tab'}</strong><p class="text-stone-600">${tab.content || ''}</p>`;
                tabsContainer.appendChild(tabEl);
            });
        } else {
            tabsSection.classList.add('hidden');
        }

        // Action links
        document.getElementById('prod-view-store-btn').href = data.store_url;
        document.getElementById('prod-view-edit-btn').href = data.edit_url;

        // Open modal
        document.body.classList.add('overflow-hidden');
        document.getElementById('view-product-modal').classList.remove('hidden');
    }

    function closeViewProductModal() {
        document.body.classList.remove('overflow-hidden');
        document.getElementById('view-product-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewProductModal();
        }
    });

    function confirmDeleteProduct(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Product?' : 'Produkt löschen?',
            text: isEn 
                ? `Are you sure you want to delete "${name}"?` 
                : `Möchten Sie "${name}" wirklich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        });
    }
</script>
@endsection

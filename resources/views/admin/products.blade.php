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

<script>
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

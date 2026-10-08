@extends('layouts.admin')
@section('title', 'Inventory & Stock Management - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Lagerbestand & Inventar" data-i18n-en="Inventory & Stock">Inventory & Stock</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamte Einheiten:" data-i18n-en="Total Stock Units:">Total Stock Units:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ number_format($totalUnits) }}</span>
        </div>
    </div>

    <!-- 5 Executive Inventory KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Card 1: Total Products -->
        <div class="exec-card p-4 sm:p-5 rounded-2xl bg-white border border-stone-200/90 shadow-2xs flex items-center gap-4">
            <div class="h-11 w-11 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center shrink-0 shadow-2xs">
                <i class="fa-solid fa-cube text-base"></i>
            </div>
            <div>
                <p class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-de="Produkte" data-i18n-en="Catalog Items">Catalog Items</p>
                <h3 class="font-black text-xl text-stone-900 leading-tight mt-0.5">{{ $totalProducts }}</h3>
            </div>
        </div>

        <!-- Card 2: Total Units -->
        <div class="exec-card p-4 sm:p-5 rounded-2xl bg-white border border-stone-200/90 shadow-2xs flex items-center gap-4">
            <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 shadow-2xs border border-emerald-100">
                <i class="fa-solid fa-boxes-stacked text-base"></i>
            </div>
            <div>
                <p class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-de="Gesamtlager" data-i18n-en="Total Units">Total Units</p>
                <h3 class="font-black text-xl text-stone-900 leading-tight mt-0.5">{{ number_format($totalUnits) }}</h3>
            </div>
        </div>

        <!-- Card 3: Low Stock Alerts -->
        <a href="{{ route('admin.inventory', ['filter' => 'low_stock']) }}" class="exec-card p-4 sm:p-5 rounded-2xl bg-white border border-stone-200/90 shadow-2xs flex items-center gap-4 transition-all hover:border-amber-400 hover:shadow-md cursor-pointer {{ $filter === 'low_stock' ? 'ring-2 ring-amber-500/20 border-amber-500' : '' }}">
            <div class="h-11 w-11 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center shrink-0 shadow-2xs border border-amber-200/60">
                <i class="fa-solid fa-triangle-exclamation text-base"></i>
            </div>
            <div>
                <p class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-de="Gering (< 5)" data-i18n-en="Low Stock (≤ 5)">Low Stock (≤ 5)</p>
                <h3 class="font-black text-xl text-amber-600 leading-tight mt-0.5">{{ $lowStockCount }}</h3>
            </div>
        </a>

        <!-- Card 4: Out of Stock -->
        <a href="{{ route('admin.inventory', ['filter' => 'out_of_stock']) }}" class="exec-card p-4 sm:p-5 rounded-2xl bg-white border border-stone-200/90 shadow-2xs flex items-center gap-4 transition-all hover:border-rose-400 hover:shadow-md cursor-pointer {{ $filter === 'out_of_stock' ? 'ring-2 ring-rose-500/20 border-rose-500' : '' }}">
            <div class="h-11 w-11 rounded-xl bg-rose-50 text-rose-700 flex items-center justify-center shrink-0 shadow-2xs border border-rose-200/60">
                <i class="fa-solid fa-circle-xmark text-base"></i>
            </div>
            <div>
                <p class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-de="Ausverkauft" data-i18n-en="Out of Stock">Out of Stock</p>
                <h3 class="font-black text-xl text-rose-600 leading-tight mt-0.5">{{ $outOfStockCount }}</h3>
            </div>
        </a>

        <!-- Card 5: Inventory Valuation -->
        <div class="exec-card p-4 sm:p-5 rounded-2xl bg-white border border-stone-200/90 shadow-2xs flex items-center gap-4">
            <div class="h-11 w-11 rounded-xl bg-saltora-blush text-saltora-terracotta flex items-center justify-center shrink-0 shadow-2xs border border-saltora-terracotta/20">
                <i class="fa-solid fa-sack-dollar text-base"></i>
            </div>
            <div>
                <p class="text-[0.68rem] font-bold uppercase tracking-wider text-stone-400" data-i18n-de="Warenwert" data-i18n-en="Total Value">Total Value</p>
                <h3 class="font-black text-xl text-stone-900 leading-tight mt-0.5">€{{ number_format($totalValuation, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Main Inventory Executive Card -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-xs overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Header & Fast Filter Tabs -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                    <span data-i18n-de="Lagerbestand Schnellverwaltung" data-i18n-en="Live Inventory & Fast Stock Updater">Live Inventory & Fast Stock Updater</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Passen Sie Stückzahlen und Variantenbestände direkt ohne Seitenwechsel an." data-i18n-en="Adjust product and variant stock counts inline without reloading pages.">Adjust product and variant stock counts inline without reloading pages.</p>
            </div>

            <!-- Fast Status Filter Tabs -->
            <div class="flex items-center gap-1.5 p-1 rounded-xl bg-stone-100 border border-stone-200/70 text-xs">
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['filter' => 'all'])) }}" class="px-3 py-1.5 rounded-lg font-bold transition {{ $filter === 'all' ? 'bg-white text-stone-900 shadow-2xs' : 'text-stone-500 hover:text-stone-900' }}">
                    All ({{ $totalProducts }})
                </a>
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['filter' => 'in_stock'])) }}" class="px-3 py-1.5 rounded-lg font-bold transition {{ $filter === 'in_stock' ? 'bg-white text-emerald-700 shadow-2xs' : 'text-stone-500 hover:text-stone-900' }}">
                    In Stock
                </a>
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['filter' => 'low_stock'])) }}" class="px-3 py-1.5 rounded-lg font-bold transition {{ $filter === 'low_stock' ? 'bg-white text-amber-700 shadow-2xs' : 'text-stone-500 hover:text-stone-900' }}">
                    Low Stock ({{ $lowStockCount }})
                </a>
                <a href="{{ route('admin.inventory', array_merge(request()->except('page'), ['filter' => 'out_of_stock'])) }}" class="px-3 py-1.5 rounded-lg font-bold transition {{ $filter === 'out_of_stock' ? 'bg-white text-rose-700 shadow-2xs' : 'text-stone-500 hover:text-stone-900' }}">
                    Out of Stock ({{ $outOfStockCount }})
                </a>
            </div>
        </div>

        <!-- Search & Filter Controls Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80">
            <form action="{{ route('admin.inventory') }}" method="GET" class="flex flex-wrap items-center gap-3">
                <input type="hidden" name="filter" value="{{ $filter }}">

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

                <!-- Sort Filter -->
                <select name="sort" onchange="this.form.submit()" class="h-10 px-3.5 rounded-xl border border-stone-200 bg-white text-xs font-semibold text-stone-900 outline-none focus:border-saltora-terracotta shadow-2xs">
                    <option value="stock_asc" {{ request('sort') === 'stock_asc' ? 'selected' : '' }} data-i18n-de="Bestand: Niedrig nach Hoch" data-i18n-en="Stock: Lowest First">Stock: Lowest First</option>
                    <option value="stock_desc" {{ request('sort') === 'stock_desc' ? 'selected' : '' }} data-i18n-de="Bestand: Hoch nach Niedrig" data-i18n-en="Stock: Highest First">Stock: Highest First</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }} data-i18n-de="Name: A-Z" data-i18n-en="Name: A-Z">Name: A-Z</option>
                </select>

                <button type="submit" class="btn-exec-primary h-10 px-5 rounded-xl text-xs font-bold transition shadow-2xs flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-filter"></i>
                    <span data-i18n-de="Filtern" data-i18n-en="Filter">Filter</span>
                </button>

                @if(request()->anyFilled(['search', 'category_id', 'filter', 'sort']))
                    <a href="{{ route('admin.inventory') }}" class="btn-exec-secondary h-10 px-4 rounded-xl text-xs font-bold transition flex items-center gap-1.5 cursor-pointer text-stone-600">
                        <i class="fa-solid fa-xmark"></i>
                        <span data-i18n-de="Zurücksetzen" data-i18n-en="Reset">Reset</span>
                    </a>
                @endif
            </form>
        </div>

        <!-- Inventory Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50/80 border-b border-stone-200 text-stone-600">
                        <th class="py-4 px-6 font-black uppercase tracking-wider" data-i18n-de="Produkt & Artikel" data-i18n-en="Product & SKU">Product & SKU</th>
                        <th class="py-4 px-6 font-black uppercase tracking-wider" data-i18n-de="Kategorie" data-i18n-en="Category">Category</th>
                        <th class="py-4 px-6 font-black uppercase tracking-wider" data-i18n-de="Preis" data-i18n-en="Price">Price</th>
                        <th class="py-4 px-6 font-black uppercase tracking-wider" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-4 px-6 font-black uppercase tracking-wider min-w-[220px]" data-i18n-de="Schnell-Bestand" data-i18n-en="Quick Stock Adjuster">Quick Stock Adjuster</th>
                        <th class="py-4 px-6 font-black uppercase tracking-wider text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($products as $product)
                        <tr id="inventory-row-{{ $product->id }}" class="exec-table-row hover:bg-stone-50/80 transition border-b border-stone-200/70">
                            <!-- Product Image & Title -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <i class="fa-solid fa-cube text-stone-300 text-lg"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="font-extrabold text-stone-900 text-sm hover:text-saltora-terracotta transition block leading-tight">
                                            {{ $product->name }}
                                        </a>
                                        <span class="text-[0.68rem] text-stone-400 font-mono">SKU: {{ $product->sku ?? 'N/A' }}</span>

                                        <!-- Variation Swatch Breakdown Pills if Product has Variations -->
                                        @if(!empty($product->variations) && is_array($product->variations))
                                            <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                                @foreach($product->variations as $vIdx => $vItem)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-stone-100 border border-stone-200/80 text-stone-700" title="{{ $vItem['name'] ?? '' }}: {{ $vItem['stock'] ?? 'N/A' }} in stock">
                                                        <span class="h-2 w-2 rounded-full shrink-0 shadow-2xs" style="background-color: {{ $vItem['color'] ?? '#1c1210' }};"></span>
                                                        <span>{{ $vItem['name'] ?? 'Finish' }}</span>
                                                        @if(isset($vItem['stock']) && is_numeric($vItem['stock']))
                                                            <span class="text-saltora-terracotta ml-0.5">({{ $vItem['stock'] }})</span>
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20">
                                    {{ $product->category ? $product->category->name : 'Unassigned' }}
                                </span>
                            </td>

                            <!-- Price -->
                            <td class="py-4 px-6 font-bold text-stone-900">
                                <div>
                                    <span class="text-sm">€{{ number_format($product->sale_price ?? $product->price, 2) }}</span>
                                    @if($product->sale_price)
                                        <span class="text-stone-400 line-through text-[0.65rem] ml-1">€{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Stock Status Badge -->
                            <td class="py-4 px-6" id="stock-badge-cell-{{ $product->id }}">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                        <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                        <span>In Stock</span>
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/80">
                                        <span class="h-2 w-2 rounded-full bg-amber-600 animate-pulse"></span>
                                        <span>Low Stock</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/80">
                                        <span class="h-2 w-2 rounded-full bg-rose-600"></span>
                                        <span>Out of Stock</span>
                                    </span>
                                @endif
                            </td>

                            <!-- Quick Inline Stock Adjuster -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <!-- Minus Button -->
                                    <button 
                                        type="button" 
                                        onclick="adjustInlineStock({{ $product->id }}, -1)"
                                        class="h-8 w-8 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 flex items-center justify-center font-bold text-stone-700 transition cursor-pointer active:scale-95"
                                        title="Decrease 1"
                                    >-</button>

                                    <!-- Stock Number Input -->
                                    <input 
                                        type="number" 
                                        id="stock-input-{{ $product->id }}" 
                                        min="0"
                                        value="{{ $product->stock }}" 
                                        class="h-8 w-20 rounded-lg text-center font-bold text-xs text-stone-900 border border-stone-200 bg-stone-50 outline-none focus:border-saltora-terracotta focus:bg-white transition"
                                        onkeydown="if(event.key==='Enter'){ saveInlineStock({{ $product->id }}); }"
                                    >

                                    <!-- Plus Button -->
                                    <button 
                                        type="button" 
                                        onclick="adjustInlineStock({{ $product->id }}, 1)"
                                        class="h-8 w-8 rounded-lg border border-stone-200 bg-white hover:bg-stone-100 flex items-center justify-center font-bold text-stone-700 transition cursor-pointer active:scale-95"
                                        title="Increase 1"
                                    >+</button>

                                    <!-- Save Button -->
                                    <button 
                                        type="button" 
                                        id="save-btn-{{ $product->id }}"
                                        onclick="saveInlineStock({{ $product->id }})"
                                        class="h-8 px-3 rounded-lg bg-stone-900 hover:bg-saltora-terracotta text-white font-bold text-[0.68rem] transition flex items-center gap-1 cursor-pointer shadow-2xs"
                                        title="Save Stock Count"
                                    >
                                        <i class="fa-solid fa-check text-[0.65rem]"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="h-8 w-8 rounded-lg border border-stone-200 bg-white text-stone-600 hover:text-saltora-terracotta hover:border-saltora-terracotta flex items-center justify-center transition shadow-2xs" title="Edit Product">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <a href="{{ route('shop.show', $product->slug ?? $product->id) }}" target="_blank" class="h-8 w-8 rounded-lg border border-stone-200 bg-white text-stone-600 hover:text-stone-900 flex items-center justify-center transition shadow-2xs" title="View in Store">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-stone-400">
                                <i class="fa-solid fa-box-open text-3xl mb-2 text-stone-300 block"></i>
                                <p class="text-sm font-semibold text-stone-600">No products found matching the criteria.</p>
                                <p class="text-xs text-stone-400 mt-1">Try clearing filters or search query.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="p-4 sm:p-6 bg-stone-50/50 border-t border-stone-200/80">
                {{ $products->links() }}
            </div>
        @endif

    </div>

</div>

<!-- Inline Stock Quick Update Engine -->
<script>
    function adjustInlineStock(productId, delta) {
        const input = document.getElementById('stock-input-' + productId);
        if (!input) return;
        let current = parseInt(input.value) || 0;
        let updated = Math.max(0, current + delta);
        input.value = updated;
    }

    async function saveInlineStock(productId) {
        const input = document.getElementById('stock-input-' + productId);
        const saveBtn = document.getElementById('save-btn-' + productId);
        if (!input || !saveBtn) return;

        const val = parseInt(input.value);
        if (isNaN(val) || val < 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Number',
                text: 'Please enter a valid stock quantity (0 or greater).'
            });
            return;
        }

        const originalBtnHtml = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i>';

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
                || '{{ csrf_token() }}';

            const res = await fetch("{{ route('admin.inventory.update-stock') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    stock: val
                })
            });

            const data = await res.json();

            if (data.success) {
                // Update badge cell dynamically
                const badgeCell = document.getElementById('stock-badge-cell-' + productId);
                if (badgeCell) {
                    if (val > 5) {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/80">
                                <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                <span>In Stock</span>
                            </span>
                        `;
                    } else if (val > 0) {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200/80">
                                <span class="h-2 w-2 rounded-full bg-amber-600 animate-pulse"></span>
                                <span>Low Stock</span>
                            </span>
                        `;
                    } else {
                        badgeCell.innerHTML = `
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/80">
                                <span class="h-2 w-2 rounded-full bg-rose-600"></span>
                                <span>Out of Stock</span>
                            </span>
                        `;
                    }
                }

                // Show quick success indicator
                saveBtn.classList.remove('bg-stone-900');
                saveBtn.classList.add('bg-emerald-600');
                saveBtn.innerHTML = '<i class="fa-solid fa-check"></i>';
                
                setTimeout(() => {
                    saveBtn.classList.remove('bg-emerald-600');
                    saveBtn.classList.add('bg-stone-900');
                    saveBtn.innerHTML = '<i class="fa-solid fa-check text-[0.65rem]"></i> <span>Save</span>';
                    saveBtn.disabled = false;
                }, 1200);

                if (window.LuxuryToast) {
                    window.LuxuryToast.fire({
                        icon: 'success',
                        title: 'Stock Updated: ' + val + ' units'
                    });
                }
            } else {
                throw new Error(data.message || 'Failed to update stock');
            }
        } catch (err) {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalBtnHtml;
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                text: err.message || 'Could not update stock.'
            });
        }
    }
</script>
@endsection

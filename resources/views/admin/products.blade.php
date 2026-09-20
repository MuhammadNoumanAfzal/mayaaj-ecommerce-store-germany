@extends('layouts.admin')
@section('title', 'Produkte Katalog verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3.5 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-normal" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Produkte Katalog" data-i18n-en="Products Catalog">Produkte Katalog</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium flex items-center gap-1.5">
            <span data-i18n-de="Gesamt Produkte:" data-i18n-en="Total Products:">Gesamt Produkte:</span> 
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200/60">{{ count($products) }}</span>
        </div>
    </div>

    <!-- Main Products Card -->
    <div class="exec-card rounded-2xl border border-slate-200/80 bg-white shadow-xs overflow-hidden">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-4.5 bg-white border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-extrabold text-base text-slate-900 tracking-tight flex items-center gap-2" data-i18n-de="Produkte Katalog" data-i18n-en="Products Catalog">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Produkte Katalog
                </h2>
                <p class="text-xs text-slate-500 font-normal mt-0.5" data-i18n-de="Verwalten Sie Ihr gesamtes Produktsortiment" data-i18n-en="Manage your full product collection">Verwalten Sie Ihr gesamtes Produktsortiment</p>
            </div>
            
            <a href="{{ route('admin.products.create') }}" class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-xs font-bold transition shadow-xs flex items-center gap-1.5 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Produkt Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2 w-full lg:w-auto">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-indigo-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Filters & Search Form -->
                <form action="{{ route('admin.products') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full lg:w-auto">
                    <!-- Category Filter -->
                    <select name="category_id" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle Hauptkategorien" data-i18n-en="All Categories">Alle Hauptkategorien</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <!-- Status Filter -->
                    <select name="status" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle Status" data-i18n-en="All Status">Alle Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</option>
                    </select>

                    <!-- Search Input -->
                    <span data-i18n-de="Suche:" data-i18n-en="Search:">Suche:</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Produkt suchen..."
                        data-i18n-placeholder-de="Produkt suchen..."
                        data-i18n-placeholder-en="Search product..."
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-indigo-500 w-full sm:w-48 shadow-2xs"
                    >
                    @if(request('search') || request('category_id') || request('status'))
                        <a href="{{ route('admin.products') }}" class="text-xs text-rose-500 hover:underline" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-200/80 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="exec-table-head bg-slate-50/90 text-slate-700 font-bold border-b border-slate-200 text-xs">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Produkt Name & SKU" data-i18n-en="Product Name & SKU">Produkt Name & SKU</th>
                            <th class="p-3.5" data-i18n-de="Kategorie / Subkategorie" data-i18n-en="Category / Subcategory">Kategorie / Subkategorie</th>
                            <th class="p-3.5" data-i18n-de="Preis (€)" data-i18n-en="Price (€)">Preis (€)</th>
                            <th class="p-3.5" data-i18n-de="Lagerbestand" data-i18n-en="Stock">Lagerbestand</th>
                            <th class="p-3.5" data-i18n-de="Bild" data-i18n-en="Image">Bild</th>
                            <th class="p-3.5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($products as $product)
                            <tr class="exec-table-row hover:bg-slate-50/80 transition">
                                <td class="p-3.5">
                                    <p class="font-bold text-slate-900 text-sm flex items-center gap-1.5">
                                        {{ $product->name }}
                                        @if($product->is_featured)
                                            <span class="badge-soft-amber px-2 py-0.5 rounded text-[0.62rem] font-bold">★ Featured</span>
                                        @endif
                                    </p>
                                    <p class="text-[0.68rem] text-slate-400 font-mono">SKU: {{ $product->sku }}</p>
                                </td>
                                <td class="p-3.5">
                                    <span class="badge-soft-indigo inline-block px-2.5 py-1 text-[0.68rem] font-bold rounded-lg">
                                        📁 {{ $product->category->name ?? 'Unkategorisiert' }}
                                    </span>
                                    @if($product->subcategory)
                                        <span class="block text-[0.68rem] text-slate-500 mt-1 font-semibold">↳ {{ $product->subcategory->name }}</span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($product->sale_price)
                                        <span class="font-bold text-emerald-600 text-sm">€{{ number_format($product->sale_price, 2, ',', '.') }}</span>
                                        <span class="line-through text-slate-400 text-xs ml-1">€{{ number_format($product->price, 2, ',', '.') }}</span>
                                    @else
                                        <span class="font-bold text-slate-900 text-sm">€{{ number_format($product->price, 2, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($product->stock > 5)
                                        <span class="badge-soft-emerald px-2.5 py-1 rounded-full text-[0.68rem] font-bold">
                                            {{ $product->stock }} Stk.
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="badge-soft-amber px-2.5 py-1 rounded-full text-[0.68rem] font-bold">
                                            {{ $product->stock }} Knapper Bestand
                                        </span>
                                    @else
                                        <span class="badge-soft-rose px-2.5 py-1 rounded-full text-[0.68rem] font-bold">
                                            Ausverkauft (0)
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-9 w-9 object-cover rounded-lg border border-slate-200 shadow-xs">
                                </td>
                                <td class="p-3.5">
                                    @if($product->status === 'active')
                                        <span class="badge-soft-active px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="badge-soft-pending px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase" data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Soft Pill Button -->
                                        <a 
                                            href="{{ route('admin.products.edit', $product->id) }}"
                                            class="badge-soft-indigo hover:bg-indigo-100 text-indigo-700 px-3 py-1 rounded-lg text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Bearbeiten
                                        </a>

                                        <!-- Delete Soft Pill Button -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteProduct({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                            class="badge-soft-rose hover:bg-rose-100 text-rose-700 px-3 py-1 rounded-lg text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Löschen
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
                                <td colspan="7" class="p-8 text-center text-slate-400 text-xs">
                                    <p class="text-base font-bold text-slate-600 mb-1" data-i18n-de="Keine Produkte gefunden" data-i18n-en="No products found">Keine Produkte gefunden</p>
                                    <p data-i18n-de="Erstellen Sie Ihr erstes Luxusprodukt über den Button oben." data-i18n-en="Create your first luxury product using the button above.">Erstellen Sie Ihr erstes Luxusprodukt über den Button oben.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<script>
    function confirmDeleteProduct(id, name) {
        LuxurySwal.fire({
            title: 'Produkt löschen?',
            text: `Möchten Sie "${name}" wirklich unwiderruflich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ja, Produkt löschen',
            cancelButtonText: 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-product-form-' + id).submit();
            }
        });
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Neues Produkt Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <h2 class="font-bold text-lg text-white tracking-wide" data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Produkt Hinzufügen</h2>
            
            <a href="{{ route('admin.products') }}" class="rounded-full btn-blue-back border border-white/20 text-white px-4 py-1.5 text-xs font-bold transition flex items-center gap-1.5 shadow-sm" style="background-color: #103375 !important; color: #ffffff !important;">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Produkten" data-i18n-en="Back to Products">Zurück zu Produkten</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 space-y-1">
                    <p class="font-bold text-sm">Bitte korrigieren Sie die folgenden Fehler:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Product Name -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Produkt Name *" data-i18n-en="Product Name *">Produkt Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Maison Leather Tote..." 
                        data-i18n-placeholder-de="z. B. Maison Leather Tote..."
                        data-i18n-placeholder-en="e.g. Maison Leather Tote..."
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- SKU Code -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Artikelnummer (SKU)" data-i18n-en="SKU Code">Artikelnummer (SKU)</label>
                    <input 
                        type="text" 
                        name="sku" 
                        value="{{ old('sku') }}" 
                        placeholder="z. B. MHJ-LT-001 (Automatisch wenn leer)" 
                        data-i18n-placeholder-de="z. B. MHJ-LT-001 (Automatisch wenn leer)"
                        data-i18n-placeholder-en="e.g. MHJ-LT-001 (Auto generated if empty)"
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Category Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Hauptkategorie" data-i18n-en="Primary Category">Hauptkategorie</label>
                    <select 
                        name="category_id" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="" data-i18n-de="— Keine Kategorie —" data-i18n-en="— No Category —">— Keine Kategorie —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Unterkategorie" data-i18n-en="Subcategory">Unterkategorie</label>
                    <select 
                        name="subcategory_id" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="" data-i18n-de="— Keine Unterkategorie —" data-i18n-en="— No Subcategory —">— Keine Unterkategorie —</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Regular Price (€) -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Regulärer Preis (€) *" data-i18n-en="Regular Price (€) *">Regulärer Preis (€) *</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        value="{{ old('price') }}" 
                        required 
                        placeholder="1290.00" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Sale Price (€) -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Angebotspreis (€)" data-i18n-en="Sale Price (€)">Angebotspreis (€)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sale_price" 
                        value="{{ old('sale_price') }}" 
                        placeholder="1150.00 (Optional)" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Lagerbestand *" data-i18n-en="Stock Quantity *">Lagerbestand *</label>
                    <input 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', 10) }}" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Status *" data-i18n-en="Status *">Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Primary Image -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Haupt-Produktbild" data-i18n-en="Primary Product Image">Haupt-Produktbild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs"
                    >
                </div>

                <!-- Gallery Images Upload -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Galerie-Bilder (Mehrfach)" data-i18n-en="Gallery Images (Multiple)">Galerie-Bilder (Mehrfach)</label>
                    <input 
                        type="file" 
                        name="gallery[]" 
                        multiple 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs"
                    >
                </div>

            </div>

            <!-- Featured Product Option -->
            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-[#194AA2] focus:ring-[#194AA2]">
                <label for="is_featured" class="font-bold text-slate-800 text-xs cursor-pointer" data-i18n-de="Als Highlight / Featured Produkt auf der Startseite markieren" data-i18n-en="Mark as Featured Product on Homepage">Als Highlight / Featured Produkt auf der Startseite markieren</label>
            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Produktbeschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Geben Sie eine detaillierte Beschreibung des Produkts ein..." 
                    data-i18n-placeholder-de="Geben Sie eine detaillierte Beschreibung des Produkts ein..."
                    data-i18n-placeholder-en="Enter detailed product description..."
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Craftsmanship Details (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Feinsattler-Handwerk & Details" data-i18n-en="Craftsmanship & Atelier Details">Feinsattler-Handwerk & Details</label>
                <textarea 
                    name="craftsmanship" 
                    rows="3" 
                    placeholder="Details zu Material, Herkunft, Vergoldung, Nahtverarbeitung..." 
                    data-i18n-placeholder-de="Details zu Material, Herkunft, Vergoldung, Nahtverarbeitung..."
                    data-i18n-placeholder-en="Details about leather origin, hardware plating, stitching..."
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                >{{ old('craftsmanship') }}</textarea>
            </div>

            <!-- Form Submit Button (Lime Green #84cc16 matching Screenshot 2) -->
            <div class="pt-4 flex items-center justify-center">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-10 py-3.5 rounded-full btn-lime-save text-white font-extrabold text-sm tracking-wide shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2"
                    style="background-color: #84cc16 !important; color: #ffffff !important;"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Produkt Speichern" data-i18n-en="Save Product">Produkt Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

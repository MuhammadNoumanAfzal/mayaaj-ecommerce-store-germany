@extends('layouts.admin')
@section('title', 'Neues Produkt Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden border-t-4 border-t-indigo-600">
        
        <!-- Executive Header -->
        <div class="px-6 py-4.5 bg-white flex items-center justify-between border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600 border border-indigo-100 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Neues Produkt Hinzufügen" data-i18n-en="Add New Product">
                        Neues Produkt Hinzufügen
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Erstellen Sie einen neuen Artikel für Ihren Online-Shop." data-i18n-en="Create a new item for your online store.">Erstellen Sie einen neuen Artikel für Ihren Online-Shop.</p>
                </div>
            </div>
            
            <a href="{{ route('admin.products') }}" class="rounded-xl px-4 py-2 text-xs font-bold bg-slate-100 hover:bg-slate-200/80 text-slate-700 border border-slate-200 transition-all flex items-center gap-1.5 shadow-2xs cursor-pointer hover:shadow-xs">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Produkten" data-i18n-en="Back to Products">Zurück zu Produkten</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Bitte korrigieren Sie die folgenden Fehler:
                    </p>
                    <ul class="list-disc list-inside text-xs pl-6">
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
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Voller Produktname wie auf der Produktseite dargestellt." data-i18n-en="Full product title displayed on the store page.">Voller Produktname wie auf der Produktseite dargestellt.</p>
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
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Eindeutige Artikelnummer für Lagerverwaltung." data-i18n-en="Unique identifier code for inventory tracking.">Eindeutige Artikelnummer für Lagerverwaltung.</p>
                </div>

                <!-- Category Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Hauptkategorie" data-i18n-en="Primary Category">Hauptkategorie</label>
                    <select 
                        name="category_id" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
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
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
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
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Standard-Verkaufspreis inkl. MwSt." data-i18n-en="Standard retail price including VAT.">Standard-Verkaufspreis inkl. MwSt.</p>
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
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Rabattierter Preis (optional)." data-i18n-en="Discounted promo price (optional).">Rabattierter Preis (optional).</p>
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Lagerbestand *" data-i18n-en="Stock Quantity *">Lagerbestand *</label>
                    <input 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', 10) }}" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Verfügbare Stückzahl auf Lager." data-i18n-en="Available units in stock inventory.">Verfügbare Stückzahl auf Lager.</p>
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Status *" data-i18n-en="Status *">Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
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
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Hauptbild für Produktlisten." data-i18n-en="Primary thumbnail for store cards.">Hauptbild für Produktlisten.</p>
                </div>

                <!-- Gallery Images Upload -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Galerie-Bilder (Mehrfach)" data-i18n-en="Gallery Images (Multiple)">Galerie-Bilder (Mehrfach)</label>
                    <input 
                        type="file" 
                        name="gallery[]" 
                        multiple 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                    <p class="text-[0.68rem] text-slate-400 mt-1 font-medium" data-i18n-de="Zusätzliche Detailansichten hochladen." data-i18n-en="Upload additional detail gallery photos.">Zusätzliche Detailansichten hochladen.</p>
                </div>

            </div>

            <!-- Featured Product Option -->
            <div class="flex items-center gap-2 pt-2 p-3 bg-indigo-50/40 rounded-xl border border-indigo-100">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
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
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
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
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                >{{ old('craftsmanship') }}</textarea>
            </div>

            <!-- Bottom Action Button Row with Generous Spacing -->
            <div class="pt-6 mt-8 border-t border-slate-200/80 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="px-6 py-2.5 rounded-xl border border-slate-300/80 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition-all shadow-2xs cursor-pointer hover:shadow-xs" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white px-6 py-2.5 text-xs font-bold transition-all shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2 cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Produkt Speichern" data-i18n-en="Save Product">Produkt Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

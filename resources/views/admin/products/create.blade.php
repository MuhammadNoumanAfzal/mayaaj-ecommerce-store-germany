@extends('layouts.admin')
@section('title', 'Neues Produkt Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card (Executive Luxury Light Theme) -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/90 shadow-md shadow-emerald-950/5 overflow-hidden border-t-4 border-t-emerald-800">
        
        <!-- Executive Header -->
        <div class="px-6 py-4 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-100/80 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Neues Produkt Hinzufügen" data-i18n-en="Add New Product">
                        Neues Produkt Hinzufügen
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Erstellen Sie einen neuen Artikel für Ihren Online-Shop." data-i18n-en="Create a new item for your online store.">Erstellen Sie einen neuen Artikel für Ihren Online-Shop.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Zurück</span>
                </a>
            </div>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Bitte korrigieren Sie die folgenden Fehler:</span>
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
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Produkt Name *" data-i18n-en="Product Name *">Produkt Name <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Maison Leather Tote..." 
                        data-i18n-placeholder-de="z. B. Maison Leather Tote..."
                        data-i18n-placeholder-en="e.g. Maison Leather Tote..."
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                    <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Voller Produktname wie auf der Produktseite dargestellt." data-i18n-en="Full product title displayed on the store page.">Voller Produktname wie auf der Produktseite dargestellt.</p>
                </div>

                <!-- SKU Code -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Artikelnummer (SKU)" data-i18n-en="SKU Code">Artikelnummer (SKU)</label>
                    <input 
                        type="text" 
                        name="sku" 
                        value="{{ old('sku') }}" 
                        placeholder="z. B. MHJ-LT-001 (Automatisch wenn leer)" 
                        data-i18n-placeholder-de="z. B. MHJ-LT-001 (Automatisch wenn leer)"
                        data-i18n-placeholder-en="e.g. MHJ-LT-001 (Auto generated if empty)"
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                    <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Eindeutige Artikelnummer für Lagerverwaltung." data-i18n-en="Unique identifier code for inventory tracking.">Eindeutige Artikelnummer für Lagerverwaltung.</p>
                </div>

                <!-- Category Select -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Hauptkategorie" data-i18n-en="Primary Category">Hauptkategorie</label>
                    <select 
                        name="category_id" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="" data-i18n-de="— Keine Kategorie —" data-i18n-en="— No Category —">— Keine Kategorie —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Select -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Unterkategorie" data-i18n-en="Subcategory">Unterkategorie</label>
                    <select 
                        name="subcategory_id" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="" data-i18n-de="— Keine Unterkategorie —" data-i18n-en="— No Subcategory —">— Keine Unterkategorie —</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Regular Price (€) -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Regulärer Preis (€) *" data-i18n-en="Regular Price (€) *">Regulärer Preis (€) <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        value="{{ old('price') }}" 
                        required 
                        placeholder="0.00" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Sale Price (€) -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Angebotspreis (€)" data-i18n-en="Sale Price (€)">Angebotspreis (€)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sale_price" 
                        value="{{ old('sale_price') }}" 
                        placeholder="0.00 (Optional)" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Lagerbestand *" data-i18n-en="Stock Quantity *">Lagerbestand <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', 10) }}" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Status *" data-i18n-en="Status *">Status <span class="text-emerald-700 font-bold">*</span></label>
                    <select 
                        name="status" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Primary Image Upload -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Hauptbild" data-i18n-en="Primary Image">Hauptbild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2.5 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                    <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Empfohlen: PNG, WebP oder JPG bis 30MB." data-i18n-en="Recommended: PNG, WebP or JPG up to 30MB.">Empfohlen: PNG, WebP oder JPG bis 30MB.</p>
                </div>

                <!-- Gallery Upload -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Galerie-Bilder (Mehrfach)" data-i18n-en="Gallery Images (Multiple)">Galerie-Bilder (Mehrfach)</label>
                    <input 
                        type="file" 
                        name="gallery[]" 
                        multiple 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2.5 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                    <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Zusätzliche Detailansichten hochladen." data-i18n-en="Upload additional detail gallery photos.">Zusätzliche Detailansichten hochladen.</p>
                </div>

            </div>

            <!-- Featured Product Option -->
            <div class="flex items-center gap-2 pt-2 p-3.5 bg-emerald-50/60 rounded-xl border border-emerald-200/80">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-500 cursor-pointer">
                <label for="is_featured" class="font-bold text-slate-900 text-xs cursor-pointer" data-i18n-de="Als Highlight / Featured Produkt auf der Startseite markieren" data-i18n-en="Mark as Featured Product on Homepage">Als Highlight / Featured Produkt auf der Startseite markieren</label>
            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Produktbeschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Geben Sie eine detaillierte Beschreibung des Produkts ein..." 
                    data-i18n-placeholder-de="Geben Sie eine detaillierte Beschreibung des Produkts ein..."
                    data-i18n-placeholder-en="Enter detailed product description..."
                    class="exec-input w-full p-4 rounded-xl text-slate-900 text-sm outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Craftsmanship Details (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Feinsattler-Handwerk & Details" data-i18n-en="Craftsmanship & Atelier Details">Feinsattler-Handwerk & Details</label>
                <textarea 
                    name="craftsmanship" 
                    rows="3" 
                    placeholder="Details zu Material, Herkunft, Vergoldung, Nahtverarbeitung..." 
                    data-i18n-placeholder-de="Details zu Material, Herkunft, Vergoldung, Nahtverarbeitung..."
                    data-i18n-placeholder-en="Details about leather origin, hardware plating, stitching..."
                    class="exec-input w-full p-4 rounded-xl text-slate-900 text-sm outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('craftsmanship') }}</textarea>
            </div>

            <!-- Bottom Action Button Row with Generous Spacing -->
            <div class="pt-6 mt-8 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary px-6 py-2.5 rounded-xl text-xs font-bold transition-all shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Produkt Speichern" data-i18n-en="Save Product">Produkt Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

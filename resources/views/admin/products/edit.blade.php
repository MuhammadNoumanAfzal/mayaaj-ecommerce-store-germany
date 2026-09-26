@extends('layouts.admin')
@section('title', 'Produkt Bearbeiten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card (Executive Luxury Light Theme) -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/90 shadow-md shadow-emerald-950/5 overflow-hidden border-t-4 border-t-emerald-800">
        
        <!-- Executive Light Header -->
        <div class="px-6 py-4 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-100/80 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Produkt Bearbeiten" data-i18n-en="Edit Product">
                        Produkt Bearbeiten
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Aktualisieren Sie die Details dieses Produkts." data-i18n-en="Update details for this product.">Aktualisieren Sie die Details dieses Produkts.</p>
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
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 space-y-1">
                    <p class="font-bold text-sm" data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Bitte korrigieren Sie die folgenden Fehler:</p>
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
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Produkt Name *" data-i18n-en="Product Name *">Produkt Name <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $product->name) }}" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- SKU Code -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Artikelnummer (SKU)" data-i18n-en="SKU Code">Artikelnummer (SKU)</label>
                    <input 
                        type="text" 
                        name="sku" 
                        value="{{ old('sku', $product->sku) }}" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
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
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                            <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
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
                        value="{{ old('price', $product->price) }}" 
                        required 
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
                        value="{{ old('sale_price', $product->sale_price) }}" 
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
                        value="{{ old('stock', $product->stock) }}" 
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
                        <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Primary Image Upload & Preview -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Neues Hauptbild (Optional)" data-i18n-en="New Primary Image (Optional)">Neues Hauptbild (Optional)</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2.5 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                    @if($product->image_url)
                        <div class="mt-3 flex items-center gap-3 bg-slate-50 p-2 rounded-xl border border-slate-200">
                            <img src="{{ $product->image_url }}" alt="Aktuelles Hauptbild" class="h-10 w-10 object-cover rounded-lg border border-slate-200">
                            <span class="text-slate-600 text-xs font-semibold">Aktuelles Bild vorhanden</span>
                        </div>
                    @endif
                </div>

                <!-- Gallery Upload -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Galerie-Bilder Ersetzen (Optional)" data-i18n-en="Replace Gallery Images (Optional)">Galerie-Bilder Ersetzen (Optional)</label>
                    <input 
                        type="file" 
                        name="gallery[]" 
                        multiple 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2.5 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                </div>

            </div>

            <!-- Featured Product Option -->
            <div class="flex items-center gap-2 pt-2 p-3.5 bg-emerald-50/60 rounded-xl border border-emerald-200/80">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-700 focus:ring-emerald-500 cursor-pointer">
                <label for="is_featured" class="font-bold text-slate-900 text-xs cursor-pointer" data-i18n-de="Als Highlight / Featured Produkt auf der Startseite markieren" data-i18n-en="Mark as Featured Product on Homepage">Als Highlight / Featured Produkt auf der Startseite markieren</label>
            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Produktbeschreibung" data-i18n-en="Product Description">Produktbeschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    class="exec-input w-full p-4 rounded-xl text-slate-900 text-sm outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('description', $product->description) }}</textarea>
                <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Ausführliche Produktbeschreibung." data-i18n-en="Detailed product description.">Ausführliche Produktbeschreibung.</p>
            </div>

            <!-- Craftsmanship Details (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Feinsattler-Handwerk & Details" data-i18n-en="Craftsmanship & Atelier Details">Feinsattler-Handwerk & Details</label>
                <textarea 
                    name="craftsmanship" 
                    rows="3" 
                    class="exec-input w-full p-4 rounded-xl text-slate-900 text-sm outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('craftsmanship', $product->craftsmanship) }}</textarea>
                <p class="text-[0.68rem] text-slate-600 mt-1 font-semibold" data-i18n-de="Material- und Verarbeitungsdetails." data-i18n-en="Material and atelier details.">Material- und Verarbeitungsdetails.</p>
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
                    <span data-i18n-de="Änderungen Speichern" data-i18n-en="Save Changes">Änderungen Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

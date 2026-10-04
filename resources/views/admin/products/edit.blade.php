@extends('layouts.admin')
@section('title', 'Edit Product - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto pb-16">

    <!-- Form Container Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/90 shadow-md shadow-stone-900/5 overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Header -->
        <div class="px-6 py-4 bg-stone-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-stone-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-stone-900 tracking-tight">
                        <span data-i18n-de="Produkt Bearbeiten:" data-i18n-en="Edit Product:">Edit Product:</span> 
                        <span class="text-saltora-terracotta">{{ $product->name }}</span>
                    </h2>
                    <p class="text-[0.7rem] text-stone-500 font-medium" data-i18n-de="Aktualisieren Sie die Details dieses Produkts." data-i18n-en="Update details for this luxury item.">Update details for this luxury item.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Back</span>
                </a>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Please correct the following errors:</span>
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
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="PRODUKT NAME *" data-i18n-en="PRODUCT NAME *">PRODUCT NAME <span class="text-saltora-terracotta">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $product->name) }}" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                </div>

                <!-- SKU Code -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="ARTIKELNUMMER (SKU)" data-i18n-en="SKU CODE">SKU CODE</label>
                    <input 
                        type="text" 
                        name="sku" 
                        value="{{ old('sku', $product->sku) }}" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                </div>

                <!-- Category Select -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="HAUPTKATEGORIE" data-i18n-en="PRIMARY CATEGORY">PRIMARY CATEGORY</label>
                    <select 
                        name="category_id" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                        <option value="" data-i18n-de="— Keine Kategorie —" data-i18n-en="— No Category —">— No Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Select -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="UNTERKATEGORIE" data-i18n-en="SUBCATEGORY">SUBCATEGORY</label>
                    <select 
                        name="subcategory_id" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                        <option value="" data-i18n-de="— Keine Unterkategorie —" data-i18n-en="— No Subcategory —">— No Subcategory —</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>{{ $sub->name }} ({{ $sub->category->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Regular Price (€) -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="REGULÄRER PREIS (€) *" data-i18n-en="REGULAR PRICE (€) *">REGULAR PRICE (€) <span class="text-saltora-terracotta">*</span></label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="price" 
                        value="{{ old('price', $product->price) }}" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                </div>

                <!-- Sale Price (€) -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="ANGEBOTSPREIS (€)" data-i18n-en="SALE PRICE (€)">SALE PRICE (€)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="sale_price" 
                        value="{{ old('sale_price', $product->sale_price) }}" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="LAGERBESTAND *" data-i18n-en="STOCK QUANTITY *">STOCK QUANTITY <span class="text-saltora-terracotta">*</span></label>
                    <input 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', $product->stock) }}" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="STATUS *" data-i18n-en="STATUS *">STATUS <span class="text-saltora-terracotta">*</span></label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 text-sm outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                    >
                        <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Active (Public)</option>
                        <option value="draft" {{ old('status', $product->status) === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Draft (Hidden)</option>
                    </select>
                </div>

                <!-- Primary Image Upload -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="HAUPTBILD" data-i18n-en="PRIMARY IMAGE">PRIMARY IMAGE</label>
                    
                    @if($product->image)
                        <div class="mb-3 flex items-center gap-3 p-2 bg-stone-50 border border-stone-200 rounded-xl">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover border border-stone-300">
                            <div>
                                <p class="text-[0.68rem] font-bold text-stone-700" data-i18n-de="Aktuelles Bild" data-i18n-en="Current image">Current image</p>
                                <p class="text-[0.62rem] text-stone-400" data-i18n-de="Laden Sie unten eine Datei hoch, um es zu ersetzen." data-i18n-en="Upload a file below to replace it.">Upload a file below to replace it.</p>
                            </div>
                        </div>
                    @endif

                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-saltora-blush file:text-saltora-terracotta hover:file:bg-saltora-blush/80 h-11 px-2 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs cursor-pointer shadow-2xs"
                    >
                </div>

                <!-- Gallery Upload -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="GALERIE-BILDER (MEHRFACH)" data-i18n-en="GALLERY IMAGES (MULTIPLE)">GALLERY IMAGES (MULTIPLE)</label>

                    @if($product->gallery_images && count($product->gallery_images) > 0)
                        <div class="mb-3 flex flex-wrap gap-2 p-2 bg-stone-50 border border-stone-200 rounded-xl">
                            @foreach($product->gallery_images as $gImg)
                                <img src="{{ asset('storage/' . $gImg) }}" alt="Gallery" class="h-10 w-10 rounded-lg object-cover border border-stone-300">
                            @endforeach
                        </div>
                    @endif

                    <input 
                        type="file" 
                        name="gallery[]" 
                        multiple 
                        accept="image/*" 
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-saltora-blush file:text-saltora-terracotta hover:file:bg-saltora-blush/80 h-11 px-2 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs cursor-pointer shadow-2xs"
                    >
                </div>

            </div>

            <!-- Featured Product Option -->
            <div class="flex items-center gap-2.5 pt-2 p-3.5 bg-saltora-blush-light rounded-xl border border-saltora-terracotta/20">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="h-4 w-4 rounded border-stone-300 text-saltora-terracotta focus:ring-saltora-terracotta/30 accent-saltora-terracotta cursor-pointer">
                <label for="is_featured" class="font-bold text-stone-900 text-xs cursor-pointer" data-i18n-de="Als Highlight / Featured Produkt auf der Startseite markieren" data-i18n-en="Mark as Featured Product on Homepage">Mark as Featured Product on Homepage</label>
            </div>

            <!-- Description -->
            <div>
                <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="PRODUKTBESCHREIBUNG" data-i18n-en="PRODUCT DESCRIPTION">PRODUCT DESCRIPTION</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    class="w-full p-4 rounded-xl text-stone-900 text-xs font-medium outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Craftsmanship Details -->
            <div>
                <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="FEINSATTLER-HANDWERK & DETAILS" data-i18n-en="CRAFTSMANSHIP & ATELIER DETAILS">CRAFTSMANSHIP & ATELIER DETAILS</label>
                <textarea 
                    name="craftsmanship" 
                    rows="3" 
                    class="w-full p-4 rounded-xl text-stone-900 text-xs font-medium outline-none transition shadow-2xs border border-stone-200 bg-stone-50 focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20"
                >{{ old('craftsmanship', $product->craftsmanship) }}</textarea>
            </div>

            <!-- Bottom Action Button Row -->
            <div class="pt-6 mt-8 border-t border-stone-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary px-6 py-2.5 rounded-xl text-xs font-bold transition-all shadow-2xs cursor-pointer" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Änderungen Speichern" data-i18n-en="Save Changes">Save Changes</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

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

                <!-- Production Cost Price (€) -->
                <div>
                    <label class="block font-bold text-stone-900 mb-1.5 uppercase tracking-wider" data-i18n-de="HERSTELLKOSTEN / EK (€)" data-i18n-en="COST / PURCHASE PRICE (€)">COST PRICE (€)</label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="cost_price" 
                        value="{{ old('cost_price', $product->cost_price) }}" 
                        placeholder="0.00" 
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

            <!-- Description with Rich Text Editor -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block font-bold text-stone-900 uppercase tracking-wider" data-i18n-de="PRODUKTBESCHREIBUNG (RICH TEXT EDITOR)" data-i18n-en="PRODUCT DESCRIPTION (RICH TEXT EDITOR)">
                        PRODUCT DESCRIPTION (RICH TEXT EDITOR)
                    </label>
                    <span class="text-[0.65rem] text-stone-400 font-medium">Supports bold, lists, headings & links</span>
                </div>
                <div id="quill-description" class="bg-white rounded-xl border border-stone-200 min-h-[140px] text-stone-800 text-sm">{!! old('description', $product->description) !!}</div>
                <textarea name="description" id="textarea-description" class="hidden">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Craftsmanship Details with Rich Text Editor -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block font-bold text-stone-900 uppercase tracking-wider" data-i18n-de="FEINSATTLER-HANDWERK & DETAILS (RICH TEXT EDITOR)" data-i18n-en="CRAFTSMANSHIP & ATELIER DETAILS (RICH TEXT EDITOR)">
                        CRAFTSMANSHIP & ATELIER DETAILS (RICH TEXT EDITOR)
                    </label>
                    <span class="text-[0.65rem] text-stone-400 font-medium">Atelier craftsmanship summary</span>
                </div>
                <div id="quill-craftsmanship" class="bg-white rounded-xl border border-stone-200 min-h-[100px] text-stone-800 text-sm">{!! old('craftsmanship', $product->craftsmanship) !!}</div>
                <textarea name="craftsmanship" id="textarea-craftsmanship" class="hidden">{{ old('craftsmanship', $product->craftsmanship) }}</textarea>
            </div>

            <!-- ======================================================== -->
            <!-- PRODUCT VARIATIONS (FINISHES / COLORS / SIZES) -->
            <!-- ======================================================== -->
            <div class="pt-6 border-t border-stone-200 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-3 bg-stone-50 p-4 rounded-xl border border-stone-200/80">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-saltora-terracotta"></span>
                            <h3 class="font-bold text-sm text-stone-900 uppercase tracking-wider" data-i18n-de="PRODUKT VARIANTEN (LEDER-FINISHES / FARBEN)" data-i18n-en="PRODUCT VARIATIONS (LEATHER FINISHES / COLORS)">
                                PRODUCT VARIATIONS (LEATHER FINISHES / COLORS)
                            </h3>
                        </div>
                        <p class="text-[0.7rem] text-stone-500 mt-0.5" data-i18n-de="Definieren Sie interaktive Ausführungen für die Produktseite (z. B. Burnished Mahogany, Noir Profond, Cognac Vintage)." data-i18n-en="Define interactive swatches and finishes displayed as selectable pills on the product page.">
                            Define interactive swatches and finishes displayed as selectable pills on the product page.
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="loadDefaultVariations()" class="btn-exec-secondary text-[0.68rem] px-3 py-1.5 rounded-lg border border-stone-300 bg-white hover:bg-stone-100 flex items-center gap-1.5 cursor-pointer shadow-2xs font-semibold text-stone-700">
                            <i class="fa-solid fa-wand-magic-sparkles text-saltora-terracotta"></i>
                            <span data-i18n-de="Standard Leder-Finishes Laden" data-i18n-en="Load Default Leather Finishes">Load Default Leather Finishes</span>
                        </button>
                        <button type="button" onclick="addVariationRow()" class="btn-exec-primary text-[0.68rem] px-3 py-1.5 rounded-lg flex items-center gap-1.5 cursor-pointer shadow-2xs font-bold text-white bg-saltora-terracotta hover:bg-saltora-terracotta-dark">
                            <i class="fa-solid fa-plus"></i>
                            <span data-i18n-de="Variante Hinzufügen" data-i18n-en="Add Variation">Add Variation</span>
                        </button>
                    </div>
                </div>

                <!-- Variations Table / List Container -->
                <input type="hidden" name="variations_json" id="variations_json" value="{{ old('variations_json', json_encode($product->variations ?? [])) }}">
                <div id="variations-container" class="space-y-2.5">
                    <!-- Populated dynamically by JavaScript -->
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- PRODUCT DETAILS, FAQS & ACCORDION TABS -->
            <!-- ======================================================== -->
            <div class="pt-6 border-t border-stone-200 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-3 bg-stone-50 p-4 rounded-xl border border-stone-200/80">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-amber-600"></span>
                            <h3 class="font-bold text-sm text-stone-900 uppercase tracking-wider" data-i18n-de="DETAILS, MATERIAL & ACCORDION TABS / FAQS" data-i18n-en="DETAILS, MATERIAL & ACCORDION TABS / FAQS">
                                DETAILS, MATERIAL & ACCORDION TABS / FAQS
                            </h3>
                        </div>
                        <p class="text-[0.7rem] text-stone-500 mt-0.5" data-i18n-de="Erstellen Sie die aufklappbaren Sektionen unter dem Produkt (Feinsattler-Verarbeitung, Pflanzengerbung, Pflege, Versand, etc.)." data-i18n-en="Manage the collapsible accordion sections beneath the product (Craftsmanship, Materials, Care, Shipping, FAQs).">
                            Manage the collapsible accordion sections beneath the product (Craftsmanship, Materials, Care, Shipping, FAQs).
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="loadDefaultTabs()" class="btn-exec-secondary text-[0.68rem] px-3 py-1.5 rounded-lg border border-stone-300 bg-white hover:bg-stone-100 flex items-center gap-1.5 cursor-pointer shadow-2xs font-semibold text-stone-700">
                            <i class="fa-solid fa-layer-group text-amber-600"></i>
                            <span data-i18n-de="4 Luxus-Standard-Tabs Laden" data-i18n-en="Load 4 Luxury Default Tabs">Load 4 Luxury Default Tabs</span>
                        </button>
                        <button type="button" onclick="addAccordionTab()" class="btn-exec-primary text-[0.68rem] px-3 py-1.5 rounded-lg flex items-center gap-1.5 cursor-pointer shadow-2xs font-bold text-white bg-amber-600 hover:bg-amber-700">
                            <i class="fa-solid fa-plus"></i>
                            <span data-i18n-de="Tab / FAQ Hinzufügen" data-i18n-en="Add Tab / FAQ">Add Tab / FAQ</span>
                        </button>
                    </div>
                </div>

                <!-- Tabs Container -->
                <input type="hidden" name="accordion_tabs_json" id="accordion_tabs_json" value="{{ old('accordion_tabs_json', json_encode($product->accordion_tabs ?? [])) }}">
                <div id="tabs-container" class="space-y-6">
                    <!-- Populated dynamically by JavaScript -->
                </div>
            </div>

            <!-- Bottom Action Button Row -->
            <div class="pt-6 mt-8 border-t border-stone-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary px-6 py-2.5 rounded-xl text-xs font-bold transition-all shadow-2xs cursor-pointer" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    id="product-submit-btn"
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer font-bold text-white bg-saltora-terracotta hover:bg-saltora-terracotta-dark"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Änderungen Speichern" data-i18n-en="Save Changes">Save Changes</span>
                </button>
            </div>

        </form>
    </div>

</div>

<!-- Interactive Engine for Quill Editors, Variations & Accordion Tabs Builder -->
<script>
    let quillDesc = null;
    let quillCraft = null;
    const tabQuillInstances = {};

    document.addEventListener('DOMContentLoaded', () => {
        const toolbarOptions = [
            [{ 'header': [2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'clean']
        ];

        if (document.getElementById('quill-description')) {
            quillDesc = new Quill('#quill-description', {
                theme: 'snow',
                placeholder: 'Enter rich product description...',
                modules: { toolbar: toolbarOptions }
            });
        }

        if (document.getElementById('quill-craftsmanship')) {
            quillCraft = new Quill('#quill-craftsmanship', {
                theme: 'snow',
                placeholder: 'Enter craftsmanship and atelier details...',
                modules: { toolbar: toolbarOptions }
            });
        }

        // Initialize Variations from product or old
        try {
            const rawVar = document.getElementById('variations_json').value;
            const vars = JSON.parse(rawVar || '[]');
            if (Array.isArray(vars) && vars.length > 0) {
                vars.forEach(v => renderVariationRow(v));
            } else {
                renderEmptyVariationsState();
            }
        } catch(e) {
            renderEmptyVariationsState();
        }

        // Initialize Accordion Tabs from product or old
        try {
            const rawTabs = document.getElementById('accordion_tabs_json').value;
            const tabs = JSON.parse(rawTabs || '[]');
            if (Array.isArray(tabs) && tabs.length > 0) {
                tabs.forEach(t => renderAccordionTab(t));
            } else {
                renderEmptyTabsState();
            }
        } catch(e) {
            renderEmptyTabsState();
        }

        // Sync all Quills and dynamic repeaters on form submit
        const form = document.querySelector('form[action*="admin/products"]');
        if (form) {
            form.addEventListener('submit', (e) => {
                if (quillDesc) {
                    document.getElementById('textarea-description').value = quillDesc.root.innerHTML === '<p><br></p>' ? '' : quillDesc.root.innerHTML;
                }
                if (quillCraft) {
                    document.getElementById('textarea-craftsmanship').value = quillCraft.root.innerHTML === '<p><br></p>' ? '' : quillCraft.root.innerHTML;
                }
                syncVariationsJSON();
                syncTabsJSON();
            });
        }
    });

    // ========================================================
    // VARIATIONS BUILDER
    // ========================================================
    function renderEmptyVariationsState() {
        const container = document.getElementById('variations-container');
        if (!container.querySelector('.variation-row')) {
            container.innerHTML = `
                <div id="empty-variations-notice" class="p-6 rounded-xl border border-dashed border-stone-200 bg-stone-50/40 text-center text-xs text-stone-500">
                    <i class="fa-solid fa-swatchbook text-stone-300 text-xl mb-1.5 block"></i>
                    <p class="font-medium text-stone-600">No variations added yet.</p>
                    <p class="text-[0.68rem] text-stone-400 mt-0.5">Click <strong class="text-saltora-terracotta cursor-pointer hover:underline" onclick="addVariationRow()">+ Add Variation</strong> to add custom leather swatches, or click <strong>Load Default Leather Finishes</strong> if desired.</p>
                </div>
            `;
        }
    }

    function loadDefaultVariations() {
        const container = document.getElementById('variations-container');
        container.innerHTML = '';
        const defaults = [
            { name: 'Burnished Mahogany', color: '#5a2e1e', sku: '', price: '', stock: 10 },
            { name: 'Noir Profond', color: '#1c1210', sku: '', price: '', stock: 8 },
            { name: 'Cognac Vintage', color: '#8c5836', sku: '', price: '', stock: 5 }
        ];
        defaults.forEach(v => renderVariationRow(v));
        syncVariationsJSON();
    }

    function addVariationRow() {
        renderVariationRow({ name: '', color: '#78000b', sku: '', price: '', stock: '' });
        syncVariationsJSON();
    }

    function renderVariationRow(data) {
        const container = document.getElementById('variations-container');
        const emptyNotice = document.getElementById('empty-variations-notice');
        if (emptyNotice) emptyNotice.remove();

        const id = 'var_' + Math.random().toString(36).substr(2, 9);

        const card = document.createElement('div');
        card.id = id;
        card.className = 'variation-row bg-white rounded-xl border border-stone-200 p-3 sm:p-3.5 shadow-2xs flex flex-wrap items-center gap-3 transition-all hover:border-saltora-terracotta/40';

        card.innerHTML = `
            <div class="flex items-center gap-2">
                <input type="color" value="${data.color || '#1c1210'}" class="h-9 w-9 rounded-lg border border-stone-300 p-0.5 cursor-pointer var-color-picker" onchange="this.nextElementSibling.value = this.value; syncVariationsJSON();">
                <input type="text" value="${data.color || '#1c1210'}" placeholder="#HEX" class="w-20 h-9 rounded-lg px-2.5 text-xs font-mono uppercase text-stone-700 border border-stone-200 bg-stone-50 outline-none var-color-hex" oninput="this.previousElementSibling.value = this.value; syncVariationsJSON();">
            </div>

            <div class="flex-1 min-w-[160px]">
                <input type="text" value="${data.name || ''}" placeholder="Finish / Variant Name (e.g. Burnished Mahogany)" required class="w-full h-9 rounded-lg px-3 text-xs font-semibold text-stone-900 border border-stone-200 bg-stone-50 outline-none focus:border-saltora-terracotta var-name" oninput="syncVariationsJSON();">
            </div>

            <div class="w-28">
                <input type="text" value="${data.sku || ''}" placeholder="SKU (optional)" class="w-full h-9 rounded-lg px-2.5 text-xs text-stone-700 border border-stone-200 bg-stone-50 outline-none var-sku" oninput="syncVariationsJSON();">
            </div>

            <div class="w-24">
                <input type="number" step="0.01" value="${data.price || ''}" placeholder="Price (€)" class="w-full h-9 rounded-lg px-2.5 text-xs text-stone-700 border border-stone-200 bg-stone-50 outline-none var-price" oninput="syncVariationsJSON();">
            </div>

            <div class="w-24">
                <input type="number" min="0" value="${data.stock !== undefined && data.stock !== null ? data.stock : ''}" placeholder="Stock (Qty)" class="w-full h-9 rounded-lg px-2.5 text-xs text-stone-700 border border-stone-200 bg-stone-50 outline-none var-stock" oninput="syncVariationsJSON();" title="Variant Stock Quantity">
            </div>

            <button type="button" onclick="document.getElementById('${id}').remove(); syncVariationsJSON();" class="h-9 w-9 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 hover:text-rose-700 transition cursor-pointer" title="Remove Variation">
                <i class="fa-solid fa-trash-can text-xs"></i>
            </button>
        `;

        container.appendChild(card);
    }

    function syncVariationsJSON() {
        const rows = document.querySelectorAll('.variation-row');
        const items = [];
        rows.forEach(r => {
            const name = r.querySelector('.var-name')?.value.trim();
            const color = r.querySelector('.var-color-hex')?.value.trim() || '#1c1210';
            const sku = r.querySelector('.var-sku')?.value.trim() || null;
            const price = r.querySelector('.var-price')?.value.trim() || null;
            const stockRaw = r.querySelector('.var-stock')?.value.trim();
            const stock = (stockRaw !== '' && !isNaN(stockRaw)) ? parseInt(stockRaw) : null;

            if (name) {
                items.push({ name, color, sku, price, stock });
            }
        });
        document.getElementById('variations_json').value = JSON.stringify(items);
        if (rows.length === 0) {
            renderEmptyVariationsState();
        }
    }

    // ========================================================
    // ACCORDION TABS / DETAILS BUILDER
    // ========================================================
    function loadDefaultTabs() {
        const container = document.getElementById('tabs-container');
        container.innerHTML = '';
        Object.keys(tabQuillInstances).forEach(k => delete tabQuillInstances[k]);

        const defaults = [
            {
                title: 'Master Craftsmanship & Saddlery Finishing',
                dot_color: '#78000b',
                content: '<p>Jedes Stück wird in aufwendiger Einzelanfertigung von unseren erfahrenen Feinsattlern vollendet. Die Schnittkanten werden traditionell mehrfach von Hand mit Bienenwachs geschliffen und kantenversiegelt, wodurch eine unvergleichliche Beständigkeit und seidig-glatte Haptik entsteht.</p>',
                features: ['Doppelte Sattlernaht mit gewachstem Garn', 'Handpolierte massive Messingbeschläge']
            },
            {
                title: 'Materials & Tuscan Vegetable Tanning',
                dot_color: '#d8b45a',
                content: '<p>Für dieses Meisterstück verwenden wir ausschließlich europäisches Vollrind- und Kalbsleder der höchsten Selektionsstufe A+. Die Gerbung erfolgt in der Toskana rein pflanzlich mittels Rinden- und Kastanienextrakten – völlig frei von toxischem Chrom.</p>',
                features: ['100% vegetabil gegerbt', 'Europäisches Vollrindleder']
            },
            {
                title: 'Care Instructions & Patina Development',
                dot_color: '#2e683a',
                content: '<p>Pflanzlich gegerbtes Leder reift mit den Jahren und entwickelt eine unverwechselbare, edle Patina. Wir empfehlen, das Leder ein- bis zweimal jährlich sanft mit unserem organischen MEHAAJ Bienenwachsbalsam und einem Baumwolltuch zu nähren.</p>',
                features: ['Inklusive Baumwoll-Staubbeutel', 'Bienenwachsbalsam-kompatibel']
            },
            {
                title: 'Shipping, Gift Packaging & Free Returns',
                dot_color: '#78000b',
                content: '<p>Jedes Produkt verlässt unser Atelier in einer nummerierten MEHAAJ Luxus-Magnetbox, geschützt durch einen atmungsaktiven Staubbeutel aus Bio-Baumwolle. Der Versand erfolgt versichert via DHL Express mit Live-Tracking. 30 Tage Rückgaberecht mit beiliegendem Retourenetikett.</p>',
                features: ['DHL Express mit Tracking', '30 Tage kostenlose Retoure in DE']
            }
        ];

        defaults.forEach(t => renderAccordionTab(t));
        syncTabsJSON();
    }

    function renderEmptyTabsState() {
        const container = document.getElementById('tabs-container');
        if (!container.querySelector('.tab-card')) {
            container.innerHTML = `
                <div id="empty-tabs-notice" class="p-6 rounded-xl border border-dashed border-stone-200 bg-stone-50/40 text-center text-xs text-stone-500">
                    <i class="fa-solid fa-layer-group text-stone-300 text-xl mb-1.5 block"></i>
                    <p class="font-medium text-stone-600">No accordion tabs added yet.</p>
                    <p class="text-[0.68rem] text-stone-400 mt-0.5">Click <strong class="text-amber-600 cursor-pointer hover:underline" onclick="addAccordionTab()">+ Add Tab / FAQ</strong> to create custom sections, or click <strong>Load 4 Luxury Default Tabs</strong> if desired.</p>
                </div>
            `;
        }
    }

    function addAccordionTab() {
        renderAccordionTab({
            title: '',
            dot_color: '#78000b',
            content: '',
            features: []
        });
        syncTabsJSON();
    }

    function renderAccordionTab(data) {
        const container = document.getElementById('tabs-container');
        const emptyNotice = document.getElementById('empty-tabs-notice');
        if (emptyNotice) emptyNotice.remove();

        const tabId = 'tab_' + Math.random().toString(36).substr(2, 9);
        const editorId = 'editor_' + tabId;

        const card = document.createElement('div');
        card.id = tabId;
        card.className = 'tab-card bg-white rounded-xl border border-stone-200/90 p-5 sm:p-6 shadow-sm flex flex-col gap-5 transition-all hover:border-amber-600/40 hover:shadow-md';

        const featuresText = Array.isArray(data.features) ? data.features.join('\n') : (data.features || '');

        card.innerHTML = `
            <div class="tab-header-row flex items-center justify-between pb-3 border-b border-stone-100">
                <div class="flex items-center gap-2.5 flex-1 mr-3">
                    <span class="tab-dot-preview h-3.5 w-3.5 rounded-full shrink-0 shadow-xs ring-2 ring-stone-100" style="background-color: ${data.dot_color || '#78000b'};"></span>
                    <input type="text" value="${data.title || ''}" placeholder="Tab Title (e.g. Master Craftsmanship & Saddlery Finishing)" required class="tab-title w-full font-bold text-stone-900 text-xs sm:text-sm bg-transparent border-b border-transparent hover:border-stone-300 focus:border-amber-600 outline-none pb-0.5" oninput="syncTabsJSON();">
                </div>
                <div class="flex items-center gap-2">
                    <select class="tab-dot-color h-8.5 rounded-lg px-2.5 text-[0.68rem] font-bold text-stone-700 border border-stone-200 bg-stone-50 outline-none focus:border-amber-600 cursor-pointer" onchange="this.closest('.tab-card').querySelector('.tab-dot-preview').style.backgroundColor = this.value; syncTabsJSON();">
                        <option value="#78000b" ${data.dot_color === '#78000b' ? 'selected' : ''}>Burgundy (#78000b)</option>
                        <option value="#d8b45a" ${data.dot_color === '#d8b45a' ? 'selected' : ''}>Gold (#d8b45a)</option>
                        <option value="#2e683a" ${data.dot_color === '#2e683a' ? 'selected' : ''}>Forest (#2e683a)</option>
                        <option value="#1c1210" ${data.dot_color === '#1c1210' ? 'selected' : ''}>Onyx (#1c1210)</option>
                    </select>
                    <button type="button" onclick="deleteAccordionTab('${tabId}')" class="h-8.5 w-8.5 flex items-center justify-center rounded-lg text-rose-500 hover:bg-rose-50 hover:text-rose-700 transition cursor-pointer" title="Remove Tab">
                        <i class="fa-solid fa-trash-can text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Tab Content Rich Text Editor -->
            <div class="tab-content-block flex flex-col gap-1.5">
                <div class="flex items-center justify-between">
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-stone-700">
                        TAB CONTENT / DESCRIPTION (RICH TEXT)
                    </label>
                    <span class="text-[0.62rem] text-stone-400">Rich text content for this accordion section</span>
                </div>
                <div class="quill-tab-wrapper">
                    <div id="${editorId}" class="tab-editor-container bg-white text-xs text-stone-800">${data.content || ''}</div>
                </div>
            </div>

            <!-- Tab Checklist / Feature Highlights (As seen in screenshot) -->
            <div class="tab-features-block flex flex-col gap-1.5 pt-1">
                <div class="flex items-center justify-between">
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-stone-700">
                        KEY HIGHLIGHT BULLETS (1 PER LINE)
                    </label>
                    <span class="text-[0.62rem] text-stone-400">Renders as checkmark badges (e.g. ✓ Double saddle stitching...)</span>
                </div>
                <textarea rows="3" placeholder="Double saddle stitching with waxed linen thread&#10;Hand-burnished solid brass hardware" class="tab-features w-full p-3 rounded-xl text-xs text-stone-800 border border-stone-200 bg-stone-50/50 outline-none focus:border-amber-600 focus:bg-white focus:ring-2 focus:ring-amber-600/10 transition shadow-2xs leading-relaxed" oninput="syncTabsJSON();">${featuresText}</textarea>
            </div>
        `;

        container.appendChild(card);

        // Initialize Quill on this tab
        setTimeout(() => {
            if (document.getElementById(editorId)) {
                const q = new Quill('#' + editorId, {
                    theme: 'snow',
                    placeholder: 'Describe details, leather characteristics, instructions...',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline'],
                            [{ 'list': 'bullet' }],
                            ['link', 'clean']
                        ]
                    }
                });
                q.on('text-change', () => {
                    syncTabsJSON();
                });
                tabQuillInstances[tabId] = q;
            }
        }, 50);
    }

    function deleteAccordionTab(tabId) {
        if (tabQuillInstances[tabId]) {
            delete tabQuillInstances[tabId];
        }
        const el = document.getElementById(tabId);
        if (el) el.remove();
        syncTabsJSON();
    }

    function syncTabsJSON() {
        const cards = document.querySelectorAll('.tab-card');
        const items = [];
        cards.forEach(card => {
            const title = card.querySelector('.tab-title')?.value.trim();
            const dot_color = card.querySelector('.tab-dot-color')?.value || '#78000b';
            const featuresRaw = card.querySelector('.tab-features')?.value.trim() || '';
            const features = featuresRaw ? featuresRaw.split('\n').map(s => s.trim()).filter(Boolean) : [];

            let content = '';
            if (tabQuillInstances[card.id]) {
                const html = tabQuillInstances[card.id].root.innerHTML;
                content = (html === '<p><br></p>') ? '' : html;
            } else {
                content = card.querySelector('.tab-editor-container')?.innerHTML || '';
            }

            if (title) {
                items.push({
                    title: title,
                    dot_color: dot_color,
                    content: content,
                    features: features
                });
            }
        });
        document.getElementById('accordion_tabs_json').value = JSON.stringify(items);
        if (cards.length === 0) {
            renderEmptyTabsState();
        }
    }
</script>
@endsection

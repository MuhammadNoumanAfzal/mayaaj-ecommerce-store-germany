@extends('layouts.admin')
@section('title', 'Create Atelier Product - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-4 w-full pb-16 text-[#1c1210]">

    <!-- 1. Breadcrumb Navigation Pill -->
    <div class="bg-gradient-to-r from-white via-[#FAF7F2] to-white rounded-xl py-2.5 px-4 text-xs font-semibold text-stone-600 border border-[#ebdccb] shadow-2xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.products') }}" class="text-[#8a7c74] hover:text-[#78000b] transition flex items-center gap-1.5 font-bold" data-i18n-de="Produkte" data-i18n-en="Products">
                <svg class="w-3.5 h-3.5 text-[#78000b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>Products</span>
            </a>
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-[#78000b] font-bold" data-i18n-de="Neues Atelier Produkt" data-i18n-en="New Atelier Product">New Atelier Product</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-[0.68rem] text-stone-500 font-medium">Multi-Step Atelier Wizard</span>
            <span id="wizardStepIndicatorBadge" class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-[#78000b]/10 text-[#78000b] border border-[#78000b]/20">Step 1 of 5</span>
        </div>
    </div>

    <!-- 2. Main Wizard Form Container Card -->
    <form id="productWizardForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-[#ebdccb] shadow-sm overflow-hidden border-t-4 border-t-[#78000b]">
        @csrf

        <!-- Wizard Header Bar -->
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Neues Atelier Produkt Erstellen" data-i18n-en="Create Atelier Product">
                        Create Atelier Product
                    </h2>
                    <p class="text-[0.68rem] text-[#8a7267]">Comprehensive 5-step master configuration for bespoke luxury catalog</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.products') }}" class="btn-exec-secondary rounded-xl px-3.5 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        <!-- 3. Luxury Interactive Stepper Tabs (5 Steps) -->
        <div class="bg-[#FAF8F5] border-b border-[#ebdccb] px-3 sm:px-6 py-2.5 overflow-x-auto">
            <nav class="flex items-center justify-between min-w-[660px] gap-2" aria-label="Product Wizard Steps">
                
                <!-- Tab 1: Core Catalog -->
                <button type="button" onclick="goToStep(1)" id="stepTab-1" class="step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group bg-white border border-[#ebdccb] shadow-2xs">
                    <span class="step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-[#78000b] text-[#d8b45a] shadow-xs">
                        1
                    </span>
                    <div class="min-w-0">
                        <span class="step-title block font-bold text-xs text-[#111827] truncate">Core Catalog</span>
                        <span class="step-sub block text-[0.65rem] font-semibold text-[#4b5563] truncate">Pricing & SKU</span>
                    </div>
                </button>

                <div class="w-4 h-px bg-[#ebdccb] shrink-0"></div>

                <!-- Tab 2: Craft & Specs -->
                <button type="button" onclick="goToStep(2)" id="stepTab-2" class="step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]">
                    <span class="step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-stone-200 text-stone-700">
                        2
                    </span>
                    <div class="min-w-0">
                        <span class="step-title block font-bold text-xs text-stone-600 truncate">Craft & Specs</span>
                        <span class="step-sub block text-[0.65rem] font-semibold text-stone-500 truncate">Materials & Size</span>
                    </div>
                </button>

                <div class="w-4 h-px bg-[#ebdccb] shrink-0"></div>

                <!-- Tab 3: Bespoke & Delivery -->
                <button type="button" onclick="goToStep(3)" id="stepTab-3" class="step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]">
                    <span class="step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-stone-200 text-stone-700">
                        3
                    </span>
                    <div class="min-w-0">
                        <span class="step-title block font-bold text-xs text-stone-600 truncate">Bespoke & Time</span>
                        <span class="step-sub block text-[0.65rem] font-semibold text-stone-500 truncate">Made-to-Order</span>
                    </div>
                </button>

                <div class="w-4 h-px bg-[#ebdccb] shrink-0"></div>

                <!-- Tab 4: Variations Matrix -->
                <button type="button" onclick="goToStep(4)" id="stepTab-4" class="step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]">
                    <span class="step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-stone-200 text-stone-700">
                        4
                    </span>
                    <div class="min-w-0">
                        <span class="step-title block font-bold text-xs text-stone-600 truncate">Variations</span>
                        <span class="step-sub block text-[0.65rem] font-semibold text-stone-500 truncate">Color & Matrix</span>
                    </div>
                </button>

                <div class="w-4 h-px bg-[#ebdccb] shrink-0"></div>

                <!-- Tab 5: Media & Payments -->
                <button type="button" onclick="goToStep(5)" id="stepTab-5" class="step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]">
                    <span class="step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-stone-200 text-stone-700">
                        5
                    </span>
                    <div class="min-w-0">
                        <span class="step-title block font-bold text-xs text-stone-600 truncate">Media & Pay</span>
                        <span class="step-sub block text-[0.65rem] font-semibold text-stone-500 truncate">Gallery & Rules</span>
                    </div>
                </button>

            </nav>
        </div>

        <!-- 4. Error Notifications -->
        @if ($errors->any())
            <div class="mx-5 sm:mx-6 mt-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                <p class="font-bold text-xs flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Please review and correct the marked errors:</span>
                </p>
                <ul class="list-disc list-inside text-[0.7rem] pl-5 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 5. Wizard Steps Content Body -->
        <div class="p-5 sm:p-7 text-xs">

            <!-- ============================================================== -->
            <!-- STEP 1: Core Catalog & Pricing                                 -->
            <!-- ============================================================== -->
            <div id="wizardStepPane-1" class="wizard-pane space-y-5">
                
                <div class="border-b border-[#f1e6da] pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-serif text-base font-bold text-[#1c1210]">1. Essential Catalog & Pricing</h3>
                        <p class="text-[0.7rem] text-[#8a7267]">Set master naming, catalog categorization, SKU identity, and retail pricing.</p>
                    </div>
                    <span class="text-[0.65rem] font-bold text-[#78000b] bg-[#FAF7F2] px-2.5 py-1 rounded-lg border border-[#ebdccb]">Required Fields (*)</span>
                </div>

                <!-- Row 1: Product Name & SKU -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="prod_name" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                            Product Title <span class="text-[#78000b]">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="prod_name" 
                            value="{{ old('name') }}" 
                            required 
                            placeholder="e.g. Meisterstück Grand Briefcase 42" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="prod_sku" class="block font-bold text-xs uppercase tracking-wider text-[#111827]">
                                Master SKU Code <span class="text-[#4b5563] font-normal text-[0.65rem]">(Optional)</span>
                            </label>
                            <button type="button" onclick="generateRandomSku()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold text-[#78000b] bg-[#78000b]/8 hover:bg-[#78000b]/15 border border-[#78000b]/20 transition cursor-pointer active:scale-95 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                                <span>Auto-Generate</span>
                            </button>
                        </div>
                        <input 
                            type="text" 
                            name="sku" 
                            id="prod_sku" 
                            value="{{ old('sku') }}" 
                            placeholder="e.g. MHJ-BC-8902" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold font-mono outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>
                </div>

                <!-- Row 2: Category & Subcategory -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                            Primary Category <span class="text-[#78000b]">*</span>
                        </label>
                        <select 
                            name="category_id" 
                            id="category_id" 
                            onchange="filterSubcategories(this.value)" 
                            required 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                        >
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="subcategory_id" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                            Subcategory <span class="text-stone-400 font-normal">(Optional)</span>
                        </label>
                        <select 
                            name="subcategory_id" 
                            id="subcategory_id" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                        >
                            <option value="">-- Select Subcategory --</option>
                            @foreach($subcategories as $sub)
                                <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                    {{ $sub->name }} ({{ $sub->category ? $sub->category->name : 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 3: Pricing Matrix (Retail, Sale, Unit Cost) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-xl border border-[#ebdccb] bg-gradient-to-br from-[#FAF8F5] via-white to-[#FAF8F5]">
                    <div>
                        <label for="prod_price" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                            Retail Price (€) <span class="text-[#78000b]">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-stone-500">€</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="price" 
                                id="prod_price" 
                                value="{{ old('price') }}" 
                                required 
                                placeholder="480.00" 
                                class="w-full h-10 pl-8 pr-3.5 rounded-xl border border-[#ebdccb] bg-white text-stone-900 text-xs font-bold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="prod_sale_price" class="block font-bold text-[0.68rem] uppercase tracking-wider text-stone-500 mb-1.5">
                            Luxury Sale Price (€) <span class="text-stone-400 font-normal">(Optional)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-stone-500">€</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="sale_price" 
                                id="prod_sale_price" 
                                value="{{ old('sale_price') }}" 
                                placeholder="395.00" 
                                class="w-full h-10 pl-8 pr-3.5 rounded-xl border border-[#ebdccb] bg-white text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="prod_cost_price" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#8a7267] mb-1.5">
                            Unit Cost Price (€) <span class="text-[0.6rem] text-stone-400 font-normal">(Private ROI)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-stone-500">€</span>
                            <input 
                                type="number" 
                                step="0.01" 
                                name="cost_price" 
                                id="prod_cost_price" 
                                value="{{ old('cost_price') }}" 
                                placeholder="160.00" 
                                class="w-full h-10 pl-8 pr-3.5 rounded-xl border border-[#ebdccb] bg-white text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                        </div>
                    </div>
                </div>

                <!-- Row 4: Stock, Visibility & Featured Badge -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center">
                    <div>
                        <label for="prod_stock" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                            Master Stock Quantity <span class="text-[#78000b]">*</span>
                        </label>
                        <input 
                            type="number" 
                            name="stock" 
                            id="prod_stock" 
                            value="{{ old('stock', 15) }}" 
                            required 
                            min="0" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_status" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Catalog Visibility <span class="text-[#78000b]">*</span>
                        </label>
                        <select 
                            name="status" 
                            id="prod_status" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                        >
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active (Live in Storefront)</option>
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden from Store)</option>
                        </select>
                    </div>

                    <div class="pt-4 sm:pt-6">
                        <label class="flex items-center gap-2.5 p-2 rounded-xl border border-[#ebdccb] bg-[#FAF8F5] hover:bg-white transition cursor-pointer shadow-2xs">
                            <input 
                                type="checkbox" 
                                name="is_featured" 
                                value="1" 
                                {{ old('is_featured') ? 'checked' : '' }} 
                                class="w-4 h-4 rounded text-[#78000b] focus:ring-[#78000b]/20 border-stone-300 accent-[#78000b] cursor-pointer"
                            >
                            <div>
                                <span class="font-bold text-xs text-[#1c1210] block">Featured Atelier Piece</span>
                                <span class="text-[0.62rem] text-stone-500 block">Highlight in home showcase</span>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- ============================================================== -->
            <!-- STEP 2: Atelier Craftsmanship & Physical Specs                 -->
            <!-- ============================================================== -->
            <div id="wizardStepPane-2" class="wizard-pane hidden space-y-5">
                
                <div class="border-b border-[#f1e6da] pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-serif text-base font-bold text-[#111827]">2. Atelier Craftsmanship & Specifications</h3>
                        <p class="text-xs font-semibold text-[#4b5563]">Poetic storytelling, certified leather origin, premium materials, and physical measurements.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-900 bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-300 shadow-2xs">
                        <svg class="w-3.5 h-3.5 text-emerald-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>German Quality Standards</span>
                    </span>
                </div>

                <!-- Poetic Short Tagline -->
                <div>
                    <label for="prod_tagline" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                        Poetic Short Tagline
                    </label>
                    <input 
                        type="text" 
                        name="tagline" 
                        id="prod_tagline" 
                        value="{{ old('tagline') }}" 
                        placeholder="e.g. Sculpted in full-grain Vachetta, designed for timeless executive journeys." 
                        class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                    >
                </div>

                <!-- Storytelling & Description -->
                <div>
                    <label for="prod_description" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                        Storytelling & Atelier Description
                    </label>
                    <textarea 
                        name="description" 
                        id="prod_description" 
                        rows="4" 
                        placeholder="Detailed poetic description of the product silhouette, sensory leather feel, and artisanal legacy..." 
                        class="w-full p-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-normal outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition leading-relaxed shadow-2xs"
                    >{{ old('description') }}</textarea>
                </div>

                <!-- Material Composition (3 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="prod_materials" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Outer Leather & Material
                        </label>
                        <input 
                            type="text" 
                            name="materials" 
                            id="prod_materials" 
                            value="{{ old('materials', '100% Full-Grain Italian Vachetta Leather') }}" 
                            placeholder="e.g. 100% Italian Vachetta Leather" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_lining" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Interior Lining
                        </label>
                        <input 
                            type="text" 
                            name="lining" 
                            id="prod_lining" 
                            value="{{ old('lining', 'Hand-finished Micro-Suede & Organic Cotton') }}" 
                            placeholder="e.g. Micro-Suede / Velvet" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_hardware" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Hardware / Metal Finish
                        </label>
                        <input 
                            type="text" 
                            name="hardware" 
                            id="prod_hardware" 
                            value="{{ old('hardware', 'Solid Brass with 24k Champagne Gold plating') }}" 
                            placeholder="e.g. Brushed Gold / Palladium" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>
                </div>

                <!-- Physical Dimensions & Origin (4 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4 rounded-xl border border-[#ebdccb] bg-[#FAF8F5]">
                    <div>
                        <label for="prod_dimensions" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Dimensions (L × W × H)
                        </label>
                        <input 
                            type="text" 
                            name="dimensions" 
                            id="prod_dimensions" 
                            value="{{ old('dimensions', '40 × 29 × 10 cm') }}" 
                            placeholder="e.g. 40 × 29 × 10 cm" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_weight" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Weight
                        </label>
                        <input 
                            type="text" 
                            name="weight" 
                            id="prod_weight" 
                            value="{{ old('weight', '950 g') }}" 
                            placeholder="e.g. 950 g" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_strap" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Handle / Strap Drop
                        </label>
                        <input 
                            type="text" 
                            name="strap_drop" 
                            id="prod_strap" 
                            value="{{ old('strap_drop', '48 - 58 cm (Adjustable)') }}" 
                            placeholder="e.g. 48 - 58 cm" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label for="prod_origin" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                            Atelier Origin Badge
                        </label>
                        <input 
                            type="text" 
                            name="origin" 
                            id="prod_origin" 
                            value="{{ old('origin', 'Handcrafted in Germany') }}" 
                            placeholder="e.g. Handcrafted in Germany" 
                            class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                        >
                    </div>
                </div>

            </div>

            <!-- ============================================================== -->
            <!-- STEP 3: Bespoke "Made to Order" & Personalization Controls    -->
            <!-- ============================================================== -->
            <div id="wizardStepPane-3" class="wizard-pane hidden space-y-5">
                
                <div class="border-b border-[#f1e6da] pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-serif text-base font-bold text-[#111827]">3. Bespoke Commission & Delivery Controls</h3>
                        <p class="text-xs font-semibold text-[#4b5563]">Fulfillment mode (In-Stock vs Made-to-Order), custom monogramming, and lead times.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-[#d8b45a] bg-[#111827] px-3 py-1 rounded-lg shadow-2xs">
                        <svg class="w-3.5 h-3.5 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <span>Atelier Bespoke System</span>
                    </span>
                </div>

                <!-- 1. Fulfillment Mode: In-Stock vs Made-to-Order -->
                <div class="p-4 sm:p-5 rounded-2xl border border-[#ebdccb] bg-gradient-to-br from-[#FAF8F5] via-white to-[#FAF8F5] space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#78000b]/10 text-[#78000b] flex items-center justify-center shrink-0 border border-[#78000b]/20">
                                <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="6" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><line x1="20" y1="4" x2="8.12" y2="15.88"/><line x1="14.47" y1="14.48" x2="20" y2="20"/><line x1="8.12" y1="8.12" x2="12" y2="12"/></svg>
                            </div>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-[#111827]">Made to Order (Artisanal Commission)</h4>
                                <p class="text-xs font-semibold text-[#4b5563]">Crafted on demand upon client order instead of holding pre-made stock.</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="is_made_to_order" 
                                id="is_made_to_order" 
                                value="1" 
                                onchange="toggleMadeToOrderFields(this.checked)"
                                {{ old('is_made_to_order') ? 'checked' : '' }} 
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-stone-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-stone-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#78000b]"></div>
                        </label>
                    </div>

                    <!-- Lead Time & Delivery Windows (Dynamic) -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2 border-t border-[#f1e6da]">
                        <div id="lead_time_container" class="{{ old('is_made_to_order') ? '' : 'opacity-60 pointer-events-none' }}">
                            <label for="lead_time_days" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                                Handcrafting Lead Time (Days)
                            </label>
                            <input 
                                type="number" 
                                name="lead_time_days" 
                                id="lead_time_days" 
                                value="{{ old('lead_time_days', 6) }}" 
                                min="0" 
                                placeholder="5 to 7 days" 
                                class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                            <p class="text-[0.68rem] font-semibold text-[#4b5563] mt-1">Days required by craftsmen before courier handover.</p>
                        </div>

                        <div>
                            <label for="delivery_days_min" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                                Min Transit Delivery Days
                            </label>
                            <input 
                                type="number" 
                                name="delivery_days_min" 
                                id="delivery_days_min" 
                                value="{{ old('delivery_days_min', 2) }}" 
                                min="1" 
                                class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                            <p class="text-[0.68rem] font-semibold text-[#4b5563] mt-1">e.g. 2 days within Germany / DHL Express.</p>
                        </div>

                        <div>
                            <label for="delivery_days_max" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                                Max Transit Delivery Days
                            </label>
                            <input 
                                type="number" 
                                name="delivery_days_max" 
                                id="delivery_days_max" 
                                value="{{ old('delivery_days_max', 4) }}" 
                                min="1" 
                                class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                            >
                            <p class="text-[0.68rem] font-semibold text-[#4b5563] mt-1">e.g. 4 days across Europe / Standard.</p>
                        </div>
                    </div>
                </div>

                <!-- 2. Personalization & Custom Monogramming -->
                <div class="p-4 sm:p-5 rounded-2xl border border-[#ebdccb] bg-gradient-to-br from-[#FAF8F5] via-white to-[#FAF8F5] space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-[#d8b45a]/20 text-[#78000b] flex items-center justify-center shrink-0 border border-[#d8b45a]/40">
                                <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 7 4 4 20 4 20 7"/><line x1="9" y1="20" x2="15" y2="20"/><line x1="12" y1="4" x2="12" y2="20"/></svg>
                            </div>
                            <div>
                                <h4 class="font-serif font-bold text-sm text-[#111827]">Hot-Stamping & Custom Monogramming</h4>
                                <p class="text-xs font-semibold text-[#4b5563]">Allow clients to customize this piece with their initials or custom name engraving.</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input 
                                type="checkbox" 
                                name="allow_personalization" 
                                id="allow_personalization" 
                                value="1" 
                                onchange="togglePersonalizationFields(this.checked)"
                                {{ old('allow_personalization') ? 'checked' : '' }} 
                                class="sr-only peer"
                            >
                            <div class="w-11 h-6 bg-stone-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-stone-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#78000b]"></div>
                        </label>
                    </div>

                    <!-- Personalization Config Options -->
                    <div id="personalization_config_container" class="{{ old('allow_personalization') ? '' : 'hidden' }} space-y-4 pt-2 border-t border-[#f1e6da]">
                        
                        <div>
                            <label class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-2">
                                Allowed Foil Stamping Types
                            </label>
                            <div class="flex flex-wrap items-center gap-3">
                                <label class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white cursor-pointer hover:border-[#78000b] transition shadow-2xs">
                                    <input type="checkbox" name="personalization_types[]" value="gold_foil" checked class="w-4 h-4 text-[#78000b] rounded border-stone-300 accent-[#78000b]">
                                    <span class="w-3 h-3 rounded-full bg-gradient-to-br from-amber-300 to-amber-600 border border-amber-600 shadow-2xs"></span>
                                    <span class="font-bold text-xs text-amber-950">24k Gold Foil</span>
                                </label>
                                <label class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white cursor-pointer hover:border-[#78000b] transition shadow-2xs">
                                    <input type="checkbox" name="personalization_types[]" value="silver_foil" checked class="w-4 h-4 text-[#78000b] rounded border-stone-300 accent-[#78000b]">
                                    <span class="w-3 h-3 rounded-full bg-gradient-to-br from-stone-200 to-stone-400 border border-stone-500 shadow-2xs"></span>
                                    <span class="font-bold text-xs text-stone-900">Silver Palladium Foil</span>
                                </label>
                                <label class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white cursor-pointer hover:border-[#78000b] transition shadow-2xs">
                                    <input type="checkbox" name="personalization_types[]" value="blind_deboss" checked class="w-4 h-4 text-[#78000b] rounded border-stone-300 accent-[#78000b]">
                                    <span class="w-3 h-3 rounded-full bg-[#78000b] border border-[#4a0207] shadow-2xs"></span>
                                    <span class="font-bold text-xs text-[#78000b]">Blind Deboss (Tone-on-Tone)</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="personalization_max_chars" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                                    Max Characters Limit
                                </label>
                                <input 
                                    type="number" 
                                    name="personalization_max_chars" 
                                    id="personalization_max_chars" 
                                    value="{{ old('personalization_max_chars', 5) }}" 
                                    min="1" 
                                    max="20" 
                                    class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-semibold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                                >
                                <p class="text-[0.68rem] font-semibold text-[#4b5563] mt-1">Recommended: 3 to 5 characters for luxury monogramming.</p>
                            </div>

                            <div>
                                <label for="personalization_fee" class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                                    Personalization Surcharge (€)
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-bold text-[#111827]">€</span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="personalization_fee" 
                                        id="personalization_fee" 
                                        value="{{ old('personalization_fee', '0.00') }}" 
                                        class="w-full h-10 pl-8 pr-3.5 rounded-xl border border-[#ebdccb] bg-white text-[#111827] text-xs font-bold outline-none focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                                    >
                                </div>
                                <p class="text-[0.68rem] font-semibold text-[#4b5563] mt-1">Set 0.00 for complimentary artisanal monogramming.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ============================================================== -->
            <!-- STEP 4: Real-World Variations Matrix                           -->
            <!-- ============================================================== -->
            <div id="wizardStepPane-4" class="wizard-pane hidden space-y-5">
                
                <div class="border-b border-[#f1e6da] pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-serif text-base font-bold text-[#111827]">4. Real-World Variations Matrix</h3>
                        <p class="text-xs font-semibold text-[#4b5563]">Configure color swatches, leather textures, sizes, and per-variant SKU/stock controls.</p>
                    </div>
                    <button type="button" onclick="addNewVariantRow()" class="btn-exec-primary rounded-xl px-3.5 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-xs active:scale-95">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <span>Add Variant</span>
                    </button>
                </div>

                <!-- Hidden JSON string input for full fidelity submit -->
                <input type="hidden" name="variations_json" id="variations_json_input">

                <!-- Quick Preset Swatches Helper -->
                <div class="p-3.5 rounded-xl border border-[#ebdccb] bg-[#FAF8F5] flex flex-wrap items-center justify-between gap-2.5">
                    <span class="text-xs font-bold text-[#111827] uppercase tracking-wider">Atelier Leather Swatch Presets:</span>
                    <div class="flex flex-wrap items-center gap-2">
                        <button type="button" onclick="addPresetVariant('Noir Deep Black', '#141414', 'Smooth Calfskin', 'Standard', 0)" class="px-3 py-1.5 rounded-lg bg-white border border-[#ebdccb] text-xs font-bold text-[#111827] hover:border-[#78000b] transition flex items-center gap-2 cursor-pointer shadow-2xs">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#141414] border border-stone-400"></span>
                            <span>Noir Black</span>
                        </button>
                        <button type="button" onclick="addPresetVariant('Cognac Amber', '#9E471A', 'Vachetta Pull-up', 'Standard', 0)" class="px-3 py-1.5 rounded-lg bg-white border border-[#ebdccb] text-xs font-bold text-[#111827] hover:border-[#78000b] transition flex items-center gap-2 cursor-pointer shadow-2xs">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#9E471A] border border-stone-400"></span>
                            <span>Cognac</span>
                        </button>
                        <button type="button" onclick="addPresetVariant('Chocolat Espresso', '#3A1E14', 'Grained Togo', 'Standard', 0)" class="px-3 py-1.5 rounded-lg bg-white border border-[#ebdccb] text-xs font-bold text-[#111827] hover:border-[#78000b] transition flex items-center gap-2 cursor-pointer shadow-2xs">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#3A1E14] border border-stone-400"></span>
                            <span>Chocolat</span>
                        </button>
                        <button type="button" onclick="addPresetVariant('Burgundy Saltora', '#78000B', 'Fine Saffiano', 'Large 42', 30)" class="px-3 py-1.5 rounded-lg bg-white border border-[#ebdccb] text-xs font-bold text-[#111827] hover:border-[#78000b] transition flex items-center gap-2 cursor-pointer shadow-2xs">
                            <span class="w-3.5 h-3.5 rounded-full bg-[#78000B] border border-stone-400"></span>
                            <span>Burgundy</span>
                        </button>
                    </div>
                </div>

                <!-- Variations Dynamic Matrix Table -->
                <div class="rounded-xl border border-[#ebdccb] overflow-hidden shadow-2xs">
                    <table class="w-full text-left text-xs" id="variantsMatrixTable">
                        <thead>
                            <tr class="bg-gradient-to-r from-[#fbf8f4] via-[#f7eee3] to-[#fbf8f4] text-[#111827] font-black uppercase tracking-wider text-xs border-b border-[#ebdccb]">
                                <th class="py-3 px-3 w-12 text-center">Swatch</th>
                                <th class="py-3 px-3">Variant / Color Name</th>
                                <th class="py-3 px-3">Texture / Leather</th>
                                <th class="py-3 px-3 w-32">Size / Model</th>
                                <th class="py-3 px-3 w-36">Variant SKU</th>
                                <th class="py-3 px-3 w-28 text-right">Price Adj (€)</th>
                                <th class="py-3 px-3 w-24 text-center">Stock</th>
                                <th class="py-3 px-3 w-16 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="variantsTableBody" class="divide-y divide-[#f1e6da] bg-white text-[#111827]">
                            <!-- Populated via JavaScript dynamically -->
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- ============================================================== -->
            <!-- STEP 5: Media Gallery & Payment Method Rules                  -->
            <!-- ============================================================== -->
            <div id="wizardStepPane-5" class="wizard-pane hidden space-y-6">
                
                <div class="border-b border-[#f1e6da] pb-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-serif text-base font-bold text-[#111827]">5. Media Showcase & Payment Rules</h3>
                        <p class="text-xs font-semibold text-[#4b5563]">Showcase imagery and selective payment gateway eligibility per item.</p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-[#78000b] bg-[#FAF7F2] px-3 py-1 rounded-lg border border-[#ebdccb] shadow-2xs">
                        <svg class="w-3.5 h-3.5 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <span>Final Launch Step</span>
                    </span>
                </div>

                <!-- 1. Main Cover Image Upload -->
                <div>
                    <label class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                        Primary Atelier Cover Image <span class="text-[#78000b]">*</span>
                    </label>
                    <div class="rounded-xl border border-[#ebdccb] p-4 shadow-2xs" style="background: linear-gradient(135deg, #fdfbf7 0%, #f6ede0 100%);">
                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <div id="main_cover_preview_box" class="w-20 h-20 rounded-xl bg-white border border-[#ebdccb] flex items-center justify-center text-[#78000b] shrink-0 overflow-hidden shadow-xs">
                                <img id="main_cover_preview_img" src="" class="hidden w-full h-full object-cover">
                                <svg id="main_cover_placeholder_svg" class="w-8 h-8 text-[#78000b]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="flex-1 text-center sm:text-left space-y-1">
                                <input type="file" name="image" id="prod_main_image" accept="image/*" onchange="previewMainImage(this)" class="hidden">
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5">
                                    <button type="button" onclick="document.getElementById('prod_main_image').click()" class="h-9 px-4 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-xs cursor-pointer active:scale-95 bg-[#111827] text-white hover:bg-black">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        <span>Select Primary Cover</span>
                                    </button>
                                    <span id="main_cover_filename" class="text-xs font-bold text-[#111827]">PNG, JPG, WEBP up to 30MB</span>
                                </div>
                                <p class="text-[0.68rem] font-semibold text-[#4b5563]">Recommended ratio: 1:1 Square (1200×1200px) on pure off-white background.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Multi-Angle High-Res Gallery -->
                <div>
                    <label class="block font-bold text-xs uppercase tracking-wider text-[#111827] mb-1.5">
                        High-Res Detail Gallery Slides <span class="text-[#4b5563] font-normal text-[0.68rem]">(Multi-Select)</span>
                    </label>
                    <div class="rounded-xl border border-dashed border-[#ebdccb] p-5 text-center bg-[#FAF8F5] hover:bg-white transition cursor-pointer" onclick="document.getElementById('prod_gallery_input').click()">
                        <input type="file" name="gallery[]" id="prod_gallery_input" accept="image/*" multiple onchange="previewGalleryImages(this)" class="hidden">
                        <div class="space-y-2">
                            <div class="w-10 h-10 rounded-full bg-white border border-[#ebdccb] mx-auto flex items-center justify-center text-[#78000b] shadow-2xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <div>
                                <span class="font-bold text-xs text-[#111827]">Click to choose multi-angle gallery photos</span>
                                <p class="text-[0.68rem] font-semibold text-[#4b5563]">Exterior profile, interior lining, hardware macro, scale on model</p>
                            </div>
                        </div>
                    </div>
                    <div id="gallery_preview_container" class="flex flex-wrap gap-2.5 mt-3"></div>
                </div>

                <!-- 3. Product-Level Payment Gateway Eligibility -->
                <div class="p-4 sm:p-5 rounded-2xl border border-[#ebdccb] bg-gradient-to-br from-[#FAF8F5] via-white to-[#FAF8F5] space-y-3.5">
                    <div>
                        <h4 class="font-serif font-bold text-sm text-[#111827]">Product-Level Payment Gateway Control</h4>
                        <p class="text-xs font-semibold text-[#4b5563]">Configure allowed payment options. Uncheck Cash on Delivery (COD) for high-ticket or personalized bespoke pieces.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 pt-2">
                        <!-- COD Option -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#ebdccb] bg-white hover:border-[#78000b] transition cursor-pointer shadow-2xs group">
                            <input type="checkbox" name="payment_methods[]" value="cod" checked class="w-4 h-4 rounded text-[#78000b] focus:ring-[#78000b]/20 border-stone-300 accent-[#78000b] cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#78000b]/8 text-[#78000b] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2"/><path d="M6 12h.01M18 12h.01"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-xs text-[#111827] block">Cash on Delivery</span>
                                    <span class="text-[0.65rem] font-semibold text-[#4b5563] block">Pay cash at doorstep</span>
                                </div>
                            </div>
                        </label>

                        <!-- Stripe / Cards -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#ebdccb] bg-white hover:border-[#78000b] transition cursor-pointer shadow-2xs group">
                            <input type="checkbox" name="payment_methods[]" value="stripe" checked class="w-4 h-4 rounded text-[#78000b] focus:ring-[#78000b]/20 border-stone-300 accent-[#78000b] cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#78000b]/8 text-[#78000b] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-xs text-[#111827] block">Credit / Debit Card</span>
                                    <span class="text-[0.65rem] font-semibold text-[#4b5563] block">Visa, Mastercard, Amex</span>
                                </div>
                            </div>
                        </label>

                        <!-- Klarna -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#ebdccb] bg-white hover:border-[#78000b] transition cursor-pointer shadow-2xs group">
                            <input type="checkbox" name="payment_methods[]" value="klarna" checked class="w-4 h-4 rounded text-[#78000b] focus:ring-[#78000b]/20 border-stone-300 accent-[#78000b] cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#78000b]/8 text-[#78000b] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-xs text-[#111827] block">Klarna Pay Later</span>
                                    <span class="text-[0.65rem] font-semibold text-[#4b5563] block">Slice in 30 days</span>
                                </div>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-[#ebdccb] bg-white hover:border-[#78000b] transition cursor-pointer shadow-2xs group">
                            <input type="checkbox" name="payment_methods[]" value="bank_transfer" checked class="w-4 h-4 rounded text-[#78000b] focus:ring-[#78000b]/20 border-stone-300 accent-[#78000b] cursor-pointer">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-[#78000b]/8 text-[#78000b] flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-[#78000b]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="21" x2="21" y2="21"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="5 6 12 3 19 6"/><line x1="4" y1="10" x2="4" y2="21"/><line x1="20" y1="10" x2="20" y2="21"/><line x1="8" y1="14" x2="8" y2="17"/><line x1="12" y1="14" x2="12" y2="17"/><line x1="16" y1="14" x2="16" y2="17"/></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-xs text-[#111827] block">SEPA Bank Transfer</span>
                                    <span class="text-[0.65rem] font-semibold text-[#4b5563] block">Advance wire payment</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

        </div>

        <!-- 6. Sticky Bottom Action Controls Bar -->
        <div class="px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-t border-[#ebdccb] flex items-center justify-between">
            <button 
                type="button" 
                id="wizardPrevBtn" 
                onclick="wizardStepPrev()" 
                class="btn-exec-secondary rounded-xl px-5 py-2.5 text-xs font-bold transition flex items-center gap-2 cursor-pointer shadow-2xs disabled:opacity-40 disabled:cursor-not-allowed"
                disabled
            >
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span>Previous Step</span>
            </button>

            <!-- Stepper Progress Dots -->
            <div class="hidden sm:flex items-center gap-1.5">
                <span class="w-2.5 h-2.5 rounded-full bg-[#78000b]" id="stepDot-1"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-stone-300" id="stepDot-2"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-stone-300" id="stepDot-3"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-stone-300" id="stepDot-4"></span>
                <span class="w-2.5 h-2.5 rounded-full bg-stone-300" id="stepDot-5"></span>
            </div>

            <div class="flex items-center gap-2.5">
                <button 
                    type="button" 
                    onclick="saveAsDraft()" 
                    class="rounded-xl px-4 py-2.5 text-xs font-bold text-stone-700 hover:text-stone-900 bg-white border border-[#ebdccb] hover:bg-stone-50 transition shadow-2xs cursor-pointer"
                >
                    Save as Draft
                </button>

                <button 
                    type="button" 
                    id="wizardNextBtn" 
                    onclick="wizardStepNext()" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs font-bold transition flex items-center gap-2 cursor-pointer shadow-md active:scale-95"
                >
                    <span>Next Step →</span>
                </button>

                <button 
                    type="submit" 
                    id="wizardSubmitBtn" 
                    class="btn-exec-primary rounded-xl px-7 py-2.5 text-xs font-bold transition hidden items-center gap-2 cursor-pointer shadow-md active:scale-95"
                >
                    <svg class="h-4 w-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span>Publish Atelier Product</span>
                </button>
            </div>
        </div>

    </form>

</div>

<script>
    let currentStep = 1;
    const totalSteps = 5;

    // In-memory variations list
    let variationsList = [
        {
            name: 'Noir Deep Black',
            color: '#141414',
            color_name: 'Noir Deep Black',
            material: 'Smooth Calfskin',
            size: 'Standard',
            sku: '',
            price: 0,
            stock: 10,
            active: true
        }
    ];

    function renderVariationsTable() {
        const tbody = document.getElementById('variantsTableBody');
        if (!tbody) return;

        if (variationsList.length === 0) {
            tbody.innerHTML = `<tr><td colspan="8" class="py-6 text-center text-stone-400 italic text-xs">No variations added yet. Click "+ Add Variant" or choose a preset above.</td></tr>`;
            document.getElementById('variations_json_input').value = '[]';
            return;
        }

        tbody.innerHTML = variationsList.map((v, idx) => `
            <tr class="hover:bg-[#FAF8F5] transition">
                <td class="py-2.5 px-3 text-center">
                    <input type="color" value="${v.color}" onchange="updateVariantField(${idx}, 'color', this.value)" class="w-6 h-6 rounded-md border border-[#ebdccb] cursor-pointer p-0">
                </td>
                <td class="py-2.5 px-3">
                    <input type="text" value="${v.name}" onchange="updateVariantField(${idx}, 'name', this.value)" placeholder="Variant name" class="w-full h-8 px-2.5 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs font-semibold">
                </td>
                <td class="py-2.5 px-3">
                    <input type="text" value="${v.material || ''}" onchange="updateVariantField(${idx}, 'material', this.value)" placeholder="Leather texture" class="w-full h-8 px-2.5 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs">
                </td>
                <td class="py-2.5 px-3">
                    <input type="text" value="${v.size || ''}" onchange="updateVariantField(${idx}, 'size', this.value)" placeholder="Size / Model" class="w-full h-8 px-2.5 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs">
                </td>
                <td class="py-2.5 px-3">
                    <input type="text" value="${v.sku || ''}" onchange="updateVariantField(${idx}, 'sku', this.value)" placeholder="Optional SKU" class="w-full h-8 px-2.5 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs font-mono">
                </td>
                <td class="py-2.5 px-3 text-right">
                    <input type="number" step="0.01" value="${v.price || 0}" onchange="updateVariantField(${idx}, 'price', parseFloat(this.value) || 0)" placeholder="+/- €" class="w-20 h-8 px-2 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs font-bold text-right">
                </td>
                <td class="py-2.5 px-3 text-center">
                    <input type="number" value="${v.stock !== null ? v.stock : 10}" onchange="updateVariantField(${idx}, 'stock', parseInt(this.value) || 0)" class="w-16 h-8 px-1.5 rounded-lg border border-[#ebdccb] bg-[#fdfbf9] text-xs font-bold text-center">
                </td>
                <td class="py-2.5 px-3 text-center">
                    <button type="button" onclick="removeVariantRow(${idx})" class="w-7 h-7 rounded-lg text-rose-600 hover:bg-rose-50 hover:text-rose-800 transition flex items-center justify-center mx-auto cursor-pointer" title="Remove Variant">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    </button>
                </td>
            </tr>
        `).join('');

        document.getElementById('variations_json_input').value = JSON.stringify(variationsList);
    }

    function updateVariantField(idx, field, value) {
        if (variationsList[idx]) {
            variationsList[idx][field] = value;
            document.getElementById('variations_json_input').value = JSON.stringify(variationsList);
        }
    }

    function addNewVariantRow() {
        const baseSku = document.getElementById('prod_sku')?.value || 'MHJ';
        variationsList.push({
            name: 'New Swatch Variant',
            color: '#78000b',
            color_name: 'Custom Atelier Color',
            material: 'Full-Grain Vachetta',
            size: 'Standard',
            sku: baseSku ? `${baseSku}-V${variationsList.length + 1}` : '',
            price: 0,
            stock: 10,
            active: true
        });
        renderVariationsTable();
    }

    function addPresetVariant(name, color, material, size, price) {
        const baseSku = document.getElementById('prod_sku')?.value || 'MHJ';
        variationsList.push({
            name: name,
            color: color,
            color_name: name,
            material: material,
            size: size,
            sku: baseSku ? `${baseSku}-${name.substring(0, 3).toUpperCase()}` : '',
            price: price,
            stock: 10,
            active: true
        });
        renderVariationsTable();
    }

    function removeVariantRow(idx) {
        variationsList.splice(idx, 1);
        renderVariationsTable();
    }

    // Wizard Navigation
    function goToStep(step) {
        if (step < 1 || step > totalSteps) return;

        // Basic validation before advancing from Step 1
        if (step > 1 && currentStep === 1) {
            const nameEl = document.getElementById('prod_name');
            const priceEl = document.getElementById('prod_price');
            const catEl = document.getElementById('category_id');
            if (!nameEl.value.trim() || !priceEl.value || !catEl.value) {
                alert('Please complete the required Step 1 fields (Product Title, Category, and Retail Price).');
                return;
            }
        }

        currentStep = step;

        // Update step panels visibility
        for (let i = 1; i <= totalSteps; i++) {
            const pane = document.getElementById('wizardStepPane-' + i);
            const tab = document.getElementById('stepTab-' + i);
            const dot = document.getElementById('stepDot-' + i);

            if (pane) pane.classList.toggle('hidden', i !== currentStep);
            
            if (dot) {
                dot.className = i <= currentStep ? 'w-2.5 h-2.5 rounded-full bg-[#78000b]' : 'w-2.5 h-2.5 rounded-full bg-stone-300';
            }

            if (tab) {
                const num = tab.querySelector('.step-num');
                const title = tab.querySelector('.step-title');
                const sub = tab.querySelector('.step-sub');
                if (i === currentStep) {
                    tab.className = 'step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group bg-white border border-[#ebdccb] shadow-2xs';
                    if (num) {
                        num.className = 'step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-[#78000b] text-[#d8b45a] shadow-xs';
                        num.textContent = i;
                    }
                    if (title) title.className = 'step-title block font-bold text-xs text-[#111827] truncate';
                    if (sub) sub.className = 'step-sub block text-[0.65rem] font-semibold text-[#4b5563] truncate';
                } else if (i < currentStep) {
                    tab.className = 'step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]';
                    if (num) {
                        num.className = 'step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-emerald-600 text-white shadow-2xs';
                        num.innerHTML = '<svg class="w-3.5 h-3.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                    }
                    if (title) title.className = 'step-title block font-bold text-xs text-[#111827] truncate';
                    if (sub) sub.className = 'step-sub block text-[0.65rem] font-semibold text-emerald-700 truncate';
                } else {
                    tab.className = 'step-tab flex-1 flex items-center gap-2.5 p-2 rounded-xl transition text-left cursor-pointer group hover:bg-white border border-transparent hover:border-[#ebdccb]';
                    if (num) {
                        num.className = 'step-num w-7 h-7 rounded-lg flex items-center justify-center font-bold text-xs shrink-0 bg-stone-200 text-stone-700';
                        num.textContent = i;
                    }
                    if (title) title.className = 'step-title block font-bold text-xs text-stone-600 truncate';
                    if (sub) sub.className = 'step-sub block text-[0.65rem] font-semibold text-stone-500 truncate';
                }
            }
        }

        // Update Bottom Bar controls
        const prevBtn = document.getElementById('wizardPrevBtn');
        const nextBtn = document.getElementById('wizardNextBtn');
        const submitBtn = document.getElementById('wizardSubmitBtn');
        const badge = document.getElementById('wizardStepIndicatorBadge');

        if (prevBtn) prevBtn.disabled = currentStep === 1;
        if (badge) badge.textContent = `Step ${currentStep} of ${totalSteps}`;

        if (currentStep === totalSteps) {
            if (nextBtn) nextBtn.classList.add('hidden');
            if (submitBtn) { submitBtn.classList.remove('hidden'); submitBtn.classList.add('inline-flex'); }
        } else {
            if (nextBtn) nextBtn.classList.remove('hidden');
            if (submitBtn) { submitBtn.classList.add('hidden'); submitBtn.classList.remove('inline-flex'); }
        }

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function wizardStepPrev() {
        if (currentStep > 1) goToStep(currentStep - 1);
    }

    function wizardStepNext() {
        if (currentStep < totalSteps) goToStep(currentStep + 1);
    }

    function saveAsDraft() {
        const statusSelect = document.getElementById('prod_status');
        if (statusSelect) statusSelect.value = 'draft';
        document.getElementById('productWizardForm').submit();
    }

    function generateRandomSku() {
        const rand = Math.floor(1000 + Math.random() * 9000);
        const nameVal = document.getElementById('prod_name')?.value || 'AT';
        const prefix = nameVal.trim().substring(0, 3).toUpperCase().replace(/[^A-Z]/g, 'MHJ') || 'MHJ';
        document.getElementById('prod_sku').value = `MHJ-${prefix}-${rand}`;
    }

    function filterSubcategories(catId) {
        const subSelect = document.getElementById('subcategory_id');
        if (!subSelect) return;
        const options = subSelect.querySelectorAll('option');
        options.forEach(opt => {
            if (!opt.value) return; // Keep "Select Subcategory"
            if (!catId || opt.getAttribute('data-category') == catId) {
                opt.style.display = '';
            } else {
                opt.style.display = 'none';
            }
        });
        subSelect.value = '';
    }

    function toggleMadeToOrderFields(isChecked) {
        const container = document.getElementById('lead_time_container');
        if (container) {
            container.classList.toggle('opacity-60', !isChecked);
            container.classList.toggle('pointer-events-none', !isChecked);
        }
    }

    function togglePersonalizationFields(isChecked) {
        const container = document.getElementById('personalization_config_container');
        if (container) {
            container.classList.toggle('hidden', !isChecked);
        }
    }

    // Media Preview Handlers
    function previewMainImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('main_cover_preview_img');
                const svg = document.getElementById('main_cover_placeholder_svg');
                const fn = document.getElementById('main_cover_filename');
                if (img) { img.src = e.target.result; img.classList.remove('hidden'); }
                if (svg) { svg.classList.add('hidden'); }
                if (fn) {
                    fn.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                    fn.className = 'text-xs text-emerald-700 font-bold';
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function previewGalleryImages(input) {
        const container = document.getElementById('gallery_preview_container');
        if (!container) return;
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const card = document.createElement('div');
                    card.className = 'w-16 h-16 rounded-xl overflow-hidden border border-[#ebdccb] bg-white shadow-2xs relative group';
                    card.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    container.appendChild(card);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        renderVariationsTable();
        const initialCat = document.getElementById('category_id')?.value;
        if (initialCat) filterSubcategories(initialCat);
    });
</script>
@endsection

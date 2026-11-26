@extends('layouts.admin')
@section('title', 'Create Deal & Bundle - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-12">

    <!-- Breadcrumb & Back Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs font-semibold text-stone-500">
            <a href="{{ route('admin.deals') }}" class="text-[#78000b] hover:underline cursor-pointer">Deals & Bundles</a>
            <span>›</span>
            <span class="text-[#1c1210] font-bold">New Product Bundle</span>
        </div>
        <a href="{{ route('admin.deals') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Back to Bundles</span>
        </a>
    </div>

    <!-- Header Banner -->
    <div class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-xs relative overflow-hidden border-t-4 border-t-[#78000b]">
        <div class="px-5 sm:px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-b border-[#ebdccb] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </div>
                <div>
                    <h1 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight">
                        Create Curated Product Bundle
                    </h1>
                    <p class="text-xs text-stone-500 font-medium">
                        Pair 2 or more luxury pieces and establish exclusive package pricing with optional countdown urgency.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs shadow-2xs">
            <p class="font-bold mb-1">Please address the following requirements:</p>
            <ul class="list-disc list-inside space-y-0.5 font-medium">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.deals.store') }}" method="POST" id="dealForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            <!-- LEFT COLUMN: Bundle Information, Pricing & Product Selection (8 Cols) -->
            <div class="lg:col-span-8 space-y-4">
                
                <!-- Card 1: Core Bundle Info -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-[#ebdccb] shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-[#f1e6da] pb-3">
                        <h2 class="font-serif text-sm font-bold text-[#1c1210] flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-[#78000b] text-[#d8b45a] flex items-center justify-center text-xs font-mono">1</span>
                            <span>Bundle Titles & Presentation</span>
                        </h2>
                        <span class="text-[0.65rem] font-bold text-[#78000b] uppercase tracking-wider bg-[#78000b]/10 px-2 py-0.5 rounded-md">Bilingual Catalog</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Bundle Title (German) *</label>
                            <input
                                type="text"
                                name="title_de"
                                id="title_de"
                                value="{{ old('title_de') }}"
                                required
                                placeholder="e.g. Meisterhaftes Duo: Aktentasche & Geldbörse"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                                oninput="autoGenerateSlug()"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Bundle Title (English) *</label>
                            <input
                                type="text"
                                name="title_en"
                                id="title_en"
                                value="{{ old('title_en') }}"
                                required
                                placeholder="e.g. Master Atelier Duo: Briefcase & Bifold Wallet"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-[#ebdccb] bg-white text-xs font-semibold text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                                oninput="autoGenerateSlug()"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Storefront URL Slug (Auto-generated)</label>
                            <input
                                type="text"
                                name="slug"
                                id="slug"
                                value="{{ old('slug') }}"
                                placeholder="meisterhaftes-duo-aktentasche-geldboerse"
                                class="w-full px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-[#FAF8F5] text-xs font-mono text-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Promotional Badge Text</label>
                            <input
                                type="text"
                                name="badge_text"
                                value="{{ old('badge_text', 'BUNDLE & SAVE 20%') }}"
                                placeholder="e.g. ATELIER DUO, SPECIAL COMMISSION"
                                class="w-full px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white text-xs uppercase font-extrabold text-[#78000b] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Description (German)</label>
                            <textarea
                                name="description_de"
                                rows="2"
                                placeholder="Kuratierte Kombination aus feinstem pflanzlich gegerbtem Leder..."
                                class="w-full px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white text-xs text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                            >{{ old('description_de') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Description (English)</label>
                            <textarea
                                name="description_en"
                                rows="2"
                                placeholder="Curated atelier pairing crafted from full-grain vegetable-tanned leather..."
                                class="w-full px-3.5 py-2 rounded-xl border border-[#ebdccb] bg-white text-xs text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                            >{{ old('description_en') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Discount Rules & Flash Timer -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-[#ebdccb] shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-[#f1e6da] pb-3">
                        <h2 class="font-serif text-sm font-bold text-[#1c1210] flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full bg-[#78000b] text-[#d8b45a] flex items-center justify-center text-xs font-mono">2</span>
                            <span>Package Discount & Urgency Countdown</span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-gradient-to-r from-[#FAF8F5] via-white to-[#FAF8F5] p-4 rounded-xl border border-[#ebdccb]">
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1">Discount Calculation Model *</label>
                            <select
                                name="discount_type"
                                id="discount_type"
                                onchange="recalculatePreview()"
                                class="filter-select w-full px-3 py-2.5 rounded-xl border border-[#ebdccb] bg-white text-xs font-bold text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none cursor-pointer transition shadow-2xs"
                            >
                                <option value="percentage_discount" {{ old('discount_type') === 'percentage_discount' ? 'selected' : '' }}>Percentage Discount on Sum (%)</option>
                                <option value="fixed_discount" {{ old('discount_type') === 'fixed_discount' ? 'selected' : '' }}>Fixed Euro Deduction (€)</option>
                                <option value="bundle_fixed_price" {{ old('discount_type') === 'bundle_fixed_price' ? 'selected' : '' }}>Fixed Package Retail Price (€)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#1c1210] mb-1" id="discount_value_label">Discount Value (%) *</label>
                            <div class="relative">
                                <input
                                    type="number"
                                    name="discount_value"
                                    id="discount_value"
                                    step="0.01"
                                    min="0.01"
                                    value="{{ old('discount_value', 20) }}"
                                    required
                                    oninput="recalculatePreview()"
                                    class="w-full pl-3.5 pr-8 py-2.5 rounded-xl border border-[#ebdccb] bg-white text-xs font-extrabold text-[#1c1210] focus:border-[#78000b] focus:ring-2 focus:ring-[#78000b]/15 outline-none transition shadow-2xs"
                                >
                                <span id="discount_value_suffix" class="absolute right-3.5 top-2.5 text-xs font-bold text-[#8a7267]">%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Flash Sale Timer Settings -->
                    <div class="border-t border-[#f1e6da] pt-3">
                        <div class="flex items-center gap-2 mb-3">
                            <input
                                type="checkbox"
                                id="enable_timer"
                                onchange="toggleTimerFields(this)"
                                class="h-4 w-4 rounded text-[#78000b] border-[#ebdccb] focus:ring-[#78000b] cursor-pointer"
                            >
                            <label for="enable_timer" class="text-xs font-bold text-[#1c1210] cursor-pointer flex items-center gap-2">
                                <span>Enable Flash Sale Countdown Timer</span>
                                <span class="text-[0.62rem] text-amber-800 bg-amber-50 border border-amber-300 px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">Urgency</span>
                            </label>
                        </div>

                        <div id="timer_fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4 p-3.5 rounded-xl bg-amber-50/50 border border-amber-200">
                            <div>
                                <label class="block text-xs font-bold text-amber-900 mb-1">Starts At (Optional)</label>
                                <input
                                    type="datetime-local"
                                    name="starts_at"
                                    value="{{ old('starts_at') }}"
                                    class="w-full px-3 py-2 rounded-xl border border-[#ebdccb] bg-white text-xs text-[#1c1210] focus:border-[#78000b] outline-none"
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-amber-900 mb-1">Ends At (Countdown Deadline) *</label>
                                <input
                                    type="datetime-local"
                                    name="ends_at"
                                    id="ends_at"
                                    value="{{ old('ends_at') }}"
                                    class="w-full px-3 py-2 rounded-xl border border-[#ebdccb] bg-white text-xs text-[#1c1210] focus:border-[#78000b] outline-none"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Product Selection Grid -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-[#ebdccb] shadow-xs space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-[#f1e6da] pb-3">
                        <div>
                            <h2 class="font-serif text-sm font-bold text-[#1c1210] flex items-center gap-2">
                                <span class="w-5 h-5 rounded-full bg-[#78000b] text-[#d8b45a] flex items-center justify-center text-xs font-mono">3</span>
                                <span>Select Products for Bundle (Minimum 2) *</span>
                            </h2>
                            <p class="text-[0.68rem] text-stone-500 font-medium">Click on items to add or remove them from this package pairing.</p>
                        </div>
                        <div class="relative w-full sm:w-64">
                            <input
                                type="text"
                                id="productSearchFilter"
                                oninput="filterProductCards(this.value)"
                                placeholder="Filter products by name..."
                                class="w-full pl-8 pr-3 py-2 rounded-xl border border-[#ebdccb] bg-[#FAF8F5] text-xs font-medium text-[#1c1210] focus:border-[#78000b] outline-none shadow-2xs"
                            >
                            <svg class="w-3.5 h-3.5 text-stone-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[460px] overflow-y-auto pr-1 modal-scroll-clean" id="productsSelectionContainer">
                        @foreach($products as $product)
                            @php
                                $effective = ($product->sale_price && $product->sale_price < $product->price) ? (float)$product->sale_price : (float)$product->price;
                            @endphp
                            <label
                                class="product-select-card relative flex items-center gap-3 p-3 rounded-2xl border border-[#ebdccb] bg-white hover:border-[#78000b] transition-all cursor-pointer select-none group shadow-2xs"
                                data-product-name="{{ strtolower($product->name) }}"
                                data-product-price="{{ $effective }}"
                                data-product-id="{{ $product->id }}"
                                data-product-img="{{ $product->image_url }}"
                            >
                                <input
                                    type="checkbox"
                                    name="products[]"
                                    value="{{ $product->id }}"
                                    class="product-checkbox h-4 w-4 rounded text-[#78000b] border-[#ebdccb] focus:ring-[#78000b] cursor-pointer"
                                    onchange="handleProductCheck(this)"
                                >
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-[#FAF7F2] border border-[#ebdccb] shrink-0 flex items-center justify-center">
                                    <img
                                        src="{{ $product->image_url }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-bold text-[#1c1210] truncate group-hover:text-[#78000b] transition">{{ $product->name }}</h3>
                                    <p class="text-[0.62rem] text-stone-400 font-mono">SKU: {{ $product->sku ?? 'MHJ-' . $product->id }}</p>
                                    <span class="text-xs font-extrabold text-[#78000b] block mt-0.5">
                                        €{{ number_format($effective, 2) }}
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Sticky Real-Time Live Calculation & Preview (4 Cols) -->
            <div class="lg:col-span-4 sticky top-24 space-y-4">
                
                <div class="exec-card bg-white p-5 rounded-2xl border border-[#ebdccb] shadow-md space-y-4 border-t-4 border-t-[#78000b]">
                    <div class="flex items-center justify-between border-b border-[#f1e6da] pb-3">
                        <h3 class="font-serif text-sm font-bold text-[#1c1210] flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Live Bundle Summary</span>
                        </h3>
                        <span id="preview_item_count_badge" class="px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-[#FAF7F2] text-[#78000b] border border-[#ebdccb]">
                            0 items selected
                        </span>
                    </div>

                    <!-- Selected Products Micro List -->
                    <div id="preview_selected_list" class="space-y-2 min-h-[90px] border border-dashed border-[#ebdccb] rounded-2xl p-2.5 bg-[#FAF8F5]">
                        <p class="text-[0.68rem] text-stone-500 text-center py-6 italic">
                            Select products on the left to see instant bundle price calculations.
                        </p>
                    </div>

                    <!-- Live Calculation Breakdown -->
                    <div class="space-y-2 text-xs border-t border-[#f1e6da] pt-3">
                        <div class="flex justify-between items-center text-stone-600">
                            <span class="font-medium">Regular Total Price:</span>
                            <span id="preview_reg_total" class="font-bold text-[#1c1210]">€0.00</span>
                        </div>
                        <div class="flex justify-between items-center text-emerald-800 font-bold" id="preview_discount_row">
                            <span id="preview_discount_label">Package Savings:</span>
                            <span id="preview_savings_val">- €0.00</span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2 border-t border-[#ebdccb]">
                            <span class="text-xs font-bold text-[#1c1210]">Customer Package Price:</span>
                            <span id="preview_bundle_price" class="font-extrabold text-xl text-[#78000b]">€0.00</span>
                        </div>
                    </div>

                    <!-- Publish Settings & Submit Button -->
                    <div class="border-t border-[#f1e6da] pt-3 space-y-3">
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                checked
                                class="h-4 w-4 rounded text-[#78000b] border-[#ebdccb] focus:ring-[#78000b] cursor-pointer"
                            >
                            <label for="is_active" class="text-xs font-bold text-[#1c1210] cursor-pointer">Activate bundle immediately in store</label>
                        </div>

                        <button
                            type="submit"
                            id="submitBundleBtn"
                            class="w-full btn-exec-primary rounded-xl py-3 text-xs font-bold flex items-center justify-center gap-2 cursor-pointer shadow-md active:scale-95 transition"
                        >
                            <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Publish Curated Bundle</span>
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </form>

</div>

<script>
    let selectedProductsMap = new Map();

    function autoGenerateSlug() {
        const titleInput = document.getElementById('title_en').value || document.getElementById('title_de').value;
        const slugInput = document.getElementById('slug');
        if (!slugInput.dataset.manual) {
            slugInput.value = titleInput.toLowerCase()
                .trim()
                .replace(/ä/g, 'ae').replace(/ö/g, 'oe').replace(/ü/g, 'ue').replace(/ß/g, 'ss')
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    }

    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.manual = "true";
    });

    function toggleTimerFields(checkbox) {
        const fields = document.getElementById('timer_fields');
        if (checkbox.checked) {
            fields.classList.remove('hidden');
        } else {
            fields.classList.add('hidden');
            document.getElementById('ends_at').value = '';
        }
    }

    function filterProductCards(query) {
        query = query.toLowerCase().trim();
        document.querySelectorAll('.product-select-card').forEach(card => {
            const name = card.dataset.productName;
            if (name.includes(query)) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }

    function handleProductCheck(checkbox) {
        const card = checkbox.closest('.product-select-card');
        const id = card.dataset.productId;
        const price = parseFloat(card.dataset.productPrice);
        const name = card.querySelector('h3').innerText;
        const img = card.dataset.productImg;

        if (checkbox.checked) {
            card.classList.add('border-[#78000b]', 'bg-[#FAF8F5]');
            selectedProductsMap.set(id, { id, name, price, img });
        } else {
            card.classList.remove('border-[#78000b]', 'bg-[#FAF8F5]');
            selectedProductsMap.delete(id);
        }

        recalculatePreview();
    }

    function recalculatePreview() {
        const count = selectedProductsMap.size;
        document.getElementById('preview_item_count_badge').innerText = `${count} items selected`;

        const listContainer = document.getElementById('preview_selected_list');

        if (count === 0) {
            listContainer.innerHTML = '<p class="text-[0.68rem] text-stone-500 text-center py-6 italic">Select products on the left to see instant bundle price calculations.</p>';
            document.getElementById('preview_reg_total').innerText = '€0.00';
            document.getElementById('preview_savings_val').innerText = '- €0.00';
            document.getElementById('preview_bundle_price').innerText = '€0.00';
            return;
        }

        let listHtml = '';
        let regularTotal = 0;

        selectedProductsMap.forEach(item => {
            regularTotal += item.price;
            listHtml += `
                <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white border border-[#ebdccb] text-xs shadow-2xs">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <img src="${item.img}" class="w-8 h-8 rounded-lg border border-[#ebdccb] object-cover shrink-0">
                        <span class="font-bold text-[0.68rem] text-[#1c1210] truncate">${item.name}</span>
                    </div>
                    <span class="text-[0.68rem] font-extrabold text-[#78000b] shrink-0">€${item.price.toFixed(2)}</span>
                </div>
            `;
        });
        listContainer.innerHTML = listHtml;

        // Calculate Discount
        const type = document.getElementById('discount_type').value;
        const discountVal = parseFloat(document.getElementById('discount_value').value) || 0;
        let bundlePrice = regularTotal;

        const label = document.getElementById('discount_value_label');
        const suffix = document.getElementById('discount_value_suffix');

        if (type === 'percentage_discount') {
            label.innerText = 'Discount Value (%) *';
            suffix.innerText = '%';
            bundlePrice = regularTotal * (1 - (discountVal / 100));
        } else if (type === 'fixed_discount') {
            label.innerText = 'Discount Amount (€) *';
            suffix.innerText = '€';
            bundlePrice = Math.max(0, regularTotal - discountVal);
        } else if (type === 'bundle_fixed_price') {
            label.innerText = 'Fixed Package Retail Price (€) *';
            suffix.innerText = '€';
            bundlePrice = discountVal;
        }

        bundlePrice = Math.max(0, bundlePrice);
        const savings = Math.max(0, regularTotal - bundlePrice);
        const savingsPercent = regularTotal > 0 ? Math.round((savings / regularTotal) * 100) : 0;

        document.getElementById('preview_reg_total').innerText = `€${regularTotal.toFixed(2)}`;
        document.getElementById('preview_savings_val').innerText = `- €${savings.toFixed(2)} (${savingsPercent}%)`;
        document.getElementById('preview_bundle_price').innerText = `€${bundlePrice.toFixed(2)}`;
    }

    // Form submission validation
    document.getElementById('dealForm').addEventListener('submit', function(e) {
        if (selectedProductsMap.size < 2) {
            e.preventDefault();
            if (window.LuxurySwal) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: 'At Least 2 Products Required',
                    text: 'A luxury curated bundle must contain at least 2 distinct products.'
                });
            } else {
                alert('A curated bundle must contain at least 2 distinct products.');
            }
        }
    });
</script>
@endsection

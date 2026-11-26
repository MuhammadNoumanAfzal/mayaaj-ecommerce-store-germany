@extends('layouts.admin')
@section('title', 'Create Deal & Bundle - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-6 pb-12">

    <!-- Header Navigation -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.deals') }}" class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-saltora-terracotta transition font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Zurück zur Bundle-Übersicht</span>
            </a>
            <h1 class="font-extrabold text-xl text-stone-900 tracking-tight mt-1">
                Neues Produkt-Bundle anlegen
            </h1>
            <p class="text-xs text-stone-500">
                Wählen Sie mindestens 2 Produkte aus und legen Sie den Paket-Rabatt fest.
            </p>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
            <p class="font-bold mb-1">Bitte korrigieren Sie folgende Fehler:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.deals.store') }}" method="POST" id="dealForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- LEFT COLUMN: Deal Details & Product Selection (8 Cols) -->
            <div class="lg:col-span-8 space-y-5">
                
                <!-- Card 1: Bundle Info -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-stone-200/80 shadow-2xs space-y-4">
                    <h2 class="font-extrabold text-sm text-stone-900 border-b border-stone-100 pb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>1. Bundle Informationen</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1">Bundle Titel (Deutsch) *</label>
                            <input
                                type="text"
                                name="title_de"
                                id="title_de"
                                value="{{ old('title_de') }}"
                                required
                                placeholder="z.B. Luxus Handtasche + Geldbörse Set"
                                class="exec-input w-full px-3.5 py-2.5 rounded-xl text-xs font-semibold"
                                oninput="autoGenerateSlug()"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1">Bundle Title (English) *</label>
                            <input
                                type="text"
                                name="title_en"
                                id="title_en"
                                value="{{ old('title_en') }}"
                                required
                                placeholder="e.g. Luxury Handbag + Leather Wallet Duo"
                                class="exec-input w-full px-3.5 py-2.5 rounded-xl text-xs font-semibold"
                                oninput="autoGenerateSlug()"
                            >
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1">URL-Slug (optional)</label>
                            <input
                                type="text"
                                name="slug"
                                id="slug"
                                value="{{ old('slug') }}"
                                placeholder="handtasche-geldboerse-duo"
                                class="exec-input w-full px-3.5 py-2 rounded-xl text-xs font-mono text-stone-600"
                            >
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1">Badge Text (Hervorhebung)</label>
                            <input
                                type="text"
                                name="badge_text"
                                value="{{ old('badge_text', 'BUNDLE & SAVE 20%') }}"
                                placeholder="z.B. KOMBO-ANGEBOT, CURATED DUO"
                                class="exec-input w-full px-3.5 py-2 rounded-xl text-xs uppercase font-bold text-saltora-terracotta"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-800 mb-1">Beschreibung (Deutsch)</label>
                        <textarea
                            name="description_de"
                            rows="2"
                            placeholder="Exklusives Atelier-Duo mit feinstem vegetabil gegerbtem Leder..."
                            class="exec-input w-full px-3.5 py-2 rounded-xl text-xs"
                        >{{ old('description_de') }}</textarea>
                    </div>
                </div>

                <!-- Card 2: Discount & Flash Timer -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-stone-200/80 shadow-2xs space-y-4">
                    <h2 class="font-extrabold text-sm text-stone-900 border-b border-stone-100 pb-3 flex items-center gap-2">
                        <svg class="w-4 h-4 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>2. Paket-Rabatt & Flash Deal Countdown</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-[#FCFAF7] p-4 rounded-xl border border-stone-200/80">
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1">Rabatt-Berechnungsart *</label>
                            <select
                                name="discount_type"
                                id="discount_type"
                                onchange="recalculatePreview()"
                                class="exec-input w-full px-3 py-2 rounded-xl text-xs font-semibold cursor-pointer"
                            >
                                <option value="percentage_discount" {{ old('discount_type') === 'percentage_discount' ? 'selected' : '' }}>Prozentualer Rabatt auf Gesamtpreis (%)</option>
                                <option value="fixed_discount" {{ old('discount_type') === 'fixed_discount' ? 'selected' : '' }}>Fester Euro-Nachlass (€)</option>
                                <option value="bundle_fixed_price" {{ old('discount_type') === 'bundle_fixed_price' ? 'selected' : '' }}>Fester Paket-Gesamtpreis (€)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-stone-800 mb-1" id="discount_value_label">Rabattwert (%) *</label>
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
                                    class="exec-input w-full px-3.5 py-2 rounded-xl text-xs font-bold text-stone-900"
                                >
                                <span id="discount_value_suffix" class="absolute right-3.5 top-2 text-xs font-bold text-stone-400">%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Flash Sale Timer Settings -->
                    <div class="border-t border-stone-100 pt-3">
                        <div class="flex items-center gap-2 mb-3">
                            <input
                                type="checkbox"
                                id="enable_timer"
                                onchange="toggleTimerFields(this)"
                                class="h-4 w-4 rounded text-saltora-terracotta border-stone-300 focus:ring-saltora-terracotta"
                            >
                            <label for="enable_timer" class="text-xs font-bold text-stone-800 cursor-pointer flex items-center gap-1.5">
                                <span>Flash Deal Countdown-Timer aktivieren</span>
                                <span class="text-[0.62rem] text-amber-700 bg-amber-50 border border-amber-200 px-1.5 py-0.5 rounded font-bold uppercase">Dringlichkeit</span>
                            </label>
                        </div>

                        <div id="timer_fields" class="hidden grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-stone-800 mb-1">Gültig ab</label>
                                <input
                                    type="datetime-local"
                                    name="starts_at"
                                    value="{{ old('starts_at') }}"
                                    class="exec-input w-full px-3 py-2 rounded-xl text-xs text-stone-600"
                                >
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-800 mb-1">Endet am (Countdown) *</label>
                                <input
                                    type="datetime-local"
                                    name="ends_at"
                                    id="ends_at"
                                    value="{{ old('ends_at') }}"
                                    class="exec-input w-full px-3 py-2 rounded-xl text-xs text-stone-600"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Product Selection Grid -->
                <div class="exec-card bg-white p-5 sm:p-6 rounded-2xl border border-stone-200/80 shadow-2xs space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-stone-100 pb-3">
                        <div>
                            <h2 class="font-extrabold text-sm text-stone-900 flex items-center gap-2">
                                <svg class="w-4 h-4 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>3. Produkte für das Bundle auswählen (Mindestens 2) *</span>
                            </h2>
                            <p class="text-[0.68rem] text-stone-400">Wählen Sie die Artikel, die als kuratierte Kombination zusammengehören.</p>
                        </div>
                        <div class="relative w-full sm:w-64">
                            <input
                                type="text"
                                id="productSearchFilter"
                                oninput="filterProductCards(this.value)"
                                placeholder="Produkt filtern..."
                                class="w-full pl-8 pr-3 py-1.5 rounded-lg border border-stone-200 bg-[#FAF8F5] text-xs focus:outline-none focus:border-saltora-terracotta"
                            >
                            <svg class="w-3.5 h-3.5 text-stone-400 absolute left-2.5 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[460px] overflow-y-auto pr-1" id="productsSelectionContainer">
                        @foreach($products as $product)
                            @php
                                $effective = ($product->sale_price && $product->sale_price < $product->price) ? (float)$product->sale_price : (float)$product->price;
                            @endphp
                            <label
                                class="product-select-card relative flex items-center gap-3 p-3 rounded-xl border border-stone-200 bg-[#FCFAF7] hover:border-saltora-terracotta transition cursor-pointer select-none group"
                                data-product-name="{{ strtolower($product->name) }}"
                                data-product-price="{{ $effective }}"
                                data-product-id="{{ $product->id }}"
                                data-product-img="{{ $product->image_url }}"
                            >
                                <input
                                    type="checkbox"
                                    name="products[]"
                                    value="{{ $product->id }}"
                                    class="product-checkbox h-4 w-4 rounded text-saltora-terracotta border-stone-300 focus:ring-saltora-terracotta"
                                    onchange="handleProductCheck(this)"
                                >
                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->name }}"
                                    class="w-12 h-12 rounded-lg border border-stone-200 object-cover bg-white shrink-0"
                                >
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xs font-bold text-stone-900 truncate group-hover:text-saltora-terracotta transition">{{ $product->name }}</h3>
                                    <p class="text-[0.62rem] text-stone-400 font-mono">{{ $product->sku ?? 'MHJ-' . $product->id }}</p>
                                    <span class="text-xs font-extrabold text-[#78000b] block mt-0.5">
                                        {{ number_format($effective, 2, ',', '.') }} €
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Sticky Real-Time Live Preview (4 Cols) -->
            <div class="lg:col-span-4 sticky top-24 space-y-4">
                
                <div class="exec-card bg-white p-5 rounded-2xl border border-stone-200/90 shadow-sm space-y-4 border-t-4 border-t-[#78000b]">
                    <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                        <h3 class="font-extrabold text-xs uppercase tracking-wider text-stone-800 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>Live Bundle Vorschau</span>
                        </h3>
                        <span id="preview_item_count_badge" class="px-2 py-0.5 rounded text-[0.62rem] font-bold bg-stone-100 text-stone-600">
                            0 Artikel gewählt
                        </span>
                    </div>

                    <!-- Selected Products Micro List -->
                    <div id="preview_selected_list" class="space-y-2 min-h-[90px] border border-dashed border-stone-200 rounded-xl p-2.5 bg-[#FAF8F5]">
                        <p class="text-[0.68rem] text-stone-400 text-center py-5 italic">
                            Wählen Sie links Produkte aus, um die Live-Kalkulation zu sehen.
                        </p>
                    </div>

                    <!-- Live Calculation Breakdown -->
                    <div class="space-y-2 text-xs border-t border-stone-100 pt-3">
                        <div class="flex justify-between items-center text-stone-500">
                            <span>Regulärer Gesamtpreis:</span>
                            <span id="preview_reg_total" class="font-bold text-stone-700">0,00 €</span>
                        </div>
                        <div class="flex justify-between items-center text-emerald-700 font-bold" id="preview_discount_row">
                            <span id="preview_discount_label">Paket-Ersparnis:</span>
                            <span id="preview_savings_val">- 0,00 €</span>
                        </div>
                        <div class="flex justify-between items-baseline pt-2 border-t border-stone-200">
                            <span class="text-xs font-bold text-stone-900">Paketpreis (Kunde zahlt):</span>
                            <span id="preview_bundle_price" class="font-extrabold text-xl text-[#78000b]">0,00 €</span>
                        </div>
                    </div>

                    <!-- Publish Settings & Submit -->
                    <div class="border-t border-stone-100 pt-3 space-y-3">
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                checked
                                class="h-4 w-4 rounded text-saltora-terracotta border-stone-300 focus:ring-saltora-terracotta"
                            >
                            <label for="is_active" class="text-xs font-bold text-stone-800 cursor-pointer">Bundle sofort im Shop aktivieren</label>
                        </div>

                        <button
                            type="submit"
                            id="submitBundleBtn"
                            class="w-full btn-exec-primary rounded-xl py-3 text-xs font-bold flex items-center justify-center gap-2 cursor-pointer shadow-md"
                        >
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span>Produkt-Bundle Veröffentlichen</span>
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
        const titleInput = document.getElementById('title_de').value || document.getElementById('title_en').value;
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
            card.classList.add('border-saltora-terracotta', 'bg-saltora-blush/20');
            selectedProductsMap.set(id, { id, name, price, img });
        } else {
            card.classList.remove('border-saltora-terracotta', 'bg-saltora-blush/20');
            selectedProductsMap.delete(id);
        }

        recalculatePreview();
    }

    function recalculatePreview() {
        const count = selectedProductsMap.size;
        document.getElementById('preview_item_count_badge').innerText = `${count} Artikel gewählt`;

        const listContainer = document.getElementById('preview_selected_list');

        if (count === 0) {
            listContainer.innerHTML = '<p class="text-[0.68rem] text-stone-400 text-center py-5 italic">Wählen Sie links Produkte aus, um die Live-Kalkulation zu sehen.</p>';
            document.getElementById('preview_reg_total').innerText = '0,00 €';
            document.getElementById('preview_savings_val').innerText = '- 0,00 €';
            document.getElementById('preview_bundle_price').innerText = '0,00 €';
            return;
        }

        // Render micro items list
        let listHtml = '';
        let regularTotal = 0;

        selectedProductsMap.forEach(item => {
            regularTotal += item.price;
            listHtml += `
                <div class="flex items-center justify-between gap-2 p-1.5 rounded-lg bg-white border border-stone-200/80 text-xs shadow-2xs">
                    <div class="flex items-center gap-2 overflow-hidden">
                        <img src="${item.img}" class="w-7 h-7 rounded border border-stone-100 object-cover shrink-0">
                        <span class="font-bold text-[0.68rem] text-stone-800 truncate">${item.name}</span>
                    </div>
                    <span class="text-[0.68rem] font-extrabold text-stone-700 shrink-0">${item.price.toFixed(2).replace('.', ',')} €</span>
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
            label.innerText = 'Rabattwert (%) *';
            suffix.innerText = '%';
            bundlePrice = regularTotal * (1 - (discountVal / 100));
        } else if (type === 'fixed_discount') {
            label.innerText = 'Rabattbetrag (€) *';
            suffix.innerText = '€';
            bundlePrice = Math.max(0, regularTotal - discountVal);
        } else if (type === 'bundle_fixed_price') {
            label.innerText = 'Fester Paket-Gesamtpreis (€) *';
            suffix.innerText = '€';
            bundlePrice = discountVal;
        }

        bundlePrice = Math.max(0, bundlePrice);
        const savings = Math.max(0, regularTotal - bundlePrice);
        const savingsPercent = regularTotal > 0 ? Math.round((savings / regularTotal) * 100) : 0;

        document.getElementById('preview_reg_total').innerText = `${regularTotal.toFixed(2).replace('.', ',')} €`;
        document.getElementById('preview_savings_val').innerText = `- ${savings.toFixed(2).replace('.', ',')} € (${savingsPercent}%)`;
        document.getElementById('preview_bundle_price').innerText = `${bundlePrice.toFixed(2).replace('.', ',')} €`;
    }

    // Form submission validation
    document.getElementById('dealForm').addEventListener('submit', function(e) {
        if (selectedProductsMap.size < 2) {
            e.preventDefault();
            if (window.LuxurySwal) {
                LuxurySwal.fire({
                    icon: 'warning',
                    title: 'Mindestens 2 Produkte erforderlich',
                    text: 'Ein Bundle muss aus mindestens 2 kombinierten Produkten bestehen.'
                });
            } else {
                alert('Ein Bundle muss aus mindestens 2 kombinierten Produkten bestehen.');
            }
        }
    });
</script>
@endsection

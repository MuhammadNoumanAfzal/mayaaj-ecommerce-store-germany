@extends('layouts.admin')
@section('title', 'Store Einstellungen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <div>
                <h2 class="font-bold text-lg text-white tracking-wide" data-i18n-de="Store & Atelier Einstellungen" data-i18n-en="Store & Atelier Settings">Store & Atelier Einstellungen</h2>
                <p class="text-xs text-blue-200/90" data-i18n-de="Konfigurieren Sie Shop-Stammdaten, Steuersatz, Währung und Vorkasse-Bankverbindung." data-i18n-en="Configure store info, tax rate, currency and prepayment bank details.">Konfigurieren Sie Shop-Stammdaten, Steuersatz, Währung und Vorkasse-Bankverbindung.</p>
            </div>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 sm:p-8 space-y-6 text-xs">
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

            <div class="border-b border-slate-100 pb-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider text-slate-400 mb-4" data-i18n-de="1. Atelier & Kontakt Daten" data-i18n-en="1. Atelier & Contact Information">1. Atelier & Kontakt Daten</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Shop Name *" data-i18n-en="Store Name *">Shop Name *</label>
                        <input 
                            type="text" 
                            name="store_name" 
                            value="{{ old('store_name', $settings['store_name']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kundenservice E-Mail *" data-i18n-en="Customer Service Email *">Kundenservice E-Mail *</label>
                        <input 
                            type="email" 
                            name="store_email" 
                            value="{{ old('store_email', $settings['store_email']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kundenservice Telefon" data-i18n-en="Customer Support Phone">Kundenservice Telefon</label>
                        <input 
                            type="text" 
                            name="store_phone" 
                            value="{{ old('store_phone', $settings['store_phone']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="USt-IdNr. (Mehrwertsteuer ID)" data-i18n-en="VAT ID Number (USt-ID)">USt-IdNr. (Mehrwertsteuer ID)</label>
                        <input 
                            type="text" 
                            name="ust_id" 
                            value="{{ old('ust_id', $settings['ust_id']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Atelier Adresse" data-i18n-en="Atelier Address">Atelier Adresse</label>
                    <textarea 
                        name="address" 
                        rows="2" 
                        class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >{{ old('address', $settings['address']) }}</textarea>
                </div>
            </div>

            <div class="border-b border-slate-100 pb-4">
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider text-slate-400 mb-4" data-i18n-de="2. Währung & Steuersatz (MwSt)" data-i18n-en="2. Currency & Tax Rate (VAT)">2. Währung & Steuersatz (MwSt)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Währung *" data-i18n-en="Currency *">Währung *</label>
                        <input 
                            type="text" 
                            name="currency" 
                            value="{{ old('currency', $settings['currency']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Gesetzliche MwSt. (%) *" data-i18n-en="Legal VAT Rate (%) *">Gesetzliche MwSt. (%) *</label>
                        <input 
                            type="number" 
                            step="0.1" 
                            name="tax_rate" 
                            value="{{ old('tax_rate', $settings['tax_rate']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Standard Versandkosten (€) *" data-i18n-en="Standard Shipping Cost (€) *">Standard Versandkosten (€) *</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="shipping_cost" 
                            value="{{ old('shipping_cost', $settings['shipping_cost']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider text-slate-400 mb-4" data-i18n-de="3. Vorkasse Bankverbindung (Bank Transfer)" data-i18n-en="3. Prepayment Bank Details (Bank Transfer)">3. Vorkasse Bankverbindung (Bank Transfer)</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Bank Name" data-i18n-en="Bank Name">Bank Name</label>
                        <input 
                            type="text" 
                            name="vorkasse_bank" 
                            value="{{ old('vorkasse_bank', $settings['vorkasse_bank']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="IBAN" data-i18n-en="IBAN">IBAN</label>
                        <input 
                            type="text" 
                            name="vorkasse_iban" 
                            value="{{ old('vorkasse_iban', $settings['vorkasse_iban']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm font-mono outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="BIC / SWIFT" data-i18n-en="BIC / SWIFT">BIC / SWIFT</label>
                        <input 
                            type="text" 
                            name="vorkasse_bic" 
                            value="{{ old('vorkasse_bic', $settings['vorkasse_bic']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm font-mono outline-none focus:border-[#194AA2] focus:bg-white transition"
                        >
                    </div>
                </div>
            </div>

            <!-- Form Submit Button (Lime Green #84cc16 matching Screenshot 2) -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-center">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-12 py-3.5 rounded-full btn-lime-save text-white font-extrabold text-sm tracking-wide shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2"
                    style="background-color: #84cc16 !important; color: #ffffff !important;"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Einstellungen Speichern" data-i18n-en="Save Settings">Einstellungen Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

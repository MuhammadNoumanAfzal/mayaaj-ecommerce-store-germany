@extends('layouts.admin')
@section('title', 'Store Einstellungen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3.5 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-normal" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Store Einstellungen" data-i18n-en="Store Settings">Store Einstellungen</span>
        </div>
    </div>

    <!-- Form Container Card (Executive Luxury Light Theme) -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/90 shadow-md shadow-emerald-950/5 overflow-hidden border-t-4 border-t-emerald-800">
        
        <!-- Executive Header -->
        <div class="px-6 py-4 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-100/80 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Store & Atelier Einstellungen" data-i18n-en="Store & Atelier Settings">
                        Store & Atelier Einstellungen
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Konfigurieren Sie Shop-Stammdaten, Steuersatz, Währung und Vorkasse-Bankverbindung." data-i18n-en="Configure store info, tax rate, currency and prepayment bank details.">Konfigurieren Sie Shop-Stammdaten, Steuersatz, Währung und Vorkasse-Bankverbindung.</p>
                </div>
            </div>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1">
                    <p class="font-bold text-sm" data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Bitte korrigieren Sie die folgenden Fehler:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="border-b border-slate-100 pb-6">
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider text-indigo-600 mb-4 flex items-center gap-1.5" data-i18n-de="1. Atelier & Kontakt Daten" data-i18n-en="1. Atelier & Contact Information">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span> 1. Atelier & Kontakt Daten
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Shop Name *" data-i18n-en="Store Name *">Shop Name *</label>
                        <input 
                            type="text" 
                            name="store_name" 
                            value="{{ old('store_name', $settings['store_name']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kundenservice E-Mail *" data-i18n-en="Customer Service Email *">Kundenservice E-Mail *</label>
                        <input 
                            type="email" 
                            name="store_email" 
                            value="{{ old('store_email', $settings['store_email']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kundenservice Telefon" data-i18n-en="Customer Support Phone">Kundenservice Telefon</label>
                        <input 
                            type="text" 
                            name="store_phone" 
                            value="{{ old('store_phone', $settings['store_phone']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="USt-IdNr. (Mehrwertsteuer ID)" data-i18n-en="VAT ID Number (USt-ID)">USt-IdNr. (Mehrwertsteuer ID)</label>
                        <input 
                            type="text" 
                            name="ust_id" 
                            value="{{ old('ust_id', $settings['ust_id']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Atelier Adresse" data-i18n-en="Atelier Address">Atelier Adresse</label>
                    <textarea 
                        name="address" 
                        rows="2" 
                        class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                    >{{ old('address', $settings['address']) }}</textarea>
                </div>
            </div>

            <div class="border-b border-slate-100 pb-6">
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider text-indigo-600 mb-4 flex items-center gap-1.5" data-i18n-de="2. Währung & Steuersatz (MwSt)" data-i18n-en="2. Currency & Tax Rate (VAT)">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span> 2. Währung & Steuersatz (MwSt)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Währung *" data-i18n-en="Currency *">Währung *</label>
                        <input 
                            type="text" 
                            name="currency" 
                            value="{{ old('currency', $settings['currency']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
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
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
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
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>
                </div>
            </div>

            <div class="pb-2">
                <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider text-indigo-600 mb-4 flex items-center gap-1.5" data-i18n-de="3. Vorkasse Bankverbindung (Bank Transfer)" data-i18n-en="3. Prepayment Bank Details (Bank Transfer)">
                    <span class="w-2 h-2 rounded-full bg-indigo-600"></span> 3. Vorkasse Bankverbindung (Bank Transfer)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Bank Name" data-i18n-en="Bank Name">Bank Name</label>
                        <input 
                            type="text" 
                            name="vorkasse_bank" 
                            value="{{ old('vorkasse_bank', $settings['vorkasse_bank']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="IBAN" data-i18n-en="IBAN">IBAN</label>
                        <input 
                            type="text" 
                            name="vorkasse_iban" 
                            value="{{ old('vorkasse_iban', $settings['vorkasse_iban']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm font-mono outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="BIC / SWIFT" data-i18n-en="BIC / SWIFT">BIC / SWIFT</label>
                        <input 
                            type="text" 
                            name="vorkasse_bic" 
                            value="{{ old('vorkasse_bic', $settings['vorkasse_bic']) }}" 
                            class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm font-mono outline-none focus:border-indigo-500 focus:bg-white transition"
                        >
                    </div>
                </div>
            </div>

            <!-- Form Submit Button -->
            <div class="pt-6 mt-8 border-t border-slate-200 flex items-center justify-end gap-3">
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Einstellungen Speichern" data-i18n-en="Save Settings">Einstellungen Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@extends('layouts.admin')
@section('title', 'Store Settings - MAYAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3.5 px-5 text-xs font-semibold text-stone-600 border border-[#E5DED5] flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-normal" data-i18n-en="MAYAJ Admin" data-i18n-de="MAYAJ Admin">MAYAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-en="Store Settings" data-i18n-de="Store Einstellungen">Store Settings</span>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Form Container Card (Pink-Salt Luxury Theme) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden border-t-4 border-t-[#964B42]">
        
        <!-- Header -->
        <div class="px-6 py-5 bg-[#FBF6F4] flex flex-wrap items-center justify-between gap-3 border-b border-[#E5DED5]">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h2 class="font-serif font-bold text-lg text-stone-900 tracking-tight" data-i18n-en="Store & Atelier Settings" data-i18n-de="Store & Atelier Einstellungen">
                        Store & Atelier Settings
                    </h2>
                    <p class="text-xs text-stone-500" data-i18n-en="Configure store master data, legal tax rate, currency and prepayment bank details." data-i18n-de="Konfigurieren Sie Shop-Stammdaten, Steuersatz, Währung und Vorkasse-Bankverbindung.">
                        Configure store master data, legal tax rate, currency and prepayment bank details.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1">
                    <p class="font-bold text-sm" data-i18n-en="Please correct the following errors:" data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:">Please correct the following errors:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="border-b border-[#E5DED5] pb-6">
                <h3 class="font-bold text-stone-900 text-xs uppercase tracking-wider text-[#964B42] mb-4 flex items-center gap-2" data-i18n-en="1. Atelier & Contact Information" data-i18n-de="1. Atelier & Kontakt Daten">
                    <span class="w-2 h-2 rounded-full bg-[#964B42]"></span> 1. Atelier & Contact Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Store Name *" data-i18n-de="Shop Name *">Store Name *</label>
                        <input 
                            type="text" 
                            name="store_name" 
                            value="{{ old('store_name', $settings['store_name']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Customer Service Email *" data-i18n-de="Kundenservice E-Mail *">Customer Service Email *</label>
                        <input 
                            type="email" 
                            name="store_email" 
                            value="{{ old('store_email', $settings['store_email']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Customer Support Phone" data-i18n-de="Kundenservice Telefon">Customer Support Phone</label>
                        <input 
                            type="text" 
                            name="store_phone" 
                            value="{{ old('store_phone', $settings['store_phone']) }}" 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="VAT ID Number (USt-ID)" data-i18n-de="USt-IdNr. (Mehrwertsteuer ID)">VAT ID Number (USt-ID)</label>
                        <input 
                            type="text" 
                            name="ust_id" 
                            value="{{ old('ust_id', $settings['ust_id']) }}" 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Atelier Address" data-i18n-de="Atelier Adresse">Atelier Address</label>
                    <textarea 
                        name="address" 
                        rows="2" 
                        class="w-full p-4 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >{{ old('address', $settings['address']) }}</textarea>
                </div>
            </div>

            <div class="border-b border-[#E5DED5] pb-6">
                <h3 class="font-bold text-stone-900 text-xs uppercase tracking-wider text-[#964B42] mb-4 flex items-center gap-2" data-i18n-en="2. Currency & Tax Rate (VAT)" data-i18n-de="2. Währung & Steuersatz (MwSt)">
                    <span class="w-2 h-2 rounded-full bg-[#964B42]"></span> 2. Currency & Tax Rate (VAT)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Currency *" data-i18n-de="Währung *">Currency *</label>
                        <input 
                            type="text" 
                            name="currency" 
                            value="{{ old('currency', $settings['currency']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Legal VAT Rate (%) *" data-i18n-de="Gesetzliche MwSt. (%) *">Legal VAT Rate (%) *</label>
                        <input 
                            type="number" 
                            step="0.1" 
                            name="tax_rate" 
                            value="{{ old('tax_rate', $settings['tax_rate']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Standard Shipping Cost (€) *" data-i18n-de="Standard Versandkosten (€) *">Standard Shipping Cost (€) *</label>
                        <input 
                            type="number" 
                            step="0.01" 
                            name="shipping_cost" 
                            value="{{ old('shipping_cost', $settings['shipping_cost']) }}" 
                            required 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>
                </div>
            </div>

            <div class="pb-2">
                <h3 class="font-bold text-stone-900 text-xs uppercase tracking-wider text-[#964B42] mb-4 flex items-center gap-2" data-i18n-en="3. Prepayment Bank Details (Bank Transfer)" data-i18n-de="3. Vorkasse Bankverbindung (Bank Transfer)">
                    <span class="w-2 h-2 rounded-full bg-[#964B42]"></span> 3. Prepayment Bank Details (Bank Transfer)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Bank Name" data-i18n-de="Bank Name">Bank Name</label>
                        <input 
                            type="text" 
                            name="vorkasse_bank" 
                            value="{{ old('vorkasse_bank', $settings['vorkasse_bank']) }}" 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="IBAN" data-i18n-de="IBAN">IBAN</label>
                        <input 
                            type="text" 
                            name="vorkasse_iban" 
                            value="{{ old('vorkasse_iban', $settings['vorkasse_iban']) }}" 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm font-mono outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="BIC / SWIFT" data-i18n-de="BIC / SWIFT">BIC / SWIFT</label>
                        <input 
                            type="text" 
                            name="vorkasse_bic" 
                            value="{{ old('vorkasse_bic', $settings['vorkasse_bic']) }}" 
                            class="w-full h-11 rounded-xl border border-[#E5DED5] bg-[#F8F5EF]/60 px-4 text-stone-900 text-sm font-mono outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                        >
                    </div>
                </div>
            </div>

            <!-- Form Submit Button -->
            <div class="pt-6 mt-8 border-t border-[#E5DED5] flex items-center justify-end gap-3">
                <button 
                    type="submit" 
                    class="rounded-xl px-6 py-2.5 text-xs font-semibold transition-all shadow-sm flex items-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white cursor-pointer"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-en="Save Settings" data-i18n-de="Einstellungen Speichern">Save Settings</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

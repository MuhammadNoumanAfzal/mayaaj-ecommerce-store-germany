@extends('layouts.admin')
@section('title', 'Neuen VIP Kunden Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
            <!-- Executive Light Header -->
        <div class="px-6 py-4 flex items-center justify-between bg-slate-50/50 border-b border-slate-200">
            <h2 class="font-extrabold text-base text-slate-900 tracking-wide flex items-center gap-2" data-i18n-de="VIP Kunde Hinzufügen" data-i18n-en="Add VIP Customer">
                <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                VIP Kunde Hinzufügen
            </h2>
            
            <a href="{{ route('admin.customers') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition flex items-center gap-1.5 shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Kunden" data-i18n-en="Back to Customers">Zurück zu Kunden</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.customers.store') }}" method="POST" class="p-6 sm:p-8 space-y-6 text-xs">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Customer Name -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Vollständiger Name *" data-i18n-en="Full Name *">Vollständiger Name <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Dr. Sophia Lindner" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Customer Email -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="E-Mail Adresse *" data-i18n-en="Email Address *">E-Mail Adresse <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        placeholder="z. B. sophia@example.de" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Telefonnummer" data-i18n-en="Phone Number">Telefonnummer</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        placeholder="+49 171 1234567" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- VIP Tier Selection -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="VIP Status *" data-i18n-en="VIP Tier *">VIP Status <span class="text-emerald-700 font-bold">*</span></label>
                    <select 
                        name="vip_tier" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="platinum" {{ old('vip_tier') === 'platinum' ? 'selected' : '' }}>💎 Platinum VIP</option>
                        <option value="gold" {{ old('vip_tier', 'gold') === 'gold' ? 'selected' : '' }}>🏆 Gold VIP</option>
                        <option value="silver" {{ old('vip_tier') === 'silver' ? 'selected' : '' }}>🥈 Silver VIP</option>
                        <option value="regular" {{ old('vip_tier') === 'regular' ? 'selected' : '' }}>Standard Kunde</option>
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Stadt" data-i18n-en="City">Stadt</label>
                    <input 
                        type="text" 
                        name="city" 
                        value="{{ old('city') }}" 
                        placeholder="z. B. München, Berlin..." 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Postal Code -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Postleitzahl" data-i18n-en="Postal Code">Postleitzahl</label>
                    <input 
                        type="text" 
                        name="postal_code" 
                        value="{{ old('postal_code') }}" 
                        placeholder="80539" 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Country -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Land *" data-i18n-en="Country *">Land <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="country" 
                        value="{{ old('country', 'Deutschland') }}" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Konto Status *" data-i18n-en="Account Status *">Konto Status <span class="text-emerald-700 font-bold">*</span></label>
                    <select 
                        name="status" 
                        required 
                        class="exec-input w-full h-11 rounded-xl px-4 text-slate-900 text-sm outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }} data-i18n-de="Inaktiv" data-i18n-en="Inactive">Inaktiv</option>
                    </select>
                </div>

            </div>

            <!-- Address (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1.5" data-i18n-de="Liefer- / Rechnungsadresse" data-i18n-en="Billing / Shipping Address">Liefer- / Rechnungsadresse</label>
                <textarea 
                    name="address" 
                    rows="3" 
                    placeholder="Straße, Hausnummer, Adresszusatz..." 
                    class="exec-input w-full p-4 rounded-xl text-slate-900 text-sm outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('address') }}</textarea>
            </div>

            <!-- Form Submit Button -->
            <div class="pt-6 mt-6 border-t border-slate-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.customers') }}" class="btn-exec-secondary px-6 py-2.5 rounded-xl text-xs font-bold transition-all shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kunde Speichern" data-i18n-en="Save Customer">Kunde Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

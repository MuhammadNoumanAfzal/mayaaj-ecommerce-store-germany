@extends('layouts.admin')
@section('title', 'Neuen VIP Kunden Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <h2 class="font-bold text-lg text-white tracking-wide" data-i18n-de="VIP Kunde Hinzufügen" data-i18n-en="Add VIP Customer">VIP Kunde Hinzufügen</h2>
            
            <a href="{{ route('admin.customers') }}" class="rounded-full btn-blue-back border border-white/20 text-white px-4 py-1.5 text-xs font-bold transition flex items-center gap-1.5 shadow-sm" style="background-color: #103375 !important; color: #ffffff !important;">
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
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Vollständiger Name *" data-i18n-en="Full Name *">Vollständiger Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Dr. Sophia Lindner" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Customer Email -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="E-Mail Adresse *" data-i18n-en="Email Address *">E-Mail Adresse *</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        placeholder="z. B. sophia@example.de" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Telefonnummer" data-i18n-en="Phone Number">Telefonnummer</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        placeholder="+49 171 1234567" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- VIP Tier Selection -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="VIP Status *" data-i18n-en="VIP Tier *">VIP Status *</label>
                    <select 
                        name="vip_tier" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="platinum" {{ old('vip_tier') === 'platinum' ? 'selected' : '' }}>💎 Platinum VIP</option>
                        <option value="gold" {{ old('vip_tier', 'gold') === 'gold' ? 'selected' : '' }}>🏆 Gold VIP</option>
                        <option value="silver" {{ old('vip_tier') === 'silver' ? 'selected' : '' }}>🥈 Silver VIP</option>
                        <option value="regular" {{ old('vip_tier') === 'regular' ? 'selected' : '' }}>Standard Kunde</option>
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Stadt" data-i18n-en="City">Stadt</label>
                    <input 
                        type="text" 
                        name="city" 
                        value="{{ old('city') }}" 
                        placeholder="z. B. München, Berlin..." 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Postal Code -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Postleitzahl" data-i18n-en="Postal Code">Postleitzahl</label>
                    <input 
                        type="text" 
                        name="postal_code" 
                        value="{{ old('postal_code') }}" 
                        placeholder="80539" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Country -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Land *" data-i18n-en="Country *">Land *</label>
                    <input 
                        type="text" 
                        name="country" 
                        value="{{ old('country', 'Deutschland') }}" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Konto Status *" data-i18n-en="Account Status *">Konto Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }} data-i18n-de="Inaktiv" data-i18n-en="Inactive">Inaktiv</option>
                    </select>
                </div>

            </div>

            <!-- Address (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Liefer- / Rechnungsadresse" data-i18n-en="Billing / Shipping Address">Liefer- / Rechnungsadresse</label>
                <textarea 
                    name="address" 
                    rows="3" 
                    placeholder="Straße, Hausnummer, Adresszusatz..." 
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                >{{ old('address') }}</textarea>
            </div>

            <!-- Form Submit Button (Lime Green #84cc16 matching Screenshot 2) -->
            <div class="pt-4 flex items-center justify-center">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-10 py-3.5 rounded-full btn-lime-save text-white font-extrabold text-sm tracking-wide shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2"
                    style="background-color: #84cc16 !important; color: #ffffff !important;"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kunde Speichern" data-i18n-en="Save Customer">Kunde Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

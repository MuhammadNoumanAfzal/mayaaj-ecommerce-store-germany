@extends('layouts.admin')
@section('title', 'Add VIP Customer - MAYAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Top Breadcrumb -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-2 text-xs text-stone-500">
            <a href="{{ route('admin.customers') }}" class="hover:text-[#964B42] transition" data-i18n-en="VIP Customers" data-i18n-de="VIP Kunden">VIP Customers</a>
            <span>/</span>
            <span class="text-stone-800 font-semibold" data-i18n-en="Add Customer" data-i18n-de="Kunde hinzufügen">Add Customer</span>
        </div>
        <a href="{{ route('admin.customers') }}" class="px-4 py-2 rounded-xl text-xs font-semibold bg-[#F8F5EF] text-stone-700 border border-[#E5DED5] hover:bg-[#F0EAE1] hover:text-[#964B42] transition flex items-center gap-1.5 shadow-2xs">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            <span data-i18n-en="Back to Customers" data-i18n-de="Zurück zu Kunden">Back to Customers</span>
        </a>
    </div>

    <!-- Form Container Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        
        <!-- Luxury Card Header -->
        <div class="px-6 py-5 bg-[#FBF6F4] border-b border-[#E5DED5] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#964B42]/10 border border-[#964B42]/20 flex items-center justify-center text-[#964B42]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif font-bold text-lg text-stone-900 tracking-tight" data-i18n-en="Add VIP Customer" data-i18n-de="VIP Kunde Hinzufügen">
                        Add VIP Customer
                    </h2>
                    <p class="text-xs text-stone-500" data-i18n-en="Register a new VIP customer profile in the luxury database." data-i18n-de="Registrieren Sie ein neues VIP-Kundenprofil in der Datenbank.">
                        Register a new VIP customer profile in the luxury database.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.customers.store') }}" method="POST" class="p-6 sm:p-8 space-y-6 text-xs">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Customer Name -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Full Name *" data-i18n-de="Vollständiger Name *">Full Name <span class="text-[#964B42] font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="e.g. Dr. Sophia Lindner" 
                        data-i18n-placeholder-en="e.g. Dr. Sophia Lindner"
                        data-i18n-placeholder-de="z. B. Dr. Sophia Lindner"
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- Customer Email -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Email Address *" data-i18n-de="E-Mail Adresse *">Email Address <span class="text-[#964B42] font-bold">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        placeholder="e.g. sophia@example.com" 
                        data-i18n-placeholder-en="e.g. sophia@example.com"
                        data-i18n-placeholder-de="z. B. sophia@example.de"
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Phone Number" data-i18n-de="Telefonnummer">Phone Number</label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        placeholder="+49 171 1234567" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- VIP Tier Selection -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="VIP Tier *" data-i18n-de="VIP Status *">VIP Tier <span class="text-[#964B42] font-bold">*</span></label>
                    <select 
                        name="vip_tier" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                        <option value="platinum" {{ old('vip_tier') === 'platinum' ? 'selected' : '' }}>💎 Platinum VIP</option>
                        <option value="gold" {{ old('vip_tier', 'gold') === 'gold' ? 'selected' : '' }}>🏆 Gold VIP</option>
                        <option value="silver" {{ old('vip_tier') === 'silver' ? 'selected' : '' }}>🥈 Silver VIP</option>
                        <option value="regular" {{ old('vip_tier') === 'regular' ? 'selected' : '' }}>Standard Client</option>
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="City" data-i18n-de="Stadt">City</label>
                    <input 
                        type="text" 
                        name="city" 
                        value="{{ old('city') }}" 
                        placeholder="e.g. Munich, Berlin..." 
                        data-i18n-placeholder-en="e.g. Munich, Berlin..."
                        data-i18n-placeholder-de="z. B. München, Berlin..."
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- Postal Code -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Postal Code" data-i18n-de="Postleitzahl">Postal Code</label>
                    <input 
                        type="text" 
                        name="postal_code" 
                        value="{{ old('postal_code') }}" 
                        placeholder="80539" 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- Country -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Country *" data-i18n-de="Land *">Country <span class="text-[#964B42] font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="country" 
                        value="{{ old('country', 'Germany') }}" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                </div>

                <!-- Status -->
                <div>
                    <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Account Status *" data-i18n-de="Konto Status *">Account Status <span class="text-[#964B42] font-bold">*</span></label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl px-4 text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-en="Active" data-i18n-de="Aktiv">Active</option>
                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }} data-i18n-en="Inactive" data-i18n-de="Inaktiv">Inactive</option>
                    </select>
                </div>

            </div>

            <!-- Address (Full Width) -->
            <div>
                <label class="block font-semibold text-stone-800 mb-1.5" data-i18n-en="Billing / Shipping Address" data-i18n-de="Liefer- / Rechnungsadresse">Billing / Shipping Address</label>
                <textarea 
                    name="address" 
                    rows="3" 
                    placeholder="Street name, house number, apartment details..." 
                    data-i18n-placeholder-en="Street name, house number, apartment details..."
                    data-i18n-placeholder-de="Straße, Hausnummer, Adresszusatz..."
                    class="w-full p-4 rounded-xl text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] text-sm outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                >{{ old('address') }}</textarea>
            </div>

            <!-- Form Submit Button -->
            <div class="pt-6 mt-6 border-t border-[#E5DED5] flex items-center justify-end gap-3">
                <a href="{{ route('admin.customers') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-stone-700 bg-[#F8F5EF] border border-[#E5DED5] hover:bg-[#F0EAE1] hover:text-[#964B42] transition shadow-2xs" data-i18n-en="Cancel" data-i18n-de="Abbrechen">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="rounded-xl px-6 py-2.5 text-xs font-semibold transition-all shadow-sm flex items-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white cursor-pointer"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-en="Save Customer" data-i18n-de="Kunde Speichern">Save Customer</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

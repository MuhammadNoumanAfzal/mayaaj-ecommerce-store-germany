@extends('layouts.admin')
@section('title', 'Neue Kategorie Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto pb-16">

    <!-- Form Container Card -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden border-t-4 border-t-indigo-600">
        @csrf

        <!-- Top Header with Actions (Always visible without scrolling) -->
        <div class="px-6 py-4 bg-white flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600 border border-indigo-100 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Neue Kategorie Hinzufügen" data-i18n-en="Add New Category">
                        Neue Kategorie Hinzufügen
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Erstellen Sie eine neue Hauptkategorie für Ihren Katalog." data-i18n-en="Create a new top-level category for your catalog.">Erstellen Sie eine neue Hauptkategorie für Ihren Katalog.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.categories') }}" class="rounded-xl px-4 py-2 text-xs font-bold bg-slate-100 hover:bg-slate-200/80 text-slate-700 border border-slate-200 transition-all flex items-center gap-1.5 shadow-2xs cursor-pointer hover:shadow-xs">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Zurück</span>
                </a>
                <button 
                    type="submit" 
                    class="rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-1.5 cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kategorie Speichern" data-i18n-en="Save Category">Kategorie Speichern</span>
                </button>
            </div>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8 text-xs space-y-5">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Bitte korrigieren Sie die folgenden Fehler:
                    </p>
                    <ul class="list-disc list-inside text-xs pl-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Category Name -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Kategorie Name *" data-i18n-en="Category Name *">Kategorie Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Leder Taschen, Geldbörsen..." 
                        data-i18n-placeholder-de="z. B. Leder Taschen, Geldbörsen..."
                        data-i18n-placeholder-en="e.g. Leather Bags, Wallets..."
                        class="w-full h-10 rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 text-slate-900 text-xs outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.65rem] text-slate-400 mt-1 font-medium" data-i18n-de="Eindeutiger Name für Kunden im Shop-Menü." data-i18n-en="Unique name shown to customers in the menu.">Eindeutiger Name für Kunden im Shop-Menü.</p>
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Status *" data-i18n-en="Status *">Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-10 rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 text-slate-900 text-xs outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                    <p class="text-[0.65rem] text-slate-400 mt-1 font-medium" data-i18n-de="Aktive Kategorien werden sofort im Shop angezeigt." data-i18n-en="Active categories are immediately visible to customers.">Aktive Kategorien werden sofort im Shop angezeigt.</p>
                </div>

                <!-- Category Image -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Kategorie Logo / Bild" data-i18n-en="Category Image">Kategorie Logo / Bild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2 text-slate-600 bg-slate-50/50 text-xs focus:outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                    <p class="text-[0.65rem] text-slate-400 mt-1 font-medium" data-i18n-de="Empfohlen: PNG, WebP oder JPG bis 2MB." data-i18n-en="Recommended: PNG, WebP or JPG up to 2MB.">Empfohlen: PNG, WebP oder JPG bis 2MB.</p>
                </div>

                <!-- Order Index -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Sortierungsreihenfolge" data-i18n-en="Sort Order">Sortierungsreihenfolge</label>
                    <input 
                        type="number" 
                        name="order_index" 
                        value="{{ old('order_index', 0) }}" 
                        class="w-full h-10 rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 text-slate-900 text-xs outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                    >
                    <p class="text-[0.65rem] text-slate-400 mt-1 font-medium" data-i18n-de="Niedrigere Zahlen erscheinen zuerst (z.B. 0, 1, 2)." data-i18n-en="Lower numbers appear first (e.g. 0, 1, 2).">Niedrigere Zahlen erscheinen zuerst (z.B. 0, 1, 2).</p>
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="3" 
                    placeholder="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..." 
                    data-i18n-placeholder-de="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..."
                    data-i18n-placeholder-en="Enter detailed description for this category..."
                    class="w-full p-3 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-xs outline-none focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20 transition shadow-2xs"
                >{{ old('description') }}</textarea>
                <p class="text-[0.65rem] text-slate-400 mt-1 font-medium" data-i18n-de="Kurze Beschreibung für Unterseiten und SEO." data-i18n-en="Brief description for subpages and search engine optimization.">Kurze Beschreibung für Unterseiten und SEO.</p>
            </div>

            <!-- Bottom Action Buttons inside Form Body with Margin -->
            <div class="pt-5 mt-6 border-t border-slate-100 flex items-center justify-end gap-3 pb-2">
                <a href="{{ route('admin.categories') }}" class="px-5 py-2 rounded-xl border border-slate-300/80 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition-all shadow-2xs cursor-pointer hover:shadow-xs" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 text-xs font-bold transition-all shadow-sm hover:shadow flex items-center gap-2 cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kategorie Speichern" data-i18n-en="Save Category">Kategorie Speichern</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection

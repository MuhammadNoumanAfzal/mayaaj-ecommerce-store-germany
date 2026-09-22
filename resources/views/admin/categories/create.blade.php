@extends('layouts.admin')
@section('title', 'Neue Kategorie Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto pb-16">

    <!-- Form Container Card (Executive Luxury Light Theme) -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="exec-card bg-white rounded-2xl border border-slate-200/90 shadow-md shadow-emerald-950/5 overflow-hidden border-t-4 border-t-emerald-800">
        @csrf

        <!-- Top Header with Actions (Always visible without scrolling) -->
        <div class="px-6 py-4 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-100/80 shadow-2xs">
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
                <a href="{{ route('admin.categories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Zurück</span>
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-5 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-md"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
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
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Kategorie Name *" data-i18n-en="Category Name *">Kategorie Name <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Leder Taschen, Geldbörsen..." 
                        data-i18n-placeholder-de="z. B. Leder Taschen, Geldbörsen..."
                        data-i18n-placeholder-en="e.g. Leather Bags, Wallets..."
                        class="exec-input w-full h-10 rounded-xl px-3.5 text-xs outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Eindeutiger Name für Kunden im Shop-Menü." data-i18n-en="Unique name shown to customers in the menu.">Eindeutiger Name für Kunden im Shop-Menü.</p>
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Status *" data-i18n-en="Status *">Status <span class="text-emerald-700 font-bold">*</span></label>
                    <select 
                        name="status" 
                        required 
                        class="exec-input w-full h-10 rounded-xl px-3.5 text-xs outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Aktive Kategorien werden sofort im Shop angezeigt." data-i18n-en="Active categories are immediately visible to customers.">Aktive Kategorien werden sofort im Shop angezeigt.</p>
                </div>

                <!-- Category Image -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Kategorie Logo / Bild" data-i18n-en="Category Image">Kategorie Logo / Bild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Empfohlen: PNG, WebP oder JPG bis 2MB." data-i18n-en="Recommended: PNG, WebP or JPG up to 2MB.">Empfohlen: PNG, WebP oder JPG bis 2MB.</p>
                </div>

                <!-- Order Index -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Sortierungsreihenfolge" data-i18n-en="Sort Order">Sortierungsreihenfolge</label>
                    <input 
                        type="number" 
                        name="order_index" 
                        value="{{ old('order_index', 0) }}" 
                        class="exec-input w-full h-10 rounded-xl px-3.5 text-xs outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Niedrigere Zahlen erscheinen zuerst (z.B. 0, 1, 2)." data-i18n-en="Lower numbers appear first (e.g. 0, 1, 2).">Niedrigere Zahlen erscheinen zuerst (z.B. 0, 1, 2).</p>
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="3" 
                    placeholder="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..." 
                    data-i18n-placeholder-de="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..."
                    data-i18n-placeholder-en="Enter detailed description for this category..."
                    class="exec-input w-full p-3 rounded-xl text-xs outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('description') }}</textarea>
                <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Kurze Beschreibung für Unterseiten und SEO." data-i18n-en="Brief description for subpages and search engine optimization.">Kurze Beschreibung für Unterseiten und SEO.</p>
            </div>

            <!-- Bottom Action Buttons inside Form Body with Margin -->
            <div class="pt-5 mt-6 border-t border-slate-200 flex items-center justify-end gap-3 pb-2">
                <a href="{{ route('admin.categories') }}" class="btn-exec-secondary px-5 py-2.5 rounded-xl text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all flex items-center gap-2 cursor-pointer shadow-md"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kategorie Speichern" data-i18n-en="Save Category">Kategorie Speichern</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection

@extends('layouts.admin')
@section('title', 'Neue Unterkategorie Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto pb-16">

    <!-- Form Container Card (Executive Luxury Light Theme) -->
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="exec-card bg-white rounded-2xl border border-slate-200/90 shadow-md shadow-emerald-950/5 overflow-hidden border-t-4 border-t-emerald-800">
        @csrf

        <!-- Top Header with Actions (Always visible without scrolling) -->
        <div class="px-6 py-4 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-800 border border-emerald-100/80 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-slate-900 tracking-tight" data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">
                        Unterkategorie Hinzufügen
                    </h2>
                    <p class="text-[0.7rem] text-slate-500 font-medium" data-i18n-de="Erstellen Sie eine Unterkategorie für Ihren Shop." data-i18n-en="Create a subcategory for your store.">Erstellen Sie eine Unterkategorie für Ihren Shop.</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.subcategories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Zurück</span>
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-5 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-md"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Unterkategorie Speichern</span>
                </button>
            </div>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8 text-xs space-y-5">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Bitte korrigieren Sie die folgenden Fehler:</span>
                    </p>
                    <ul class="list-disc list-inside text-xs pl-6">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                <!-- Parent Category Selection -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Hauptkategorie *" data-i18n-en="Parent Category *">Hauptkategorie <span class="text-emerald-700 font-bold">*</span></label>
                    <select 
                        name="category_id" 
                        required 
                        class="exec-input w-full h-10 rounded-xl px-3.5 text-xs outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                        <option value="" disabled selected data-i18n-de="— Hauptkategorie wählen —" data-i18n-en="— Select parent category —">— Hauptkategorie wählen —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Übergeordnete Kategorie zuweisen." data-i18n-en="Assign parent category hierarchy.">Übergeordnete Kategorie zuweisen.</p>
                </div>

                <!-- Subcategory Name -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Unterkategorie Name *" data-i18n-en="Subcategory Name *">Unterkategorie Name <span class="text-emerald-700 font-bold">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Handtaschen, Automatische Uhren..." 
                        data-i18n-placeholder-de="z. B. Handtaschen, Automatische Uhren..."
                        data-i18n-placeholder-en="e.g. Handbags, Automatic Watches..."
                        class="exec-input w-full h-10 rounded-xl px-3.5 text-xs outline-none transition shadow-2xs"
                        style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                    >
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Verständlicher Name der Unterkategorie." data-i18n-en="Clear subcategory title for navigation.">Verständlicher Name der Unterkategorie.</p>
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
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Aktiv schaltet die Anzeige im Katalog frei." data-i18n-en="Active publish status for store catalog.">Aktiv schaltet die Anzeige im Katalog frei.</p>
                </div>

                <!-- Subcategory Image -->
                <div>
                    <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Unterkategorie Bild" data-i18n-en="Subcategory Image">Unterkategorie Bild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-300 rounded-xl p-2 text-slate-700 bg-slate-50 text-xs focus:outline-none focus:border-emerald-600 transition"
                    >
                    <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Empfohlen: PNG, WebP oder JPG bis 30MB." data-i18n-en="Recommended format: PNG, WebP or JPG up to 30MB.">Empfohlen: PNG, WebP oder JPG bis 30MB.</p>
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-900 mb-1" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="3" 
                    placeholder="Geben Sie eine Beschreibung für diese Unterkategorie ein..." 
                    data-i18n-placeholder-de="Geben Sie eine Beschreibung für diese Unterkategorie ein..."
                    data-i18n-placeholder-en="Enter description for this subcategory..."
                    class="exec-input w-full p-3 rounded-xl text-xs outline-none transition shadow-2xs"
                    style="background-color: #f8fafc !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important;"
                >{{ old('description') }}</textarea>
                <p class="text-[0.65rem] text-slate-500 mt-1 font-semibold" data-i18n-de="Optionale Beschreibung der Unterkategorie." data-i18n-en="Optional subcategory description.">Optionale Beschreibung der Unterkategorie.</p>
            </div>

            <!-- Bottom Action Buttons inside Form Body with Margin -->
            <div class="pt-5 mt-6 border-t border-slate-200 flex items-center justify-end gap-3 pb-2">
                <a href="{{ route('admin.subcategories') }}" class="btn-exec-secondary px-5 py-2.5 rounded-xl text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs" style="background-color: #f1f5f9 !important; color: #0f172a !important; border: 1px solid #cbd5e1 !important; font-weight: 700 !important;" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all flex items-center gap-2 cursor-pointer shadow-md"
                    style="background-color: #064e3b !important; color: #ffffff !important; font-weight: 700 !important;"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Unterkategorie Speichern</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection

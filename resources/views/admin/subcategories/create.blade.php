@extends('layouts.admin')
@section('title', 'Neue Unterkategorie Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Executive Light Header -->
        <div class="px-6 py-4.5 flex items-center justify-between" style="background-color: #ffffff !important; color: #0f172a !important; border-bottom: 1px solid #e2e8f0 !important;">
            <h2 class="font-extrabold text-base text-slate-900 tracking-wide flex items-center gap-2" data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Unterkategorie Hinzufügen
            </h2>
            
            <a href="{{ route('admin.subcategories') }}" class="rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #334155 !important; border: 1px solid #e2e8f0 !important;">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Unterkategorien" data-i18n-en="Back to Subcategories">Zurück zu Unterkategorien</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
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
                
                <!-- Parent Category Selection -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Hauptkategorie *" data-i18n-en="Parent Category *">Hauptkategorie *</label>
                    <select 
                        name="category_id" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="" disabled selected data-i18n-de="— Hauptkategorie wählen —" data-i18n-en="— Select parent category —">— Hauptkategorie wählen —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Name -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Unterkategorie Name *" data-i18n-en="Subcategory Name *">Unterkategorie Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Handtaschen, Automatische Uhren..." 
                        data-i18n-placeholder-de="z. B. Handtaschen, Automatische Uhren..."
                        data-i18n-placeholder-en="e.g. Handbags, Automatic Watches..."
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Status *" data-i18n-en="Status *">Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Subcategory Image -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Unterkategorie Bild" data-i18n-en="Subcategory Image">Unterkategorie Bild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs"
                    >
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Geben Sie eine Beschreibung für diese Unterkategorie ein..." 
                    data-i18n-placeholder-de="Geben Sie eine Beschreibung für diese Unterkategorie ein..."
                    data-i18n-placeholder-en="Enter description for this subcategory..."
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Form Submit Button (Lime Green #84cc16 matching Screenshot 2) -->
            <div class="pt-4 flex items-center justify-center">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-10 py-3.5 rounded-full btn-lime-save text-white font-extrabold text-sm tracking-wide shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2"
                    style="background-color: #84cc16 !important; color: #ffffff !important;"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Unterkategorie Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

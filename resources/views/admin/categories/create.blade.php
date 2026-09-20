@extends('layouts.admin')
@section('title', 'Neue Kategorie Hinzufügen - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Executive Dark Navy Gradient Header -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Executive Light Header -->
        <div class="px-6 py-4.5 flex items-center justify-between" style="background-color: #ffffff !important; color: #0f172a !important; border-bottom: 1px solid #e2e8f0 !important;">
            <h2 class="font-extrabold text-base text-slate-900 tracking-wide flex items-center gap-2" data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Kategorie Hinzufügen
            </h2>
            
            <a href="{{ route('admin.categories') }}" class="rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer" style="background-color: #f1f5f9 !important; color: #334155 !important; border: 1px solid #e2e8f0 !important;">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Kategorien" data-i18n-en="Back to Categories">Zurück zu Kategorien</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1">
                    <p class="font-bold text-sm">Bitte korrigieren Sie die folgenden Fehler:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Category Name -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kategorie Name *" data-i18n-en="Category Name *">Kategorie Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="z. B. Leder Taschen, Geldbörsen..." 
                        data-i18n-placeholder-de="z. B. Leder Taschen, Geldbörsen..."
                        data-i18n-placeholder-en="e.g. Leather Bags, Wallets..."
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                </div>

                <!-- Status Select -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Status *" data-i18n-en="Status *">Status *</label>
                    <select 
                        name="status" 
                        required 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                        <option value="active" {{ old('status') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Category Image -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kategorie Logo / Bild" data-i18n-en="Category Image">Kategorie Logo / Bild</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs"
                    >
                </div>

                <!-- Order Index -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Sortierungsreihenfolge" data-i18n-en="Sort Order">Sortierungsreihenfolge</label>
                    <input 
                        type="number" 
                        name="order_index" 
                        value="{{ old('order_index', 0) }}" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                    >
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    placeholder="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..." 
                    data-i18n-placeholder-de="Geben Sie eine ausführliche Beschreibung für diese Kategorie ein..."
                    data-i18n-placeholder-en="Enter detailed description for this category..."
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-indigo-500 focus:bg-white transition"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Form Submit Button -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.categories') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-bold text-xs transition cursor-pointer" data-i18n-de="Abbrechen" data-i18n-en="Cancel">
                    Abbrechen
                </a>
                <button 
                    type="submit" 
                    class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 text-xs font-bold transition shadow-xs flex items-center gap-2 cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kategorie Speichern" data-i18n-en="Save Category">Kategorie Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@extends('layouts.admin')
@section('title', 'Kategorie Bearbeiten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto">

    <!-- Form Container Card with Dark Navy Header matching reference screenshot 2 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-md overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <h2 class="font-bold text-lg text-white tracking-wide" data-i18n-de="Kategorie Bearbeiten" data-i18n-en="Edit Category">Kategorie Bearbeiten</h2>
            
            <a href="{{ route('admin.categories') }}" class="rounded-full btn-blue-back border border-white/20 text-white px-4 py-1.5 text-xs font-bold transition flex items-center gap-1.5 shadow-sm" style="background-color: #103375 !important; color: #ffffff !important;">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Zurück zu Kategorien" data-i18n-en="Back to Categories">Zurück zu Kategorien</span>
            </a>
        </div>

        <!-- Form Body (2-Column Grid Layout) -->
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6 text-xs">
            @csrf
            @method('PUT')

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
                
                <!-- Category Name -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Kategorie Name *" data-i18n-en="Category Name *">Kategorie Name *</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $category->name) }}" 
                        required 
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
                        <option value="active" {{ old('status', $category->status) === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Öffentlich)" data-i18n-en="Active (Public)">Aktiv (Öffentlich)</option>
                        <option value="draft" {{ old('status', $category->status) === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Entwurf (Versteckt)</option>
                    </select>
                </div>

                <!-- Category Image Upload & Preview -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Neues Bild Hochladen (Optional)" data-i18n-en="Upload New Image (Optional)">Neues Bild Hochladen (Optional)</label>
                    <input 
                        type="file" 
                        name="image" 
                        accept="image/*" 
                        class="w-full border border-slate-200 rounded-xl p-2.5 text-slate-600 bg-slate-50/50 text-xs"
                    >
                    @if($category->image_url)
                        <div class="mt-3 flex items-center gap-3 bg-slate-50 p-2 rounded-xl border border-slate-200">
                            <img src="{{ $category->image_url }}" alt="Aktuelles Bild" class="h-10 w-10 object-cover rounded-lg border border-slate-200">
                            <span class="text-slate-500 text-xs">Aktuelles Bild vorhanden</span>
                        </div>
                    @endif
                </div>

                <!-- Order Index -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Sortierungsreihenfolge" data-i18n-en="Sort Order">Sortierungsreihenfolge</label>
                    <input 
                        type="number" 
                        name="order_index" 
                        value="{{ old('order_index', $category->order_index) }}" 
                        class="w-full h-11 rounded-xl border border-slate-200 bg-slate-50/50 px-4 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                    >
                </div>

            </div>

            <!-- Description (Full Width) -->
            <div>
                <label class="block font-bold text-slate-700 mb-1.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</label>
                <textarea 
                    name="description" 
                    rows="4" 
                    class="w-full p-4 rounded-xl border border-slate-200 bg-slate-50/50 text-slate-900 text-sm outline-none focus:border-[#194AA2] focus:bg-white transition"
                >{{ old('description', $category->description) }}</textarea>
            </div>

            <!-- Form Submit Button (Lime Green #84cc16 matching Screenshot 2) -->
            <div class="pt-4 flex items-center justify-center">
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-10 py-3.5 rounded-full btn-lime-save text-white font-extrabold text-sm tracking-wide shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2"
                    style="background-color: #84cc16 !important; color: #ffffff !important;"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Änderungen Speichern" data-i18n-en="Save Changes">Änderungen Speichern</span>
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

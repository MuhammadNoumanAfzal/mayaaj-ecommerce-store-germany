@extends('layouts.admin')
@section('title', 'Add New Category - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-6 max-w-5xl mx-auto pb-16">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.categories') }}" class="text-stone-400 hover:text-stone-700 transition" data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</a>
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Neue Kategorie" data-i18n-en="New Category">New Category</span>
        </div>
        <a href="{{ route('admin.categories') }}" class="text-xs font-bold text-saltora-terracotta hover:underline">
            ← <span data-i18n-de="Zurück zur Übersicht" data-i18n-en="Back to Directory">Back to Directory</span>
        </a>
    </div>

    <!-- Form Container Card -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="exec-card bg-white rounded-2xl border border-stone-200/90 shadow-md shadow-stone-900/5 overflow-hidden border-t-4 border-t-saltora-terracotta">
        @csrf

        <!-- Top Header with Actions -->
        <div class="px-6 py-4 bg-stone-50/50 flex flex-wrap items-center justify-between gap-3 border-b border-stone-200/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-extrabold text-base text-stone-900 tracking-tight" data-i18n-de="Neue Kategorie Hinzufügen" data-i18n-en="Add New Category">
                        Add New Category
                    </h2>
                    <p class="text-[0.7rem] text-stone-500 font-medium" data-i18n-de="Erstellen Sie eine neue Hauptkategorie für Ihren Luxuskatalog." data-i18n-en="Create a top-level category with automatic storefront synchronization.">
                        Create a top-level category with automatic storefront synchronization.
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.categories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Back</span>
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-5 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-md"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Kategorie Speichern" data-i18n-en="Save Category">Save Category</span>
                </button>
            </div>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8 text-xs space-y-5">
            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span data-i18n-de="Bitte korrigieren Sie die folgenden Fehler:" data-i18n-en="Please correct the following errors:">Please correct the following errors:</span>
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
                    <label for="name" class="block font-bold text-xs text-stone-800 mb-1.5 uppercase tracking-wider" data-i18n-de="KATEGORIE NAME *" data-i18n-en="CATEGORY NAME *">
                        CATEGORY NAME *
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="catNameInput" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="e.g. Leather Briefcases"
                        data-i18n-placeholder-de="z.B. Leder Aktentaschen"
                        data-i18n-placeholder-en="e.g. Leather Briefcases"
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs font-medium outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs"
                    >
                    <div class="flex items-center gap-1.5 text-[0.68rem] text-stone-400 mt-1 font-mono">
                        <span>Slug:</span>
                        <span id="slugPreview" class="text-saltora-terracotta font-semibold">/category-slug</span>
                    </div>
                </div>

                <!-- Status Select -->
                <div>
                    <label for="status" class="block font-bold text-xs text-stone-800 mb-1.5 uppercase tracking-wider" data-i18n-de="STATUS *" data-i18n-en="STATUS *">
                        STATUS *
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs font-semibold outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs"
                    >
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }} data-i18n-de="Aktiv (Sichtbar im Katalog & Navigation)" data-i18n-en="Active (Visible in Catalog & Navigation)">Active (Visible in Catalog & Navigation)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }} data-i18n-de="Entwurf (Versteckt)" data-i18n-en="Draft (Hidden)">Draft (Hidden)</option>
                    </select>
                </div>

            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block font-bold text-xs text-stone-800 mb-1.5 uppercase tracking-wider" data-i18n-de="BESCHREIBUNG" data-i18n-en="DESCRIPTION">
                    DESCRIPTION
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4" 
                    placeholder="Short summary for luxury catalog display and search engines..."
                    data-i18n-placeholder-de="Kurze Zusammenfassung für Luxuskatalog und SEO..."
                    data-i18n-placeholder-en="Short summary for luxury catalog display and search engines..."
                    class="w-full p-4 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs font-medium outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs leading-relaxed"
                >{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                
                <!-- Display Sort Order -->
                <div>
                    <label for="order_index" class="block font-bold text-xs text-stone-800 mb-1.5 uppercase tracking-wider" data-i18n-de="SORTIERUNG / REIHENFOLGE" data-i18n-en="SORT ORDER / INDEX">
                        SORT ORDER / INDEX
                    </label>
                    <input 
                        type="number" 
                        name="order_index" 
                        id="order_index" 
                        value="{{ old('order_index', $suggestedOrder ?? 0) }}" 
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs font-medium outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs font-mono"
                    >
                    <p class="text-[0.68rem] text-stone-400 mt-1 font-medium" data-i18n-de="Niedrigere Werte werden zuerst in der Navigation angezeigt." data-i18n-en="Lower numbers display first in menu and homepage slider.">Lower numbers display first in menu and homepage slider.</p>
                </div>

                <!-- Category Image Upload -->
                <div>
                    <label for="catImageInput" class="block font-bold text-xs text-stone-800 mb-1.5 uppercase tracking-wider" data-i18n-de="KATEGORIE BILD / COVER" data-i18n-en="CATEGORY IMAGE / COVER">
                        CATEGORY IMAGE / COVER
                    </label>
                    <input 
                        type="file" 
                        name="image" 
                        id="catImageInput" 
                        accept="image/*"
                        onchange="previewCategoryImage(this)"
                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-saltora-blush file:text-saltora-terracotta hover:file:bg-saltora-blush/80 h-10 px-2 rounded-xl border border-stone-200 bg-stone-50 text-stone-900 text-xs cursor-pointer shadow-2xs"
                    >
                    
                    <!-- Live Image Preview -->
                    <div id="imagePreviewContainer" class="mt-3 hidden items-center gap-3 p-3 rounded-xl bg-stone-50 border border-stone-200">
                        <img id="imagePreviewImg" src="" alt="Category Preview" class="h-16 w-16 object-cover rounded-lg border border-stone-200 shadow-2xs">
                        <span class="text-xs text-stone-500 font-medium">Selected Image Preview</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer Actions Bar -->
        <div class="px-6 py-4 bg-stone-50/70 border-t border-stone-200/80 flex items-center justify-between">
            <a href="{{ route('admin.categories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs transition-all flex items-center gap-1.5 cursor-pointer shadow-2xs">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Abbrechen" data-i18n-en="Cancel">Cancel</span>
            </a>

            <button 
                type="submit" 
                class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all flex items-center gap-2 cursor-pointer shadow-md"
            >
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span data-i18n-de="Kategorie Jetzt Speichern" data-i18n-en="Save Category Now">Save Category Now</span>
            </button>
        </div>

    </form>

</div>

<script>
    // Live Slug Preview Generator
    const nameInput = document.getElementById('catNameInput');
    const slugPreview = document.getElementById('slugPreview');

    if (nameInput && slugPreview) {
        nameInput.addEventListener('input', function() {
            const val = this.value.trim().toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugPreview.textContent = '/' + (val || 'category-slug');
        });
    }

    // Live Image Preview
    function previewCategoryImage(input) {
        const container = document.getElementById('imagePreviewContainer');
        const img = document.getElementById('imagePreviewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                container.classList.remove('hidden');
                container.classList.add('flex');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

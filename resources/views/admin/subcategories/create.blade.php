@extends('layouts.admin')
@section('title', 'Add New Subcategory - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-3.5 w-full pb-10 text-[#1c1210]">

    <!-- 1. Clean Breadcrumb Pill -->
    <div class="bg-gradient-to-r from-white via-[#FAF7F2] to-white rounded-xl py-2.5 px-4 text-xs font-semibold text-stone-600 border border-[#ebdccb] shadow-2xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.subcategories') }}" class="text-[#8a7c74] hover:text-[#78000b] transition flex items-center gap-1.5 font-bold" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">
                <svg class="w-3.5 h-3.5 text-[#78000b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>Subcategories</span>
            </a>
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-[#78000b] font-bold" data-i18n-de="Neue Unterkategorie" data-i18n-en="New Subcategory">New Subcategory</span>
        </div>
    </div>

    <!-- 2. Colorful Form Card Container -->
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-[#ebdccb] shadow-xs overflow-hidden border-t-4 border-t-[#78000b]">
        @csrf

        <!-- Header with Balanced Spacing & Warm Atelier Gradient -->
        <div class="px-5 py-3.5 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] flex items-center justify-between gap-3 border-b border-[#ebdccb]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Neue Unterkategorie Hinzufügen" data-i18n-en="Add New Subcategory">
                        Add New Subcategory
                    </h2>
                </div>
            </div>
        </div>

        <!-- Form Body with Clean Compact Spacing -->
        <div class="p-5 sm:p-6 text-xs space-y-4">
            
            @if ($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 space-y-1 shadow-2xs">
                    <p class="font-bold text-xs flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Please correct the errors below:</span>
                    </p>
                    <ul class="list-disc list-inside text-[0.7rem] pl-5 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Row 1: Parent Category & Subcategory Name -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Parent Category -->
                <div>
                    <label for="category_id" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                        Parent Category <span class="text-[#78000b] font-bold">*</span>
                    </label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        required 
                        class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                    >
                        <option value="">-- Select Parent Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Name -->
                <div>
                    <label for="subNameInput" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                        Subcategory Name <span class="text-[#78000b] font-bold">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="subNameInput" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="e.g. Slim Bifold Wallets"
                        class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                    >
                </div>

            </div>

            <!-- Row 2: Catalog Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                        Catalog Status <span class="text-[#78000b] font-bold">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full h-10 px-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                    >
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>• Active (Visible in Storefront & Menu)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>• Draft (Hidden from Storefront)</option>
                    </select>
                </div>
            </div>

            <!-- Row 3: Description & Tagline -->
            <div>
                <label for="description" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                    Description & Tagline
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    placeholder="Brief poetic description of the subcategory for luxury catalog display and Google SEO..."
                    class="w-full p-3.5 rounded-xl border border-[#ebdccb] bg-[#fdfbf9] text-stone-900 text-xs font-normal outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition leading-relaxed shadow-2xs"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Row 4: Banner Image Upload (Clean, Luxury Atelier Style) -->
            <div>
                <label class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#483732] mb-1.5">
                    Banner Image
                </label>
                
                <div class="rounded-xl border border-[#ebdccb] p-4 shadow-2xs" style="background: linear-gradient(135deg, #fdfbf7 0%, #f6ede0 100%);">
                    
                    <div class="flex flex-col sm:flex-row items-center gap-3.5">
                        <!-- Thumbnail / Placeholder Frame -->
                        <div id="sub_banner_preview_box" class="w-14 h-14 rounded-xl bg-white border border-[#ebdccb] flex items-center justify-center text-[#78000b] shrink-0 overflow-hidden shadow-xs">
                            <img id="sub_banner_preview_img" src="" class="hidden w-full h-full object-cover">
                            <svg id="sub_banner_placeholder_svg" class="w-7 h-7 text-[#78000b]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>

                        <!-- Upload Button & Clear Visibility Hint -->
                        <div class="flex-1 text-center sm:text-left space-y-1">
                            <input 
                                type="file" 
                                name="image" 
                                id="subImageInput" 
                                accept="image/*"
                                onchange="previewSubcategoryImage(this)"
                                class="hidden"
                            >
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5">
                                <button 
                                    type="button" 
                                    onclick="document.getElementById('subImageInput').click()" 
                                    class="h-9 px-4 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-xs cursor-pointer active:scale-95"
                                    style="background: #181210 !important; color: #ffffff !important;"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: #ffffff !important;"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <span style="color: #ffffff !important;">Upload from Computer</span>
                                </button>
                                <span id="sub_banner_filename" class="text-[0.7rem] font-semibold text-[#685c54]">PNG, JPG, WEBP up to 10MB</span>
                            </div>
                            <p class="text-[0.65rem] text-[#8a7c74]">Recommended: 800×800px (Square) or 1200×800px (Landscape)</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Footer Actions Bar -->
        <div class="px-6 py-4 bg-stone-50/80 border-t border-stone-200/80 flex items-center justify-between">
            <a href="{{ route('admin.subcategories') }}" class="btn-exec-secondary rounded-xl px-5 py-2.5 text-xs transition-all flex items-center gap-2 cursor-pointer shadow-2xs">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Abbrechen" data-i18n-en="Cancel">Cancel</span>
            </a>

            <button 
                type="submit" 
                class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs transition-all flex items-center gap-2 cursor-pointer shadow-md active:scale-95"
            >
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Save Subcategory</span>
            </button>
        </div>

    </form>

</div>

<script>
    // Live Image Preview Handler
    function previewSubcategoryImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('sub_banner_preview_img');
                const svg = document.getElementById('sub_banner_placeholder_svg');
                const fn = document.getElementById('sub_banner_filename');
                if (img) { img.src = e.target.result; img.classList.remove('hidden'); }
                if (svg) { svg.classList.add('hidden'); }
                if (fn) {
                    fn.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                    fn.className = 'text-xs text-emerald-700 font-bold';
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Add New Category - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 w-full pb-12 text-[#1c1210]">

    <!-- 1. Minimalist Clean Breadcrumb Pill -->
    <div class="bg-white rounded-xl py-2.5 px-4 text-xs font-semibold text-stone-600 border border-[#e5ded5] shadow-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.categories') }}" class="text-stone-400 hover:text-[#78000b] transition" data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</a>
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Neue Kategorie" data-i18n-en="New Category">New Category</span>
        </div>
        <span class="text-[0.65rem] text-[#2e683a] bg-[#2e683a]/10 px-2.5 py-0.5 rounded-full font-bold border border-[#2e683a]/20 flex items-center gap-1.5 whitespace-nowrap">
            <span class="w-1.5 h-1.5 rounded-full bg-[#2e683a] animate-pulse"></span>
            <span>Auto-Sorting Enabled</span>
        </span>
    </div>

    <!-- 2. Form Container Card -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-[#e5ded5] shadow-xs overflow-hidden">
        @csrf

        <!-- Clean Header -->
        <div class="px-5 py-4 bg-[#faf7f2] flex items-center justify-between gap-3 border-b border-[#f0e8de]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white text-[#78000b] border border-[#ebdccb] flex items-center justify-center shrink-0 shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base font-bold text-[#1c1210] tracking-tight" data-i18n-de="Neue Kategorie Hinzufügen" data-i18n-en="Add New Category">
                        Add New Category
                    </h2>
                    <p class="text-[0.68rem] text-[#8a7c74]" data-i18n-de="Erstellen Sie eine neue Hauptkategorie für Ihren Luxuskatalog." data-i18n-en="Create a top-level category with automatic storefront synchronization.">
                        Create a top-level category with automatic storefront synchronization.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Body (Compact & High-Density) -->
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

            <!-- Row 1: Name & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                
                <!-- Category Name -->
                <div>
                    <label for="catNameInput" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                        Category Name <span class="text-[#78000b]">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="catNameInput" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="e.g. Leather Briefcases"
                        class="w-full h-9 px-3 rounded-lg border border-[#ebdccb] bg-[#faf7f2]/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/10 transition"
                    >
                    <div class="flex items-center gap-1 text-[0.65rem] text-[#8a7c74] mt-1 font-mono">
                        <span>URL:</span>
                        <span id="slugPreview" class="text-[#78000b] font-semibold">/category-slug</span>
                    </div>
                </div>

                <!-- Status Select -->
                <div>
                    <label for="status" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                        Catalog Status <span class="text-[#78000b]">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full h-9 px-3 rounded-lg border border-[#ebdccb] bg-[#faf7f2]/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/10 transition"
                    >
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active (Visible in Storefront)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                    <p class="text-[0.65rem] text-[#8a7c74] mt-1">Control instant visibility in navigation & shop filter.</p>
                </div>

            </div>

            <!-- Row 2: Description -->
            <div>
                <label for="description" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                    Description
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    placeholder="Short summary for luxury catalog display and search engines..."
                    class="w-full p-3 rounded-lg border border-[#ebdccb] bg-[#faf7f2]/60 text-stone-900 text-xs font-normal outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/10 transition leading-relaxed"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Row 3: Category Cover Image Upload (Modern Dropzone Box) -->
            <div>
                <label class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                    Category Cover Image
                </label>
                
                <div class="rounded-xl border border-dashed border-[#d9cebc] bg-[#faf7f2]/40 hover:bg-[#faf7f2] hover:border-[#78000b]/50 p-4 transition text-center relative cursor-pointer" onclick="document.getElementById('catImageInput').click()">
                    <input 
                        type="file" 
                        name="image" 
                        id="catImageInput" 
                        accept="image/*"
                        onchange="previewCategoryImage(this)"
                        class="hidden"
                    >

                    <!-- Empty Upload State -->
                    <div id="uploadPromptContainer" class="flex flex-col items-center justify-center gap-1.5 py-1">
                        <div class="w-8 h-8 rounded-full bg-white border border-[#ebdccb] flex items-center justify-center text-[#78000b] shadow-2xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-xs font-semibold text-[#1c1210]">
                            Click to upload <span class="font-normal text-[#8a7c74]">or drag & drop cover image</span>
                        </p>
                        <p class="text-[0.65rem] text-[#8a7c74]">
                            JPG, PNG, or WebP • Recommended: 800×800px or 1200×800px
                        </p>
                    </div>

                    <!-- Selected Image Preview State -->
                    <div id="imagePreviewContainer" class="hidden items-center justify-center gap-3 py-1">
                        <img id="imagePreviewImg" src="" alt="Cover Preview" class="h-16 w-16 object-cover rounded-lg border border-[#ebdccb] shadow-sm">
                        <div class="text-left">
                            <p id="imagePreviewName" class="text-xs font-bold text-[#1c1210] truncate max-w-xs">image.jpg</p>
                            <p class="text-[0.65rem] text-[#2e683a] font-semibold">Ready for upload</p>
                            <button type="button" onclick="event.stopPropagation(); removeSelectedImage();" class="text-[0.65rem] text-[#78000b] hover:underline font-bold mt-0.5">
                                Change Image
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 3. Clean Footer Actions Bar (Single-Wording, Zero Duplication) -->
        <div class="px-5 py-3.5 bg-[#faf7f2] border-t border-[#f0e8de] flex items-center justify-between">
            <a href="{{ route('admin.categories') }}" class="h-8 px-4 rounded-lg text-xs font-semibold text-[#685c54] bg-white border border-[#d9cebc] hover:bg-[#f0e7d8] transition flex items-center gap-1.5">
                <span>Cancel</span>
            </a>

            <button 
                type="submit" 
                class="h-8 px-5 rounded-lg text-xs font-bold uppercase tracking-wider text-white bg-[#78000b] hover:bg-[#5a0309] transition flex items-center gap-1.5 shadow-sm active:scale-95 cursor-pointer"
            >
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span>Save Category</span>
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

    // Live Image Preview Handler
    function previewCategoryImage(input) {
        const promptContainer = document.getElementById('uploadPromptContainer');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const img = document.getElementById('imagePreviewImg');
        const nameLabel = document.getElementById('imagePreviewName');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            nameLabel.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                promptContainer.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            };
            reader.readAsDataURL(file);
        }
    }

    function removeSelectedImage() {
        const input = document.getElementById('catImageInput');
        const promptContainer = document.getElementById('uploadPromptContainer');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const img = document.getElementById('imagePreviewImg');

        input.value = '';
        img.src = '';
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
        promptContainer.classList.remove('hidden');
    }
</script>
@endsection

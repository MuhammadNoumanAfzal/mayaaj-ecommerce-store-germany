@extends('layouts.admin')
@section('title', 'Edit Category - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 w-full pb-12 text-[#1c1210]">

    <!-- 1. Minimalist Clean Breadcrumb Pill -->
    <div class="bg-white rounded-xl py-2.5 px-4 text-xs font-semibold text-stone-600 border border-[#e5ded5] shadow-xs flex items-center justify-between">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.categories') }}" class="text-stone-400 hover:text-[#78000b] transition" data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</a>
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold">Edit: {{ $category->name }}</span>
        </div>
        <a href="{{ route('shop', ['category' => $category->slug]) }}" target="_blank" class="text-[0.68rem] font-bold text-[#78000b] hover:underline flex items-center gap-1">
            <span>↗</span> <span>View in Storefront</span>
        </a>
    </div>

    <!-- 2. Form Container Card -->
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-[#e5ded5] shadow-xs overflow-hidden">
        @csrf
        @method('PUT')

        <!-- Clean Header -->
        <div class="px-5 py-4 bg-[#faf7f2] flex items-center justify-between gap-3 border-b border-[#f0e8de]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white text-[#78000b] border border-[#ebdccb] flex items-center justify-center shrink-0 shadow-2xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="font-serif text-base font-bold text-[#1c1210] tracking-tight">
                            Edit Category: <span class="text-[#78000b]">{{ $category->name }}</span>
                        </h2>
                        <span class="inline-flex items-center px-2 py-0.2 rounded-full text-[0.6rem] font-bold uppercase {{ $category->status === 'active' ? 'bg-[#2e683a]/15 text-[#2e683a] border border-[#2e683a]/30' : 'bg-stone-100 text-stone-600 border border-stone-200' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </div>
                    <p class="text-[0.68rem] text-[#8a7c74]">
                        Update details and cover image with real-time storefront synchronization.
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
                    <label for="catEditNameInput" class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                        Category Name <span class="text-[#78000b]">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="catEditNameInput" 
                        value="{{ old('name', $category->name) }}" 
                        required 
                        class="w-full h-9 px-3 rounded-lg border border-[#ebdccb] bg-[#faf7f2]/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/10 transition"
                    >
                    <div class="flex items-center gap-1 text-[0.65rem] text-[#8a7c74] mt-1 font-mono">
                        <span>URL:</span>
                        <span id="slugEditPreview" class="text-[#78000b] font-semibold">/{{ $category->slug }}</span>
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
                        <option value="active" {{ old('status', $category->status) === 'active' ? 'selected' : '' }}>Active (Visible in Storefront)</option>
                        <option value="draft" {{ old('status', $category->status) === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
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
                    class="w-full p-3 rounded-lg border border-[#ebdccb] bg-[#faf7f2]/60 text-stone-900 text-xs font-normal outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/10 transition leading-relaxed"
                >{{ old('description', $category->description) }}</textarea>
            </div>

            <!-- Row 3: Category Cover Image Upload (Modern Dropzone Box) -->
            <div>
                <label class="block font-bold text-[0.68rem] uppercase tracking-wider text-[#685c54] mb-1.5">
                    Category Cover Image
                </label>
                
                <div class="rounded-xl border border-dashed border-[#d9cebc] bg-[#faf7f2]/40 hover:bg-[#faf7f2] hover:border-[#78000b]/50 p-4 transition text-center relative cursor-pointer" onclick="document.getElementById('editCatImageInput').click()">
                    <input 
                        type="file" 
                        name="image" 
                        id="editCatImageInput" 
                        accept="image/*"
                        onchange="previewEditCategoryImage(this)"
                        class="hidden"
                    >

                    @if($category->image)
                        <!-- Current Image Display State -->
                        <div id="currentImageContainer" class="flex items-center justify-center gap-3.5 py-1">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-16 w-16 object-cover rounded-lg border border-[#ebdccb] shadow-sm">
                            <div class="text-left">
                                <p class="text-xs font-bold text-[#1c1210]">Current Cover Active</p>
                                <p class="text-[0.65rem] text-[#8a7c74]">Click anywhere to choose a new file to replace it</p>
                                <span class="inline-block text-[0.65rem] text-[#78000b] font-bold mt-0.5">Replace Image ↗</span>
                            </div>
                        </div>
                    @else
                        <!-- Empty Upload State -->
                        <div id="currentImageContainer" class="flex flex-col items-center justify-center gap-1.5 py-1">
                            <div class="w-8 h-8 rounded-full bg-white border border-[#ebdccb] flex items-center justify-center text-[#78000b] shadow-2xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-xs font-semibold text-[#1c1210]">Click to upload cover image</p>
                            <p class="text-[0.65rem] text-[#8a7c74]">JPG, PNG, or WebP</p>
                        </div>
                    @endif

                    <!-- New Selected Image Preview State -->
                    <div id="newImagePreviewContainer" class="hidden items-center justify-center gap-3 py-1">
                        <img id="newImagePreviewImg" src="" alt="New Preview" class="h-16 w-16 object-cover rounded-lg border border-[#2e683a]/40 shadow-sm">
                        <div class="text-left">
                            <p id="newImagePreviewName" class="text-xs font-bold text-[#1c1210] truncate max-w-xs">new-image.jpg</p>
                            <p class="text-[0.65rem] text-[#2e683a] font-semibold">Will replace cover upon saving</p>
                            <button type="button" onclick="event.stopPropagation(); resetEditImage();" class="text-[0.65rem] text-[#78000b] hover:underline font-bold mt-0.5">
                                Keep Existing Cover
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
                <span>Save Changes</span>
            </button>
        </div>

    </form>

</div>

<script>
    // Live Slug Preview Generator
    const editNameInput = document.getElementById('catEditNameInput');
    const slugEditPreview = document.getElementById('slugEditPreview');

    if (editNameInput && slugEditPreview) {
        editNameInput.addEventListener('input', function() {
            const val = this.value.trim().toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugEditPreview.textContent = '/' + (val || 'category-slug');
        });
    }

    // Live Image Preview Handler
    function previewEditCategoryImage(input) {
        const currentContainer = document.getElementById('currentImageContainer');
        const previewContainer = document.getElementById('newImagePreviewContainer');
        const img = document.getElementById('newImagePreviewImg');
        const nameLabel = document.getElementById('newImagePreviewName');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            nameLabel.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                if (currentContainer) currentContainer.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                previewContainer.classList.add('flex');
            };
            reader.readAsDataURL(file);
        }
    }

    function resetEditImage() {
        const input = document.getElementById('editCatImageInput');
        const currentContainer = document.getElementById('currentImageContainer');
        const previewContainer = document.getElementById('newImagePreviewContainer');
        const img = document.getElementById('newImagePreviewImg');

        input.value = '';
        img.src = '';
        previewContainer.classList.add('hidden');
        previewContainer.classList.remove('flex');
        if (currentContainer) currentContainer.classList.remove('hidden');
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Add New Subcategory - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 w-full pb-12">

    <!-- Form Container Card (Pink-Salt Atelier Luxury Style) -->
    <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data" class="exec-card bg-white rounded-2xl border border-[#ebdccb] shadow-md overflow-hidden border-t-4 border-t-[#78000b]">
        @csrf

        <!-- Top Header with Actions -->
        <div class="px-6 py-4 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] flex flex-wrap items-center justify-between gap-3 border-b border-[#ebdccb]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-sm" style="background: linear-gradient(135deg, #78000b 0%, #4a0207 100%) !important; color: #d8b45a !important; border: 1px solid rgba(216, 180, 90, 0.45) !important;">
                    <svg class="w-4 h-4 text-[#d8b45a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <h2 class="font-serif text-base sm:text-lg font-bold text-[#1c1210] tracking-tight leading-tight" data-i18n-de="Neue Unterkategorie Hinzufügen" data-i18n-en="Add New Subcategory">
                        Add New Subcategory
                    </h2>
                </div>
            </div>
            
            <div class="flex items-center gap-2.5">
                <a href="{{ route('admin.subcategories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                    <span data-i18n-de="Zurück" data-i18n-en="Back">Back</span>
                </a>
                <button 
                    type="submit" 
                    class="btn-exec-primary rounded-xl px-5 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-md active:scale-95"
                >
                    <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Save Subcategory</span>
                </button>
            </div>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8 text-xs space-y-4">
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Parent Category -->
                <div>
                    <label for="category_id" class="block font-bold text-[0.7rem] text-[#685c54] mb-1.5 uppercase tracking-wider cursor-pointer">
                        Parent Category <span class="text-[#78000b]">*</span>
                    </label>
                    <select 
                        name="category_id" 
                        id="category_id" 
                        required 
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                    >
                        <option value="">-- Select Parent Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Subcategory Name -->
                <div>
                    <label for="name" class="block font-bold text-[0.7rem] text-[#685c54] mb-1.5 uppercase tracking-wider cursor-pointer">
                        Subcategory Name <span class="text-[#78000b]">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="e.g. Slim Bifold Wallets"
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                    >
                </div>

            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block font-bold text-[0.7rem] text-[#685c54] mb-1.5 uppercase tracking-wider cursor-pointer">
                    Description
                </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="3" 
                    placeholder="Short description for luxury catalog display..."
                    class="w-full p-3.5 rounded-xl border border-stone-200 bg-stone-50/60 text-stone-900 text-xs font-medium outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs"
                >{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                
                <!-- Status -->
                <div>
                    <label for="status" class="block font-bold text-[0.7rem] text-[#685c54] mb-1.5 uppercase tracking-wider cursor-pointer">
                        Status <span class="text-[#78000b]">*</span>
                    </label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full h-10 px-4 rounded-xl border border-stone-200 bg-stone-50/60 text-stone-900 text-xs font-semibold outline-none focus:border-[#78000b] focus:bg-white focus:ring-2 focus:ring-[#78000b]/15 transition shadow-2xs cursor-pointer"
                    >
                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active (Visible in Catalog)</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                    </select>
                </div>

                <!-- Banner Image Upload -->
                <div>
                    <label class="block font-bold text-[0.7rem] text-[#685c54] mb-1.5 uppercase tracking-wider cursor-pointer">
                        Subcategory Image
                    </label>
                    
                    <div class="rounded-2xl border border-[#ebdccb] bg-[#FAF7F2] p-3 flex items-center gap-3">
                        <div id="sub_create_preview_box" class="w-12 h-12 rounded-xl bg-stone-200/70 border border-stone-300 flex items-center justify-center text-stone-400 shrink-0 overflow-hidden shadow-2xs">
                            <img id="sub_create_preview_img" src="" class="hidden w-full h-full object-cover">
                            <svg id="sub_create_placeholder_svg" class="w-6 h-6 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>

                        <div class="space-y-0.5">
                            <input type="file" name="image" id="sub_create_file" accept="image/*" class="hidden" onchange="previewSubCreateImage(this)">
                            <button 
                                type="button" 
                                onclick="document.getElementById('sub_create_file').click()" 
                                class="h-8 px-3.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer active:scale-95"
                                style="background: #181210 !important; color: #ffffff !important;"
                            >
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: #ffffff !important;"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <span style="color: #ffffff !important;">Upload from Computer</span>
                            </button>
                            <p id="sub_create_filename" class="text-[0.65rem] text-[#8a7c74]">PNG, JPG, WEBP up to 10MB</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer Actions Bar -->
        <div class="px-6 py-3.5 bg-gradient-to-r from-[#fdfbf8] via-[#f7eee4] to-[#fbf5ef] border-t border-[#ebdccb] flex items-center justify-between">
            <a href="{{ route('admin.subcategories') }}" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span data-i18n-de="Abbrechen" data-i18n-en="Cancel">Cancel</span>
            </a>

            <button 
                type="submit" 
                class="btn-exec-primary rounded-xl px-6 py-2.5 text-xs font-bold transition flex items-center gap-2 cursor-pointer shadow-md active:scale-95"
            >
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span data-i18n-de="Unterkategorie Speichern" data-i18n-en="Save Subcategory">Save Subcategory</span>
            </button>
        </div>

    </form>

</div>

<script>
    function previewSubCreateImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('sub_create_preview_img');
                const svg = document.getElementById('sub_create_placeholder_svg');
                const fn = document.getElementById('sub_create_filename');
                if (img) { img.src = e.target.result; img.classList.remove('hidden'); }
                if (svg) { svg.classList.add('hidden'); }
                if (fn) {
                    fn.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                    fn.className = 'text-[0.65rem] text-emerald-700 font-bold';
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

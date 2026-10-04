@extends('layouts.admin')
@section('title', 'Categories Management - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-stone-600 border border-stone-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-stone-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-stone-300 font-mono">›</span> 
            <span class="text-stone-900 font-bold" data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-stone-400" data-i18n-de="Gesamt Kategorien:" data-i18n-en="Total Categories:">Total Categories:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/20 shadow-2xs">{{ count($categories) }}</span>
        </div>
    </div>

    <!-- Main Categories Executive Card (Pink-Salt Style) -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm overflow-hidden border-t-4 border-t-saltora-terracotta">
        
        <!-- Clean White Card Header with Terracotta Add Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span data-i18n-de="Kategorien Übersichtsleiste" data-i18n-en="Categories Overview Bar">Categories Overview Bar</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Shop-Kategorien und Produkt-Hierarchien." data-i18n-en="Manage store categories and product hierarchies.">Manage store categories and product hierarchies.</p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
            </a>
        </div>

        <!-- Table Filters & Search Bar Toolbar -->
        <div class="p-5 sm:p-6 bg-stone-50/60 border-b border-stone-200/80 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-stone-700">
                
                <!-- Left: Full Width Search Form -->
                <form action="{{ route('admin.categories') }}" method="GET" class="flex items-center gap-2.5 w-full sm:flex-1 sm:max-w-md">
                    <div class="relative w-full">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search category by name or description..."
                            data-i18n-placeholder-de="Kategorie nach Name oder Beschreibung suchen..."
                            data-i18n-placeholder-en="Search category by name or description..."
                            class="h-10 w-full pl-10 pr-4 rounded-xl border border-stone-200 bg-white text-xs font-medium text-stone-900 outline-none focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 shadow-2xs placeholder:text-stone-400"
                        >
                        <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search'))
                        <a href="{{ route('admin.categories') }}" class="btn-exec-secondary px-3.5 py-2 rounded-xl text-xs transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

                <!-- Right: Show Entries Selector -->
                <div class="flex items-center gap-2 shrink-0">
                    <span class="text-stone-600 font-bold" data-i18n-de="Zeige" data-i18n-en="Show">Show</span>
                    <select class="h-9 px-3 rounded-xl border border-stone-200 bg-white text-stone-900 font-semibold outline-none focus:border-saltora-terracotta shadow-2xs">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-stone-600 font-bold" data-i18n-de="Einträge" data-i18n-en="entries">entries</span>
                </div>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="exec-table-head bg-stone-50 text-stone-800 font-extrabold uppercase tracking-wider text-[0.7rem] border-y border-stone-200">
                        <th class="py-4 px-6 font-black" data-i18n-de="Kategorie Name" data-i18n-en="Category Name">Category Name</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Beschreibung" data-i18n-en="Description">Description</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Logo / Bild" data-i18n-en="Image">Image</th>
                        <th class="py-4 px-6 font-black" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-4 px-6 font-black text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium">
                    @forelse($categories as $category)
                        <tr class="exec-table-row hover:bg-stone-50/90 transition-colors duration-150 border-b border-stone-200/80">
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-stone-900 text-sm tracking-tight block">
                                    {{ $category->name }}
                                </span>
                                <span class="text-[0.68rem] text-stone-400 font-mono">/{{ $category->slug }}</span>
                            </td>
                            <td class="py-4 px-6 text-stone-700 font-medium max-w-sm">
                                @if($category->description)
                                    {{ $category->description }}
                                @else
                                    <span class="text-stone-400 italic" data-i18n-de="Keine Beschreibung" data-i18n-en="No description">No description</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="h-12 w-12 rounded-xl overflow-hidden bg-[#F8F5EF] border border-stone-200/90 shadow-2xs flex items-center justify-center shrink-0 group">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                        <div class="hidden text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @else
                                        <div class="text-stone-400 flex items-center justify-center w-full h-full bg-stone-100">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($category->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-active">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                        <span data-i18n-de="Aktiv" data-i18n-en="Active">Active</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider badge-draft">
                                        <span class="h-1.5 w-1.5 rounded-full bg-stone-500"></span>
                                        <span data-i18n-de="Entwurf" data-i18n-en="Draft">Draft</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <a
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn-exec-secondary rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Edit</span>
                                    </a>

                                    <!-- Delete Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        class="btn-exec-danger rounded-xl px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Delete</span>
                                    </button>

                                    <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-stone-500 text-xs">
                                <p class="text-base font-bold text-stone-700 mb-1" data-i18n-de="Keine Kategorien gefunden" data-i18n-en="No categories found">No categories found</p>
                                <p data-i18n-de="Erstellen Sie Ihre erste Kategorie über den Button oben." data-i18n-en="Create your first category using the button above.">Create your first category using the button above.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
    function confirmDeleteCategory(id, name) {
        const isEn = (window.__mehaaj_lang || 'en') === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Category?' : 'Kategorie löschen?',
            text: isEn 
                ? `Are you sure you want to delete "${name}"? All assigned subcategories will also be deleted.` 
                : `Möchten Sie "${name}" wirklich löschen? Alle zugewiesenen Unterkategorien werden ebenfalls gelöscht.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            confirmButtonText: isEn ? 'Yes, Delete' : 'Ja, Löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-category-form-' + id).submit();
            }
        });
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Kategorien verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-slate-400" data-i18n-de="Gesamt Kategorien:" data-i18n-en="Total Categories:">Gesamt Kategorien:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-200/60 shadow-2xs">{{ count($categories) }}</span>
        </div>
    </div>

    <!-- Main Categories Executive Card -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden border-t-4 border-t-indigo-600">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-5 bg-white border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-slate-900 tracking-tight flex items-center gap-2.5" data-i18n-de="Kategorien" data-i18n-en="Categories">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Kategorien Übersichtsleiste
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Shop-Kategorien und Produkt-Hierarchien." data-i18n-en="Manage store categories and product hierarchies.">Verwalten Sie Shop-Kategorien und Produkt-Hierarchien.</p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}" class="rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white px-5 py-2.5 text-xs font-bold transition-all shadow-md shadow-indigo-500/20 hover:shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Kategorie Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Search Bar Toolbar -->
        <div class="p-5 sm:p-6 bg-slate-50/60 border-b border-slate-100 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <span class="text-slate-500" data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-xl border border-slate-200 bg-white text-slate-800 font-medium outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="text-slate-500" data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('admin.categories') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Kategorie suchen..."
                            data-i18n-placeholder-de="Kategorie suchen..."
                            data-i18n-placeholder-en="Search category..."
                            class="h-9 w-full pl-9 pr-4 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs placeholder:text-slate-400"
                        >
                        <svg class="h-4 w-4 absolute left-3 top-2.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search'))
                        <a href="{{ route('admin.categories') }}" class="px-3 py-2 rounded-xl bg-slate-200/70 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-100/70 text-slate-600 font-extrabold uppercase tracking-wider text-[0.68rem] border-b border-slate-200">
                        <th class="py-3.5 px-5" data-i18n-de="Name" data-i18n-en="Name">Name</th>
                        <th class="py-3.5 px-5" data-i18n-de="Slug" data-i18n-en="Slug">Slug</th>
                        <th class="py-3.5 px-5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</th>
                        <th class="py-3.5 px-5" data-i18n-de="Logo / Bild" data-i18n-en="Image">Logo / Bild</th>
                        <th class="py-3.5 px-5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-5">
                                <span class="font-extrabold text-slate-900 text-sm tracking-tight block">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="py-4 px-5">
                                <span class="rounded-lg bg-indigo-50/80 border border-indigo-100 text-indigo-700 px-2.5 py-1 text-[0.68rem] font-mono font-bold tracking-tight inline-block shadow-2xs">
                                    {{ $category->slug }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-slate-600 font-medium max-w-xs truncate">
                                {{ $category->description ?? '— Keine Beschreibung —' }}
                            </td>
                            <td class="py-4 px-5">
                                @if($category->image_url)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover rounded-xl border border-slate-200 shadow-2xs transition-transform duration-200 hover:scale-105">
                                @else
                                    <span class="text-slate-400 italic text-[0.7rem]" data-i18n-de="Kein Bild" data-i18n-en="No Image">Kein Bild</span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                @if($category->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[0.65rem] font-extrabold uppercase tracking-wide">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-200 text-[0.65rem] font-extrabold uppercase tracking-wide">
                                        <span data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</span>
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Soft Pill Button -->
                                    <a 
                                        href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200/80 px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                        data-i18n-de="Bearbeiten"
                                        data-i18n-en="Edit"
                                    >
                                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span data-i18n-de="Bearbeiten" data-i18n-en="Edit">Bearbeiten</span>
                                    </a>

                                    <!-- Delete Soft Pill Button -->
                                    <button
                                        type="button"
                                        onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                        class="rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/80 px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                        data-i18n-de="Löschen"
                                        data-i18n-en="Delete"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Löschen</span>
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
                            <td colspan="6" class="py-12 px-6 text-center text-slate-500 text-xs">
                                <p class="text-base font-bold text-slate-700 mb-1" data-i18n-de="Keine Kategorien gefunden" data-i18n-en="No categories found">Keine Kategorien gefunden</p>
                                <p data-i18n-de="Erstellen Sie Ihre erste Kategorie über den Button oben." data-i18n-en="Create your first category using the button above.">Erstellen Sie Ihre erste Kategorie über den Button oben.</p>
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
        LuxurySwal.fire({
            title: 'Kategorie löschen?',
            text: `Möchten Sie "${name}" wirklich löschen? Alle zugewiesenen Unterkategorien werden ebenfalls gelöscht.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ja, Kategorie löschen',
            cancelButtonText: 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-category-form-' + id).submit();
            }
        });
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Kategorien verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-100 flex items-center justify-between">
        <div>
            <span data-i18n-de="MEHAAJ Admin Dashboard" data-i18n-en="MEHAAJ Admin Dashboard">MEHAAJ Admin Dashboard</span> 
            <span class="mx-1.5 text-slate-400 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium">
            <span data-i18n-de="Gesamt:" data-i18n-en="Total:">Gesamt:</span> <span class="text-[#194AA2] font-bold">{{ count($categories) }}</span>
        </div>
    </div>

    <!-- Main Categories Card -->
    <div class="exec-card overflow-hidden">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-lg text-slate-900 tracking-tight" data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</h2>
                <p class="text-xs text-slate-500 font-medium" data-i18n-de="Verwalten Sie Shop-Kategorien und Hierarchien" data-i18n-en="Manage store categories and hierarchies">Verwalten Sie Shop-Kategorien und Hierarchien</p>
            </div>
            
            <a href="{{ route('admin.categories.create') }}" class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-xs font-bold transition shadow-xs flex items-center gap-1.5 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Kategorie Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-indigo-500">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span data-i18n-de="Einträge" data-i18n-en="entries">Einträge</span>
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('admin.categories') }}" method="GET" class="flex items-center gap-2 w-full sm:w-auto">
                    <span data-i18n-de="Suche:" data-i18n-en="Search:">Suche:</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Kategorie suchen..."
                        data-i18n-placeholder-de="Kategorie suchen..."
                        data-i18n-placeholder-en="Search category..."
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-indigo-500 w-full sm:w-56 shadow-2xs"
                    >
                    @if(request('search'))
                        <a href="{{ route('admin.categories') }}" class="text-xs text-rose-500 hover:underline" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="exec-table-head">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Name" data-i18n-en="Name">Name</th>
                            <th class="p-3.5" data-i18n-de="Slug" data-i18n-en="Slug">Slug</th>
                            <th class="p-3.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</th>
                            <th class="p-3.5" data-i18n-de="Logo / Bild" data-i18n-en="Image">Logo / Bild</th>
                            <th class="p-3.5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($categories as $category)
                            <tr class="exec-table-row">
                                <td class="p-3.5 font-bold text-slate-900 text-sm">
                                    {{ $category->name }}
                                </td>
                                <td class="p-3.5">
                                    <span class="rounded-md bg-slate-100 border border-slate-200 text-slate-700 px-2 py-0.5 text-[0.68rem] font-mono font-semibold">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-slate-600 max-w-xs truncate">
                                    {{ $category->description ?? '— Keine Beschreibung —' }}
                                </td>
                                <td class="p-3.5">
                                    @if($category->image_url)
                                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="h-9 w-9 object-cover rounded-lg border border-slate-200 shadow-xs">
                                    @else
                                        <span class="text-slate-400 italic text-[0.7rem]" data-i18n-de="Kein Bild" data-i18n-en="No Image">Kein Bild</span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($category->status === 'active')
                                        <span class="rounded-full badge-soft-active px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="rounded-full badge-soft-pending px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Soft Pill Button -->
                                        <a 
                                            href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Bearbeiten
                                        </a>

                                        <!-- Delete Soft Pill Button -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                            class="rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Löschen
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
                                <td colspan="6" class="p-8 text-center text-slate-400 text-xs">
                                    <p class="text-base font-bold text-slate-600 mb-1" data-i18n-de="Keine Kategorien gefunden" data-i18n-en="No categories found">Keine Kategorien gefunden</p>
                                    <p data-i18n-de="Erstellen Sie Ihre erste Kategorie über den Button oben." data-i18n-en="Create your first category using the button above.">Erstellen Sie Ihre erste Kategorie über den Button oben.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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

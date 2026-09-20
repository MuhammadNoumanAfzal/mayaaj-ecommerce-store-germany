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

    <!-- Main Categories Card matching Screenshot 3 -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        
        <!-- Dark Navy Card Header (#0d2352) with Lime Green Add Button (#84cc16) -->
        <div class="card-navy-header px-6 py-4 flex items-center justify-between" style="background-color: #0d2352 !important; color: #ffffff !important;">
            <h2 class="font-extrabold text-lg text-white tracking-wide" data-i18n-de="Kategorien" data-i18n-en="Categories">Kategorien</h2>
            
            <a href="{{ route('admin.categories.create') }}" class="rounded-full btn-lime-save text-white px-5 py-2 text-xs font-extrabold transition shadow-md flex items-center gap-1.5 cursor-pointer" style="background-color: #84cc16 !important; color: #ffffff !important;">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Kategorie Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls -->
        <div class="p-6 space-y-4">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-semibold text-slate-600">
                
                <!-- Show Entries Selector -->
                <div class="flex items-center gap-2">
                    <span data-i18n-de="Zeige" data-i18n-en="Show">Zeige</span>
                    <select class="h-9 px-3 rounded-lg border border-slate-200 bg-slate-50 text-slate-800 outline-none focus:border-[#194AA2]">
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
                        placeholder=""
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-[#194AA2] w-full sm:w-56 shadow-2xs"
                    >
                    @if(request('search'))
                        <a href="{{ route('admin.categories') }}" class="text-xs text-red-500 hover:underline">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-700 font-bold border-b border-slate-200 text-xs">
                        <tr>
                            <th class="p-3.5">Name</th>
                            <th class="p-3.5">Slug</th>
                            <th class="p-3.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</th>
                            <th class="p-3.5" data-i18n-de="Logo / Bild" data-i18n-en="Image">Logo / Bild</th>
                            <th class="p-3.5">Status</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="p-3.5 font-bold text-slate-900 text-sm">
                                    {{ $category->name }}
                                </td>
                                <td class="p-3.5">
                                    <span class="rounded bg-teal-500 text-white px-2 py-0.5 text-[0.68rem] font-bold tracking-wide">
                                        {{ $category->slug }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-slate-600 max-w-xs truncate">
                                    {{ $category->description ?? '— Keine Beschreibung —' }}
                                </td>
                                <td class="p-3.5">
                                    @if($category->image_url)
                                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover rounded-full border border-slate-200 shadow-xs">
                                    @else
                                        <span class="text-slate-400 italic">Kein Bild</span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($category->status === 'active')
                                        <span class="rounded-full bg-emerald-100 text-emerald-800 px-3 py-1 text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="rounded-full bg-amber-100 text-amber-800 px-3 py-1 text-[0.65rem] font-bold uppercase" data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Pill Button matching Screenshot 3 -->
                                        <a 
                                            href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="rounded-full text-white px-4 py-1.5 text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1"
                                            style="background-color: #0d2352 !important; color: #ffffff !important;"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Edit
                                        </a>

                                        <!-- Delete Pill Button matching Screenshot 3 -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                                            class="rounded-full text-white px-4 py-1.5 text-xs font-bold transition shadow-xs cursor-pointer inline-flex items-center gap-1"
                                            style="background-color: #dc2626 !important; color: #ffffff !important;"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Delete
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

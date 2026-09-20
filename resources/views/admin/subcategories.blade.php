@extends('layouts.admin')
@section('title', 'Unterkategorien verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="bg-white rounded-xl shadow-xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-100 flex items-center justify-between">
        <div>
            <span data-i18n-de="MEHAAJ Admin Dashboard" data-i18n-en="MEHAAJ Admin Dashboard">MEHAAJ Admin Dashboard</span> 
            <span class="mx-1.5 text-slate-400 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Unterkategorien</span>
        </div>
        <div class="text-[0.68rem] text-slate-400 font-medium">
            <span data-i18n-de="Gesamt:" data-i18n-en="Total:">Gesamt:</span> <span class="text-[#194AA2] font-bold">{{ count($subcategories) }}</span>
        </div>
    </div>

    <!-- Main Subcategories Card -->
    <div class="exec-card overflow-hidden">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="font-extrabold text-lg text-slate-900 tracking-tight" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Unterkategorien</h2>
                <p class="text-xs text-slate-500 font-medium" data-i18n-de="Verwalten Sie Unterkategorien und deren Zuordnung" data-i18n-en="Manage subcategories and parent assignments">Verwalten Sie Unterkategorien und deren Zuordnung</p>
            </div>
            
            <a href="{{ route('admin.subcategories.create') }}" class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-xs font-bold transition shadow-xs flex items-center gap-1.5 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Unterkategorie Hinzufügen</span>
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

                <!-- Category Filter & Search Form -->
                <form action="{{ route('admin.subcategories') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <select name="category_id" onchange="this.form.submit()" class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-800 outline-none focus:border-indigo-500">
                        <option value="" data-i18n-de="Alle Hauptkategorien" data-i18n-en="All Categories">Alle Hauptkategorien</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <span data-i18n-de="Suche:" data-i18n-en="Search:">Suche:</span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Suchen..."
                        data-i18n-placeholder-de="Suchen..."
                        data-i18n-placeholder-en="Search..."
                        class="h-9 px-3 rounded-lg border border-slate-200 bg-white text-xs text-slate-900 outline-none focus:border-indigo-500 w-full sm:w-48 shadow-2xs"
                    >
                    @if(request('search') || request('category_id'))
                        <a href="{{ route('admin.subcategories') }}" class="text-xs text-rose-500 hover:underline" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto border border-slate-100 rounded-xl">
                <table class="w-full text-left text-xs">
                    <thead class="exec-table-head">
                        <tr>
                            <th class="p-3.5" data-i18n-de="Unterkategorie Name" data-i18n-en="Subcategory Name">Unterkategorie Name</th>
                            <th class="p-3.5" data-i18n-de="Hauptkategorie" data-i18n-en="Parent Category">Hauptkategorie</th>
                            <th class="p-3.5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</th>
                            <th class="p-3.5" data-i18n-de="Logo / Bild" data-i18n-en="Image">Logo / Bild</th>
                            <th class="p-3.5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                            <th class="p-3.5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($subcategories as $sub)
                            <tr class="exec-table-row">
                                <td class="p-3.5 font-bold text-slate-900 text-sm">
                                    {{ $sub->name }}
                                    <span class="block text-[0.68rem] text-slate-400 font-mono font-normal">/{{ $sub->slug }}</span>
                                </td>
                                <td class="p-3.5">
                                    <span class="rounded-lg badge-soft-indigo px-2.5 py-1 text-[0.68rem] font-bold">
                                        📁 {{ $sub->category->name ?? 'Keine' }}
                                    </span>
                                </td>
                                <td class="p-3.5 text-slate-600 max-w-xs truncate">
                                    {{ $sub->description ?? '— Keine Beschreibung —' }}
                                </td>
                                <td class="p-3.5">
                                    @if($sub->image_url)
                                        <img src="{{ $sub->image_url }}" alt="{{ $sub->name }}" class="h-9 w-9 object-cover rounded-lg border border-slate-200 shadow-xs">
                                    @else
                                        <span class="text-slate-400 italic text-[0.7rem]" data-i18n-de="Kein Bild" data-i18n-en="No Image">Kein Bild</span>
                                    @endif
                                </td>
                                <td class="p-3.5">
                                    @if($sub->status === 'active')
                                        <span class="rounded-full badge-soft-active px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Aktiv" data-i18n-en="Active">Aktiv</span>
                                    @else
                                        <span class="rounded-full badge-soft-pending px-2.5 py-0.5 text-[0.65rem] font-bold uppercase" data-i18n-de="Entwurf" data-i18n-en="Draft">Entwurf</span>
                                    @endif
                                </td>
                                <td class="p-3.5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit Soft Pill Button -->
                                        <a 
                                            href="{{ route('admin.subcategories.edit', $sub->id) }}"
                                            class="rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 border border-indigo-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Bearbeiten"
                                            data-i18n-en="Edit"
                                        >
                                            Bearbeiten
                                        </a>

                                        <!-- Delete Soft Pill Button -->
                                        <button
                                            type="button"
                                            onclick="confirmDeleteSubcategory({{ $sub->id }}, '{{ addslashes($sub->name) }}')"
                                            class="rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 px-3 py-1 text-[0.72rem] font-semibold transition cursor-pointer inline-flex items-center gap-1 shadow-2xs"
                                            data-i18n-de="Löschen"
                                            data-i18n-en="Delete"
                                        >
                                            Löschen
                                        </button>

                                        <form id="delete-subcategory-form-{{ $sub->id }}" action="{{ route('admin.subcategories.destroy', $sub->id) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-slate-400 text-xs">
                                    <p class="text-base font-bold text-slate-600 mb-1" data-i18n-de="Keine Unterkategorien gefunden" data-i18n-en="No subcategories found">Keine Unterkategorien gefunden</p>
                                    <p data-i18n-de="Erstellen Sie eine Unterkategorie über den Button oben." data-i18n-en="Create a subcategory using the button above.">Erstellen Sie eine Unterkategorie über den Button oben.</p>
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
    function confirmDeleteSubcategory(id, name) {
        LuxurySwal.fire({
            title: 'Unterkategorie löschen?',
            text: `Möchten Sie "${name}" wirklich löschen?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ja, Unterkategorie löschen',
            cancelButtonText: 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-subcategory-form-' + id).submit();
            }
        });
    }
</script>
@endsection

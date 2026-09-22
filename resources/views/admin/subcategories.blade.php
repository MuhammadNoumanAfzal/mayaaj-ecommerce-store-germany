@extends('layouts.admin')
@section('title', 'Unterkategorien verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Executive Breadcrumb Pill -->
    <div class="bg-white rounded-xl shadow-2xs py-3 px-5 text-xs font-semibold text-slate-600 border border-slate-200/80 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-slate-400 font-medium" data-i18n-de="MEHAAJ Admin" data-i18n-en="MEHAAJ Admin">MEHAAJ Admin</span> 
            <span class="text-slate-300 font-mono">›</span> 
            <span class="text-slate-900 font-bold" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Unterkategorien</span>
        </div>
        <div class="text-[0.68rem] font-semibold flex items-center gap-1.5">
            <span class="text-slate-400" data-i18n-de="Gesamt Unterkategorien:" data-i18n-en="Total Subcategories:">Gesamt Unterkategorien:</span> 
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-200/60 shadow-2xs">{{ count($subcategories) }}</span>
        </div>
    </div>

    <!-- Main Subcategories Executive Card -->
    <div class="exec-card bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        
        <!-- Clean White Card Header with Indigo Add Button -->
        <div class="px-6 py-5 bg-white border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-lg text-slate-900 tracking-tight flex items-center gap-2.5" data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    Unterkategorien Übersichtsleiste
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-0.5" data-i18n-de="Verwalten Sie Unterkategorien und deren Zuordnung zu Hauptkategorien." data-i18n-en="Manage subcategories and parent category assignments.">Verwalten Sie Unterkategorien und deren Zuordnung zu Hauptkategorien.</p>
            </div>
            
            <a href="{{ route('admin.subcategories.create') }}" class="rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 text-xs font-bold transition shadow-xs flex items-center gap-2 cursor-pointer hover:shadow-md">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Unterkategorie Hinzufügen</span>
            </a>
        </div>

        <!-- Table Filters & Controls Toolbar -->
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

                <!-- Category Filter & Search Form -->
                <form action="{{ route('admin.subcategories') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
                    <select name="category_id" onchange="this.form.submit()" class="h-9 px-3 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs">
                        <option value="" data-i18n-de="Alle Hauptkategorien" data-i18n-en="All Categories">Alle Hauptkategorien</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <div class="relative w-full sm:w-48">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Suchen..."
                            data-i18n-placeholder-de="Suchen..."
                            data-i18n-placeholder-en="Search..."
                            class="h-9 w-full pl-9 pr-4 rounded-xl border border-slate-200 bg-white text-xs font-medium text-slate-900 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-2xs placeholder:text-slate-400"
                        >
                        <svg class="h-4 w-4 absolute left-3 top-2.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </div>

                    @if(request('search') || request('category_id'))
                        <a href="{{ route('admin.subcategories') }}" class="px-3 py-2 rounded-xl bg-slate-200/70 hover:bg-slate-200 text-slate-700 text-xs font-bold transition" data-i18n-de="Zurücksetzen" data-i18n-en="Clear">Clear</a>
                    @endif
                </form>

            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-slate-100/70 text-slate-600 font-extrabold uppercase tracking-wider text-[0.68rem] border-b border-slate-200">
                        <th class="py-3.5 px-5" data-i18n-de="Unterkategorie Name" data-i18n-en="Subcategory Name">Unterkategorie Name</th>
                        <th class="py-3.5 px-5" data-i18n-de="Hauptkategorie" data-i18n-en="Parent Category">Hauptkategorie</th>
                        <th class="py-3.5 px-5" data-i18n-de="Beschreibung" data-i18n-en="Description">Beschreibung</th>
                        <th class="py-3.5 px-5" data-i18n-de="Logo / Bild" data-i18n-en="Image">Logo / Bild</th>
                        <th class="py-3.5 px-5" data-i18n-de="Status" data-i18n-en="Status">Status</th>
                        <th class="py-3.5 px-5 text-center" data-i18n-de="Aktionen" data-i18n-en="Actions">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($subcategories as $sub)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="py-4 px-5">
                                <span class="font-extrabold text-slate-900 text-sm tracking-tight block">
                                    {{ $sub->name }}
                                </span>
                                <span class="block text-[0.68rem] text-slate-400 font-mono font-medium mt-0.5">/{{ $sub->slug }}</span>
                            </td>
                            <td class="py-4 px-5">
                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-50/80 border border-indigo-100 text-indigo-700 px-2.5 py-1 text-[0.68rem] font-bold shadow-2xs">
                                    <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                    {{ $sub->category->name ?? 'Keine' }}
                                </span>
                            </td>
                            <td class="py-4 px-5 text-slate-600 font-medium max-w-xs truncate">
                                {{ $sub->description ?? '— Keine Beschreibung —' }}
                            </td>
                            <td class="py-4 px-5">
                                @if($sub->image_url)
                                    <img src="{{ $sub->image_url }}" alt="{{ $sub->name }}" class="h-10 w-10 object-cover rounded-xl border border-slate-200 shadow-2xs transition-transform duration-200 hover:scale-105">
                                @else
                                    <span class="text-slate-400 italic text-[0.7rem]" data-i18n-de="Kein Bild" data-i18n-en="No Image">Kein Bild</span>
                                @endif
                            </td>
                            <td class="py-4 px-5">
                                @if($sub->status === 'active')
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
                                        href="{{ route('admin.subcategories.edit', $sub->id) }}"
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
                                        onclick="confirmDeleteSubcategory({{ $sub->id }}, '{{ addslashes($sub->name) }}')"
                                        class="rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200/80 px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-2xs hover:shadow-xs"
                                        data-i18n-de="Löschen"
                                        data-i18n-en="Delete"
                                    >
                                        <svg class="h-3.5 w-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span data-i18n-de="Löschen" data-i18n-en="Delete">Löschen</span>
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
                            <td colspan="6" class="py-12 px-6 text-center text-slate-500 text-xs">
                                <p class="text-base font-bold text-slate-700 mb-1" data-i18n-de="Keine Unterkategorien gefunden" data-i18n-en="No subcategories found">Keine Unterkategorien gefunden</p>
                                <p data-i18n-de="Erstellen Sie eine Unterkategorie über den Button oben." data-i18n-en="Create a subcategory using the button above.">Erstellen Sie eine Unterkategorie über den Button oben.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

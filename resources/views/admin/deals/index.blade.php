@extends('layouts.admin')
@section('title', 'Deals & Bundles - MEHAAJ Atelier Admin')

@section('admin-content')
<div class="space-y-4 pb-8">

    <!-- 4 Executive KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
        
        <!-- 1. Total Deals -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-stone-500 uppercase tracking-wider block" data-i18n-de="Gesamte Bundles" data-i18n-en="Total Bundles">Total Bundles</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $stats['total'] }}</span>
                <span class="text-[0.62rem] text-stone-400 font-medium">Angelegte Sets</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-[#F8F5EF] text-stone-700 border border-stone-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
        </div>

        <!-- 2. Active in Store -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-emerald-700 uppercase tracking-wider block" data-i18n-de="Im Shop Aktiv" data-i18n-en="Active in Store">Active in Store</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $stats['active'] }}</span>
                <span class="text-[0.62rem] text-emerald-600 font-medium">Kombos live</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 3. Flash Sale Deals -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-amber-700 uppercase tracking-wider block" data-i18n-de="Flash Deals mit Timer" data-i18n-en="Flash Deals (Timer)">Flash Deals (Timer)</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ $stats['flash'] }}</span>
                <span class="text-[0.62rem] text-amber-600 font-medium">Zeitlimitierte Angebote</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <!-- 4. Avg Patron Savings -->
        <div class="group bg-white rounded-xl border border-stone-200/90 p-3.5 sm:p-4 shadow-2xs hover:shadow-xs transition-all duration-150 flex items-center justify-between">
            <div class="space-y-0.5">
                <span class="text-[0.65rem] font-bold text-purple-700 uppercase tracking-wider block" data-i18n-de="Ø Kundenersparnis" data-i18n-en="Avg Patron Savings">Avg Patron Savings</span>
                <span class="font-extrabold text-2xl text-stone-900 tracking-tight leading-none block">{{ number_format($stats['avg_savings'], 2, ',', '.') }} €</span>
                <span class="text-[0.62rem] text-purple-600 font-medium">pro Bundle</span>
            </div>
            <div class="h-10 w-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-200 flex items-center justify-center shrink-0 shadow-2xs group-hover:scale-105 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

    </div>

    <!-- Main Table Container -->
    <div class="exec-card bg-white rounded-2xl border border-stone-200/80 shadow-sm relative border-t-4 border-t-saltora-terracotta">
        
        <!-- Header with Action Button -->
        <div class="px-6 py-5 bg-white border-b border-stone-100 rounded-t-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-lg text-stone-900 tracking-tight flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-saltora-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <span data-i18n-de="Deals & Produkt-Bundles" data-i18n-en="Deals & Product Bundles">Deals & Product Bundles</span>
                </h2>
                <p class="text-xs text-stone-500 font-medium mt-0.5" data-i18n-de="Erstellen Sie kuratierte Produktkombinationen mit Sonderpreisen für den Storefront." data-i18n-en="Curate product pairings with special package pricing for the storefront.">
                    Curate product pairings with special package pricing for the storefront.
                </p>
            </div>
            
            <a href="{{ route('admin.deals.create') }}" class="btn-exec-primary rounded-xl px-5 py-2.5 text-xs transition-all shadow-md flex items-center gap-2 cursor-pointer shrink-0">
                <svg class="h-4 w-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span data-i18n-de="Neues Bundle Anlegen" data-i18n-en="Create New Bundle">Create New Bundle</span>
            </a>
        </div>

        <!-- Filter Toolbar -->
        <div class="p-4 sm:p-5 bg-[#FCFAF7] border-b border-stone-200/80">
            <form action="{{ route('admin.deals') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 text-xs font-semibold text-stone-700">
                
                <div class="relative flex-1 min-w-[260px] max-w-md">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Bundle-Name oder Badge suchen..."
                        class="w-full pl-9 pr-3.5 py-2 rounded-xl bg-white border border-stone-200 focus:outline-none focus:border-saltora-terracotta text-stone-800 text-xs shadow-2xs font-medium"
                    >
                    <svg class="w-4 h-4 text-stone-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <div class="flex items-center gap-2.5">
                    <select name="status" onchange="this.form.submit()" class="px-3 py-2 rounded-xl bg-white border border-stone-200 text-xs font-semibold text-stone-700 focus:outline-none focus:border-saltora-terracotta shadow-2xs cursor-pointer">
                        <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Alle Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>✓ Nur Aktive</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>✕ Deaktiviert</option>
                    </select>

                    @if(request()->anyFilled(['q', 'status']))
                        <a href="{{ route('admin.deals') }}" class="px-3 py-2 rounded-xl border border-stone-200 bg-white text-stone-500 hover:text-stone-800 text-xs font-bold transition flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table View -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="exec-table-head bg-[#F8F5EF] border-b border-stone-200 text-stone-700 font-extrabold text-[0.68rem] uppercase tracking-wider">
                        <th class="py-3 px-4">Bundle Name & Badge</th>
                        <th class="py-3 px-4">Kombinierte Artikel</th>
                        <th class="py-3 px-4">Preise & Ersparnis</th>
                        <th class="py-3 px-4">Flash Countdown</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100 font-medium text-stone-700">
                    @forelse($deals as $deal)
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            
                            <!-- Title & Badge -->
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-stone-900 text-xs flex items-center gap-2">
                                    <span>{{ $deal->title }}</span>
                                    @if($deal->badge_text)
                                        <span class="inline-block px-2 py-0.5 rounded text-[0.6rem] font-extrabold uppercase tracking-wider bg-saltora-blush text-saltora-terracotta border border-saltora-terracotta/30">
                                            {{ $deal->badge_text }}
                                        </span>
                                    @endif
                                </div>
                                <span class="text-[0.62rem] text-stone-400 font-mono mt-0.5 block">Slug: /deals#{{ $deal->slug }}</span>
                                @if($deal->title_de && $deal->title_en && $deal->title_de !== $deal->title_en)
                                    <span class="text-[0.62rem] text-stone-500 block italic">EN: {{ $deal->title_en }}</span>
                                @endif
                            </td>

                            <!-- Bundled Products Preview -->
                            <td class="py-3.5 px-4">
                                <div class="flex items-center -space-x-2">
                                    @foreach($deal->products as $product)
                                        <img
                                            src="{{ $product->image_url }}"
                                            alt="{{ $product->name }}"
                                            title="{{ $product->name }} ({{ number_format($product->price, 2, ',', '.') }} €)"
                                            class="w-8 h-8 rounded-lg border-2 border-white object-cover bg-stone-100 shadow-2xs shrink-0"
                                        >
                                    @endforeach
                                    <span class="ml-3 text-[0.68rem] font-bold text-stone-600 pl-2">
                                        {{ $deal->products_count }} Artikel
                                    </span>
                                </div>
                            </td>

                            <!-- Pricing & Savings -->
                            <td class="py-3.5 px-4">
                                <div class="space-y-0.5">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-extrabold text-sm text-[#78000b]">
                                            {{ number_format($deal->bundle_price, 2, ',', '.') }} €
                                        </span>
                                        <span class="text-[0.68rem] text-stone-400 line-through">
                                            {{ number_format($deal->regular_total, 2, ',', '.') }} €
                                        </span>
                                    </div>
                                    @if($deal->savings_amount > 0)
                                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[0.6rem] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                            Ersparnis: -{{ number_format($deal->savings_amount, 2, ',', '.') }} € ({{ $deal->savings_percentage }}%)
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Flash Deal Timer -->
                            <td class="py-3.5 px-4">
                                @if($deal->ends_at)
                                    <div class="space-y-0.5">
                                        <span class="inline-flex items-center gap-1 text-[0.65rem] font-bold {{ $deal->is_expired ? 'text-rose-600' : 'text-amber-700' }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>{{ $deal->is_expired ? 'Abgelaufen' : 'Endet in ' . $deal->ends_at->diffForHumans(['parts' => 2]) }}</span>
                                        </span>
                                        <span class="block text-[0.6rem] text-stone-400">{{ $deal->ends_at->format('d.m.Y H:i') }}</span>
                                    </div>
                                @else
                                    <span class="text-[0.68rem] text-stone-400">Dauerhaft aktiv</span>
                                @endif
                            </td>

                            <!-- Status Toggle -->
                            <td class="py-3.5 px-4 text-center">
                                @if($deal->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Aktiv
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[0.65rem] font-bold bg-stone-100 text-stone-600 border border-stone-200">
                                        Deaktiviert
                                    </span>
                                @endif
                                <div class="mt-1">
                                    <form action="{{ route('admin.deals.toggle-status', $deal) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-[0.62rem] font-bold underline {{ $deal->is_active ? 'text-stone-400 hover:text-stone-600' : 'text-emerald-600 hover:text-emerald-700' }} cursor-pointer">
                                            {{ $deal->is_active ? 'Deaktivieren' : 'Aktivieren' }}
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Edit Link -->
                                    <a
                                        href="{{ route('admin.deals.edit', $deal) }}"
                                        class="p-1.5 rounded-lg border border-stone-200 text-stone-600 hover:text-saltora-terracotta hover:border-saltora-terracotta bg-white transition shadow-2xs"
                                        title="Bearbeiten"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.deals.destroy', $deal) }}" method="POST" onsubmit="return confirmDeleteDeal(event, '{{ $deal->title }}')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-1.5 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50 hover:text-rose-700 bg-white transition shadow-2xs cursor-pointer"
                                            title="Löschen"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-stone-400">
                                <div class="max-w-xs mx-auto space-y-2">
                                    <div class="h-12 w-12 rounded-2xl bg-stone-100 border border-stone-200 text-stone-400 mx-auto flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </div>
                                    <p class="font-bold text-stone-700 text-xs">Keine Produkt-Bundles vorhanden</p>
                                    <p class="text-[0.68rem] text-stone-400">Kombinieren Sie 2 oder mehr Artikel zu einem rabattierten Set.</p>
                                    <a href="{{ route('admin.deals.create') }}" class="btn-exec-primary rounded-xl px-4 py-2 text-xs transition inline-flex items-center gap-1.5 mt-2">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                        <span>Erstes Bundle Erstellen</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($deals->hasPages())
            <div class="px-6 py-4 border-t border-stone-100 bg-[#FCFAF7]">
                {{ $deals->links() }}
            </div>
        @endif

    </div>

</div>

<script>
    function confirmDeleteDeal(event, title) {
        event.preventDefault();
        const form = event.target;

        if (window.LuxurySwal) {
            LuxurySwal.fire({
                icon: 'warning',
                title: `Bundle "${title}" löschen?`,
                text: 'Dieses Bundle wird aus dem Shop und allen Produktseiten entfernt.',
                showCancelButton: true,
                confirmButtonText: 'Ja, löschen',
                cancelButtonText: 'Abbrechen',
                confirmButtonColor: '#be123c'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        } else {
            if (confirm(`Möchten Sie das Bundle "${title}" wirklich löschen?`)) {
                form.submit();
            }
        }
    }
</script>
@endsection

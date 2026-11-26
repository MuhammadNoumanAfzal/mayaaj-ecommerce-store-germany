@extends('layouts.admin')
@section('title', 'Retouren & RMA Management - MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-7xl mx-auto pb-12">

    <!-- Top Header -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-5 sm:p-6 border-t-4 border-t-saltora-terracotta">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-saltora-terracotta">
                    <span class="h-2 w-2 rounded-full bg-saltora-terracotta"></span>
                    <span>KUNDEN-RETOUREN & WIDERRECHT (§ 355 BGB)</span>
                </div>
                <h1 class="text-2xl font-black text-stone-900 tracking-tight mt-1">
                    Retouren & RMA Management
                </h1>
                <p class="text-xs text-stone-500 font-medium mt-0.5">
                    Gesetzliche 14-Tage Widerrufsanträge prüfen, Warenprüfung protokollieren und Erstattungen freigeben.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="flex items-center gap-2">
                <a href="{{ route('returns.index') }}" target="_blank" class="btn-exec-secondary rounded-xl px-4 py-2 text-xs font-bold transition flex items-center gap-2 shadow-2xs">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Storefront Retourenportal öffnen</span>
                </a>
            </div>
        </div>

        <!-- 4 KPI Metrics Header Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-6 border-t border-stone-100">
            <!-- 1. Pending Review -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-amber-700 block">In Prüfung (Offen)</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-stone-900">{{ $pendingCount }}</span>
                    <span class="text-xs font-bold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full border border-amber-200">Wartet</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Muss moderiert werden</p>
            </div>

            <!-- 2. Approved & In Transit -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-blue-700 block">Genehmigt / Unterwegs</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-stone-900">{{ $approvedCount + $receivedCount }}</span>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full border border-blue-200">Aktiv</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">{{ $receivedCount }} im Atelier eingetroffen</p>
            </div>

            <!-- 3. Total Refunded Sum -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-emerald-700 block">Gesamt Erstattet</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-emerald-800">€{{ number_format($totalRefundedSum, 2, ',', '.') }}</span>
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">{{ $refundedCount }} Fälle</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Erfolgreich abgewickelt</p>
            </div>

            <!-- 4. Outstanding Pending Refund -->
            <div class="bg-[#faf7f2] rounded-xl p-4 border border-[#e6decb] space-y-1">
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-rose-700 block">Ausstehendes Erstattungsvolumen</span>
                <div class="flex items-baseline justify-between">
                    <span class="text-2xl font-black text-rose-800">€{{ number_format($pendingRefundSum, 2, ',', '.') }}</span>
                    <span class="text-xs font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-full border border-rose-200">{{ $totalReturnsCount }} Gesamt</span>
                </div>
                <p class="text-[0.65rem] text-stone-500">Inkl. abgewiesene: {{ $rejectedCount }}</p>
            </div>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
        
        <!-- Status Tabs -->
        <div class="flex flex-wrap items-center gap-1.5 w-full sm:w-auto">
            <a href="{{ route('admin.returns') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ !$status ? 'bg-saltora-terracotta text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Alle ({{ $totalReturnsCount }})
            </a>
            <a href="{{ route('admin.returns', ['status' => 'pending']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                In Prüfung ({{ $pendingCount }})
            </a>
            <a href="{{ route('admin.returns', ['status' => 'approved']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'approved' ? 'bg-blue-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Genehmigt ({{ $approvedCount }})
            </a>
            <a href="{{ route('admin.returns', ['status' => 'received']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'received' ? 'bg-indigo-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Eingegangen ({{ $receivedCount }})
            </a>
            <a href="{{ route('admin.returns', ['status' => 'refunded']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'refunded' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Erstattet ({{ $refundedCount }})
            </a>
            <a href="{{ route('admin.returns', ['status' => 'rejected']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition {{ $status === 'rejected' ? 'bg-rose-600 text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Abgelehnt ({{ $rejectedCount }})
            </a>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('admin.returns') }}" class="w-full sm:w-72">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ $search ?? '' }}" 
                    placeholder="RMA, Bestellnummer, Kunde..." 
                    class="w-full rounded-xl border border-stone-200 bg-stone-50 pl-9 pr-3.5 py-2 text-xs text-stone-800 focus:border-saltora-terracotta focus:bg-white focus:outline-none transition"
                >
                <svg class="w-4 h-4 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>

    </div>

    <!-- Returns Table -->
    <div class="bg-white rounded-2xl border border-stone-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-[#faf7f2] border-b border-stone-200 text-[0.68rem] font-black uppercase tracking-wider text-stone-700">
                        <th class="py-3 px-4">RMA / Beleg</th>
                        <th class="py-3 px-4">Bestellung</th>
                        <th class="py-3 px-4">Kunde</th>
                        <th class="py-3 px-4">Retournierte Artikel</th>
                        <th class="py-3 px-4">Grund / Mangel</th>
                        <th class="py-3 px-4 text-right">Erstattung</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Aktionen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($returns as $ret)
                        @php $badge = $ret->status_badge; @endphp
                        <tr class="hover:bg-stone-50/70 transition">
                            <!-- RMA Number -->
                            <td class="py-3.5 px-4 font-mono font-bold text-stone-900">
                                <a href="{{ route('returns.slip', $ret->return_number) }}" target="_blank" class="text-saltora-terracotta hover:underline flex items-center gap-1.5" title="Rücksendebeleg öffnen">
                                    <span>{{ $ret->return_number }}</span>
                                    <svg class="w-3 h-3 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                                <span class="block text-[0.62rem] text-stone-400 font-sans font-normal mt-0.5">
                                    {{ $ret->created_at->format('d.m.Y H:i') }}
                                </span>
                            </td>

                            <!-- Order Reference -->
                            <td class="py-3.5 px-4">
                                @if($ret->order)
                                    <a href="{{ route('admin.orders.show', $ret->order->id) }}" class="font-bold text-stone-800 hover:text-saltora-terracotta hover:underline">
                                        #{{ $ret->order->order_number }}
                                    </a>
                                    <span class="block text-[0.62rem] text-stone-400">{{ $ret->order->payment_method_label ?? 'Zahlung' }}</span>
                                @else
                                    <span class="text-stone-400">Order #{{ $ret->order_id }}</span>
                                @endif
                            </td>

                            <!-- Customer -->
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-stone-900">{{ $ret->customer_name }}</p>
                                <p class="text-[0.65rem] text-stone-500">{{ $ret->customer_email }}</p>
                            </td>

                            <!-- Items List -->
                            <td class="py-3.5 px-4 max-w-xs">
                                <div class="space-y-1">
                                    @foreach($ret->items as $it)
                                        <div class="text-[0.68rem] text-stone-700 truncate">
                                            <span class="font-bold text-stone-900">{{ $it->quantity }}x</span>
                                            {{ $it->product->name ?? 'Produkt' }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Reason & Photo -->
                            <td class="py-3.5 px-4">
                                <span class="inline-block px-2 py-0.5 rounded-full text-[0.62rem] font-bold bg-stone-100 text-stone-700 border border-stone-200">
                                    {{ $ret->reason_label }}
                                </span>
                                @if($ret->photo_path)
                                    <a href="/storage/{{ $ret->photo_path }}" target="_blank" class="block text-[0.62rem] text-blue-600 hover:underline mt-1">
                                        📷 Fotobeweis öffnen
                                    </a>
                                @endif
                                @if($ret->customer_notes)
                                    <p class="text-[0.62rem] text-stone-500 italic mt-0.5 truncate max-w-xs" title="{{ $ret->customer_notes }}">
                                        "{{ $ret->customer_notes }}"
                                    </p>
                                @endif
                            </td>

                            <!-- Refund Amount -->
                            <td class="py-3.5 px-4 text-right font-mono font-bold text-stone-900">
                                €{{ number_format($ret->refund_amount, 2, ',', '.') }}
                            </td>

                            <!-- Status Badge -->
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-block px-2.5 py-1 rounded-full text-[0.62rem] font-bold border {{ $badge['badge'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button 
                                    type="button" 
                                    onclick="openStatusModal({{ json_encode($ret) }})" 
                                    class="px-2.5 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200 text-stone-700 font-bold text-xs transition cursor-pointer shadow-2xs"
                                    title="Status ändern & Notizen"
                                >
                                    Bearbeiten
                                </button>
                                <a 
                                    href="{{ route('returns.slip', $ret->return_number) }}" 
                                    target="_blank" 
                                    class="px-2.5 py-1.5 rounded-lg bg-white border border-stone-200 hover:bg-stone-50 text-stone-700 font-bold text-xs transition inline-block shadow-2xs"
                                    title="Rücksendebeleg drucken"
                                >
                                    RMA-Beleg
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-stone-400 text-xs">
                                <p class="text-2xl mb-2">📦</p>
                                <p class="font-bold text-stone-700">Keine Retourenanträge gefunden</p>
                                <p class="text-[0.65rem] text-stone-400 mt-1">Sobald Kunden über das Retourenportal einen Widerruf anmelden, erscheinen sie hier.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($returns->hasPages())
            <div class="p-4 border-t border-stone-100">
                {{ $returns->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Status Moderation Modal -->
<div id="statusModal" class="fixed inset-0 z-50 hidden bg-stone-900/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-stone-200 space-y-4">
        <div class="flex items-center justify-between border-b border-stone-100 pb-3">
            <div>
                <span class="text-[0.62rem] font-bold uppercase tracking-wider text-saltora-terracotta">RMA-MODERATION</span>
                <h3 class="text-base font-bold text-stone-900" id="modalRmaTitle">RMA bearbeiten</h3>
            </div>
            <button type="button" onclick="closeStatusModal()" class="text-stone-400 hover:text-stone-600 text-xl font-bold">✕</button>
        </div>

        <form id="statusUpdateForm" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="space-y-3 text-xs">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Status setzen *</label>
                    <select name="status" id="modalStatusSelect" required class="w-full rounded-xl border border-stone-200 bg-stone-50 p-2.5 text-xs text-stone-900 font-bold focus:border-saltora-terracotta focus:outline-none">
                        <option value="pending">In Prüfung (Pending)</option>
                        <option value="approved">Genehmigt (Approved - Kunde kann versenden)</option>
                        <option value="received">Im Atelier eingetroffen (Received)</option>
                        <option value="refunded">Erstattet (Refunded - Betrag freigegeben)</option>
                        <option value="rejected">Abgelehnt (Rejected)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Erstattungsbetrag (€)</label>
                    <input type="number" step="0.01" name="refund_amount" id="modalRefundAmount" class="w-full rounded-xl border border-stone-200 bg-stone-50 p-2.5 text-xs font-mono font-bold text-stone-900 focus:border-saltora-terracotta focus:outline-none">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Interne Admin-Notiz</label>
                    <textarea name="admin_notes" id="modalAdminNotes" rows="3" placeholder="z. B. Ware in Originalzustand eingetroffen, Erstattung per Stripe veranlasst." class="w-full rounded-xl border border-stone-200 bg-stone-50 p-2.5 text-xs text-stone-900 focus:border-saltora-terracotta focus:outline-none"></textarea>
                </div>
            </div>

            <div class="mt-5 flex items-center justify-end gap-2 pt-3 border-t border-stone-100">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-stone-600 hover:bg-stone-100 transition cursor-pointer">
                    Abbrechen
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider bg-saltora-terracotta text-white hover:brightness-110 transition shadow-md cursor-pointer">
                    Speichern
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openStatusModal(ret) {
        document.getElementById('modalRmaTitle').innerText = ret.return_number + ' (' + ret.customer_name + ')';
        document.getElementById('modalStatusSelect').value = ret.status;
        document.getElementById('modalRefundAmount').value = ret.refund_amount;
        document.getElementById('modalAdminNotes').value = ret.admin_notes || '';
        document.getElementById('statusUpdateForm').action = '/admin/returns/' + ret.id + '/status';
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }
</script>
@endsection

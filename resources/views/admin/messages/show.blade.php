@extends('layouts.admin')
@section('title', 'Inquiry Details - MSG-' . str_pad($message->id, 5, '0', STR_PAD_LEFT) . ' - MAYAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.messages') }}" class="h-10 px-4 rounded-xl text-xs font-semibold flex items-center gap-2 bg-[#F8F5EF] text-stone-700 border border-[#E5DED5] hover:bg-[#F0EAE1] hover:text-[#964B42] transition shadow-2xs">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                <span data-i18n-en="Back to Messages" data-i18n-de="Zurück zur Übersicht">Back to Messages</span>
            </a>
            <span class="font-mono text-xs font-semibold text-stone-500 bg-[#F8F5EF] px-3 py-1.5 rounded-lg border border-[#E5DED5]">
                TICKET #MSG-{{ str_pad($message->id, 5, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <div class="flex items-center gap-2">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ urlencode($message->subject ?? 'MAYAJ Concierge') }}" class="h-10 px-4 rounded-xl text-xs font-semibold flex items-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                <span data-i18n-en="Reply via Email" data-i18n-de="Direkt Antworten (E-Mail)">Reply via Email</span>
            </a>
        </div>
    </div>

    <!-- Alert Notification -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Main Message Details (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Customer Message Content Box -->
            <div class="bg-white rounded-2xl border border-[#E5DED5] p-6 sm:p-8 space-y-6 shadow-xs">
                <div class="flex flex-wrap items-start justify-between gap-4 border-b border-[#E5DED5] pb-5">
                    <div>
                        <span class="text-[0.68rem] font-bold uppercase tracking-wider text-[#964B42] bg-[#964B42]/10 px-2.5 py-1 rounded border border-[#964B42]/20">
                            {{ $message->subject ?? 'General Inquiry' }}
                        </span>
                        <h1 class="mt-2.5 text-xl sm:text-2xl font-serif font-bold text-stone-900">
                            {{ $message->subject ?? 'Client Message' }}
                        </h1>
                        <p class="text-xs text-stone-400 mt-1">
                            <span data-i18n-en="Received on" data-i18n-de="Eingegangen am">Received on</span> {{ $message->created_at->format('M d, Y · H:i') }}
                        </p>
                    </div>

                    <div>
                        @if($message->status === 'unread')
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">● <span data-i18n-en="Unread" data-i18n-de="Ungelesen">Unread</span></span>
                        @elseif($message->status === 'read')
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-stone-100 text-stone-700 border border-stone-200">✓ <span data-i18n-en="Read" data-i18n-de="Gelesen">Read</span></span>
                        @elseif($message->status === 'replied')
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">✓✓ <span data-i18n-en="Replied" data-i18n-de="Beantwortet">Replied</span></span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-stone-100 text-stone-500 border border-stone-200"><span data-i18n-en="Archived" data-i18n-de="Archiviert">Archived</span></span>
                        @endif
                    </div>
                </div>

                <!-- Full Message Body Text -->
                <div class="bg-[#F8F5EF]/60 border border-[#E5DED5] rounded-xl p-6 text-sm text-stone-800 leading-relaxed font-normal whitespace-pre-line">
                    {{ $message->message }}
                </div>

                <!-- Related Order Reference Box if present -->
                @if($message->order_number)
                    <div class="rounded-xl border border-[#964B42]/20 bg-[#FBF6F4] p-4 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">🛍️</span>
                            <div>
                                <p class="font-bold text-stone-900">
                                    <span data-i18n-en="Associated Order Reference:" data-i18n-de="Zugehörige Bestellnummer:">Associated Order Reference:</span> 
                                    <span class="font-mono text-[#964B42] font-bold">#{{ $message->order_number }}</span>
                                </p>
                                <p class="text-[0.68rem] text-stone-500" data-i18n-en="The client included this order number in their inquiry form." data-i18n-de="Der Kunde hat diese Referenz im Kontaktformular angegeben.">The client included this order number in their inquiry form.</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.orders', ['search' => $message->order_number]) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-white border border-[#E5DED5] text-stone-700 hover:text-[#964B42] hover:bg-[#F8F5EF] transition shadow-2xs">
                            <span data-i18n-en="View Order →" data-i18n-de="Bestellung Ansehen →">View Order →</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Admin Reply / Status Update Form Card -->
            <div class="bg-white rounded-2xl border border-[#E5DED5] p-6 space-y-5 shadow-xs">
                <h3 class="font-serif font-bold text-base text-stone-900 border-b border-[#E5DED5] pb-3" data-i18n-en="Inquiry Status & Internal Notes" data-i18n-de="Nachrichtenstatus & Interne Notiz">
                    Inquiry Status & Internal Notes
                </h3>

                <form action="{{ route('admin.messages.update-status', $message->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-semibold text-stone-700 mb-1.5" data-i18n-en="Change Status" data-i18n-de="Status Ändern">Change Status</label>
                        <select name="status" class="w-full h-11 rounded-xl px-4 text-xs font-semibold text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white cursor-pointer shadow-2xs">
                            <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }} data-i18n-en="● Unread" data-i18n-de="● Ungelesen">● Unread</option>
                            <option value="read" {{ $message->status === 'read' ? 'selected' : '' }} data-i18n-en="✓ Read" data-i18n-de="✓ Gelesen">✓ Read</option>
                            <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }} data-i18n-en="✓✓ Replied" data-i18n-de="✓✓ Beantwortet">✓✓ Replied</option>
                            <option value="archived" {{ $message->status === 'archived' ? 'selected' : '' }} data-i18n-en="Archived" data-i18n-de="Archiviert">Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-700 mb-1.5" data-i18n-en="Internal Concierge Notes (e.g. follow-up resolution)" data-i18n-de="Interne Notiz (z.B. Antwortdatum & Inhalt)">Internal Concierge Notes (e.g. follow-up resolution)</label>
                        <textarea name="reply_notes" rows="3" placeholder="e.g. Contacted client by email regarding bespoke delivery." data-i18n-placeholder-en="e.g. Contacted client by email regarding bespoke delivery." data-i18n-placeholder-de="z. B. Kunde telefonisch / per Mail kontaktiert. Erstattung veranlasst." class="w-full rounded-xl p-3.5 text-xs text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs">{{ $message->reply_notes }}</textarea>
                    </div>

                    <button type="submit" class="h-10 px-5 rounded-xl text-xs font-semibold flex items-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span data-i18n-en="SAVE STATUS" data-i18n-de="STATUS SPEICHERN">SAVE STATUS</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- Right Column: Customer Info Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-2xl border border-[#E5DED5] p-6 space-y-5 shadow-xs">
                <h3 class="font-serif font-bold text-base text-stone-900 border-b border-[#E5DED5] pb-3" data-i18n-en="Client Contact Info" data-i18n-de="Kundenkontakt Info">
                    Client Contact Info
                </h3>

                <div class="space-y-4 text-xs">
                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Client Name" data-i18n-de="Kundenname">Client Name</p>
                        <p class="font-semibold text-stone-900 text-sm mt-0.5">{{ $message->name }}</p>
                    </div>

                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Email Address" data-i18n-de="E-Mail-Adresse">Email Address</p>
                        <a href="mailto:{{ $message->email }}" class="font-semibold text-[#964B42] hover:underline mt-0.5 block break-all">
                            {{ $message->email }}
                        </a>
                    </div>

                    @if($message->phone)
                        <div>
                            <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Phone Number" data-i18n-de="Telefonnummer">Phone Number</p>
                            <a href="tel:{{ $message->phone }}" class="font-semibold text-stone-800 hover:text-[#964B42] mt-0.5 block">
                                {{ $message->phone }}
                            </a>
                        </div>
                    @endif

                    <div>
                        <p class="text-[0.68rem] text-stone-400 font-bold uppercase tracking-wider" data-i18n-en="Submitted At" data-i18n-de="Eingereicht am">Submitted At</p>
                        <p class="font-semibold text-stone-800 mt-0.5">{{ $message->created_at->format('M d, Y · H:i:s') }}</p>
                    </div>
                </div>

                <div class="border-t border-[#E5DED5] pt-4">
                    <button type="button" onclick="confirmDeleteSingleMessage()" class="w-full h-10 rounded-xl text-xs font-semibold flex items-center justify-center gap-2 text-rose-600 bg-rose-50 border border-rose-200 hover:bg-rose-100 transition shadow-2xs cursor-pointer">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        <span data-i18n-en="Delete Inquiry" data-i18n-de="Anfrage Löschen">Delete Inquiry</span>
                    </button>

                    <form id="delete-single-msg-form" action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    function confirmDeleteSingleMessage() {
        const isDe = (window.__mehaaj_lang || localStorage.getItem('mehaaj_admin_lang')) === 'de';
        LuxurySwal.fire({
            title: isDe ? 'Anfrage löschen?' : 'Delete Inquiry?',
            text: isDe ? 'Möchten Sie diese Anfrage dauerhaft aus dem System entfernen?' : 'Are you sure you want to permanently delete this inquiry?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            confirmButtonText: isDe ? 'Ja, Löschen' : 'Yes, Delete',
            cancelButtonText: isDe ? 'Abbrechen' : 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-single-msg-form').submit();
            }
        });
    }
</script>
@endsection

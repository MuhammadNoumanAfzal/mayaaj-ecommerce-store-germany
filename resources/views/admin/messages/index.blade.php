@extends('layouts.admin')
@section('title', 'Customer Inquiries & Messages - MAYAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Hero Header Banner (Pink-Salt Terracotta Elegance) -->
    <div class="rounded-2xl p-6 sm:p-8 bg-gradient-to-r from-[#964B42] to-[#803D35] flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-sm text-white">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                <svg class="h-3.5 w-3.5 text-rose-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                <span data-i18n-en="CLIENT CONCIERGE & INQUIRIES" data-i18n-de="VIP KUNDENSUPPORT PORTAL">CLIENT CONCIERGE & INQUIRIES</span>
            </div>
            <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Contact Inquiries & Messages" data-i18n-de="Kundenanfragen & Nachrichten">
                Contact Inquiries & Messages
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl" data-i18n-en="Manage incoming client inquiries, bespoke requests and support messages in real-time." data-i18n-de="Verwalten Sie eingehende Kundenanfragen aus dem Shop-Kontaktformular in Echtzeit.">
                Manage incoming client inquiries, bespoke requests and support messages in real-time.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[110px]">
                <span class="block text-2xl font-bold font-serif text-white">{{ $unreadCount }}</span>
                <span class="text-[0.68rem] font-semibold text-rose-200 uppercase tracking-wider" data-i18n-en="Unread" data-i18n-de="Ungelesen">Unread</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[110px]">
                <span class="block text-2xl font-bold font-serif text-white">{{ $messages->count() }}</span>
                <span class="text-[0.68rem] font-semibold text-rose-200 uppercase tracking-wider" data-i18n-en="Total" data-i18n-de="Gesamt">Total</span>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Control Bar (Filter & Search) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-4 sm:p-5 shadow-xs">
        <form action="{{ route('admin.messages') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            
            <div class="flex-1 w-full sm:w-auto relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by client name, email, order reference, message..."
                    data-i18n-placeholder-en="Search by client name, email, order reference, message..."
                    data-i18n-placeholder-de="Suche nach Name, E-Mail, Bestellnummer, Nachricht..."
                    class="w-full h-11 rounded-xl pl-10 pr-4 text-xs text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select name="status" onchange="this.form.submit()" class="h-11 rounded-xl px-4 text-xs font-medium text-stone-800 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white cursor-pointer shadow-2xs">
                    <option value="" data-i18n-en="All Statuses" data-i18n-de="Alle Status">All Statuses</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }} data-i18n-en="Unread" data-i18n-de="Ungelesen">Unread</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }} data-i18n-en="Read" data-i18n-de="Gelesen">Read</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }} data-i18n-en="Replied" data-i18n-de="Beantwortet">Replied</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }} data-i18n-en="Archived" data-i18n-de="Archiviert">Archived</option>
                </select>

                <button type="submit" class="h-11 px-5 rounded-xl text-xs font-semibold flex items-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span data-i18n-en="SEARCH" data-i18n-de="SUCHEN">SEARCH</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Contact Messages Table Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        <div class="p-5 bg-[#FBF6F4] flex items-center justify-between border-b border-[#E5DED5]">
            <div>
                <h3 class="font-serif font-bold text-base text-stone-900" data-i18n-en="Incoming Inquiries" data-i18n-de="Eingegangene Anfragen">
                    Incoming Inquiries
                </h3>
                <p class="text-xs text-stone-500" data-i18n-en="Overview of all customer messages submitted via contact form." data-i18n-de="Übersicht aller Nachrichten von Kunden aus dem Kontaktformular.">
                    Overview of all customer messages submitted via contact form.
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                {{ $messages->count() }} <span data-i18n-en="{{ $messages->count() === 1 ? 'Message' : 'Messages' }}" data-i18n-de="{{ $messages->count() === 1 ? 'Nachricht' : 'Nachrichten' }}">{{ $messages->count() === 1 ? 'Message' : 'Messages' }}</span>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                        <th class="px-5 py-3.5">TICKET ID</th>
                        <th class="px-5 py-3.5" data-i18n-en="CLIENT & CONTACT" data-i18n-de="KUNDE & KONTAKT">CLIENT & CONTACT</th>
                        <th class="px-5 py-3.5" data-i18n-en="SUBJECT / ORDER" data-i18n-de="BETREFF / ORDER">SUBJECT / ORDER</th>
                        <th class="px-5 py-3.5" data-i18n-en="MESSAGE" data-i18n-de="NACHRICHT">MESSAGE</th>
                        <th class="px-5 py-3.5" data-i18n-en="DATE" data-i18n-de="DATUM">DATE</th>
                        <th class="px-5 py-3.5" data-i18n-en="STATUS" data-i18n-de="STATUS">STATUS</th>
                        <th class="px-5 py-3.5 text-right" data-i18n-en="ACTIONS" data-i18n-de="AKTIONEN">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DED5] text-xs">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-[#FBF6F4] transition {{ $msg->status === 'unread' ? 'bg-[#964B42]/5 font-semibold' : '' }}">
                            <td class="px-5 py-4 font-mono font-bold text-stone-800">
                                MSG-{{ str_pad($msg->id, 5, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-semibold text-stone-900 text-sm">{{ $msg->name }}</p>
                                <p class="text-stone-500 flex items-center gap-1 mt-0.5">
                                    <svg class="h-3 w-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                                    <a href="mailto:{{ $msg->email }}" class="hover:underline text-[#964B42]">{{ $msg->email }}</a>
                                </p>
                                @if($msg->phone)
                                    <p class="text-[0.68rem] text-stone-500 mt-0.5">📞 {{ $msg->phone }}</p>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-semibold text-stone-800">{{ $msg->subject ?? 'General Inquiry' }}</p>
                                @if($msg->order_number)
                                    <span class="inline-block mt-1 font-mono text-[0.68rem] font-bold text-[#964B42] bg-[#964B42]/10 px-2 py-0.5 rounded border border-[#964B42]/20">
                                        #{{ $msg->order_number }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 max-w-xs truncate text-stone-600">
                                {{ \Illuminate\Support\Str::limit($msg->message, 80) }}
                            </td>

                            <td class="px-5 py-4 text-stone-600 whitespace-nowrap">
                                <p class="font-semibold text-stone-800">{{ $msg->created_at->format('d.m.Y') }}</p>
                                <p class="text-[0.68rem] text-stone-400">{{ $msg->created_at->format('H:i') }}</p>
                            </td>

                            <td class="px-5 py-4">
                                @if($msg->status === 'unread')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">
                                        ● <span data-i18n-en="Unread" data-i18n-de="Ungelesen">Unread</span>
                                    </span>
                                @elseif($msg->status === 'read')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-stone-100 text-stone-700 border border-stone-200">
                                        ✓ <span data-i18n-en="Read" data-i18n-de="Gelesen">Read</span>
                                    </span>
                                @elseif($msg->status === 'replied')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                                        ✓✓ <span data-i18n-en="Replied" data-i18n-de="Beantwortet">Replied</span>
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-stone-100 text-stone-500 border border-stone-200">
                                        <span data-i18n-en="Archived" data-i18n-de="Archiviert">Archived</span>
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold inline-flex items-center gap-1 bg-[#F8F5EF] text-stone-700 border border-[#E5DED5] hover:bg-[#F0EAE1] hover:text-[#964B42] transition shadow-2xs">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <span data-i18n-en="View" data-i18n-de="Ansehen">View</span>
                                </a>

                                <button type="button" onclick="confirmDeleteMessage({{ $msg->id }})" class="px-2.5 py-1.5 rounded-lg text-xs font-semibold text-rose-600 bg-rose-50 border border-rose-200 hover:bg-rose-100 transition shadow-2xs cursor-pointer" title="Delete">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                </button>

                                <form id="delete-message-form-{{ $msg->id }}" action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-stone-500 text-xs">
                                <div class="mx-auto h-12 w-12 rounded-full bg-[#F8F5EF] border border-[#E5DED5] flex items-center justify-center text-stone-400 mb-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                                </div>
                                <p class="font-bold text-stone-800 text-sm" data-i18n-en="No messages found" data-i18n-de="Keine Anfragen vorhanden">No messages found</p>
                                <p class="mt-1" data-i18n-en="No client inquiries have been submitted yet." data-i18n-de="Es wurden bisher noch keine Nachrichten eingereicht.">No client inquiries have been submitted yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    function confirmDeleteMessage(id) {
        const isDe = (window.__mehaaj_lang || localStorage.getItem('mehaaj_admin_lang')) === 'de';
        LuxurySwal.fire({
            title: isDe ? 'Nachricht löschen?' : 'Delete Contact Message?',
            text: isDe ? 'Möchten Sie diese Kundenanfrage wirklich dauerhaft löschen?' : 'Are you sure you want to permanently delete this client inquiry?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#964B42',
            confirmButtonText: isDe ? 'Ja, Nachricht löschen' : 'Yes, Delete Message',
            cancelButtonText: isDe ? 'Abbrechen' : 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-message-form-' + id).submit();
            }
        });
    }
</script>
@endsection

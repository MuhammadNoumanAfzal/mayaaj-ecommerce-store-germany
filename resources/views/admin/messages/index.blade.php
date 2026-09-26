@extends('layouts.admin')
@section('title', 'Kundenanfragen & Nachrichten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Hero Header Banner -->
    <div class="admin-hero-banner rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-md">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full bg-emerald-400/20 px-3 py-1 text-xs font-bold text-emerald-200">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                <span data-i18n-de="VIP KUNDENSUPPORT PORTAL" data-i18n-en="VIP CUSTOMER SUPPORT PORTAL">VIP KUNDENSUPPORT PORTAL</span>
            </div>
            <h1 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight text-white" data-i18n-de="Kundenanfragen & Nachrichten" data-i18n-en="Contact Messages & Inquiries">
                Kundenanfragen & Nachrichten
            </h1>
            <p class="mt-1 text-xs sm:text-sm text-emerald-100 max-w-2xl" data-i18n-de="Verwalten Sie eingehende Kundenanfragen aus dem Shop-Kontaktformular in Echtzeit." data-i18n-en="Manage incoming customer inquiries from the shop contact form in real-time.">
                Verwalten Sie eingehende Kundenanfragen aus dem Shop-Kontaktformular in Echtzeit.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[120px]">
                <span class="block text-2xl font-black text-white">{{ $unreadCount }}</span>
                <span class="text-[0.68rem] font-bold text-emerald-200 uppercase tracking-wider" data-i18n-de="Ungelesen" data-i18n-en="Unread">Ungelesen</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 text-center min-w-[120px]">
                <span class="block text-2xl font-black text-white">{{ $messages->count() }}</span>
                <span class="text-[0.68rem] font-bold text-emerald-200 uppercase tracking-wider" data-i18n-de="Gesamt" data-i18n-en="Total">Gesamt</span>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-xs font-bold text-emerald-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Control Bar (Filter & Search) -->
    <div class="exec-card p-5">
        <form action="{{ route('admin.messages') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-between items-center">
            
            <div class="flex-1 w-full sm:w-auto relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Suche nach Name, E-Mail, Bestellnummer, Nachricht..."
                    data-i18n-placeholder-de="Suche nach Name, E-Mail, Bestellnummer, Nachricht..."
                    data-i18n-placeholder-en="Search by name, email, order ref, message..."
                    class="exec-input w-full h-10 rounded-xl pl-10 pr-4 text-xs outline-none"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <select name="status" onchange="this.form.submit()" class="exec-input h-10 rounded-xl px-3.5 text-xs outline-none cursor-pointer">
                    <option value="" data-i18n-de="Alle Status" data-i18n-en="All Statuses">Alle Status</option>
                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }} data-i18n-de="Ungelesen" data-i18n-en="Unread">Ungelesen</option>
                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }} data-i18n-de="Gelesen" data-i18n-en="Read">Gelesen</option>
                    <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }} data-i18n-de="Beantwortet" data-i18n-en="Replied">Beantwortet</option>
                    <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }} data-i18n-de="Archiviert" data-i18n-en="Archived">Archiviert</option>
                </select>

                <button type="submit" class="btn-exec-primary h-10 px-4 rounded-xl text-xs flex items-center gap-2 cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span data-i18n-de="SUCHEN" data-i18n-en="SEARCH">SUCHEN</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Contact Messages Table Card -->
    <div class="exec-card overflow-hidden">
        <div class="p-5 card-navy-header flex items-center justify-between border-b border-slate-200">
            <div>
                <h3 class="font-bold text-base text-slate-900" data-i18n-de="Eingegangene Anfragen" data-i18n-en="Incoming Inquiries">
                    Eingegangene Anfragen
                </h3>
                <p class="text-xs exec-helper-text" data-i18n-de="Übersicht aller Nachrichten von Kunden aus dem Kontaktformular." data-i18n-en="Overview of all customer messages submitted via contact form.">
                    Übersicht aller Nachrichten von Kunden aus dem Kontaktformular.
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                {{ $messages->count() }} {{ $messages->count() === 1 ? 'Nachricht' : 'Nachrichten' }}
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="exec-table-head">
                        <th class="px-5 py-3.5">TICKET ID</th>
                        <th class="px-5 py-3.5" data-i18n-de="KUNDE & KONTAKT" data-i18n-en="CUSTOMER & CONTACT">KUNDE & KONTAKT</th>
                        <th class="px-5 py-3.5" data-i18n-de="BETREFF / ORDER" data-i18n-en="SUBJECT / ORDER">BETREFF / ORDER</th>
                        <th class="px-5 py-3.5" data-i18n-de="NACHRICHT" data-i18n-en="MESSAGE">NACHRICHT</th>
                        <th class="px-5 py-3.5" data-i18n-de="DATUM" data-i18n-en="DATE">DATUM</th>
                        <th class="px-5 py-3.5" data-i18n-de="STATUS" data-i18n-en="STATUS">STATUS</th>
                        <th class="px-5 py-3.5 text-right" data-i18n-de="AKTIONEN" data-i18n-en="ACTIONS">AKTIONEN</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-xs">
                    @forelse($messages as $msg)
                        <tr class="exec-table-row hover:bg-slate-50 transition {{ $msg->status === 'unread' ? 'bg-amber-50/40 font-semibold' : '' }}">
                            <td class="px-5 py-4 font-mono font-bold text-slate-800">
                                MSG-{{ str_pad($msg->id, 5, '0', STR_PAD_LEFT) }}
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900 text-sm">{{ $msg->name }}</p>
                                <p class="text-slate-600 flex items-center gap-1 mt-0.5">
                                    <svg class="h-3 w-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                                    <a href="mailto:{{ $msg->email }}" class="hover:underline text-emerald-700">{{ $msg->email }}</a>
                                </p>
                                @if($msg->phone)
                                    <p class="text-[0.68rem] text-slate-500 mt-0.5">📞 {{ $msg->phone }}</p>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-800">{{ $msg->subject ?? 'Allgemeine Anfrage' }}</p>
                                @if($msg->order_number)
                                    <span class="inline-block mt-1 font-mono text-[0.68rem] font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded border border-emerald-300">
                                        {{ $msg->order_number }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 max-w-xs truncate text-slate-700">
                                {{ \Illuminate\Support\Str::limit($msg->message, 80) }}
                            </td>

                            <td class="px-5 py-4 text-slate-600 whitespace-nowrap">
                                <p class="font-bold">{{ $msg->created_at->format('d.m.Y') }}</p>
                                <p class="text-[0.68rem] text-slate-400">{{ $msg->created_at->format('H:i') }} Uhr</p>
                            </td>

                            <td class="px-5 py-4">
                                @if($msg->status === 'unread')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-300 animate-pulse">
                                        ● Ungelesen
                                    </span>
                                @elseif($msg->status === 'read')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-blue-100 text-blue-800 border border-blue-300">
                                        ✓ Gelesen
                                    </span>
                                @elseif($msg->status === 'replied')
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        ✓✓ Beantwortet
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-slate-100 text-slate-700 border border-slate-300">
                                        Archiviert
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right space-x-1.5 whitespace-nowrap">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-exec-secondary px-3 py-1.5 rounded-lg text-xs inline-flex items-center gap-1 cursor-pointer">
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <span data-i18n-de="Ansehen" data-i18n-en="View">Ansehen</span>
                                </a>

                                <button type="button" onclick="confirmDeleteMessage({{ $msg->id }})" class="btn-exec-danger px-2.5 py-1.5 rounded-lg text-xs cursor-pointer" title="Löschen">
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
                            <td colspan="7" class="px-5 py-12 text-center text-slate-500 text-xs">
                                <div class="mx-auto h-12 w-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                                </div>
                                <p class="font-bold text-slate-700 text-sm" data-i18n-de="Keine Anfragen vorhanden" data-i18n-en="No messages found">Keine Anfragen vorhanden</p>
                                <p class="mt-1" data-i18n-de="Es wurden bisher noch keine Nachrichten eingereicht." data-i18n-en="No messages have been submitted yet.">Es wurden bisher noch keine Nachrichten eingereicht.</p>
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
        const isEn = (window.__mehaaj_lang || localStorage.getItem('mehaaj_admin_lang')) === 'en';
        LuxurySwal.fire({
            title: isEn ? 'Delete Contact Message?' : 'Nachricht löschen?',
            text: isEn ? 'Are you sure you want to delete this customer inquiry?' : 'Möchten Sie diese Anfrage wirklich löschen?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#be123c',
            confirmButtonText: isEn ? 'Yes, Delete Message' : 'Ja, Nachricht löschen',
            cancelButtonText: isEn ? 'Cancel' : 'Abbrechen'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-message-form-' + id).submit();
            }
        });
    }
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Nachricht Details - MSG-' . str_pad($message->id, 5, '0', STR_PAD_LEFT) . ' - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.messages') }}" class="btn-exec-secondary h-10 px-4 rounded-xl text-xs flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m6 6-6-6 6-6"/></svg>
                <span data-i18n-de="Zurück zur Übersicht" data-i18n-en="Back to Messages">Zurück zur Übersicht</span>
            </a>
            <span class="font-mono text-xs font-bold text-slate-500">TICKET #MSG-{{ str_pad($message->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>

        <div class="flex items-center gap-2">
            <a href="mailto:{{ $message->email }}?subject=RE: {{ urlencode($message->subject ?? 'MEHAAJ Kundenservice') }}" class="btn-exec-primary h-10 px-4 rounded-xl text-xs flex items-center gap-2 cursor-pointer">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22 6 10 13 2 6"/></svg>
                <span data-i18n-de="Direkt Antworten (E-Mail)" data-i18n-en="Reply via Email">Direkt Antworten (E-Mail)</span>
            </a>
        </div>
    </div>

    <!-- Alert Notification -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-300 bg-emerald-50 p-4 text-xs font-bold text-emerald-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-12">
        
        <!-- Main Message Details (8 cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Customer Message Content Box -->
            <div class="exec-card p-6 sm:p-8 space-y-6">
                <div class="flex flex-wrap items-start justify-between gap-4 border-b border-slate-200 pb-5">
                    <div>
                        <span class="text-[0.68rem] font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                            {{ $message->subject ?? 'Allgemeine Anfrage' }}
                        </span>
                        <h1 class="mt-2.5 text-xl sm:text-2xl font-bold text-slate-900">
                            {{ $message->subject ?? 'Kundennachricht vom ' . $message->created_at->format('d.m.Y') }}
                        </h1>
                        <p class="text-xs text-slate-500 mt-1">Eingegangen am {{ $message->created_at->format('d.m.Y \u\m H:i') }} Uhr</p>
                    </div>

                    <div>
                        @if($message->status === 'unread')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-300">● Ungelesen</span>
                        @elseif($message->status === 'read')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-300">✓ Gelesen</span>
                        @elseif($message->status === 'replied')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">✓✓ Beantwortet</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-300">Archiviert</span>
                        @endif
                    </div>
                </div>

                <!-- Full Message Body Text -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 text-sm text-slate-800 leading-relaxed font-normal whitespace-pre-line">
                    {{ $message->message }}
                </div>

                <!-- Related Order Reference Box if present -->
                @if($message->order_number)
                    <div class="rounded-xl border border-emerald-300/80 bg-emerald-50/60 p-4 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">🛍️</span>
                            <div>
                                <p class="font-bold text-slate-900">Zugehörige Bestellnummer: <span class="font-mono text-emerald-800 font-extrabold">{{ $message->order_number }}</span></p>
                                <p class="text-[0.68rem] text-slate-600">Der Kunde hat diese Referenz im Kontaktformular angegeben.</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.orders', ['search' => $message->order_number]) }}" class="btn-exec-secondary px-3 py-1.5 rounded-lg text-xs font-bold">
                            Bestellung In Admin Suchen →
                        </a>
                    </div>
                @endif
            </div>

            <!-- Admin Reply / Status Update Form Card -->
            <div class="exec-card p-6 space-y-5">
                <h3 class="font-bold text-base text-slate-900 border-b border-slate-200 pb-3" data-i18n-de="Nachrichtenstatus & Interne Notiz" data-i18n-en="Status & Internal Reply Notes">
                    Nachrichtenstatus & Interne Notiz
                </h3>

                <form action="{{ route('admin.messages.update-status', $message->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5" data-i18n-de="Status Ändern" data-i18n-en="Change Status">Status Ändern</label>
                        <select name="status" class="exec-input w-full h-10 rounded-xl px-3.5 text-xs font-bold outline-none cursor-pointer">
                            <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>● Ungelesen</option>
                            <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>✓ Gelesen</option>
                            <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>✓✓ Beantwortet</option>
                            <option value="archived" {{ $message->status === 'archived' ? 'selected' : '' }}>Archiviert</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5" data-i18n-de="Interne Notiz (z.B. Antwortdatum & Inhalt)" data-i18n-en="Internal Notes (e.g. Reply info)">Interne Notiz (z.B. Antwortdatum & Inhalt)</label>
                        <textarea name="reply_notes" rows="3" placeholder="z. B. Kunde telefonisch / per Mail kontaktiert. Erstattung veranlasst." class="exec-input w-full rounded-xl p-3.5 text-xs outline-none">{{ $message->reply_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn-exec-primary h-10 px-5 rounded-xl text-xs flex items-center gap-2 cursor-pointer font-bold">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        <span data-i18n-de="STATUS SPEICHERN" data-i18n-en="SAVE STATUS">STATUS SPEICHERN</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- Right Column: Customer Info Sidebar (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="exec-card p-6 space-y-5">
                <h3 class="font-bold text-base text-slate-900 border-b border-slate-200 pb-3" data-i18n-de="Kundenkontakt Info" data-i18n-en="Customer Info">
                    Kundenkontakt Info
                </h3>

                <div class="space-y-4 text-xs">
                    <div>
                        <p class="text-[0.68rem] text-slate-500 font-bold uppercase tracking-wider">Kundenname</p>
                        <p class="font-bold text-slate-900 text-sm mt-0.5">{{ $message->name }}</p>
                    </div>

                    <div>
                        <p class="text-[0.68rem] text-slate-500 font-bold uppercase tracking-wider">E-Mail-Adresse</p>
                        <a href="mailto:{{ $message->email }}" class="font-bold text-emerald-700 hover:underline mt-0.5 block break-all">
                            {{ $message->email }}
                        </a>
                    </div>

                    @if($message->phone)
                        <div>
                            <p class="text-[0.68rem] text-slate-500 font-bold uppercase tracking-wider">Telefonnummer</p>
                            <a href="tel:{{ $message->phone }}" class="font-bold text-slate-800 mt-0.5 block">
                                {{ $message->phone }}
                            </a>
                        </div>
                    @endif

                    <div>
                        <p class="text-[0.68rem] text-slate-500 font-bold uppercase tracking-wider">Eingereicht am</p>
                        <p class="font-bold text-slate-800 mt-0.5">{{ $message->created_at->format('d.m.Y H:i:s') }}</p>
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-4">
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Möchten Sie diese Anfrage dauerhaft löschen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-exec-danger w-full h-10 rounded-xl text-xs flex items-center justify-center gap-2 cursor-pointer font-bold">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            <span data-i18n-de="Anfrage Löschen" data-i18n-en="Delete Inquiry">Anfrage Löschen</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

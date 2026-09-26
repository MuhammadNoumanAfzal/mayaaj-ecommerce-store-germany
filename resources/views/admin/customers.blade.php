@extends('layouts.admin')
@section('title', 'Kundenstamm verwalten - MEHAAJ Admin')

@section('admin-content')
<div class="space-y-6">

    <!-- Top Breadcrumb -->
    <div class="text-xs font-semibold text-slate-500 dark:text-slate-400">
        <span data-i18n-de="MEHAAJ E-Commerce Atelier" data-i18n-en="MEHAAJ E-Commerce Atelier">MEHAAJ E-Commerce Atelier</span> 
        <span class="mx-1.5 opacity-60 font-mono">></span> 
        <span class="text-slate-900 dark:text-white font-bold" data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Kundenstamm</span>
    </div>

    <!-- Header Banner -->
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between border-b border-slate-200 dark:border-slate-800 pb-5">
        <div>
            <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 dark:border-blue-900 bg-blue-50 dark:bg-blue-950/60 px-3 py-1 text-[0.62rem] font-bold uppercase tracking-[0.2em] text-[#2563eb] dark:text-[#60a5fa]">
                <span data-i18n-de="MEHAAJ VIP KUNDEN" data-i18n-en="MEHAAJ VIP CUSTOMERS">MEHAAJ VIP KUNDEN</span>
            </div>
            <h1 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight text-slate-900 dark:text-white" data-i18n-de="Kundenstamm & VIP Portal" data-i18n-en="Customer Database & VIP Portal">Kundenstamm & VIP Portal</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1" data-i18n-de="Übersicht aller registrierten Kunden, VIP-Mitglieder und Newsletter-Abonnenten." data-i18n-en="Overview of all registered customers, VIP members, and newsletter subscribers.">Übersicht aller registrierten Kunden, VIP-Mitglieder und Newsletter-Abonnenten.</p>
        </div>
    </div>

    <!-- Modern Coming Soon Card -->
    <div class="admin-card rounded-2xl border p-8 text-center space-y-4 shadow-sm">
        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 dark:bg-blue-950/60 text-[#2563eb] dark:text-blue-400 text-2xl mx-auto border border-blue-200 dark:border-blue-800 animate-pulse">
            👥
        </div>
        <h2 class="font-bold text-xl text-slate-900 dark:text-white" data-i18n-de="Kundenverwaltung Modul — In Entwicklung" data-i18n-en="Customer Management Module — In Development">Kundenverwaltung Modul — In Entwicklung</h2>
        <p class="text-xs text-slate-500 dark:text-slate-400 max-w-lg mx-auto leading-relaxed" data-i18n-de="Verwalten Sie VIP-Kundenstufen, Kaufhistorien, Einladungen zu Manufaktur-Führungen und Newsletter-Verteiler." data-i18n-en="Manage VIP customer levels, purchase history, factory tour invitations, and newsletter subscribers.">
            Verwalten Sie VIP-Kundenstufen, Kaufhistorien, Einladungen zu Manufaktur-Führungen und Newsletter-Verteiler.
        </p>
    </div>

</div>
@endsection

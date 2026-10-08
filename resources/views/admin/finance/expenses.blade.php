@extends('layouts.admin')
@section('title', 'Operating Expenses & Cost Management — MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-full overflow-hidden">

    <!-- Executive Header Banner (Terracotta Gradient) -->
    <div class="rounded-2xl p-5 sm:p-7 bg-gradient-to-r from-[#964B42] via-[#853E36] to-[#6d3029] shadow-sm text-white">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                    <span data-i18n-en="COST CONTROL & OPERATING EXPENSES" data-i18n-de="BETRIEBSAUSGABEN & KOSTENMANAGEMENT">COST CONTROL & OPERATING EXPENSES</span>
                </div>
                <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Atelier Operating Expenses (OpEx)" data-i18n-de="Betriebliche Aufwendungen & Kosten">
                    Atelier Operating Expenses (OpEx)
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl leading-relaxed" data-i18n-en="Track and categorize all studio overhead, artisan payroll, luxury packaging, and digital marketing disbursements." data-i18n-de="Verwalten Sie alle Betriebskosten: Miete, Meisterlöhne, Verpackungsmaterialien und Werbeaufwendungen.">
                    Track and categorize all studio overhead, artisan payroll, luxury packaging, and digital marketing disbursements.
                </p>
            </div>

            <!-- Header Actions -->
            <div class="flex flex-wrap items-center gap-2 shrink-0">
                <a href="{{ route('admin.finance.profit-loss') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-white/15 hover:bg-white/25 text-white border border-white/20 px-3.5 py-2.5 text-xs font-bold transition shadow-xs">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    <span>View P&L</span>
                </a>

                <button
                    type="button"
                    onclick="openAddExpenseModal()"
                    class="inline-flex items-center gap-2 rounded-xl bg-white text-[#964B42] hover:bg-rose-50 px-5 py-2.5 text-xs font-bold uppercase tracking-wider transition shadow-md hover:shadow-lg cursor-pointer"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span data-i18n-en="+ Record Expense" data-i18n-de="+ Ausgabe Erfassen">+ Record Expense</span>
                </button>
            </div>
        </div>

        <!-- Metric KPI Cards (4-Grid) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-white/20">
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center">
                <span class="block text-xl sm:text-2xl font-bold font-serif text-white">€{{ number_format($thisMonthTotal, 2) }}</span>
                <span class="text-[0.62rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">This Month</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center">
                <span class="block text-xl sm:text-2xl font-bold font-serif text-white">€{{ number_format($lastMonthTotal, 2) }}</span>
                <span class="text-[0.62rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Last Month</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center">
                <span class="block text-xl sm:text-2xl font-bold font-serif text-amber-300">€{{ number_format($ytdTotal, 2) }}</span>
                <span class="text-[0.62rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Year to Date</span>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center">
                <span class="block text-xl sm:text-2xl font-bold font-serif text-purple-200">€{{ number_format($allTimeTotal, 2) }}</span>
                <span class="text-[0.62rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Total Recorded</span>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center gap-2 shadow-2xs">
            <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Control Bar (Filters & Search) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-4 sm:p-5 shadow-xs space-y-4">
        
        <!-- Category Filter Pills Strip -->
        <div class="flex flex-wrap items-center gap-1.5 border-b border-stone-200/60 pb-3.5 text-xs">
            @php
                $cats = [
                    'all'                 => 'All Categories',
                    'workshop_rent'       => 'Atelier Rent',
                    'artisan_payroll'     => 'Artisan Payroll',
                    'materials_packaging' => 'Packaging',
                    'marketing_ads'       => 'Marketing',
                    'shipping_logistics'  => 'Shipping',
                    'software_hosting'    => 'Software & IT',
                    'utilities'           => 'Utilities',
                    'taxes_legal'         => 'Legal & Tax',
                ];
            @endphp

            @foreach($cats as $catKey => $catName)
                <a
                    href="{{ route('admin.finance.expenses', ['category' => $catKey, 'search' => request('search')]) }}"
                    class="px-3 py-1.5 rounded-full font-bold transition {{ (!request('category') && $catKey === 'all') || request('category') === $catKey ? 'bg-[#964B42] text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}"
                >
                    {{ $catName }}
                </a>
            @endforeach
        </div>

        <!-- Search & Month Filter Form -->
        <form action="{{ route('admin.finance.expenses') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            <div class="flex-1 relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search expenses by title, vendor, or invoice reference..."
                    class="w-full h-11 rounded-xl pl-10 pr-4 text-xs text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <div class="flex items-center gap-2">
                <input
                    type="month"
                    name="month"
                    value="{{ request('month') }}"
                    class="h-11 px-3 rounded-xl text-xs font-semibold bg-stone-50 border border-stone-200 text-stone-800"
                >

                <button type="submit" class="h-11 px-5 rounded-xl text-xs font-bold uppercase tracking-wider flex items-center justify-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span>Filter</span>
                </button>

                @if(request('search') || request('category') || request('month'))
                    <a href="{{ route('admin.finance.expenses') }}" class="h-11 px-4 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 transition" title="Clear Filters">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Expenses Table Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 bg-[#FBF6F4] flex flex-wrap items-center justify-between gap-3 border-b border-[#E5DED5]">
            <div>
                <h3 class="font-serif font-bold text-base text-stone-900" data-i18n-en="Logged Operating Invoices & Disbursements" data-i18n-de="Erfasste Betriebsausgaben">
                    Logged Operating Invoices & Disbursements
                </h3>
                <p class="text-xs text-stone-500">
                    Comprehensive ledger of verified atelier expenses.
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                {{ $expenses->total() }} Entries
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-auto text-xs">
                <thead>
                    <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                        <th class="px-4 sm:px-5 py-3.5 w-28">DATE</th>
                        <th class="px-4 sm:px-5 py-3.5">EXPENSE / DESCRIPTION</th>
                        <th class="px-4 sm:px-5 py-3.5">CATEGORY</th>
                        <th class="px-4 sm:px-5 py-3.5">VENDOR & REF</th>
                        <th class="px-4 sm:px-5 py-3.5 text-right w-36">AMOUNT (€)</th>
                        <th class="px-4 sm:px-5 py-3.5 text-right w-28">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DED5] font-sans">
                    @forelse($expenses as $exp)
                        <tr class="hover:bg-stone-50/70 transition-colors">
                            
                            <!-- Date -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle text-stone-600 font-mono text-[0.72rem]">
                                {{ $exp->expense_date->format('d M Y') }}
                            </td>

                            <!-- Title & Notes -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle">
                                <p class="font-bold text-stone-900 text-xs">{{ $exp->title }}</p>
                                @if($exp->notes)
                                    <p class="text-[0.65rem] text-stone-400 truncate max-w-sm">{{ $exp->notes }}</p>
                                @endif
                            </td>

                            <!-- Category Badge -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold border {{ $exp->category_badge_class }}">
                                    {{ $exp->category_label }}
                                </span>
                            </td>

                            <!-- Vendor & Ref -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle">
                                <p class="text-stone-800 font-semibold">{{ $exp->vendor ?? '—' }}</p>
                                <div class="flex items-center gap-1.5 text-[0.65rem] text-stone-400">
                                    @if($exp->reference_no)
                                        <span class="font-mono">#{{ $exp->reference_no }}</span>
                                        <span>•</span>
                                    @endif
                                    <span>{{ ucfirst(str_replace('_', ' ', $exp->payment_method ?? 'Bank')) }}</span>
                                </div>
                            </td>

                            <!-- Amount -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle text-right">
                                <span class="font-mono font-black text-sm text-stone-900">
                                    €{{ number_format($exp->amount, 2) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 sm:px-5 py-3.5 align-middle text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button
                                        type="button"
                                        onclick="openEditExpenseModal({{ json_encode($exp) }})"
                                        class="p-1.5 rounded-lg text-stone-500 hover:text-stone-900 hover:bg-stone-100 transition cursor-pointer"
                                        title="Edit Expense"
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>

                                    <button
                                        type="button"
                                        onclick="confirmDeleteExpense({{ $exp->id }}, '{{ addslashes($exp->title) }}')"
                                        class="p-1.5 rounded-lg text-rose-400 hover:text-rose-700 hover:bg-rose-50 transition cursor-pointer"
                                        title="Delete Expense"
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-stone-400">
                                <svg class="w-12 h-12 mx-auto text-stone-300 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <p class="text-sm font-semibold">No operating expenses recorded yet.</p>
                                <p class="text-xs text-stone-400 mt-0.5">Click "+ Record Expense" to log your first studio invoice.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($expenses->hasPages())
            <div class="p-4 border-t border-[#E5DED5] bg-stone-50">
                {{ $expenses->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal: Record New Expense -->
<div id="addExpenseModal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        <div class="p-4 sm:p-5 bg-[#FBF6F4] border-b border-stone-200 flex items-center justify-between">
            <h3 class="font-serif font-bold text-base text-stone-900">Record Operating Expense</h3>
            <button type="button" onclick="closeAddExpenseModal()" class="text-stone-400 hover:text-stone-700">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.finance.expenses.store') }}" method="POST" class="p-5 space-y-4 text-xs">
            @csrf

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Expense Title / Description *</label>
                <input type="text" name="title" required placeholder="e.g. Maximilianstraße Showroom Lease" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Category *</label>
                    <select name="category" required class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                        <option value="workshop_rent">Atelier & Studio Lease</option>
                        <option value="artisan_payroll">Artisan & Tailor Payroll</option>
                        <option value="materials_packaging">Luxury Packaging & Materials</option>
                        <option value="marketing_ads">Digital Marketing & Ads</option>
                        <option value="shipping_logistics">Courier & Express Shipping</option>
                        <option value="software_hosting">Software & Cloud Hosting</option>
                        <option value="utilities">Utilities & Energy</option>
                        <option value="taxes_legal">Legal, Tax & Advisory</option>
                        <option value="other">Other Operational</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Amount (€) *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-stone-400 font-bold">€</span>
                        <input type="number" step="0.01" min="0.01" name="amount" required placeholder="0.00" class="w-full pl-8 pr-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 font-mono font-bold focus:outline-none focus:border-[#964B42]">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Expense Date *</label>
                    <input type="date" name="expense_date" required value="{{ date('Y-m-d') }}" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Vendor / Payee</label>
                    <input type="text" name="vendor" placeholder="e.g. DHL Express, Meta Platforms" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Invoice / Ref Number</label>
                    <input type="text" name="reference_no" placeholder="e.g. INV-2026-901" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 font-mono focus:outline-none focus:border-[#964B42]">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Payment Method</label>
                    <select name="payment_method" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                        <option value="bank_transfer">Bank Wire Transfer (SEPA)</option>
                        <option value="credit_card">Corporate Credit Card</option>
                        <option value="paypal">PayPal Merchant</option>
                        <option value="cash">Petty Cash Drawer</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Notes & Details</label>
                <textarea name="notes" rows="2" placeholder="Itemized breakdown or accounting notes..." class="w-full p-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-stone-200">
                <button type="button" onclick="closeAddExpenseModal()" class="px-4 py-2.5 rounded-xl font-semibold bg-stone-100 hover:bg-stone-200 text-stone-700 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    Save Expense
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Expense -->
<div id="editExpenseModal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xl w-full max-w-lg overflow-hidden animate-in fade-in zoom-in-95 duration-200">
        <div class="p-4 sm:p-5 bg-[#FBF6F4] border-b border-stone-200 flex items-center justify-between">
            <h3 class="font-serif font-bold text-base text-stone-900">Edit Operating Expense</h3>
            <button type="button" onclick="closeEditExpenseModal()" class="text-stone-400 hover:text-stone-700">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>

        <form id="editExpenseForm" method="POST" class="p-5 space-y-4 text-xs">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Expense Title / Description *</label>
                <input type="text" id="edit_title" name="title" required class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Category *</label>
                    <select id="edit_category" name="category" required class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                        <option value="workshop_rent">Atelier & Studio Lease</option>
                        <option value="artisan_payroll">Artisan & Tailor Payroll</option>
                        <option value="materials_packaging">Luxury Packaging & Materials</option>
                        <option value="marketing_ads">Digital Marketing & Ads</option>
                        <option value="shipping_logistics">Courier & Express Shipping</option>
                        <option value="software_hosting">Software & Cloud Hosting</option>
                        <option value="utilities">Utilities & Energy</option>
                        <option value="taxes_legal">Legal, Tax & Advisory</option>
                        <option value="other">Other Operational</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Amount (€) *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-stone-400 font-bold">€</span>
                        <input type="number" step="0.01" min="0.01" id="edit_amount" name="amount" required class="w-full pl-8 pr-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 font-mono font-bold focus:outline-none focus:border-[#964B42]">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Expense Date *</label>
                    <input type="date" id="edit_expense_date" name="expense_date" required class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Vendor / Payee</label>
                    <input type="text" id="edit_vendor" name="vendor" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Invoice / Ref Number</label>
                    <input type="text" id="edit_reference_no" name="reference_no" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 font-mono focus:outline-none focus:border-[#964B42]">
                </div>

                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Payment Method</label>
                    <select id="edit_payment_method" name="payment_method" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]">
                        <option value="bank_transfer">Bank Wire Transfer (SEPA)</option>
                        <option value="credit_card">Corporate Credit Card</option>
                        <option value="paypal">PayPal Merchant</option>
                        <option value="cash">Petty Cash Drawer</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-1">Notes & Details</label>
                <textarea id="edit_notes" name="notes" rows="2" class="w-full p-2.5 rounded-xl border border-stone-300 text-stone-900 focus:outline-none focus:border-[#964B42]"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-3 border-t border-stone-200">
                <button type="button" onclick="closeEditExpenseModal()" class="px-4 py-2.5 rounded-xl font-semibold bg-stone-100 hover:bg-stone-200 text-stone-700 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    Update Expense
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddExpenseModal() {
        document.getElementById('addExpenseModal').classList.remove('hidden');
    }
    function closeAddExpenseModal() {
        document.getElementById('addExpenseModal').classList.add('hidden');
    }

    function openEditExpenseModal(expense) {
        document.getElementById('edit_title').value = expense.title || '';
        document.getElementById('edit_category').value = expense.category || 'other';
        document.getElementById('edit_amount').value = expense.amount || '';
        document.getElementById('edit_expense_date').value = expense.expense_date ? expense.expense_date.substring(0, 10) : '';
        document.getElementById('edit_vendor').value = expense.vendor || '';
        document.getElementById('edit_reference_no').value = expense.reference_no || '';
        document.getElementById('edit_payment_method').value = expense.payment_method || 'bank_transfer';
        document.getElementById('edit_notes').value = expense.notes || '';

        document.getElementById('editExpenseForm').action = `/admin/finance/expenses/${expense.id}`;
        document.getElementById('editExpenseModal').classList.remove('hidden');
    }

    function closeEditExpenseModal() {
        document.getElementById('editExpenseModal').classList.add('hidden');
    }

    function confirmDeleteExpense(expenseId, title) {
        LuxurySwal.fire({
            title: `Delete expense "${title}"?`,
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                fetch(`/admin/finance/expenses/${expenseId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        LuxuryToast.fire({ icon: 'success', title: data.message });
                        setTimeout(() => window.location.reload(), 400);
                    } else {
                        LuxuryToast.fire({ icon: 'error', title: data.message || 'Could not delete expense.' });
                    }
                })
                .catch(err => {
                    console.error(err);
                    LuxuryToast.fire({ icon: 'error', title: 'Connection error.' });
                });
            }
        });
    }
</script>
@endsection

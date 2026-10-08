@extends('layouts.admin')
@section('title', 'Staff & Role-Based Access Control — MEHAAJ Atelier')

@section('admin-content')
<div class="space-y-6 max-w-full overflow-hidden">

    <!-- Hero Header Banner (Pink-Salt Terracotta Gradient) -->
    <div class="rounded-2xl p-5 sm:p-7 bg-gradient-to-r from-[#964B42] to-[#803D35] shadow-sm text-white">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-white/15 backdrop-blur-md px-3 py-1 text-xs font-semibold text-rose-100 border border-white/20">
                    <svg class="h-3.5 w-3.5 text-[#ffd45a]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span data-i18n-en="SECURITY & ACCESS GOVERNANCE" data-i18n-de="SICHERHEIT & RECHTEMANAGEMENT">SECURITY & ACCESS GOVERNANCE</span>
                </div>
                <h1 class="mt-3 text-2xl sm:text-3xl font-serif font-bold tracking-tight text-white" data-i18n-en="Staff & Role-Based Access Control" data-i18n-de="Mitarbeiter & Rollenbasierte Rechte (RBAC)">
                    Staff & Role-Based Access Control
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-rose-100 max-w-2xl leading-relaxed" data-i18n-en="Configure team roles and granular access permissions across the executive atelier portal." data-i18n-de="Verwalten Sie Mitarbeiterkonten und weisen Sie spezifische Berechtigungen für Atelier-Module zu.">
                    Configure team roles and granular access permissions across the executive atelier portal.
                </p>
            </div>

            <!-- Add Staff Member Button -->
            <div>
                <button
                    type="button"
                    onclick="openAddStaffModal()"
                    class="inline-flex items-center gap-2 rounded-xl bg-white text-[#964B42] hover:bg-rose-50 px-5 py-3 text-xs font-bold uppercase tracking-wider transition shadow-md hover:shadow-lg cursor-pointer shrink-0"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    <span data-i18n-en="+ Add Team Member" data-i18n-de="+ Mitarbeiter Anlegen">+ Add Team Member</span>
                </button>
            </div>
        </div>

        <!-- Metric KPI Cards (100% Fluid Responsive Grid) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mt-6 pt-5 border-t border-white/20">
            <!-- Super Admin -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-purple-300">{{ $superAdminCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Super Admins</span>
            </div>

            <!-- Store Admin -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-white">{{ $adminCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Store Admins</span>
            </div>

            <!-- Review Moderator -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-blue-300">{{ $moderatorCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Review Moderators</span>
            </div>

            <!-- Inventory Manager -->
            <div class="bg-white/10 backdrop-blur-md rounded-xl p-3 sm:p-4 border border-white/20 text-center flex flex-col justify-center">
                <span class="block text-2xl sm:text-3xl font-bold font-serif text-amber-300">{{ $inventoryCount }}</span>
                <span class="text-[0.65rem] sm:text-xs font-bold text-rose-200 uppercase tracking-wider block mt-1">Inventory Staff</span>
            </div>
        </div>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-xs font-semibold text-emerald-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs font-semibold text-rose-800 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Control Bar (Filter & Search) -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] p-4 sm:p-5 shadow-xs space-y-4">
        
        <!-- Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 border-b border-stone-200/60 pb-3.5">
            <a href="{{ route('admin.staff') }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ !request('role') || request('role') === 'all' ? 'bg-[#964B42] text-white shadow-xs' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                <span>All Roles</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ !request('role') || request('role') === 'all' ? 'bg-white/20 text-white' : 'bg-stone-200 text-stone-700' }}">{{ $totalUsers }}</span>
            </a>

            <a href="{{ route('admin.staff', ['role' => 'super_admin']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('role') === 'super_admin' ? 'bg-purple-700 text-white shadow-xs' : 'bg-purple-50 text-purple-800 border border-purple-200 hover:bg-purple-100' }}">
                <span>Super Admin</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('role') === 'super_admin' ? 'bg-white/20 text-white' : 'bg-purple-200 text-purple-900' }}">{{ $superAdminCount }}</span>
            </a>

            <a href="{{ route('admin.staff', ['role' => 'admin']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('role') === 'admin' ? 'bg-rose-700 text-white shadow-xs' : 'bg-rose-50 text-rose-800 border border-rose-200 hover:bg-rose-100' }}">
                <span>Store Admin</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('role') === 'admin' ? 'bg-white/20 text-white' : 'bg-rose-200 text-rose-900' }}">{{ $adminCount }}</span>
            </a>

            <a href="{{ route('admin.staff', ['role' => 'moderator']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('role') === 'moderator' ? 'bg-blue-700 text-white shadow-xs' : 'bg-blue-50 text-blue-800 border border-blue-200 hover:bg-blue-100' }}">
                <span>Review Moderator</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('role') === 'moderator' ? 'bg-white/20 text-white' : 'bg-blue-200 text-blue-900' }}">{{ $moderatorCount }}</span>
            </a>

            <a href="{{ route('admin.staff', ['role' => 'inventory_manager']) }}" class="px-3.5 py-1.5 rounded-full text-xs font-bold transition flex items-center gap-1.5 {{ request('role') === 'inventory_manager' ? 'bg-amber-700 text-white shadow-xs' : 'bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100' }}">
                <span>Inventory Staff</span>
                <span class="rounded-full px-1.5 py-0.2 text-[0.65rem] {{ request('role') === 'inventory_manager' ? 'bg-white/20 text-white' : 'bg-amber-200 text-amber-900' }}">{{ $inventoryCount }}</span>
            </a>
        </div>

        <!-- Search Form -->
        <form action="{{ route('admin.staff') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center justify-between">
            @if(request('role'))
                <input type="hidden" name="role" value="{{ request('role') }}">
            @endif

            <div class="flex-1 relative">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search staff by name or email address..."
                    class="w-full h-11 rounded-xl pl-10 pr-4 text-xs text-stone-900 bg-[#F8F5EF]/60 border border-[#E5DED5] outline-none focus:border-[#964B42] focus:bg-white focus:ring-2 focus:ring-[#964B42]/20 transition shadow-2xs"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3.5 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="h-11 px-5 rounded-xl text-xs font-semibold flex items-center justify-center gap-2 bg-[#964B42] hover:bg-[#803D35] text-white transition shadow-sm cursor-pointer">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <span>SEARCH</span>
                </button>

                @if(request('search') || (request('role') && request('role') !== 'all'))
                    <a href="{{ route('admin.staff') }}" class="h-11 px-4 rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 transition" title="Clear Filters">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <span>Reset</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Staff Table Card -->
    <div class="bg-white rounded-2xl border border-[#E5DED5] shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 bg-[#FBF6F4] flex flex-wrap items-center justify-between gap-3 border-b border-[#E5DED5]">
            <div>
                <h3 class="font-serif font-bold text-base text-stone-900">
                    Atelier Executive Team & Staff
                </h3>
                <p class="text-xs text-stone-500">
                    Authorized team members with role-governed permissions.
                </p>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-[#964B42]/10 text-[#964B42] border border-[#964B42]/20">
                {{ $staffMembers->total() }} Members
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse table-auto">
                <thead>
                    <tr class="bg-[#F8F5EF] text-[0.68rem] font-bold text-stone-600 uppercase tracking-wider border-b border-[#E5DED5]">
                        <th class="px-4 sm:px-5 py-3.5 w-16">ID</th>
                        <th class="px-4 sm:px-5 py-3.5">STAFF MEMBER</th>
                        <th class="px-4 sm:px-5 py-3.5">ROLE & PRIVILEGES</th>
                        <th class="px-4 sm:px-5 py-3.5 w-32">STATUS</th>
                        <th class="px-4 sm:px-5 py-3.5 w-36">REGISTERED</th>
                        <th class="px-4 sm:px-5 py-3.5 text-right w-44">ACTIONS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5DED5] text-xs">
                    @forelse($staffMembers as $member)
                        @php
                            $memberData = [
                                'id'        => $member->id,
                                'name'      => $member->name,
                                'email'     => $member->email,
                                'role'      => $member->role,
                                'is_active' => $member->is_active,
                            ];
                            $isSelf = auth()->id() === $member->id;
                        @endphp
                        <tr class="hover:bg-stone-50/70 transition-colors {{ !$member->is_active ? 'opacity-60 bg-stone-50/30' : '' }}">
                            
                            <!-- ID -->
                            <td class="px-4 sm:px-5 py-4 align-middle">
                                <span class="font-mono text-xs font-bold text-stone-700">#{{ $member->id }}</span>
                            </td>

                            <!-- Staff Member Info -->
                            <td class="px-4 sm:px-5 py-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-2xs">
                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-stone-900 text-sm truncate">{{ $member->name }}</span>
                                            @if($isSelf)
                                                <span class="px-2 py-0.2 rounded-full text-[0.62rem] font-bold bg-emerald-100 text-emerald-800">You</span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-stone-500 font-mono block truncate">{{ $member->email }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Role Badge -->
                            <td class="px-4 sm:px-5 py-4 align-middle whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border {{ $member->role_badge_class }}">
                                    @if($member->role === 'super_admin')
                                        <span>👑</span>
                                    @elseif($member->role === 'admin')
                                        <span>🛡️</span>
                                    @elseif($member->role === 'moderator')
                                        <span>⭐</span>
                                    @else
                                        <span>📦</span>
                                    @endif
                                    <span>{{ $member->role_label }}</span>
                                </span>
                            </td>

                            <!-- Active Status Toggle -->
                            <td class="px-4 sm:px-5 py-4 align-middle whitespace-nowrap">
                                @if($isSelf)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <span class="h-2 w-2 rounded-full bg-emerald-600"></span>
                                        Active
                                    </span>
                                @else
                                    <button
                                        type="button"
                                        onclick="toggleStaffStatus({{ $member->id }}, '{{ addslashes($member->name) }}', {{ $member->is_active ? 'false' : 'true' }})"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border transition cursor-pointer {{ $member->is_active ? 'bg-emerald-50 text-emerald-800 border-emerald-200 hover:bg-emerald-100' : 'bg-stone-100 text-stone-500 border-stone-200 hover:bg-stone-200' }}"
                                        title="Click to toggle account activation"
                                    >
                                        <span class="h-2 w-2 rounded-full {{ $member->is_active ? 'bg-emerald-600' : 'bg-stone-400' }}"></span>
                                        <span>{{ $member->is_active ? 'Active' : 'Inactive' }}</span>
                                    </button>
                                @endif
                            </td>

                            <!-- Registered Date -->
                            <td class="px-4 sm:px-5 py-4 align-middle whitespace-nowrap text-stone-500 text-xs">
                                <div>{{ $member->created_at ? $member->created_at->format('d.m.Y') : '—' }}</div>
                                <div class="text-[0.68rem] text-stone-400">{{ $member->created_at ? $member->created_at->diffForHumans() : '' }}</div>
                            </td>

                            <!-- Actions -->
                            <td class="px-4 sm:px-5 py-4 align-middle text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5 justify-end">
                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        onclick='openEditStaffModal(@json($memberData))'
                                        class="inline-flex items-center gap-1 rounded-lg bg-stone-100 hover:bg-[#964B42] hover:text-white text-stone-700 px-2.5 py-1.5 text-xs font-bold transition border border-stone-200 cursor-pointer"
                                        title="Edit Role & Permissions"
                                    >
                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Button -->
                                    @if(!$isSelf)
                                        <button
                                            type="button"
                                            onclick="confirmDeleteStaff({{ $member->id }}, '{{ addslashes($member->name) }}')"
                                            class="p-1.5 rounded-lg text-stone-400 hover:text-rose-700 hover:bg-rose-50 transition cursor-pointer"
                                            title="Delete Staff Account"
                                        >
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                        </button>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-stone-400">
                                No staff accounts match your filter criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($staffMembers->hasPages())
            <div class="p-4 bg-[#FBF6F4] border-t border-[#E5DED5]">
                {{ $staffMembers->links() }}
            </div>
        @endif
    </div>

</div>

<!-- Modal: Add Staff Member -->
<div id="add-staff-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-900/60 backdrop-blur-xs hidden transition-all duration-300">
    <div class="relative w-full max-w-lg bg-white rounded-2xl border border-[#E5DED5] shadow-2xl overflow-hidden" id="add-staff-dialog">
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf
            
            <div class="p-5 bg-gradient-to-r from-[#964B42] to-[#803D35] text-white flex items-center justify-between">
                <div>
                    <h3 class="font-serif font-bold text-lg text-white">Create Staff Account</h3>
                    <p class="text-xs text-rose-100">Grant role-governed access to a new team member.</p>
                </div>
                <button type="button" onclick="closeAddStaffModal()" class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div class="p-5 space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Full Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Dr. Julian Vance" class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Email Address *</label>
                    <input type="email" name="email" required placeholder="julian@mehaaj.de" class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Assign Role & Privileges *</label>
                    <select name="role" required class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none font-semibold">
                        <option value="admin">Store Admin — Full Store Operations (Products, Orders, Customers, Inventory, Reviews)</option>
                        <option value="moderator">Review Moderator — Reviews & Customer Contact Messages</option>
                        <option value="inventory_manager">Inventory Staff — Product Catalog & Stock Management</option>
                        <option value="super_admin">Super Admin — Master Unrestricted Access</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Password *</label>
                    <input type="password" name="password" required minlength="6" placeholder="Minimum 6 characters" class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" id="add_is_active" value="1" checked class="h-4 w-4 rounded border-stone-300 text-[#964B42] focus:ring-[#964B42]">
                    <label for="add_is_active" class="font-bold text-stone-700 cursor-pointer">Activate account immediately</label>
                </div>
            </div>

            <div class="p-4 bg-stone-50 border-t border-stone-200 flex justify-end gap-2">
                <button type="button" onclick="closeAddStaffModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#964B42] hover:bg-[#803D35] text-white font-bold text-xs shadow-xs cursor-pointer">Save Account</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Staff Member -->
<div id="edit-staff-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-900/60 backdrop-blur-xs hidden transition-all duration-300">
    <div class="relative w-full max-w-lg bg-white rounded-2xl border border-[#E5DED5] shadow-2xl overflow-hidden" id="edit-staff-dialog">
        <form id="edit-staff-form" action="" method="POST">
            @csrf
            @method('PUT')
            
            <div class="p-5 bg-gradient-to-r from-[#964B42] to-[#803D35] text-white flex items-center justify-between">
                <div>
                    <h3 class="font-serif font-bold text-lg text-white" id="edit-modal-title">Edit Staff Account</h3>
                    <p class="text-xs text-rose-100">Update role privileges and credentials.</p>
                </div>
                <button type="button" onclick="closeEditStaffModal()" class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-white cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div class="p-5 space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Full Name *</label>
                    <input type="text" id="edit-name" name="name" required class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Email Address *</label>
                    <input type="email" id="edit-email" name="email" required class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Role & Permissions *</label>
                    <select id="edit-role" name="role" required class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none font-semibold">
                        <option value="admin">Store Admin — Full Store Operations (Products, Orders, Customers, Inventory, Reviews)</option>
                        <option value="moderator">Review Moderator — Reviews & Customer Contact Messages</option>
                        <option value="inventory_manager">Inventory Staff — Product Catalog & Stock Management</option>
                        <option value="super_admin">Super Admin — Master Unrestricted Access</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">New Password (leave empty to keep current)</label>
                    <input type="password" name="password" minlength="6" placeholder="Enter new password to change..." class="w-full h-10 px-3 rounded-xl border border-stone-300 bg-stone-50/70 focus:bg-white focus:border-[#964B42] outline-none">
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" id="edit-is-active" value="1" class="h-4 w-4 rounded border-stone-300 text-[#964B42] focus:ring-[#964B42]">
                    <label for="edit-is-active" class="font-bold text-stone-700 cursor-pointer">Account Active</label>
                </div>
            </div>

            <div class="p-4 bg-stone-50 border-t border-stone-200 flex justify-end gap-2">
                <button type="button" onclick="closeEditStaffModal()" class="px-4 py-2 rounded-xl bg-white border border-stone-200 text-stone-700 font-bold text-xs hover:bg-stone-100 cursor-pointer">Cancel</button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#964B42] hover:bg-[#803D35] text-white font-bold text-xs shadow-xs cursor-pointer">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function openAddStaffModal() {
        document.getElementById('add-staff-modal').classList.remove('hidden');
    }

    function closeAddStaffModal() {
        document.getElementById('add-staff-modal').classList.add('hidden');
    }

    function openEditStaffModal(data) {
        document.getElementById('edit-staff-form').action = `/admin/staff/${data.id}`;
        document.getElementById('edit-modal-title').textContent = `Edit Staff: ${data.name}`;
        document.getElementById('edit-name').value = data.name;
        document.getElementById('edit-email').value = data.email;
        document.getElementById('edit-role').value = data.role;
        document.getElementById('edit-is-active').checked = !!data.is_active;

        document.getElementById('edit-staff-modal').classList.remove('hidden');
    }

    function closeEditStaffModal() {
        document.getElementById('edit-staff-modal').classList.add('hidden');
    }

    function toggleStaffStatus(staffId, staffName, willActivate) {
        const actionWord = willActivate ? 'activate' : 'deactivate';
        LuxurySwal.fire({
            title: `${willActivate ? 'Activate' : 'Deactivate'} ${staffName}?`,
            text: willActivate 
                ? 'This staff member will regain access to the admin portal.'
                : 'This staff member will be immediately blocked from signing in.',
            icon: willActivate ? 'question' : 'warning',
            showCancelButton: true,
            confirmButtonText: `Yes, ${actionWord}`,
            cancelButtonText: 'Cancel',
            confirmButtonColor: willActivate ? '#059669' : '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/staff/${staffId}/toggle-status`, {
                    method: 'POST',
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
                        LuxuryToast.fire({ icon: 'error', title: data.message || 'Status could not be updated.' });
                    }
                })
                .catch(err => {
                    console.error(err);
                    LuxuryToast.fire({ icon: 'error', title: 'Connection error.' });
                });
            }
        });
    }

    function confirmDeleteStaff(staffId, staffName) {
        LuxurySwal.fire({
            title: `Delete staff account for ${staffName}?`,
            text: 'This action is irreversible.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc2626'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/staff/${staffId}`, {
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
                        LuxuryToast.fire({ icon: 'error', title: data.message || 'Could not delete staff member.' });
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

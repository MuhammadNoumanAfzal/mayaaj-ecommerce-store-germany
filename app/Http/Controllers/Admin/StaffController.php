<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    /**
     * Display a listing of admin and staff members.
     */
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $staffMembers = $query->paginate(15)->withQueryString();

        // Role Statistics
        $totalUsers = User::count();
        $superAdminCount = User::where('role', 'super_admin')->count();
        $adminCount = User::where('role', 'admin')->count();
        $moderatorCount = User::where('role', 'moderator')->count();
        $inventoryCount = User::where('role', 'inventory_manager')->count();

        return view('admin.staff.index', compact(
            'staffMembers',
            'totalUsers',
            'superAdminCount',
            'adminCount',
            'moderatorCount',
            'inventoryCount'
        ));
    }

    /**
     * Store a newly created staff member in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|max:150|unique:users,email',
            'password'  => 'required|string|min:6',
            'role'      => 'required|in:super_admin,admin,moderator,inventory_manager',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->boolean('is_active', true);

        User::create($validated);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Staff account created successfully! ✓'
            ]);
        }

        return redirect()->route('admin.staff')->with('success', 'Staff account created successfully! ✓');
    }

    /**
     * Update an existing staff member.
     */
    public function update(Request $request, User $staff)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($staff->id)],
            'password'  => 'nullable|string|min:6',
            'role'      => 'required|in:super_admin,admin,moderator,inventory_manager',
            'is_active' => 'nullable|boolean',
        ]);

        // Prevent demoting the last super admin
        if ($staff->role === 'super_admin' && $validated['role'] !== 'super_admin') {
            $superAdminsCount = User::where('role', 'super_admin')->where('is_active', true)->count();
            if ($superAdminsCount <= 1) {
                return back()->with('error', 'Cannot change role: System requires at least one active Super Admin.');
            }
        }

        $staff->name = $validated['name'];
        $staff->email = $validated['email'];
        $staff->role = $validated['role'];
        $staff->is_active = $request->boolean('is_active', true);

        if (!empty($validated['password'])) {
            $staff->password = Hash::make($validated['password']);
        }

        $staff->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Staff member updated successfully! ✓'
            ]);
        }

        return redirect()->route('admin.staff')->with('success', 'Staff member updated successfully! ✓');
    }

    /**
     * Toggle active/inactive status of a staff member.
     */
    public function toggleStatus(Request $request, User $staff)
    {
        if ($staff->id === auth()->id()) {
            return response()->json(['success' => false, 'message' => 'You cannot deactivate your own account.'], 403);
        }

        if ($staff->role === 'super_admin' && $staff->is_active) {
            $superAdminsCount = User::where('role', 'super_admin')->where('is_active', true)->count();
            if ($superAdminsCount <= 1) {
                return response()->json(['success' => false, 'message' => 'Cannot deactivate the last Super Admin.'], 403);
            }
        }

        $staff->is_active = !$staff->is_active;
        $staff->save();

        $statusWord = $staff->is_active ? 'activated' : 'deactivated';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $staff->is_active,
                'message'   => "Staff member successfully {$statusWord}."
            ]);
        }

        return redirect()->back()->with('success', "Staff member successfully {$statusWord}.");
    }

    /**
     * Remove a staff account.
     */
    public function destroy(Request $request, User $staff)
    {
        if ($staff->id === auth()->id()) {
            $errorMsg = 'Security Error: You cannot delete your own account while logged in.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $errorMsg], 403);
            }
            return redirect()->back()->with('error', $errorMsg);
        }

        if ($staff->role === 'super_admin') {
            $superAdminsCount = User::where('role', 'super_admin')->count();
            if ($superAdminsCount <= 1) {
                $errorMsg = 'Security Error: Cannot delete the primary Super Admin account.';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => $errorMsg], 403);
                }
                return redirect()->back()->with('error', $errorMsg);
            }
        }

        $staff->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Staff account removed successfully! ✓'
            ]);
        }

        return redirect()->route('admin.staff')->with('success', 'Staff account removed successfully! ✓');
    }
}

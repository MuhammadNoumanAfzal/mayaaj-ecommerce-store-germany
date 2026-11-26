<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    /**
     * Display all coupons with KPI metrics and filtering.
     */
    public function index(Request $request)
    {
        $query = Coupon::withCount('usages');

        // Search by Code or Description
        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $status = $request->input('status');
            if ($status === 'active') {
                $query->active();
            } elseif ($status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($status === 'expired') {
                $query->whereNotNull('expires_at')->where('expires_at', '<', now());
            } elseif ($status === 'exhausted') {
                $query->whereNotNull('usage_limit')->whereColumn('used_count', '>=', 'usage_limit');
            }
        }

        // Type Filter
        if ($request->filled('type') && in_array($request->input('type'), ['percentage', 'fixed'])) {
            $query->where('type', $request->input('type'));
        }

        $coupons = $query->latest()->paginate(15)->withQueryString();

        // High-level KPI Stats
        $totalCoupons = Coupon::count();
        $activeCoupons = Coupon::active()->count();
        $totalRedemptions = Coupon::sum('used_count');
        $totalDiscountGiven = CouponUsage::sum('discount_amount');
        $expiringSoon = Coupon::where('is_active', true)
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays(7)])
            ->count();

        return view('admin.coupons.index', compact(
            'coupons',
            'totalCoupons',
            'activeCoupons',
            'totalRedemptions',
            'totalDiscountGiven',
            'expiringSoon'
        ));
    }

    /**
     * Store newly created coupon.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_spend' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['min_spend'] = $validated['min_spend'] ?? 0;

        $coupon = Coupon::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Gutschein erfolgreich erstellt.',
                'coupon' => $coupon,
            ]);
        }

        return redirect()->route('admin.coupons')->with('success', 'Gutschein ' . $coupon->code . ' erfolgreich erstellt.');
    }

    /**
     * Update an existing coupon.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_spend' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['is_active'] = $request->boolean('is_active', false);
        $validated['min_spend'] = $validated['min_spend'] ?? 0;

        $coupon->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Gutschein erfolgreich aktualisiert.',
                'coupon' => $coupon,
            ]);
        }

        return redirect()->route('admin.coupons')->with('success', 'Gutschein ' . $coupon->code . ' erfolgreich aktualisiert.');
    }

    /**
     * Toggle coupon active status (AJAX or POST).
     */
    public function toggleStatus(Request $request, Coupon $coupon)
    {
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $coupon->is_active,
                'message' => $coupon->is_active ? 'Gutschein aktiviert.' : 'Gutschein deaktiviert.',
            ]);
        }

        return back()->with('success', 'Gutscheinstatus geändert.');
    }

    /**
     * Remove the specified coupon.
     */
    public function destroy(Request $request, Coupon $coupon)
    {
        $code = $coupon->code;
        $coupon->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Gutschein ' . $code . ' gelöscht.',
            ]);
        }

        return redirect()->route('admin.coupons')->with('success', 'Gutschein ' . $code . ' gelöscht.');
    }
}

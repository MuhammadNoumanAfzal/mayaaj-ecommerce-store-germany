<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display store settings form.
     */
    public function index()
    {
        $settings = [
            'store_name' => StoreSetting::getByKey('store_name', 'MEHAAJ Luxury Atelier'),
            'store_email' => StoreSetting::getByKey('store_email', 'service@mehaaj.de'),
            'store_phone' => StoreSetting::getByKey('store_phone', '+49 30 8910234'),
            'address' => StoreSetting::getByKey('address', 'Kurfürstendamm 182, D-10707 Berlin'),
            'currency' => StoreSetting::getByKey('currency', 'EUR (€)'),
            'tax_rate' => StoreSetting::getByKey('tax_rate', '19'),
            'shipping_cost' => StoreSetting::getByKey('shipping_cost', '0.00'),
            'vorkasse_bank' => StoreSetting::getByKey('vorkasse_bank', 'Commerzbank Berlin'),
            'vorkasse_iban' => StoreSetting::getByKey('vorkasse_iban', 'DE89 3704 0044 0532 0130 00'),
            'vorkasse_bic' => StoreSetting::getByKey('vorkasse_bic', 'COBADEFFXXX'),
            'ust_id' => StoreSetting::getByKey('ust_id', 'DE 391 048 291'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update store settings in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'currency' => 'required|string|max:50',
            'tax_rate' => 'required|numeric|min:0',
            'shipping_cost' => 'required|numeric|min:0',
            'vorkasse_bank' => 'nullable|string|max:255',
            'vorkasse_iban' => 'nullable|string|max:100',
            'vorkasse_bic' => 'nullable|string|max:100',
            'ust_id' => 'nullable|string|max:100',
        ]);

        foreach ($validated as $key => $value) {
            StoreSetting::setByKey($key, $value);
        }

        return redirect()->route('admin.settings')->with('success', 'Store Einstellungen erfolgreich gespeichert! ✓');
    }
}

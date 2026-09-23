<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Display the luxury contact page.
     */
    public function show()
    {
        return view('pages.contact');
    }

    /**
     * Handle incoming contact form submission via AJAX or Form POST.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'order_number' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:5|max:3000',
        ], [
            'name.required' => 'Bitte geben Sie Ihren vollständigen Namen ein.',
            'email.required' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'email.email' => 'Die E-Mail-Adresse ist ungültig.',
            'message.required' => 'Bitte geben Sie Ihre Nachricht ein.',
            'message.min' => 'Ihre Nachricht sollte mindestens 5 Zeichen enthalten.',
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'order_number' => $validated['order_number'] ?? null,
            'subject' => $validated['subject'] ?? 'Allgemeine Anfrage',
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Vielen Dank! Ihre Nachricht wurde erfolgreich an die MEHAAJ Manufaktur übermittelt. Wir antworten Ihnen innerhalb von 24 Stunden.',
                'ticket_id' => 'MSG-' . str_pad($contactMessage->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return redirect()->back()->with('success', 'Vielen Dank! Ihre Nachricht wurde erfolgreich an uns übermittelt.');
    }
}

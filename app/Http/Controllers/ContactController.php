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
        $isEn = app()->getLocale() === 'en';

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'order_number' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:5|max:3000',
        ], [
            'name.required' => $isEn ? 'Please enter your full name.' : 'Bitte geben Sie Ihren vollständigen Namen ein.',
            'email.required' => $isEn ? 'Please provide a valid email address.' : 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'email.email' => $isEn ? 'The email address is invalid.' : 'Die E-Mail-Adresse ist ungültig.',
            'message.required' => $isEn ? 'Please enter your message.' : 'Bitte geben Sie Ihre Nachricht ein.',
            'message.min' => $isEn ? 'Your message must contain at least 5 characters.' : 'Ihre Nachricht sollte mindestens 5 Zeichen enthalten.',
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'order_number' => $validated['order_number'] ?? null,
            'subject' => $validated['subject'] ?? ($isEn ? 'General Inquiry' : 'Allgemeine Anfrage'),
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $isEn 
                    ? 'Thank you! Your message has been sent to the MEHAAJ concierge. We will respond within 24 hours.' 
                    : 'Vielen Dank! Ihre Nachricht wurde erfolgreich an die MEHAAJ Manufaktur übermittelt. Wir antworten Ihnen innerhalb von 24 Stunden.',
                'ticket_id' => 'MSG-' . str_pad($contactMessage->id, 5, '0', STR_PAD_LEFT),
            ]);
        }

        return redirect()->back()->with('success', $isEn ? 'Thank you! Your message has been sent.' : 'Vielen Dank! Ihre Nachricht wurde erfolgreich an uns übermittelt.');
    }
}

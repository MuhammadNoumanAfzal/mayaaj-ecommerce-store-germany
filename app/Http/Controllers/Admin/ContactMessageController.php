<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display listing of customer contact inquiries in Admin panel.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('order_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $messages = $query->get();
        $unreadCount = ContactMessage::where('status', 'unread')->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    /**
     * Display a specific message detail.
     */
    public function show(ContactMessage $message)
    {
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Update status or reply notes for an inquiry.
     */
    public function updateStatus(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => 'required|in:unread,read,replied,archived',
            'reply_notes' => 'nullable|string',
        ]);

        $message->update($validated);

        return redirect()->back()->with('success', 'Nachrichtenstatus erfolgreich aktualisiert! ✓');
    }

    /**
     * Delete an inquiry from database.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages')->with('success', 'Nachricht erfolgreich gelöscht! ✓');
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:5',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.min' => 'Pesan minimal harus berisi 5 karakter.',
        ]);

        ContactMessage::create($validated);

        // Jika request via AJAX / Fetch (Alpine.js)
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih! Pesan Anda telah berhasil terkirim.',
            ], 200);
        }

        return redirect()->to(url()->previous() . '#contact')
            ->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactEditController extends Controller
{
    public function index()
    {
        $contactData = contact::firstOrCreate([], [
            'whatsapp' => '',
            'email' => '',
            'address' => '',
            'working_hours' => ''
        ]);

        return view('contact-edit', [
            'title' => 'Contact Page',
            'activePage' => 'contact-edit',
            'contactData' => $contactData
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp'   => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:100',
            'address'     => 'nullable|string|max:255',
            'working_hours'  => 'nullable|string|max:50',
            'footer_background' => 'nullable|file|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $contact = contact::first(); // ambil data pertama
        if (!$contact) {
            $contact = new contact();
        }

        $footerBackground = $contact->footer_background ?? '';
        if ($request->hasFile('footer_background')) {
            if ($footerBackground && Storage::disk('public')->exists($footerBackground)) {
                Storage::disk('public')->delete($footerBackground);
            }
            $footerBackground = $request->file('footer_background')->store('footer', 'public');
        }

        $contact->update([
            'whatsapp'   => $request->whatsapp,
            'email'      => $request->email,
            'address'     => $request->address,
            'working_hours'  => $request->working_hours,
            'footer_background' => $footerBackground,
        ]);

        return redirect()->back()->with('success', 'Contact updated successfully!');
    }
}

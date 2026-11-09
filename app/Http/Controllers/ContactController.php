<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::first();
        return view('contact', [
            'title' => 'Өв Соёл ХХК - Холбоо барих',
            'activePage' => 'contact',
            'contact' => $contact,
        ]);
    }
}

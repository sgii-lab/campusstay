<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // validate input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // handle submission (e.g. save to DB or send email)
        // Contact::create($data);

        return back()->with('success', 'Your message has been sent!');
    }
}

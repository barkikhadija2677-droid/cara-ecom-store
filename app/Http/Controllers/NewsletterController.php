<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        Newsletter::firstOrCreate(['email' => $request->email]);

        return back()->with('newsletter_success', 'Thanks for subscribing to our newsletter!');
    }
}

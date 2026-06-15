<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signup;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Signup::updateOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'phone' => $request->phone]
        );

        return back()->with('success', 'Signup successful!');
    }
}

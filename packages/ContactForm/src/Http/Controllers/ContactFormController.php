<?php

namespace ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use ContactForm\Models\ContactForm;
use ContactForm\Mail\NewContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactFormController extends \App\Http\Controllers\Controller
{
    public function index()
    {

        $user = auth('api')->user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $forms = ContactForm::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $forms
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::guard('api')->user();
        $data['user_id'] = $user ? $user->id : null;

        $contact = ContactForm::create($data);

        Mail::to(config('mail.admin_address', 'trippldee8@gmail.com'))
        ->queue(new NewContactMail($contact));

        return response()->json([
            'message' => 'Contact form submitted successfully',
            'data' => $contact
        ]);
    }
}

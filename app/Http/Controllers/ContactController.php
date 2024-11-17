<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // Assuming you want to send an email.

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact'); // Your contact page view
    }

    public function submitForm(Request $request)
    {
        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send the message to the admin (using an email, for example)
        try {
            // Send email to admin (you can create an Mailable to handle the email sending)
            Mail::to('sathishfaaz@gmail.com')->send(new ContactFormMail($validated));

            // Redirect with success message
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            // In case of error (e.g., email could not be sent)
            return redirect()->back()->with('error', 'There was an issue sending your message. Please try again.');
        }
    }
}

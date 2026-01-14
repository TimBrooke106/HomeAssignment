<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnquiryController extends Controller
{
    public function create()
    {
        return view('enquiries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:120'],
            'email' => ['required','email','max:120'],
            'message' => ['required','string','max:1000'],
            'g-recaptcha-response' => ['required'],
        ]);

        // Verify reCAPTCHA (external API validation)
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!($response->json('success') === true)) {
            return back()
                ->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.'])
                ->withInput();
        }

        Enquiry::create($request->only('name', 'email', 'message'));

        return redirect()->route('enquiries.create')->with('success', 'Enquiry sent successfully!');
    }
}

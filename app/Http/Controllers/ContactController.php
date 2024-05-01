<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\ContactMailer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact.contact');
    }
    public function index_gmail(Request $request)
    {

        return view('mail.contact_mail', compact("message"));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $mail = Contact::create([
            'user_id' => $request->user_id,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        $messageContent = request()->message;
        Mail::to('oufkirhamza08@gmail.com')->send(new ContactMailer($messageContent ));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function index_about() {
        
        return view('about.about');
    }

    public function show(Contact $contact)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

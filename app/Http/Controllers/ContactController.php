<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::paginate(5);
        
        return view('contact.index', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:contacts'
        ]);

        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name'  => $request->get('last_name'),
            'email'      => $request->get('email'),
        ]);

        $contact->save();

        return redirect('/')->with('success', 'Contact saved!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|unique:contacts,email,' . $contact->id,
        ]);

        $contact->first_name = $request->get('first_name');
        $contact->last_name  = $request->get('last_name');
        $contact->email      = $request->get('email');
        $contact->save();

        return redirect('/')->with('success', 'Contact updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/')->with('success', 'Contact deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_info  = ContactInfo::first();
        return view('contacts.contact_info', compact('contact_info'));
    }



    public function update(Request $request, ContactInfo $contactInfo)
    {
        DB::table('contact_info')->update($request->except('_token'));
        return redirect()->back()->with('success', 'Successfuly');
    }
}

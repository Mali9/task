<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\ContactsMail;
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
        return view('contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Contact::create($request->all())) {
            return redirect()->back()->with('success', 'Email Send Successfuly');

            $body = request()->body;
            $title = request()->subject;
            $receiver = request()->email;

            // send  mail to user
            \Mail::to('MaliMali01120354080@gmail.com')
                ->send(new ContactsMail($body, $title, $receiver));
        }
    }


    public function getContents()
    {
        $contents = Contact::paginate(10);

        return view('contacts.contents', compact('contents'));
    }
}

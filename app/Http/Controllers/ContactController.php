<?php

namespace App\Http\Controllers;

use App\Helpers\GenericHelper;
use App\Mail\ContactFormSubmitted;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
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

        if(config('services.recaptcha.key')) {

            $this->validate($request, [
                'g-recaptcha-response' => 'required'
            ], [
            'g-recaptcha-response.required' => 'Please complete the recaptcha.'
            ]);

            // validate recaptcha
            $captchaSuccess = GenericHelper::validateRecaptcha($_POST['g-recaptcha-response']);

            if(! $captchaSuccess){
                return redirect('contact')->withErrors(['g-recaptcha-response' => 'failed to validate recaptcha'])->withInput();
                }
        }

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);


        $contactus = Contactus::create($request->all());

        Mail::to('support@stats4sd.org')->queue(
            new ContactFormSubmitted($contactus)
        );

        return back()->with('success', 'Thanks for contacting us!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactus $contactus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
        //
    }
}

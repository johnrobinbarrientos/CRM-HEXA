<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Mail\TestEmail;

class TestController extends Controller
{
    public function mail()
    {
        $data = ['message' => 'Hi HELOW GOOD BYE'];
        Mail::to('kenjimagto@gmail.com')->send(new TestEmail($data));
        return 'Sent!'
    }

    public function mailConfirmation()
    {
       $view = view('emails.confirmation');

       return $view;
    }
}
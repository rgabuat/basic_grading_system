<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{
    public function index(){
        $mailData=[
            'title'=> 'Mail test',
            'body' => 'test'
        ];
        Mail::to('johncarlocasipit@gmail.com')->send(new DemoMail($mailData));
        dd('Email send succesfully');
    }
}

<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $data = [
//            'no-reply' => 'contact-from-web@nomail.com',
//            'admin'    => 'mohamedsasa201042@yahoo.com',
//            'Fname'    => 'test', //$request->get('Fname'),
//            'Lname'    => 'test', //$request->get('Lname'),
//            'Email'    => 'test@email.com', //$request->get('Email'),
//            'Phone'    => 'test', //$request->get('Phone'),
//            'Order'    => 'test'  //$request->get('Order'),
//        ];
//
//        //Mail::fake();
//
//        Mail::send('email.test', ['data' => $data],
//            function ($message) use ($data)
//            {
//                $message
//                    ->from($data['no-reply'])
//                    ->to($data['admin'])->subject('Some body wrote to you online')
//                    ->to($data['Email'])->subject('Your submitted information')
//                    ->to('elbiheiry2@gmail.com', 'elbiheiry')->subject('Feedback');
//            });
        $details = 'your_email@gmail.com';
        //dispatch(new SendEmails($details));
        //SendEmails::dispatch($details);
        SendEmails::dispatch($details)->delay(now()->addSeconds(15));

        return 'Test';

    }
}

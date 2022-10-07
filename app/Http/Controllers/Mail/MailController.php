<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Mail\Client;
use App\Models\User;
use App;

class MailController extends Controller
{
    public function sendEmail(Request $request,$package){

       
        $user = User::where('id_client',$package->id_client)->first();

        $email_to_send = $user->email;
       
        Mail::to($email_to_send)->send(new Client());

        return;

    }
}

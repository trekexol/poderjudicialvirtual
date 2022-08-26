<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class WhatsAppChannelController extends Controller
{
    public function send()
    {
       
        $sid    = "AC35c2fc532a6c1a395a1db407d31488e0"; 
        $token  = "ff765f0d5e404ee030b63c1ce7bcdf92"; 
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:+584242014842", // to 
                                   array( 
                                       "from" => "whatsapp:+14155238886",       
                                       "body" => "hhhhhhhhhhhhhh" 
                                   ) 
                          ); 
         
        print($message->sid);

       
        return redirect('/home')->withSuccess('Se ha registrado exitosamente!');
    }
}

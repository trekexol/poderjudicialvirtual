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
       
 
        $sid    = "ACc6fabbf1885958d0e8f0da7cb459fd16"; 
        $token  = "42f5ffb14a270acada4be224e0fc57c1"; 
        $twilio = new Client($sid, $token); 
         
        $message = $twilio->messages 
                          ->create("whatsapp:+584242041615", // to 
                                   array( 
                                       "from" => "whatsapp:+14155238886",       
                                       "body" => "hola Señor Nestor, Soy Carlos, ya couriertool puede enviar msj por whatsapp, ahora estoy viendo si arriba puedo cambiarle el nombre e imagen por couriertool" 
                                   ) 
                          ); 
         
        print($message->sid);

        return redirect('/home')->withSuccess('Se ha registrado exitosamente!');
    }
}

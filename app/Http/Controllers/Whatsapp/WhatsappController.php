<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Channels\Messages\WhatsAppMessage;
use App\Notifications\OrderProcessed;
use Illuminate\Bus\Queueable;

use GuzzleHttp;
use GuzzleHttp\Client;
use Storage;

class WhatsappController extends Controller
{
  
    public function index(){
       /* $json = [
            'operacion'=>'registermessage',
            'token_qr'=>'OXzTLdXnCYcCFUA=',
            'mensajes'=>[
                   'numero'=>'584242041615',
                   'mensaje'=>'ola pr888888888'
             ]
        ];*/

        $client = new Client();
        $res = $client->request('POST', 'https://01da9qbyce.execute-api.us-east-2.amazonaws.com/dev/whatsapp', [
            'headers'=>['Content-Type'=>'application/json'],
            'json' => [
               
                'token_qr' => 'OXzTLdXnCYcCFUA=',
                'mensajes' => [
                    'numero' => '584242041615',
                    'mensaje' => 'ola proba2432',
                ],
            ]
        ]);
      

        
       /* $client = new GuzzleHttp\Client();
        $response = $client->request('POST','https://01da9qbyce.execute-api.us-east-2.amazonaws.com/dev/whatsapp',
        [
            'headers'=>['Content-Type'=>'application/json'],
            'json'=>$json
        ]
        );*/

        return redirect('/home')->withSuccess('Se ha registrado exitosamente!');
      
    }
    
}
/*      
        $json = [
            'token'=>'',
            'source'=>'+5804242041615',
            'destination'=>'+5804242097471',
            'type'=>'text',
            'body'=>[
                'text'=>'probando'
            ]
        ];

        $client = new GuzzleHttp\Client();
        $response = $client->request('POST','http://waping.es/api/send',
        [
            'headers'=>['Content-Type'=>'application/json'],
            'json'=>$json
        ]
        )*/
<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goutte\Clientg;

class BcvController extends Controller
{
    public function search_bcv()
    {
        $clientg = new Clientg();

        $url = "http://www.bcv.org.ve/bcv/contactos";
    
        $ch = curl_init( $url );
        // Establecer un tiempo de espera
        curl_setopt( $ch, CURLOPT_TIMEOUT, 3 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 3 );
        // Establecer NOBODY en true para hacer una solicitud tipo HEAD
        curl_setopt( $ch, CURLOPT_NOBODY, true );
        // Permitir seguir redireccionamientos
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        // Recibir la respuesta como string, no output
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        // Descomentar si tu servidor requiere un user-agent, referrer u otra configuración específica
        // $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36';
        // curl_setopt($ch, CURLOPT_USERAGENT, $agent)
        $data = curl_exec( $ch );
        // Obtener el código de respuesta
        $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        //cerrar conexión
        curl_close( $ch );
        // Aceptar solo respuesta 200 (Ok), 301 (redirección permanente) o 302 (redirección temporal)
        $accepted_response = array( 200, 301, 302 );
        if( in_array( $httpcode, $accepted_response ) ) {
            $urlexists = true;
        } else {
            $urlexists = false;
        }
        if ($urlexists == true) { // condicion para validar consulta 
            $crawler = $clientg->request('GET', 'http://www.bcv.org.ve/bcv/contactos');
        } else {
            $crawler = '';   
        }

            if ($crawler != '') {

               $contact = $crawler->filter("[class='col-sm-6 col-xs-6 centrado']")->last();      
               
               if (count($contact) > 0) {

                   $rateconsult = $contact->text();
                   $bcv = str_replace(',', '.', str_replace('.', '',$rateconsult));
                   $bcv = bcdiv($bcv, '1', 2);  

                  
               } 

            } 

            /*-------------------------- */
            return bcdiv($bcv, '1', 2);

    
    }




    
}

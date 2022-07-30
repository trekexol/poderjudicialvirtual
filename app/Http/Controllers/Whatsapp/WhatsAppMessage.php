<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhatsAppMessage extends Controller
{
    public $content;
  
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}

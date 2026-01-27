<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class MensajeRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
        // $this->middleware('auth');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                return $this->view('contacto.contactarlicu');
                break;
            case "MACU":
                return $this->view('contacto.contactarmacu');
                break;
        }
    }
}

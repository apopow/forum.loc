<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    public $subject ="Новое сообщение";

    public $reply;

    public $unit;
   
    public function __construct($reply, $unit)
    {
        $this->reply = $reply;
        $this->unit = $unit;
    }

    public function build()
    {
        return $this->view('emails.letter');
    }
}

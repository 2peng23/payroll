<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaySlip extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $receiver,$slip=[];
    public function __construct($receiver,$data)
    {
        $this->receiver = $receiver;
        $this->slip=$data;
    }

   
    public function build()
    {
        return $this->markdown('mail.payslip');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class payment extends Mailable
{
    use Queueable, SerializesModels;
    private $payment_name_to_send = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_pdf)
    {
        $this->$payment_name_to_send =$order_pdf;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.mail.payment',[

            'payment_name_to_send' =>$this->payment_name_to_send
        ]);
    }
}

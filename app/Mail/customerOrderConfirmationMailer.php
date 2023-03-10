<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class customerOrderConfirmationMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data, $base_url;
    public $all;

    public function __construct($data,$all,$base_url)
    {
        $this->data = $data;
        $this->all = $all;
        $this->base_url = $base_url;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.order-confirmation')->subject('Confirmation Mail from Rapti Fashion');
    }
}

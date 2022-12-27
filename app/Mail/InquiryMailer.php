<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return $this
     */
    public function build()
    {
        $email = $this->view('mails.inquiry-mail')->subject('New Inquiry Request');
        return $email;
    }
}

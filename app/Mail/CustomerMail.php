<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customerMail')
                ->subject($this->data['sub'])
                ->from($this->data['from'],$this->data['companyName'])
                ->with('data',$this->data);
        
    }
}

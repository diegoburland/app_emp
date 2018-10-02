<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OcupasionEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $data;

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
        //return $this->view('view.name');

        $address = 'ocupasion2018@gmail.com';
        $subject = $this->data['subject'];
        $name = 'VidaAndWork.com';

        return $this->view($this->data['template'])
                    ->from($address, $name)
                    //->cc($address, $name)
                    //->bcc($address, $name)
                    //->replyTo($address, $name)
                    ->subject($subject)
                    ->with($this->data);
    }
}

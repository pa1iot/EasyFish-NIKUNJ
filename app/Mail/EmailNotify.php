<?php

namespace ZigKart\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $record;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($record)
    {
        $this->record = $record;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        return $this->view('email.EmailNotify')->subject('Email Alert')
            ->from('protesting123@gmail.com', 'EasyFish');
    }
}

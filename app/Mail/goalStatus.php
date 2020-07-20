<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class goalStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $goal;
    public $buyer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($goal, User $buyer)
    {
        $this->goal = $goal;
        $this->buyer = $buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.goalStatus')->subject('Your daily status of spending goals');
    }
}

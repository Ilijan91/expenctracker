<?php

namespace App\Mail;

use App\User;
use App\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $buyer;
    public $vendor;
    public $amount;
    public $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $buyer, Vendor $vendor, $amount, $request)
    {
        $this->buyer = $buyer;
        $this->vendor = $vendor;
        $this->amount = $amount;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.transactionCreated')->subject('Transaction notification from your account');
    }
}

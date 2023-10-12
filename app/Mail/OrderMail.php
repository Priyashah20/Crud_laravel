<?php

namespace App\Mail;

use App\Model\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
      //  return $this->subject('Order Confirmation')->view('emails.ordermail');

         return $this->subject('Order Confirmation')->with(['order'=>$this->order,'msg'=>$this])->markdown('emails.ordermail');
    }
}

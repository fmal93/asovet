<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Comuna;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Pedido Asovet';

    public $order;

    public $datos;

    public $buyOrder;

    public $comuna;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $datos, $buyOrder)
    {
        $this->order = $order;
        $this->datos = $datos;
        $this->buyOrder = $buyOrder;
        $this->comuna = Comuna::find($datos['c_comuna'])->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('myamin@asovet.cl')->view('layouts.mail')->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('Asovet Pedido', 'Asovet Pedido');
        }); 
    }
}

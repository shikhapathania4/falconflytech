<?php
namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $oldStatus;
    public $newStatus;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $oldStatus, $newStatus)
    {
        $this->order = $order;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('tanujapathania81@gmail.com', 'FalconFly')
                    ->subject('Order Status Changed')
                    ->view('emails.order_status_changed')
                    ->with([
                        'order' => $this->order,
                        'oldStatus' => $this->oldStatus,
                        'newStatus' => $this->newStatus,
                    ]);
    }
}

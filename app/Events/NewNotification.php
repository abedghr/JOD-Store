<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $order_id;
    public $name;
    public $email;
    public $city;
    public $provider_id;
    public $total_price;
    public $date;
    public $time;
    public function __construct($data)
    {
        $this->order_id = $data['order_id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->city = $data['city'];
        $this->provider_id = $data['provider_id'];
        $this->total_price = $data['total_price'];
        $this->date = date("Y M d",strtotime(Carbon::now()));
        $this->time = date("h:m A",strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-notification');
    }
    
}

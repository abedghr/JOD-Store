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

class NewFeedbackNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $feedback_id;
    public $feedback;
    public $feedback_userID;
    public $feedback_provID;
    public $date;
    public $time;
    public function __construct($data)
    {
        $this->feedback_id = $data['feedback_id'];
        $this->feedback = $data['feedback'];
        $this->feedback_userID = $data['feedback_userID'];
        $this->feedback_provID = $data['feedback_provID'];
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

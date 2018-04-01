<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

abstract class ParticipantEvent implements ShouldBroadcast
{
    public $results;
    public $gate;
    public $date;
    public $event_type;

    public function __construct($event_type, $gate, $results)
    {
        $this->event_type = $event_type;
        $this->gate = $gate;
        $this->results = $results;
        $this->date = date("G:i:s");
    }

    public function broadcastOn()
    {
        return new Channel('participant');
    }

    public function broadcastAs()
    {
        return 'participant';
    }

}
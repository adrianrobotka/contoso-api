<?php

namespace App\Events;

class IdentifyEvent extends ParticipantEvent
{
    public function __construct($gate, $results)
    {
        parent::__construct("identify", $gate, $results);
    }
}
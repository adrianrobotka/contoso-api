<?php

namespace App;

class ParticipantView extends Participant
{
    public $incrementing = false;

    protected $table = 'participant_overview';

    public function images()
    {
        return ParticipantImage::where('participant_id', $this->id);
    }
}
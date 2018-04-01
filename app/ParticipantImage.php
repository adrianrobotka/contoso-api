<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class ParticipantImage extends BaseModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'participant_id'
    ];

    // Get URL of the image
    public function getUrl()
    {
        return Storage::disk('images')->url($this->id . '.jpg');
    }
}
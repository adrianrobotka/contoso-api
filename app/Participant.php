<?php

namespace App;

class Participant extends BaseModel
{
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'email', 'birth', 'company', 'work_title'
    ];

    public function images()
    {
        return $this->hasMany('App\ParticipantImage');
    }
}
<?php

namespace App;

class Organizer extends BaseAuth
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function getName()
    {
        return $this->last_name . " " . $this->first_name;
    }
}

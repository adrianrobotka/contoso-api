<?php

namespace App;

class Group extends BaseModel
{
    public $timestamps = false;

    public function getName()
    {
        return $this->id == 1 ? $this->name . ' (alapértelmezett)' : $this->name;
    }

    public function participants()
    {
        return Participant::where('group_id', $this->id);
    }
}
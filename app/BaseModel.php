<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getDateFormat()
    {
        if (env('DB_CONNECTION') == "mysql")
            return 'Y-m-d H:i:s';

        return 'Y-m-d H:i:s.u';
    }

    public function fromDateTime($value)
    {
        return substr(parent::fromDateTime($value), 0, -3);
    }
}

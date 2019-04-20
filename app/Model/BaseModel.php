<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    function __construct()
    {
        parent::__construct();
       $this->setTable(array_reverse(explode("\\",get_called_class()))[0]);

    }
}

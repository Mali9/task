<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function emloyees()
    {
        return $this->hasMany('App\Emloyee');
    }
}

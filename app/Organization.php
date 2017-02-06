<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function ranks()
    {
        return $this->hasMany('\App\Rank');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    public function organization()
    {
        return $this->belongsTo('\App\Organization');
    }

    public function clients()
    {
        return $this->hasMany('\App\Client');
    }
}

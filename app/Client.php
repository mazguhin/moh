<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function organization()
    {
        return $this->belongsTo('\App\Organization');
    }

    public function rank()
    {
        return $this->belongsTo('\App\Rank');
    }
}

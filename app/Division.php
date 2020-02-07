<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}

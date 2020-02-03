<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}

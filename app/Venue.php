<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}

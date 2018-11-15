<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class)->withPivot('price')->withTimestamps();
    }
}

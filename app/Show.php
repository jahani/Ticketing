<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class);
    }
}

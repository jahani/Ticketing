<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}

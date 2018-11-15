<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function row()
    {
        return $this->belongsTo(Row::class);
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class)->withPivot('user')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function shows()
    {
        return $this->belongsToMany(Show::class)->withPivot('user_id')->withTimestamps();
    }
}

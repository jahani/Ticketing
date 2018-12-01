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
        return $this->belongsToMany(Show::class)
            ->as('reserves')
            ->withPivot('price', 'status', 'session_id', 'user_id', 'order_id')
            ->withTimestamps()
            ->using(SeatShow::class);
    }

    // Relations with Show Model
    public function hasReserveData()
    {
        return isset($this->reserves);
    }
    
    
}

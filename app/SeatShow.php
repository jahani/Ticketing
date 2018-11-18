<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Enums\SeatBookType;

class SeatShow extends Pivot
{
    public function setStatusAttribute($value)
    {
        $this->attributes['status_code'] = SeatBookType::getValue($value);
    }

    public function getStatusAttribute()
    {
        return SeatBookType::getKey($this->status_code);
    }
}

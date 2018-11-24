<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Enums\SeatBookType;
use Illuminate\Support\Facades\Auth;

class SeatShow extends Pivot
{
    // public function setStatusAttribute($value)
    // {
    //     $this->attributes['status_code'] = SeatBookType::getValue($value);
    // }

    // public function getStatusAttribute()
    // {
    //     return SeatBookType::getKey($this->status_code);
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isBooked()
    {
        return $this->getStatus() == SeatBookType::Booked;
    }
    
    public function isReserved()
    {
        return $this->getStatus() == SeatBookType::Reserved;
    }

    public function isReservedForClient()
    {
        if (!($this->isReserved())) return false;
        if (session()->getId() == $this->session_id and !is_null($this->session_id)) {
            return true;
        }
        if (!Auth::guest() and $this->user_id == Auth::id()) return true;
        return false;
    }

    // Do Reservation Stuff
    public static function reserve(Seat $seat, Show $show)
    {
        // TODO : check if reservable
        $status = SeatBookType::Reserved;
        $session_id = session()->getId();
        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            $user_id = null;
        }
        $seat->shows()->attach($show, compact('status', 'session_id', 'user_id'));
    }

    public function unreserve()
    {
        if (!$this->isReservedForClient()) return false;
        $this->delete();
        return true;
    }

    public function book()
    {
        // TODO : if bookable
        return true;
    }
}

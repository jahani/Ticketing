<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Enums\SeatBookType;
use Illuminate\Support\Facades\Auth;

class SeatShow extends Pivot
{

    /**
     * Relations
     */

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Class Actions
     */

    public static function cleanup()
    {
        return self::expired()->delete();
    }

    /**
     * Scopes
     */

    public function scopeExpired($query)
    {
        return $query->reserved()
            ->where(
                'updated_at', '<',
                now()->subMinutes(config('app.reserves_expire_timeout'))
            );
    }

    public function scopeReserved($query)
    {
        return $query->where('status', SeatBookType::Reserved)
            ->whereNull('order_id');
    }

    /**
     * Helpers
     */

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
        if (isset($this->order_id)) return false;
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

    public function bookToOrder(Order $order)
    {
        if (!$this->isBookable()) {
            throw new Exception("book is not bookable", 1);
        }

        return $this->show->seats()
            ->updateExistingPivot($this->seat->id, [
                'status' => SeatBookType::Booked
            ]);
    }
    
    public function isBookable()
    {
        // TODO : if bookable
        return true;
    }

    public function getPrice()
    {
        return $this->show->sections
        ->whereStrict('id', $this->seat->section->id)
        ->first()->pivot->price;
    }

    public function attachToOrder(Order $order)
    {
        // TODO : if does not already have an order

        $this->show->seats()
            ->updateExistingPivot($this->seat->id, [
                'price' => $this->getPrice(),
                'order_id' => $order->id
            ]);
        // TODO : why this example is not working as expected:
        // $seatShow->price = 3500;
        // $seatShow->save();
        // dd($seatShow);
    }

    public static function currentClientReserves()
    {
        return self::where('status', SeatBookType::Reserved)
            ->whereNull('order_id')
            ->Where(function($q) {
                $q->where('session_id', session()->getId());
                if (Auth::check()) {
                    $q->orWhere('user_id', Auth::id());
                }
            });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Enums\SeatBookType;

class Order extends Model
{
    /**
     * Relations
     */

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function seatShows()
    {
        return $this->hasMany(SeatShow::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helpers
     */
    
    public function getSeatShows()
    {
        return self::getCart($this);
    }

    public static function getCart(?Order $order = null)
    {
        if (is_null($order)) {
            $seatShows = SeatShow::currentClientReserves()->get();
        } else {
            $seatShows = $order->seatShows;
        }

        // We will need this data to mass calculate price
        // which depends on section-show
        // 'seat.section.stage' part is used for views
        if ($seatShows->isNotEmpty()) {
            $seatShows->load('show', 'show.sections', 'seat', 'seat.section', 'seat.section.stage');

            // Load price data if reserve is not attached to an order
            // and price is not fixed yet.
            
            // This is a patch to use sum('price') on this collection
            if (is_null($order)) {
                foreach ($seatShows as $seatShow) {
                    $seatShow->price = $seatShow->getPrice();
                }
            }

        }

        return $seatShows;
    }

    // Create and return an order based on client reservations
    public static function create()
    {
        $reservedSeats = self::getCart();

        if ($reservedSeats->isEmpty()) {
            return;
        }

        DB::beginTransaction();

        try {

            $order = new Order();
            if(auth()->check()) {
                $order->user_id = auth()->id();
            } else {
                $order->tracking_code = str_random(
                    config('tracking_code_length')
                );
            }
            $order->save();

            foreach ($reservedSeats as $seatShow) {
                $seatShow->attachToOrder($order);
            }

        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return $order;
    }
}

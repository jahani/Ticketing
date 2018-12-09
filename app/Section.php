<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Section extends Model
{
    protected $fillable = ['name'];

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

    public function getGroupedSeats()
    {
        $allSeats = $this->seats;

        $seats = array();
        foreach ($allSeats as $seat) {
            $seats[$seat->row_number][$seat->seat_number] = $seat;
        }
        
        ksort($seats);
        foreach ($seats as $key => $seatsRow) {
            ksort($seatsRow);
            $seats[$key] = array_values($seatsRow);
        }

        $seats = array_values($seats);

        

        
        return $seats;
    }
    
    public function getSortedSeats()
    {
        $allSeats = $this->seats;

        // Sort seats but not group them
        $seats = $allSeats->all();
        $row_number  = array_column($seats, 'row_number');
        $seat_number = array_column($seats, 'seat_number');
        array_multisort($row_number, SORT_ASC, $seat_number, SORT_ASC, $seats);

        return $seats;
    }

    public function getDimmentions()
    {
        $seats = $this->seats;

        $rows = 0;
        $cols = 0;
        foreach ($seats as $seat) {
            $rows = max($rows, $seat->row_number);
            $cols = max($cols, $seat->seat_number);
        }

        return [$rows, $cols];
    }

    public function addRows(Array $rows)
    {
        // Reset index
        $rows = array_values($rows);
        
        // Validate bounding
        if(min($rows) < 0) {
            throw new Exception("Seats count can't be less than zero!", 1);
        }

        
        // Create seats
        $section = $this;
        DB::transaction(function() use ($section, $rows)
        {
            foreach ($rows as $i => $seatNumbers) {
                for ($j=1; $j <= $seatNumbers; $j++) { 
                    $seat = new Seat();
                    $seat->row_number = $i + 1;
                    $seat->seat_number = $j;
                    $section->seats()->save($seat);
                }
            }
        });
        
        // If succeeded
        return true;
    }
}

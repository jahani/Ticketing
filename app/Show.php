<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = ['name'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class)
            ->withPivot('price')->withTimestamps();
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class)
            ->as('reserve')
            ->withPivot('user_id', 'status', 'session_id')
            ->withTimestamps()
            ->using(SeatShow::class);
    }

    public function sectionSeats(Section $section)
    {
        $sectionSeats = $section->seats;
        // TODO : Built query is not specific about section_id
        $showSeats = $this->seats->where('section_id', $section->id);
        $seats = $sectionSeats->merge($showSeats);
        return $seats;
    }

    public function hasSection(Section $section)
    {
        return $this->sections->contains($section);
    }

    public function sectionPrice(Section $section)
    {
        return $this->sections->find($section)->pivot->price;
    }
}

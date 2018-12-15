<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Section, Show, Seat, SeatShow};

class ReserveController extends Controller
{
    public function show(Show $show, Section $section)
    {
        if (!$show->hasSection($section)) abort(404);
        return view('reserves.section', compact('show', 'section'));
    }

    public function store(Show $show, Seat $seat)
    {
        SeatShow::reserve($seat, $show);
        return back();
    }

    public function destroy(Show $show, Seat $seat)
    {
        // TODO :
        // This is much more eloquent :
        // Just needed to check unreserve() conditions :
        // $show->seats()->detach($seat);

        $show->seats()->wherePivot('seat_id', $seat->id)
            ->first()->reserves->unreserve();

        return back();
    }
}

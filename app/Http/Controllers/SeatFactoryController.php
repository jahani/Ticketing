<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\Auth; // Logged user data
use Illuminate\Support\Facades\Gate;

class SeatFactoryController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'auth.admin']);
    }

    private static function isCreatable(Section $section)
    {
        if($section->seats->isNotEmpty()) {
            session()->flash('message',
                __(
                    'This section already has :number seats!
                    <br>You may delete all of them <a href=":href">here</a>',
                    ['number' => $section->seats->count(), 'href' => route('seatfactory.destroy', $section)]
                )
            );
            session()->flash('alert-class', 'alert-danger');
            return true;
        }
        return false;
    }

    public function create(Section $section)
    {
        if (self::isCreatable($section)) {
            return view('layouts.app');
        }
        return view('seatfactory.create', compact('section'));
    }
    
    public function store(Request $request, Section $section)
    {
        if (self::isCreatable($section)) {
            return response()->json(['data' => 'Section is not creatable.'], 401);
        }
        
        $rows = array();
        foreach ($request->input('rows') as $row) {
            if(array_key_exists("value",$row)) {
                array_push($rows, $row['value']);
            }
        }

        if(empty($rows)) {
            return response()->json(['data' => 'No proper value is passed.'], 401);
        }

        if (!$section->addRows($rows)) {
            return response()->json(['data' => 'There was an error for adding seats.'], 401);
        }

        return response()->json(['data' => 'Seats added to database']);
    }

    public function destroy(Section $section)
    {
        $seats = $section->seats;
        $seats->load('shows');
        foreach ($seats as $seat) {
            if($seat->shows->count()) {
                session()->flash('message', __('Seat :seat has :num reservations',
                    ['seat' => $seat->id, 'num' => $seat->shows->count()]
                ));
                return view('layouts.app');
            }
        }
        $section->seats()->delete();
        session()->flash('message', __('Section seats deleted successfully!'));
        return view('layouts.app');
    }
}

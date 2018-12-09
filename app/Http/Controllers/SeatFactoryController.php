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
            return false;
        }
        return true;
    }
    
    public function store(Request $request, Section $section)
    {
        if (!self::isCreatable($section)) {
            return ['ok' => false, 'error' => 'Section already has some seats.'];
        }

        $rows = $request->input('rows');

        if(empty($rows)) {
            return ['ok' => false, 'error' => 'No proper value is passed.'];
        }

        if (!$section->addRows($rows)) {
            return ['ok' => false, 'error' => 'There was an error for adding seats.'];
        }

        return ['ok' => true, 'message' => 'Seats added to database', 'seats' => $section->seats()->get()];
    }

    public function destroy(Section $section)
    {

        $seats = $section->seats;
        $seats->load('shows');
        foreach ($seats as $seat) {
            if($seat->shows->count()) {
                $error = __('Seat :seat has :num reservations',
                    ['seat' => $seat->id, 'num' => $seat->shows->count()]
                );
                return ['ok' => false, 'error' => $error];
            }
        }

        $section->seats()->delete();
        return ['ok' => true];
    }
}

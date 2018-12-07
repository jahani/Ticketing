<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Venue, Stage, Section};

class PlaceController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'auth.admin']);
    }

    public function index()
    {
        return view('places.index');
    }
}

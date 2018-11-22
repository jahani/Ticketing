<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Section, Show};

class ReserveController extends Controller
{
    public function show(Show $show, Section $section)
    {
        if (!$show->hasSection($section)) abort(404);
        return view('reserves.section', compact('show', 'section'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Seat;
use App\Section;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function index(Section $section)
    {
        return $section->seats()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function create(Section $section)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Section $section)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section, Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section, Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section, Seat $seat)
    {
        //
    }
}

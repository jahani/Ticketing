<?php

namespace App\Http\Controllers;

use App\Stage;
use App\Venue;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function index(Venue $venue)
    {
        return $venue->stages()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function create(Venue $venue)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Venue $venue)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:180',
        ]);

        $stage = $venue->stages()->create($request->all());

        return $stage;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venue  $venue
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue, Stage $stage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue, Stage $stage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue, Stage $stage)
    {
        // TODO: validation

        $stage->update($request->all());

        return $stage;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue, Stage $stage)
    {
        $stage->delete();
        
        return $stage;
    }
}

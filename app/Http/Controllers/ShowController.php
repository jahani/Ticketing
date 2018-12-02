<?php

namespace App\Http\Controllers;

use App\{Show, Event, Section};
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('shows.create')->with(compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:180',
            'start' => 'required',
            'end' => 'required|after:start',
        ]);

        $show = new Show();
        $show->fill($request->except('start', 'end'));
        $show->start = Carbon::parse($request->input('start'))->toDateTimeString();
        $show->end = Carbon::parse($request->input('end'))->toDateTimeString();
        
        $event->shows()->save($show);

        return redirect()->route('events.show', $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show)
    {
        // Check authentication
        $show->load(['sections', 'sections.stage', 'sections.stage.venue']);
        $sections = Section::with(['stage', 'stage.venue'])->get();
        return view('shows.show', compact('show', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\{Event};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Logged user data
use App\Enums\EventStatusType;
use BenSampo\Enum\Rules\EnumValue;

class EventController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Event::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
            $events = Event::published()->get();
        } else {
            $events = Auth::user()->events;
        }
        return view('events.index')->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create')->with(compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO handle $errors
        $this->validate($request, [
            'name' => 'required|min:3|max:180',
            'status' => [new EnumValue(EventStatusType::class, false)],
        ]);

        Auth::user()->events()->create($request->all());

        // $event = new Event();
        // $event->fill($request->all());
        // $event->user_id = Auth::id();
        // $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event->load('shows');
        return view('events.show')->with(compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\{Event};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Logged user data
use App\Enums\PublishType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Storage;

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
        $events = Event::published()->paginate();
        return view('events.index', compact('events'));
    }

    public function mine()
    {
        $events =  Auth::user()->events()->paginate();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required|min:3|max:180',
            'image' => 'mimes:png,gif,jpeg,jpg|max:1024',
            'status' => [new EnumValue(PublishType::class, false)],
        ]);
        
        $event = new Event();
        $event->fill($request->except(['image']));
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('uploads/events', 'public');
        }
        Auth::user()->events()->save($event);

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

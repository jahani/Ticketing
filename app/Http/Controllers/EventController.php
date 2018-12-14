<?php

namespace App\Http\Controllers;

use App\{Event};
use App\Filters\{EventFilter};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Logged user data
use App\Http\Requests\EventRequest;
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
    public function index(EventFilter $filter)
    {
        $events = Event::notDraft();
        $events = $filter->apply($events);
        $events = $events->paginate(); // TODO

        return view('events.index', compact('events'));
    }

    public function my()
    {
        $events =  Auth::user()->events()->paginate();
        return view('events.list', compact('events'));
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
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->fill($request->except(['image']));
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('uploads/events', 'public');
        }
        Auth::user()->events()->save($event);

        return redirect()->route('my.events');
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
        return view('events.create', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->fill($request->except(['image']));
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('uploads/events', 'public');
        }
        $event->save();

        session()->flash('message', __('Event has been successfully updated.'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('message', __('Event has been successfully deleted.'));
        session()->flash('alert-class', 'alert-danger');
        return redirect()->route('my.events');
    }
}

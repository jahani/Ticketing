<?php

namespace App\Http\Controllers;

use App\{Event};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Logged user data

class EventController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->get();
        return view('events.index')->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Handle enums
        // $statuses = Event::getPossibleEnumValues('status');
        $statuses = ['draft', 'published'];
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
        $statuses = ['draft', 'published'];
        $this->validate(request(), [
            'name' => 'required|min:3|max:100',
            'status' => 'in:' . implode(',', $statuses),
        ]);

        $event = new Event();
        $event->name = request('name');
        $event->status = request('status');
        $event->user_id = Auth::user()->id;
        $event->save();

        // Event::create([
        //     'name' => request('name'),
        //     'status' => request('status'),
        //     'user_id' => Auth::user()->id,
        // ]);

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

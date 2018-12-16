<?php

namespace App\Http\Controllers;

use App\{Show, Event, Section, Venue};
use App\Filters\{ShowFilter, EventFilter};
use App\Enums\PublishType;
use App\Http\Resources\ShowEventResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Show::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = PublishType::toSelectArray();
        $venues = Venue::all();
        return view('shows.index', compact('statuses', 'venues'));
    }

    public function api(ShowFilter $showFilter, EventFilter $eventFilter)
    {
        // TODO :
        // It is supposed that event and show have different filter names

        $shows = new Show;
        $shows = $shows->orderBy('start');
        $shows = $showFilter->apply($shows);
        
        // Filter by event and load event info
        $shows = $shows->whereHas('event', $filter = function ($query) use ($eventFilter) {
            $query->notDraft(); // Security Concern
            $eventFilter->apply($query);
        })->with(['event' => $filter]);

        // Filter by venue
        if(request()->has('venue_id')) {
            $shows = $shows->whereHas('sections', function ($query) {
                // TODO : Refactor without get()ting it first
                $iDs = Venue::findOrFail(request('venue_id'))->sections()->get();
                $query->whereIn('id', $iDs);
            });
        }

        // Load venue info
        $shows = $shows->with('sections.stage.venue');

        // Paginate
        $shows = $shows->paginate(config('app.show_items_per_page'));

        // Format Output
        $shows = ShowEventResource::collection($shows);

        return $shows;
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
        return view('shows.create', compact('show'));
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
        // TODO Validation

        $show->fill($request->except('start', 'end'));
        $show->start = Carbon::parse($request->input('start'))->toDateTimeString();
        $show->end = Carbon::parse($request->input('end'))->toDateTimeString();
        $show->save();

        session()->flash('message', __('Show has been successfully updated.'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show)
    {
        $show->delete();
        session()->flash('message', __('Show has been successfully deleted.'));
        session()->flash('alert-class', 'alert-danger');

        return redirect()->route('events.show', [$show->event]);
    }
}

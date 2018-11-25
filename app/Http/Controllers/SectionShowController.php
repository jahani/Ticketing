<?php

namespace App\Http\Controllers;

use App\Section;
use App\Show;
use Illuminate\Http\Request;

class SectionShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function index(Show $show)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function create(Show $show)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Show  $show
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Show $show)
    {
        // TODO : if user own the show

        $this->validate($request, [
            'section' => 'required|exists:sections,id',
            'price' => 'required|numeric|min:1|digits_between:1,9',
        ]);
        
        $show->sections()->attach(request('section'), ['price' => request('price')]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Show  $show
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Show $show, Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Show  $show
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Show $show, Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Show  $show
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Show $show, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Show  $show
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Show $show, Section $section)
    {
        //
    }
}

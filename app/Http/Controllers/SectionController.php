<?php

namespace App\Http\Controllers;

use App\Section;
use App\Stage;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'auth.admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function index(Stage $stage)
    {
        return $stage->sections()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function create(Stage $stage)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stage $stage)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:180',
        ]);

        $section = $stage->sections()->create($request->all());

        return $section;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stage  $stage
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage, Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stage  $stage
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage, Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stage  $stage
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage, Section $section)
    {
        // TODO: validation

        $section->update($request->all());

        return $section;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stage  $stage
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage, Section $section)
    {
        $section->delete();
        
        return $section;
    }
}

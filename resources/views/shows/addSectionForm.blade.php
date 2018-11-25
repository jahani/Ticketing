<h2>Add Section to the Show</h2>

@php
    $sectionSelections = [];
    foreach ($sections as $section) { 
        $sectionSelections[$section->id] = $section->name . ', ' . $section->stage->name . ', ' . $section->stage->venue->name;
    }
@endphp

{!!Form::open()->post()->route('sectionshows.shows.store', ['show' => $show])!!}
{!!Form::select('section', 'Choose a Section', $sectionSelections)!!}
{!!Form::text('price', 'Section Price')->type('number')!!}
{!!Form::submit(__('Submit'))!!}
{!!Form::close()!!}
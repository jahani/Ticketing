@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{__('Events')}}</h1>
    <div class="row justify-content-center">

        @each('events.partials.card', $events, 'event')

    </div>
</div>
@endsection
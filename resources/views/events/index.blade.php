@extends('layouts.app')

@section('content')
<div class="container">
    <h1>@lang('Events')</h1>
    <div class="row justify-content-center">

        @each('events.partials.card', $events, 'event')

    </div>
</div>
@endsection
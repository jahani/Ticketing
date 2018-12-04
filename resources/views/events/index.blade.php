@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @each('events.partials.card', $events, 'event')

    </div>
</div>
@endsection
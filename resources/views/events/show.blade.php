@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Event Details') }}</div>

                <div class="card-body">
                    <h1>{{ $event->name }}</h1>
                    <div>Status: {{ $event->status }}</div>

                    <h2>Shows</h2>
                    @if ($event->shows->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($event->shows as $index => $show)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td><a href="#">{{ $show->name }}</a></td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>{{ __('There is no show here!') }}</div>
                    @endif
                    <div>{!! sprintf(__('Why not <a href="%s">create a new one</a>?'), route('events.shows.create', $event)) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
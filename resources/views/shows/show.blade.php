@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Details') }}</div>

                <div class="card-body">
                    <h1>{{ $show->name }}</h1>
                    <div>Back to event <a href="{{ route('events.show', $show->event) }}">{{ $show->event->name }}</a></div>

                    <br>
                    <h2>Sections</h2>
                    @if ($show->sections->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Stage</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($show->sections as $index => $section)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->stage->name }}</td>
                                <td>{{ $section->stage->venue->name }}</td>
                                <td>{{ $section->pivot->price }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>{{ __('There is no section here!') }}</div>
                    @endif
                    {{-- @can('update', $show) --}}
                        {{-- <div>{!! sprintf(__('Why not <a href="%s">add a new section for this show</a>?'), route('')) !!}</div> --}}
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

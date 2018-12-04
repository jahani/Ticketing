@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Event Details') }}</div>

                <img class="img-fluid" src="{{ $event->getImageURL() }}">
                <div class="card-body">

                    @can('update', $event)
                        <a class="btn btn-sm btn-secondary" href="{{ route('events.edit', $event) }}" role="button">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete', $event)
                        {!!Form::open()->delete()->route('events.destroy', [$event])->attrs(['class'=>'inline-form'])!!}
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!!Form::close()!!}
                    @endcan

                    <h1>{{ $event->name }}</h1>
                    <div>Status: {{ $event->statusName }}</div>
                    <div>{!! nl2br(e($event->description)) !!}</div>

                    <h2>Shows</h2>
                    @if ($event->shows->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">End</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($event->shows as $index => $show)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td><a href="{{ route('shows.show', $show) }}">{{ $show->name }}</a></td>
                                <td>
                                    {{ $show->start->toDateTimeString() }}
                                    ({{ $show->start->diffForHumans() }})
                                </td>
                                <td>
                                    {{ $show->end->toFormattedDateString() }}
                                    ({{ $show->end->diffForHumans($show->start, true) }})
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>{{ __('There is no show here!') }}</div>
                    @endif
                    @can('update', $event)
                        <div>{!! sprintf(__('Why not <a href="%s">create a new show</a>?'), route('events.shows.create', $event)) !!}</div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

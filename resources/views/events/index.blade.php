@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Your Events') }}</div>

                <div class="card-body">
                    @if ($events->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($events as $index => $event)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td><a href="{{ route('events.show', $event) }}">{{ $event->name }}</a></td>
                                <td>{{ $event->status }}</td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>{{ __('There is no event here!') }}</div>
                    @endif
                    <div>{!! sprintf(__('Why not <a href="%s">create a new one</a>?'), route('events.create')) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

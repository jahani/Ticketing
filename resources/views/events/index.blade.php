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
                                    <th scope="col">User</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($events as $index => $event)
                            <tr>
                                <th scope="row">{{ $events->firstItem() + $index }}</th>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->statusName }}</td>
                                <td>{{ $event->user->name }}</td>
                                <td>
                                    @can('view', $event)
                                        <a class="btn btn-sm btn-primary" href="{{ route('events.show', $event) }}" role="button">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan
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
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>{{ __('There is no event here!') }}</div>
                    @endif
                    {{ $events->links() }}
                    @can('create', App\Event::class)
                        <div>{!! sprintf(__('Why not <a href="%s">create a new event</a>?'), route('events.create')) !!}</div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

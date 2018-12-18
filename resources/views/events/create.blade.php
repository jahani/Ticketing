@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(isset($event))
                        {{ __('Edit event #:event', ['event' => $event->id]) }}
                    @else
                        {{ __('Create an event') }}
                    @endif
                </div>

                @if(isset($event))
                    <img class="img-fluid" src="{{ $event->getImageURL() }}">
                @endif

                <div class="card-body">

                    @if(isset($event))
                        {!!Form::open()->put()->route('events.update', [$event])->fill($event)->multipart()!!}
                    @else
                        {!!Form::open()->post()->route('events.store')->multipart()!!}
                    @endif
                    {!!Form::text('name', __('Name'))!!}
                    {!!Form::textarea('description', __('Description'))!!}
                    {!!Form::file('image', __('Image'))!!}
                    {!!Form::select('status', __('Status'), App\Enums\PublishType::toSelectArray())!!}
                    {!!Form::submit(__('Submit'))!!}
                    {!!Form::close()!!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

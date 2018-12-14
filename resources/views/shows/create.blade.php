@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if(isset($show))
                        {{ __('Edit show #:show', ['show' => $show->id]) }}
                    @else
                        {{ __('Create a show') }}
                    @endif
                </div>

                <div class="card-body">
                    
                    @if(isset($show))
                    <div>You are editing <a href="{{ route('shows.show', [$show]) }}">a show</a> for <a href="{{ route('events.show', $show->event) }}">{{ $show->event->name }}</a> event.</div>
                        <form method="POST" action="{{ route('shows.update', $show) }}">
                            @method('PUT')
                    @else
                        <div>You are creating a new show for <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a> event.</div>
                        <form method="POST" action="{{ route('events.shows.store', $event) }}">
                    @endif
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', isset($show) ? $show->name : null) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Start') }}</label>

                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker-start" class="datetimepicker" data-target-input="nearest">
                                    <input name="start" value="{{ old('start', isset($show) ? $show->start->format('m/d/Y g:i A') : null) }}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-start"/>
                                    <div class="input-group-append" data-target="#datetimepicker-start" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                
                                @if ($errors->has('start'))
                                    <span class="text-danger" role="alert">
                                        {{ $errors->first('start') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('End') }}</label>

                            <div class="col-md-6">
                                <div class="input-group date" id="datetimepicker-end" class="datetimepicker" data-target-input="nearest">
                                    <input name="end" value="{{ old('end', isset($show) ? $show->end->format('m/d/Y g:i A') : null) }}" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-end"/>
                                    <div class="input-group-append" data-target="#datetimepicker-end" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>

                                @if ($errors->has('end'))
                                    <span class="text-danger" role="alert">
                                        {{ $errors->first('end') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

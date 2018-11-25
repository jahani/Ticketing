@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a new event') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required :autofocus="'autofocus'">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                @php
                                    $statuses = App\Enums\EventStatusType::toSelectArray();
                                @endphp
                                @foreach ($statuses as $statusKey => $statusDescription)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status"
                                        id="status-{{ $statusKey }}" value="{{ $statusKey }}"
                                        @if (old('status') == $statusKey )) checked @endif>
                                        <label class="form-check-label" for="status-{{ $statusKey }}">
                                                {{ $statusDescription }}
                                        </label>
                                    </div>
                                @endforeach
                                        
                                @if ($errors->has('status'))
                                    <span class="text-danger" role="alert">
                                        {{ $errors->first('status') }}
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

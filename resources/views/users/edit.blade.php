@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Profile') }}</div>

                <div class="card-body">
                    {!!Form::open()->put()->route('users.update', [$user])->fill($user)->multipart()!!}
                    <h4>{{__('Personal Data')}}</h4>
                    {!!Form::text('name', __('Name'))!!}
                    {!!Form::text('password', __('Password'))->type('password')->placeholder('Fill to update your password')!!}
                    {!!Form::text('password_confirmation', __('Confirm Password'))->type('password')->placeholder('Fill to update your password')!!}
                    <h4>{{__('Organization Data')}}</h4>
                    {!!Form::text('organizer_name', __('Organizer Name'))!!}
                    {!!Form::text('organizer_tel', __('Organizer Tel'))!!}
                    {!!Form::submit(__('Update'))!!}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('User Profile')</div>

                <div class="card-body">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->organizer_name }}</p>
                    <p>{{ $user->organizer_tel }}</p>

                    @can('update', $user)
                        <a class="btn btn-secondary" href="{{ route('users.edit', $user) }}" role="button">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

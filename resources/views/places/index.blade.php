@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Manage Places')</div>

                <div class="card-body">

                    <places-index></places-index>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

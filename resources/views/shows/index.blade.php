@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{__('Shows')}}</h1>
    <shows-index
        :statustypes="{{ json_encode($statuses) }}"
        :venues="{{ $venues }}"
        :now="'{{ now()->toDateTimeString() }}'"
    />
</div>
@endsection
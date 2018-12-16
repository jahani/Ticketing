@extends('layouts.app')

@section('content')
<shows-index
    :statustypes="{{ json_encode($statuses) }}"
    :venues="{{ $venues }}"
    :now="'{{ now()->toDateTimeString() }}'"
/>
@endsection
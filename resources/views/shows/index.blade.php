@extends('layouts.app')

@section('content')
<shows-index
    :statustypes="{{ json_encode($status) }}"
    :now="'{{ now()->toDateTimeString() }}'"
/>
@endsection
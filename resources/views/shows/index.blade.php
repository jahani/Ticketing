@php
    // dump(json_encode($status));
@endphp

@extends('layouts.app')

@section('content')
<shows-index :statustypes="{{ json_encode($status) }}"></shows-index>
@endsection
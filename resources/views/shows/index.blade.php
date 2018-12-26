@extends('layouts.app')

@section('content')
<div class="container">
    <h1>@lang('Shows')</h1>
    <shows-index
        :statustypes="{{ json_encode($statuses) }}"
        :status-types-draft-code="{{ \App\Enums\PublishType::Draft }}"
        :venues="{{ $venues }}"
        :now="'{{ now()->toDateTimeString() }}'"
    />
</div>
@endsection
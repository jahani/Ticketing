@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create section seats') }}</div>

                <div class="card-body">
                    <h1>Add seats for section <a href="#">{{ $section->name }}</a></h1>

                    <section-factory section_id="{{ $section->id }}"></section-factory>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

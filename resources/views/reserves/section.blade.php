@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Seat Reserve</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>{{__('Section')}}: {{ $section->name }}</h1>
                    <h1>{{__('Show')}}: {{ $show->name }}</h1>
                    <h1>{{__('Price')}}: @price($show->sectionPrice($section))</h1>
                    <h4>
                        {{ __('Belongs to ') }}
                        {{ $section->stage->name }}{{ __(', ') }}
                        {{ $section->stage->venue->name }}
                    </h4>

                    <p>{{__('Please chooose your seats.')}}</p>

                    @include('sections.seats')

                    <br>
                    <a class="btn btn-primary" role="button" href="{{ route('orders.create') }}">
                        {{ __('Cart') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

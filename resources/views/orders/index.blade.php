@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>

                <div class="card-body">
                    <div class="pb-2">
                        <h1>Track an Order</h1>
                        @include('orders.partials.track')
                    </div>
                    
                    @auth
                        <h1>Your Orders</h1>
                        @include('orders.partials.list')
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order Detail') }}</div>

                <div class="card-body">
                    <h1>
                        {{ __('Order #:order', ['order'=> $order->id]) }}
                    </h1>
                    @include('seatShows.partials.list')

                    @if ($order->status == app('App\Enums\OrderType')::Waiting)
                        {!!Form::open()->post()->route('orders.show', [$order])!!}
                        {!!Form::submit(__('Pay (TODO)'))!!}
                        {!!Form::close()!!}
                    @else
                        <div>
                            <strong>{{ __('Order Status') }}: </strong>
                            {{ app('App\Enums\OrderType')::getDescription($order->status) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

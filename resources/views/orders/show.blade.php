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
                    <div>
                        <strong>{{ __('Order Status') }}: </strong>
                        {{ app('App\Enums\OrderType')::getDescription($order->status) }}
                    </div>
                    @isset($order->tracking_code)
                        <div>
                            <strong>{{ __('Tracking Code') }}: </strong>
                            {{ $order->tracking_code }}
                        </div>
                    @endisset

                    @include('seatShows.partials.list')

                    @if ($order->status == app('App\Enums\OrderType')::Waiting)
                        <div class="lead py-2" data-countdown-for="{{ $order->secondsUntilExpire() }}"></div>
                        {!!Form::open()->post()->route('orders.show', [$order])->attrs(['class'=>'inline-form'])!!}
                        {!!Form::submit(__('Pay (TODO)'))!!}
                        {!!Form::close()!!}
                        {!!Form::open()->delete()->route('orders.destroy', [$order])->attrs(['class'=>'inline-form'])!!}
                        {!!Form::submit(__('Cancel'))->color('danger')!!}
                        {!!Form::close()!!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

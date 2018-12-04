@php
    $cart = \App\Order::getCart();
@endphp
@if ($cart->count())
    <li class="nav-item">
        <a class="nav-link text-info" href="{{ route('orders.create') }}">
            {{ __('Cart') }}
            &nbsp;
            ({{$cart->count()}} {{ str_plural(__('seat'), $cart->count()) }}
            &nbsp;/&nbsp;
            @price($cart->sum('price')))
        </a>
    </li>
@endif
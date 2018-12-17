@if ($cart->count())
    <li class="nav-item">
        <a class="nav-link text-success" href="{{ route('orders.create') }}">
            {{ __('Cart') }}
            &nbsp;
            ({{$cart->count()}} {{ str_plural(__('seat'), $cart->count()) }}
            &nbsp;/&nbsp;
            @price($cart->sum('price')))
        </a>
    </li>
@endif
@if ($cart->count())
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.create') }}">
            {{ __('Cart') }}
            &nbsp;
            (
                {{
                    trans_choice(
                        __(':num seat|:num seats'),
                        $cart->count(),
                        ['num' => $cart->count()]
                    )
                }}
            &nbsp;/&nbsp;
            @price($cart->sum('price')))
        </a>
    </li>
@endif
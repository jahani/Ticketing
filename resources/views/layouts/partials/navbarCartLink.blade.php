@if ($cart->count())
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.create') }}">
            @lang('Cart')
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
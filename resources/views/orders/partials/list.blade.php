@if ($orders->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Status')</th>
                <th scope="col">@lang('Total Price')</th>
                <th scope="col">@lang('Commands')</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($orders as $index => $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ app('App\Enums\OrderType')::getDescription($order->status) }}</td>
            <td>@price($order->getTotalPrice())</td>
            <td>
                <a class="btn btn-primary" role="button" href="{{ route('orders.show', [$order]) }}">
                    @lang('Show')
                </a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@else
    <div>@lang('There is no order here!')</div>
@endif
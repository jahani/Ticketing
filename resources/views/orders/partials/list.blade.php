@if ($orders->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Status</th>
                <th scope="col">Total Price</th>
                <th scope="col">Commands</th>
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
                    {{ __('Show') }}
                </a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
@else
    <div>{{ __('There is no order here!') }}</div>
@endif
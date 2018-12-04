{!!Form::open()->post()->route('orders.track')!!}
{!!Form::text('order_id', 'Order ID')!!}
{!!Form::text('tracking_code', 'Tracking Code')!!}
{!!Form::submit(__('Submit'))!!}
{!!Form::close()!!}
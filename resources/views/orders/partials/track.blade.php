{!!Form::open()->post()->route('orders.track')!!}
{!!Form::text('order_id', __('Order ID'))!!}
{!!Form::text('tracking_code', __('Tracking Code'))!!}
{!!Form::submit(__('Submit'))!!}
{!!Form::close()!!}
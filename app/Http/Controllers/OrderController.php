<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Order::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()) {
            $orders = auth()->user()->orders;
        }

        return view('orders.index', compact('orders'));
    }

    public function track(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|numeric',
            'tracking_code' => 'required|size:'.config('app.tracking_code_length'),
        ]);

        $order = Order::find($request->input('order_id'));
        if (!is_null($order)
            and isset($order->tracking_code)
            and $order->tracking_code == $request->input('tracking_code')
        ){
            return redirect()->route('orders.show', [
                'order' => $order, 'tracking_code'=> $request->input('tracking_code')
            ]);
        }

        // Request failed
        session()->flash('message', __("Something doesn't match with our records!"));
        session()->flash('alert-class', 'alert-danger');
        return redirect()->back()->withInput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seatShows = Order::getCart();

        return view('orders.create', compact('seatShows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = Order::create();

        return redirect()->route('orders.show', [
            'order' => $order,
            'tracking_code' => $order->tracking_code
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $seatShows = $order->getSeatShows();

        return view('orders.show', compact('order', 'seatShows'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // TODO : payment process
        $order->finalize();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->cancel();
        session()->flash('message', __('Order has been successfully canceled.'));
        return redirect()->back();
    }
}

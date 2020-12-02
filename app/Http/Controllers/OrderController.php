<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Stripe\Charge;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		try {
			Charge::create([
				"amount" => $request->price,
				"currency" => "eur",
				"source" => $request->stripeToken,
				"description" => "Charge for " . auth()->user()->email,
			]);
			Order::create([
				'service' => $request->service,
				'tier' => $request->tier,
				'division' => $request->division,
				'server' => request('server'),
				'wins' => $request->wins,
				'queue' => $request->queue,
				'client_id' => auth()->id(),
				'specific_champions' => $request->specific_champions,
				'priority' => $request->priority,
				'streaming' => $request->streaming,
				'price' => $request->price,
			]);
			return response([
				'message' => __('Your order has been placed'),
			]);
		} catch (\Exception $ex) {
			logger()->error($ex->getMessage());
			return response([
				'error' => __('Purchase failed!'),
			], 402);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function show(Order $order)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Order  $order
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
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Order $order)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Order $order)
	{
		//
	}
}

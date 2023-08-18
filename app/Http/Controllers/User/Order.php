<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\OrderRequest;
use App\Models\Cart;
use App\Models\Order as OrderModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Laravel\Pennant\Feature;
use RealRashid\SweetAlert\Facades\Alert;

class Order
{
    public function __invoke(OrderRequest $request, Cart $cartModel): RedirectResponse
    {
        /** @var Cart $cart */
        $cart = $cartModel->newQuery()
            ->findOrFail($request->cart_id)
            ->with('product')
            ->first();

        /** @var User $user */
        $user = Auth::user();

        $order = new OrderModel();
        $order->user_id = $user->getAuthIdentifier();
        $order->product_id = $cart->product->id;
        $order->quantity = $request->quantity;

        $order->shipping_cost = 100;
        $order->order_number = rand(200, 299) . '' . Carbon::now()->timestamp;

        if ($cart->product->onSale) {
            $totalPrice = $cart->product->sale_price;
        } else {
            $totalPrice = $cart->product->price;
        }

        $isVip = Feature::for($user)->active('vip');

        if ($isVip) {
            $order->price = (int)$totalPrice * 0.9;
        } else {
            $order->price = $totalPrice;
        }

        Log::info('User ordered', [
            'user' => $user->email,
            'is_vip' => $isVip,
        ]);

        if ($order->save()) {
            //cart delete
            $cart->delete();
            Alert::toast('Order Placed!', 'success');
        } else {
            Alert::toast('Checkout fail' . 'error');
        }

        return Redirect::route('myOrder.index');
    }
}

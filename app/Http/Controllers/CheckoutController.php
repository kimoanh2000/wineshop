<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
            'email'   => 'nullable|email'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        $total = collect($cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'customer_name'    => $request->name,
            'customer_phone'   => $request->phone,
            'customer_address' => $request->address,
            'customer_email'   => $request->email,
            'total'            => $total,
            'status'           => 'pending',
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'price'      => $item['price'],
                'quantity'   => $item['quantity'],
                'subtotal'   => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('store.front')
            ->with('success', 'Đặt hàng thành công! Chúng tôi sẽ liên hệ sớm.');
    }
}

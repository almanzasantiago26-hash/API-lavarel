<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id'   => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'cantidad'     => 'required|array|min:1',
            'cantidad.*'   => 'required|integer|min:1',
        ]);

        $productIds = $request->input('product_id');
        $cantidades = $request->input('cantidad');

        // Calcular total
        $total = 0;
        $items = [];
        foreach ($productIds as $i => $pid) {
            $product = \App\Models\Product::find($pid);
            $subtotal = $product->price * $cantidades[$i];
            $total += $subtotal;
            $items[] = [
                'product'  => $product,
                'cantidad' => $cantidades[$i],
                'subtotal' => $subtotal,
            ];
        }

        $order = Order::create([
            'user_id' => null,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product']->id,
                'cantidad'   => $item['cantidad'],
                'price'      => $item['product']->price,
            ]);
        }

        return view('confirmacion', compact('order', 'items', 'total'));
    }
}

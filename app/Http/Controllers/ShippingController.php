<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;

class ShippingController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function getQuantity($order_id, $product_id)
    {
        $shippiing = Shipping::Query()->join('productos', 'productos.id', '=', 'shippings.product_id')->join('orders', 'orders.id', '=', 'shippings.order_id')->where("order_id", '=' ,$order_id)->where("product_id", '=' ,$product_id)->select('shippings.quantity')->first();
        return $shippiing;
    }

    public function getContent($order_id)
    {
        $shippiing = Shipping::Query()->join('productos', 'productos.id', '=', 'shippings.product_id')->join('orders', 'orders.id', '=', 'shippings.order_id')->where("order_id", '=' ,$order_id)->select('productos.nombre', 'productos.precio', 'productos.unidad', 'productos.categoria','shippings.quantity')->get();
        return $shippiing;
    }

    public function store(Request $request)
    {
        $products = json_decode($request->input('productos'), true);

        foreach ($products as $product) {
            $shippiing = new Shipping();
            $shippiing->product_id = $product['id'];
            $shippiing->order_id = Order::latest()->first()->id;
            $shippiing->quantity= $product['cantidad'];
            $shippiing->save();
        }
        return true;
    }
}

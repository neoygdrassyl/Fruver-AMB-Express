<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class OrderController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(Request $request)
    {

        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Order::eloquentQuery($sortBy, $orderBy, $searchValue);

        $query->where("order_public_id", 'like' ,'%'.$searchValue.'%')->orWhere("created_at", 'like' ,'%'.$searchValue.'%');

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->subtotal = $request->subtotal;
        $order->total = $request->total;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ( isset($_SESSION['key'])){
            $order->order_public_id = $_SESSION['key'];
        }

        if ($order->save()){
            return true;
        }else{
            return false;
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Pose;
use App\Model\Product;
use DateTime;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function getTodayOrders()
    {
        $orders = Order::with('customer')->where('order_date', date('d/m/Y'))->get();
        return response()->json($orders, 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
            'pay_amount' => 'required',
            'pay_type' => 'required',
        ]);
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_qty' => $request->total_qty,
            'sub_total' => $request->sub_total,
            'vat' => $request->vat,
            'total_amount' => $request->total,
            'pay_amount' => $request->pay_amount,
            'due_amount' => $request->pay_amount,
            'pay_by' => $request->pay_type,
            'order_date' => date('d/m/Y'),
            'order_month' => date('F'),
            'order_year' => date('Y'),
        ]);

        $poses = Pose::all();
        foreach ($poses as $pos){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $pos->product_id,
                'product_qty' => $pos->selling_quantity,
                'product_price' => $pos->selling_price,
                'sub_total' => $pos->sub_total,
            ]);
            $pro = Product::findOrFail($pos->product_id);
            $pro->product_quantity =  $pro->product_quantity - $pos->selling_quantity;
            $pro->save();
        }

        Pose::truncate();
        return response()->json('done', 201);


    }


    public function show(Order $order)
    {
        return Order::with('customer', 'orderDetails.product')->where('id', $order->id)->first();

    }


    public function searchyOrders($date)
    {
        $make_formate = new DateTime($date);
        $right_formate =  $make_formate->format('d/m/Y');
        return Order::with('customer')
            ->where('order_date', $right_formate)->get();

    }


}

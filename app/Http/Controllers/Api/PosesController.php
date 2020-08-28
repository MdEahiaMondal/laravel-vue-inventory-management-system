<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Pose;
use App\Model\Product;
use Illuminate\Http\Request;

class PosesController extends Controller
{
    public function getCategoryWiseProduct($id){
        return response()->json(Product::where('category_id', $id)->get());
    }

    public function productAddToPose($product_id){
        $product = Product::findOrFail($product_id);

        $check = Pose::where('product_id', $product->id)->first();

        if ($check){
            $check->increment('selling_quantity');
            $check->sub_total = $check->selling_quantity * $check->selling_price ;
            $check->save();
            return response()->json('successfully cart updated', 201);
        }

        Pose::create([
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'selling_quantity' => 1,
            'selling_price' => $product->selling_price,
            'sub_total' => $product->selling_price
        ]);
        return response()->json('successfully add to cart', 201);

    }

    public function getCartProduct()
    {
        $products = Pose::all();
        return response()->json(['products' => $products], 201);

    }
    public function removeCartProduct($id){
        Pose::findOrFail($id)->delete();
        return response()->json('success', 201);
    }

    public function incrementCartProduct($cart_id){
        $cart_item = Pose::findOrFail($cart_id);

        $cart_item->increment('selling_quantity');
        $cart_item->sub_total = $cart_item->selling_quantity * $cart_item->selling_price ;
        $cart_item->save();

        return response()->json('success', 201);
    }

    public function decrementCartProduct($cart_id){
        $cart_item = Pose::findOrFail($cart_id);

        $cart_item->decrement('selling_quantity');
        $cart_item->sub_total = $cart_item->selling_quantity * $cart_item->selling_price ;
        $cart_item->save();
        return response()->json('success', 201);
    }


}

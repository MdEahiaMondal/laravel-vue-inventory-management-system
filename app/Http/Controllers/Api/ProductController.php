<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category', 'supplier')->get();
        return response()->json($products, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/products/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
        }else{
            $image_url = null;
        }
        Product::create([
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'root' => $request->root,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'buying_date' => $request->buying_date,
            'photo' =>  $image_url,
            'product_quantity' => $request->product_quantity
        ]);
        return  response()->json('employ created success', 201);
    }


    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_code' => 'required|unique:products,product_code,'.$product->id,
            'category_id' => 'required',
            'supplier_id' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);


        if ($request->photo != $product->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/products/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
            if ($product->photo){
                unlink($product->photo);
            }
        }else{
            $image_url = $product->photo;
        }

        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->photo = $image_url;
        $product->product_quantity = $request->product_quantity;
        $product->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Product $product)
    {
        if ($product->photo){
            unlink($product->photo);
        }
        $product->delete();
        return response()->json('deleted success', 200);
    }
}

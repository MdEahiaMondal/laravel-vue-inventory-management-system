<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class PosesController extends Controller
{
    public function getCategoryWiseProduct($id){
        return response()->json(Product::where('category_id', $id)->get());
    }
}

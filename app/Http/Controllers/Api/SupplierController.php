<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    public function index()
    {
        $Supplier = Supplier::all();
        return response()->json($Supplier, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/suppliers/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
        }else{
            $image_url = null;
        }
        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $image_url,
            'address' => $request->address,
            'shop_name' => $request->salary,
        ]);
        return  response()->json('Supplier created success', 201);
    }


    public function show(Supplier $supplier)
    {
        return response()->json($supplier, 200);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo != $supplier->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/suppliers/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
            if ($supplier->photo){
                unlink($supplier->photo);
            }
        }else{
            $image_url = $supplier->photo;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->photo = $image_url;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shop_name = $request->shop_name;
        $supplier->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Supplier $supplier)
    {
        if ($supplier->photo){
            unlink($supplier->photo);
        }
        $supplier->delete();
        return response()->json('deleted success', 200);
    }
}

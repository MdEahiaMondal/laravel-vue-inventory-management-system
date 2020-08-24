<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        $Supplier = Customer::all();
        return response()->json($Supplier, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/customers/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
        }else{
            $image_url = null;
        }
        Customer::create([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'photo' => $image_url,
            'address' => $request->address,
        ]);
        return  response()->json('Customer created success', 201);
    }


    public function show(Customer $customer)
    {
        return response()->json($customer, 200);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($request->photo != $customer->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/customers/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
            if ($customer->photo){
                unlink($customer->photo);
            }
        }else{
            $image_url = $customer->photo;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->photo = $image_url;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Customer $customer)
    {
        if ($customer->photo){
            unlink($customer->photo);
        }
        $customer->delete();
        return response()->json('deleted success', 200);
    }
}

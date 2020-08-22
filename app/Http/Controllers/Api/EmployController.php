<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employ;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployController extends Controller
{

    public function index()
    {
        $employes = Employ::all();
        return response()->json($employes, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:employs',
            'email' => 'required|unique:employs',
            'phone' => 'required|unique:employs',
            'address' => 'required',
            'salary' => 'required|integer',
            'joining_date' => 'required',
        ]);

        if ($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/employs/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
        }else{
            $image_url = null;
        }
        Employ::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $image_url,
            'address' => $request->address,
            'salary' => $request->salary,
            'nid' => $request->nid,
            'joining_date' => $request->joining_date,
        ]);
        return  response()->json('employ created success', 201);
    }


    public function show(Employ $employ)
    {
        return response()->json($employ, 200);
    }

    public function update(Request $request, Employ $employ)
    {
        $this->validate($request, [
            'name' => 'required|unique:employs,name,'.$employ->id,
            'email' => 'required|unique:employs,email,'.$employ->id,
            'phone' => 'required|unique:employs,phone,'.$employ->id,
            'address' => 'required',
            'salary' => 'required|integer',
            'joining_date' => 'required',
        ]);


        if ($request->photo != $employ->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0,$position);
            $ext = explode('/', $sub)[1];

            $setName = time() . '.' .$ext;
            $img = Image::make($request->photo)->resize(240,200);
            $upload_path = 'backend/uploads/employs/';
            $image_url = $upload_path.$setName;
            $img->save($image_url);
            if ($employ->photo){
                unlink($employ->photo);
            }
        }else{
            $image_url = $employ->photo;
        }

        $employ->name = $request->name;
        $employ->email = $request->email;
        $employ->photo = $image_url;
        $employ->phone = $request->phone;
        $employ->address = $request->address;
        $employ->nid = $request->nid;
        $employ->salary = $request->salary;
        $employ->joining_date = $request->joining_date;
        $employ->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Employ $employ)
    {
        if ($employ->photo){
            unlink($employ->photo);
        }
        $employ->delete();
        return response()->json('deleted success', 200);
    }
}

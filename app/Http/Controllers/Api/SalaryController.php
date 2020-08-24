<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employ;
use App\Model\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{

    public function index()
    {
        $salaries = Salary::all()->groupBy('month');
        return response()->json($salaries, 200);
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'salary' => 'required',
            'month' => 'required',
        ]);

        $check = Salary::where(['employ_id' => $request->id, 'month' => $request->month])->first();
        if ($check){

            if (($check->amount + $request->salary)  > $check->employ->salary){
                return response()->json('You pay more, Please pay proper salary', 500);
            }else{
                $check->amount = $request->salary + $check->amount;
                $check->save();
                return  response()->json('payment success', 201);
            }
            $right_salary = $check->employ->salary - $check->amount;
            if ($right_salary < $request->salary){
                return response()->json('You pay more, Please pay proper salary', 500);
            }elseif ($check->employ->salary <= $check->amount){
                return response()->json('Already Paid', 500);
            }
        }
        $employ = Employ::findOrFail($request->id);
        if ($request->salary > $employ->salary){
            return response()->json('You pay more, Please pay proper salary', 500);
        }else{
            Salary::create([
                'employ_id' =>  $request->id,
                'amount' => $request->salary,
                'date' => date('d/m/Y'),
                'month' => $request->month,
                'year' => date('Y'),
            ]);
            return  response()->json('payment success', 201);
        }
    }


    public function show(Salary $salary)
    {
        //
    }


    public function edit(Salary $salary)
    {
        //
    }


    public function update(Request $request, Salary $salary)
    {
        //
    }


    public function destroy(Salary $salary)
    {
        //
    }

    public function monthWiseSalaries($month)
    {
        $check = Salary::with('employ')->where(['month' =>$month])->get();
        return response()->json($check, 200);
    }

}

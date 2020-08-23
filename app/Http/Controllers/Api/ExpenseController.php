<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'details' => 'required',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);

        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->expense_date = $request->expense_date;
        $expense->save();
        return  response()->json('Expense created success', 201);
    }


    public function show(Expense $expense)
    {
        return response()->json($expense, 200);
    }

    public function update(Request $request, Expense $expense)
    {
        $this->validate($request, [
            'details' => 'required',
            'amount' => 'required',
            'expense_date' => 'required',
        ]);

        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->expense_date = $request->expense_date;
        $expense->save();
        return response()->json('successfully updated', 200);
    }


    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json('deleted success', 200);
    }
}

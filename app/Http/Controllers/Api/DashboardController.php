<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Expense;
use App\Model\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function todaySell(){
        $sell =  Order::where('order_date', date('d/m/Y'))->get()->sum('total_amount');
        return  response()->json($sell, 200);
    }
    public function todayIncome(){
        $income  = Order::where('order_date', date('d/m/Y'))->get()->sum('pay_amount');
        return  response()->json($income, 200);
    }
    public function todayDue(){
        $due = Order::where('order_date', date('d/m/Y'))->get()->sum('due_amount');
        return  response()->json($due, 200);
    }
    public function todayExpense(){
        $expense = Expense::where('expense_date', date('Y-m-d'))->get()->sum('amount');
        return  response()->json($expense, 200);
    }
}

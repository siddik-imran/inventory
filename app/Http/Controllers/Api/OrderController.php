<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderDetail;
use DateTime;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function latestOrder()
    {
        $date = date('d/m/Y');

        $order = Order::with('customer')->where('order_date', $date)->orderBy('id', 'DESC')->get();
        return response()->json($order);
    }

    public function viewOrder($id)
    {
        $order = Order::with('customer')->where('id', $id)->first();
        //dd($order->toArray());
        return response()->json($order);
    }

    public function orderDetails($id)
    {
        $order_detils = OrderDetail::with('product')->where('order_id', $id)->get();
        //dd($order_detils->toArray());
        return response()->json($order_detils);
    }

    public function search(Request $request)
    {
        $data = $request->date;
        $formate_date= new DateTime($data);
        $format_date= $formate_date->format('d/m/Y');

        $order = Order::with('customer')->where('order_date', $format_date)->get();
        return response()->json($order);

    }

    public function earningStatement()
    {
        $statement = Order::select(

            DB::raw("SUM(total) as total_earning"),
            DB::raw("SUM(quantity) as total_sells"),
            DB::raw("SUM(pay) as pay_amount"),
            DB::raw("SUM(due) as due_amount")
        )->get();

        //dd($statement->toArray());
        return response()->json($statement);
    }

    public function expenseStatement()
    {
        $expenses = Expense::select(
            DB::raw("SUM(amount) as total_expenses")
            )->get();
            //dd($expenses);
        return response()->json($expenses);
    }
}

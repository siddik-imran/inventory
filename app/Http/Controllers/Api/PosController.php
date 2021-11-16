<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function getProduct($id)
    {
        $product = Product::where('category_id', $id)->get();
        return response()->json($product);
    }

    public function order(Request $request)
    {

    //    $validateData = $request->validate([
    //        'customer_id' => 'required',
    //        'payment_method' => 'required'
    //    ]);

       $order = new Order;
       $order->customer_id = $request->customer_id;
       $order->quantity = $request->quantity;
       $order->sub_total = $request->sub_total;
       $order->vat = $request->vat;
       $order->total = $request->total;
       $order->pay = $request->pay;
       $order->due = $request->due;
       $order->payment_method = $request->payment_method;
       $order->order_date = date('d/m/Y');
       $order->order_month = date('M');
       $order->order_year = date('Y');

       $order->save();
       $order_id = Order::latest()->first();
       $order_id = $order_id->id;

       $pos_data_collection = Pos::all();
        foreach($pos_data_collection as $pos_data){

            $order_details = new  OrderDetail;
            $order_details->order_id = $order_id;
            $order_details->product_id = $pos_data->product_id;
            $order_details->product_quantity = $pos_data->product_quantity;
            $order_details->product_price = $pos_data->product_price;
            $order_details->sub_total = $pos_data->sub_total;

            $order_details->save();

            $product = Product::where('id', $pos_data->product_id)->update([
                'product_quantity' => DB::Raw('product_quantity -' .$pos_data->product_quantity)
            ]);

            $pos = Pos::where('product_id', $pos_data->product_id)->delete();
        }




    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        $check = Pos::where('product_id', $id)->first();
        if($check){
            $pos = Pos::where('product_id', $id)->increment('product_quantity');
            $pos = Pos::where('product_id', $id)->first();
            $subTotal = $pos->product_quantity * $pos->product_price;
            $pos->sub_total = $subTotal;
            $pos->update();
        }


        else{
            $pos = new Pos ;
            $pos->product_id = $id;
            $pos->product_quantity = 1;
            $pos->product_price = $product->selling_price;
            $pos->sub_total = $product->selling_price;

            $pos->save();
        }


    }

    public function cartProduct()
    {
        $cartProduct = Pos::with('product')->get();
        return response()->json($cartProduct);
    }

    public function removeCartProduct($id)
    {
        $cart = Pos::where('id', $id)->delete();
    }

    public function incrementCartItem($id)
    {
        $quantity = Pos::where('id', $id)->increment('product_quantity');
        $product = Pos::where('id', $id)->first();
        $subTotal = $product->product_quantity * $product->product_price;
        $product->sub_total = $subTotal;
        $product->update();


    }

    public function decrementCartItem($id)
    {
        $quantity = Pos::where('id', $id)->decrement('product_quantity');
        $product = Pos::where('id', $id)->first();
        $subTotal = $product->product_quantity * $product->product_price;
        $product->sub_total = $subTotal;
        $product->update();

    }

    public function getVat()
    {
        $vat = Extra::get('vat');
        return response()->json($vat);
    }
}

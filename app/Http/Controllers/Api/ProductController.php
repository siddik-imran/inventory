<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category', 'supplier')->orderBy('id','desc')->get();
        return response()->json($product);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:150',
            'product_code' => 'required|unique:products',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'root' => 'required',
            'product_quantity' => 'required',

        ]);

        if($request->product_image){
            $position = strpos($request->product_image, ';');
            $sub = substr($request->product_image, 0, $position);
            $text = explode('/', $sub)[1];

            $image_name = time().".".$text;
            $img = Image::make($request->product_image)->resize(240, 200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$image_name;
            $img->save($image_url);

            $product = new Product;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->buying_date = $request->buying_date;
            $product->selling_price = $request->selling_price;
            $product->product_quantity = $request->product_quantity;
            $product->product_image = $image_url;

            $product->save();
        }
        else{
            $product = new Product;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->buying_date = $request->buying_date;
            $product->selling_price = $request->selling_price;
            $product->product_quantity = $request->product_quantity;

            $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:150',
            'product_code' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'root' => 'required',
            'product_quantity' => 'required',

        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['buying_date'] = $request->buying_date;
        $data['root'] = $request->root;
        $data['product_quantity'] = $request->product_quantity;
        $image = $request->new_product_image;

        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $text = explode('/', $sub)[1];

            $image_name = time().".".$text;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$image_name;
            $success = $img->save($image_url);

            if($success){
                $data['product_image'] = $image_url;
                $img = Product::where('id', $id)->first();
                $image_path = $img->product_image;
                $done = unlink($image_path);
                $product = Product::where('id', $id)->update($data);
            }
        }
        else{
            $oldphoto = $request->product_image;
            $data['product_image'] = $oldphoto;
            $product = product::where('id', $id)->update($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $photo = $product->product_image;
        if($photo){
            unlink($photo);
            $product->delete();
        }
        else{
            $product->delete();
        }
    }
}

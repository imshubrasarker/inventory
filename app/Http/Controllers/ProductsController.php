<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use App\Unit;
use Auth;
use Hash;
use App\Company;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id = $request->get('product_id');
        $size = $request->get('size');
        $perPage = 25;

        if (!empty($product_id) && empty($size)) {
            $products = Product::where('id', $product_id)->orderBy('created_at', 'DESC')->paginate(10);
        }
        elseif (!empty($product_id) && !empty($size))
        {
            $products = Product::where('id', $product_id)->where('size', 'like', '%'.$size.'%')->orderBy('created_at', 'DESC')->paginate(10);
        }
        elseif (empty($product_id) && !empty($size))
        {
            $products = Product::where('size', 'like', '%'.$size.'%')->orderBy('created_at', 'DESC')->paginate(10);
        }
        else {
            $products = Product::latest()->orderBy('created_at', 'DESC')->paginate($perPage);
        }
        $product = [];
        $product_data = Product::select('name','size','id')->orderBy('created_at', 'DESC')->get();
        foreach ($product_data as $row) {
            $product[$row->id] = $row->name.'('.$row->size.')';
        }
        return view('products.index', compact('products', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        $units = Unit::pluck('name','id');
        return view('products.create',compact('categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if($request->discount != null){
            $discount = $request->discount/100;
            $discount_amount = $request->sale_price*$discount;
            $final_price = $request->sale_price-$discount_amount;
        }else {
           $final_price = $request->sale_price;
        }

        $product                    = new Product();
        $product->name              = $request->name;
        $product->size              = $request->size;
        $product->buy_price         = $request->buy_price;
        $product->sale_price        = $request->sale_price;
        $product->final_price       = round($final_price);
        $product->unit_id           = $request->unit_id;
        $product->category_id       = $request->category_id;
        $product->discount          = $request->discount;
        $product->description       = $request->description;
        $product->alert_quantity    = $request->alert_quantity;
        $product->active            = $request->active;
        $product->save();

        return redirect('products')->with('success', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::pluck('name','id');
        $units = Unit::pluck('name','id');
        return view('products.show', compact('product','categories','units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = Category::pluck('name','id');
        $units = Unit::pluck('name','id');
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product','categories','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        if($request->discount != null){
            $discount = $request->discount/100;
            $discount_amount = $request->sale_price*$discount;
            $final_price = $request->sale_price-$discount_amount;
        }else {
           $final_price = $request->sale_price;
        }

        $product->name              = $request->name;
        $product->size              = $request->size;
        $product->buy_price         = $request->buy_price;
        $product->sale_price        = $request->sale_price;
        $product->final_price       = $final_price;
        $product->unit_id           = $request->unit_id;
        $product->category_id       = $request->category_id;
        $product->discount          = $request->discount;
        $product->description       = $request->description;
        $product->alert_quantity    = $request->alert_quantity;
        $product->active            =  $request->active;
        $product->save();

        return redirect('products')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        $old_password = $request->password;
        $current_password = Auth::user()->password;
        if(Hash::check($old_password, $current_password))
        {
            Product::destroy($id);
            return redirect('products')->with('success', 'Product deleted!');
        }else{
            return redirect('products')->with('error', 'Password Not Matched!');
        }
    }

    public function printProductView(Request $request)
    {
        //return $request->query->get('first_id');
        $start_serial = $request->query->get('start_serial');
        $perPage = 25;
        $product = [];
        $product_data = Product::select('name','size','id')->get();
        //return $product_data;
        foreach ($product_data as $row) {
            $product[$row->id] = $row->name.'('.$row->size.')';
        }
        $products = Product::whereBetween('id', [$request->query->get('first_id'), $request->query->get('last_id')])->latest()->get();
        //return response()->json($products);
        $company = Company::latest()->first();
        return view('products.product-index', compact('products', 'product','company', 'start_serial'));
    }
}

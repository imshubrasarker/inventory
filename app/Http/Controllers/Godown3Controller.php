<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class Godown3Controller extends Controller
{
    public function index(Request $request)
    {
        //$keyword = $request->get('search');
        $product_id = $request->get('product_id');
        $perPage = 25;

        if (!empty($product_id)) {
            //$products->where('id',$product_id)
            $stocks = Product::join('stocks','products.id','=','stocks.product_id')
                ->where('active',1)
                ->select('stocks.*','products.name','products.size','products.sale_price', 'products.alert_quantity')
                ->latest()->groupBy('product_id')->where('products.id',$product_id)->paginate($perPage);

        } else {
            $stocks = Product::join('stocks','products.id','=','stocks.product_id')
               ->where('active',1)
                ->select('stocks.*','products.name', 'products.size','products.sale_price', 'products.alert_quantity')
                ->latest()->groupBy('product_id')->paginate($perPage);
        }

        $products = Product::join('stocks','products.id','=','stocks.product_id')
            ->where('active',1)
            ->select('stocks.*','products.name', 'products.size','products.sale_price', 'products.alert_quantity')->latest()->groupBy('product_id')->get();
        /*
        if (!empty($keyword)) {
            $stocks = Stock::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('product_stock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stocks = Product::join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name','products.size','products.sale_price', 'products.alert_quantity')
            ->latest()->groupBy('product_id')->paginate($perPage);
        }
        */
        return view('godown3.index', compact('stocks','products'));
    }
}

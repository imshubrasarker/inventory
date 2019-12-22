<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use App\Product;
use DB;
use App\Customer;
use App\Stock;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
    	$data = [];


        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("products")
            		->select("id","name")
            		->orwhere('name','LIKE',"%$search%")
            		->orwhere('id','LIKE',"%$search%")
            		->orwhere('size','LIKE',"%$search%")
            		->get();
        }


        return response()->json($data);
    }

    public function getProductDetail(Request $request)
    {
        $product_id = $request->get('product_id');
        $product = Product::where('id',$product_id)->first();
        $stocks = Stock::where('product_id',$product_id)->first();
        return response()->json(['product'=>$product,'stocks'=>$stocks]);
    }

    public function getCustomerDetail(Request $request)
    {
        $customer_id = $request->get('customer_id');
        $customer = Customer::where('id',$customer_id)->first();
        return response()->json(['customer'=>$customer]);
    }

    public function getSupplierDetail(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $supplier = Supplier::where('id',$supplier_id)->first();
        return response()->json(['supplier'=>$supplier]);
    }
}

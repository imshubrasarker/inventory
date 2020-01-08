<?php

namespace App\Http\Controllers;

use App\Employee;
use App\GodownUnit;
use App\Invoice;
use App\Payment;
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

        $customer_due = Customer::findOrFail($customer_id);
        $invoices = Invoice::where('customer_id',$customer_id)->latest()->orderBy('id')->get();
        $payments = Payment::where('customer_id',$customer_id)->latest()->get();
        $total_payment_amount = $payments->sum('amount');

        $grand_total_price = $invoices->sum('grand_total_price');
        $paid_price = $invoices->sum('advanced')+$total_payment_amount;
        $due_amount = $grand_total_price+$customer_due->due-$paid_price;

        $customer = Customer::where('id',$customer_id)->first();
        return response()->json([
            'customer'=> $customer,
            'due_amount' => $due_amount
        ]);
    }

    public function getSupplierDetail(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $supplier = Supplier::where('id',$supplier_id)->first();
        return response()->json(['supplier'=>$supplier]);
    }

    public function getEmployeeDetails(Request $request)
    {
        $employee_id = $request->get('employee_id');
        $employee = Employee::where('id',$employee_id)->first();
        return response()->json(['employee'=>$employee]);
    }
    public function getColors(Request $request)
    {
        $product_id = $request->get('product_id');
        $colors = GodownUnit::where('product_id', $product_id)->get();
        return response()->json(['colors' => $colors]);
    }
}

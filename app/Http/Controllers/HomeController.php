<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Customer;
use App\Payment;
use App\ProductCart;
use App\Product;
use Carbon\Carbon;
use App\Stock;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        // dd($today);

        $month = date('m');

        $today_invoice = Invoice::where('manual_date',$today)->count();
        $total_invoice = Invoice::count();

        $today_customer = Customer::whereDate('created_at',$today)->count();   
        $total_customer = Customer::count();
        
        $today_product = Product::whereDate('created_at',$today)->count();
        $total_product = Product::count();
        
        $total_stock_value = 0;
        
        $stocks_value = Stock::all();
        
        foreach($stocks_value as $stock) {
            $total_stock_value += $stock->product->buy_price * $stock->product_stock;
        }
       
        $today_sale_amount = Invoice::where('manual_date',$today)->sum('grand_total_price');
        // dd($today_sale_amount);
        $total_sale_amount = Invoice::sum('grand_total_price');

        $monthly_sale = Invoice::where('created_at',$month)->sum('grand_total_price');

        
        $customers = Customer::pluck('name','id');

        $seven_days = Carbon::today()->subDays(7);
        $thirty_days = Carbon::today()->subDays(30);

        $six_months = Carbon::today()->subMonths(6);

        $one_year = Carbon::today()->subYears(1);

        // dd($seven_days);

        $seven_days_sale = Invoice::where('created_at', '>=', $seven_days)->sum('grand_total_price');
        $thirty_days_sale = Invoice::where('created_at', '>=', $thirty_days)->sum('grand_total_price');

        $six_months_sale = Invoice::where('created_at', '>=', $six_months)->sum('grand_total_price');

        $one_year_sale = Invoice::where('created_at', '>=', $one_year)->sum('grand_total_price');
        
        $total_stock = Stock::sum('product_stock');
       
       //$total_due = Invoice::sum('due_amount');

       $product_info = ProductCart::join('products','product_carts.product_id','=','products.id')
                        ->select('products.name','products.size', 'products.discount', 'products.sale_price', 'products.buy_price','product_carts.quantity','product_carts.total_price', 'product_carts.invoice_id', 'products.final_price')
                        ->get();
        // dd($product_info);
        $total_profit = 0;
        foreach($product_info as $row){
                $total_profit += ($row->final_price-$row->buy_price)*($row->quantity);
        }
        
        $total_due = 0;
        
        $all_customers = Customer::all();
		foreach($all_customers as $customer) {
            $customer_due = Customer::findOrFail($customer->id);
            $invoices = Invoice::where('customer_id',$customer->id)->latest()->orderBy('id')->get();
            $payments = Payment::where('customer_id',$customer->id)->latest()->get();
    		$total_payment_amount = $payments->sum('amount');

            $grand_total_price = $invoices->sum('grand_total_price');
            $paid_price = $invoices->sum('advanced')+$total_payment_amount;
            $due_amount = $grand_total_price+$customer_due->due-$paid_price; 
            $total_due +=$due_amount; 
        }
        $invoices = Invoice::latest()->paginate(10); 
        
        return view('home',compact('total_due', 'today_invoice', 'total_invoice', 'today_customer', 'total_customer', 'today_product', 'total_product', 'today_sale_amount', 'total_sale_amount', 'monthly_sale', 'invoices', 'customers', 'seven_days_sale', 'thirty_days_sale', 'six_months_sale', 'one_year_sale', 'total_stock', 'total_due', 'total_profit', 'total_stock_value'));
    }
}

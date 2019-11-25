<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\ProductCart;
use App\Company;
use App\Stock;
use App\StockData;
use App\Smse;
use SoapClient;
use App\User;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Unit;
use App\Payment;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $customer_mobile = $request->get('customer_mobile');
        if($request->get('from')){
            $from = $request->get('from')." 00:00:00";
        }else{
            $from = null;
        }

        if($request->get('to')){
            $to = $request->get('to')." 23:59:59"; 
        }else{
            $to = null;
        }
        
        
        // dd($from);
        $customer_id = $request->get('customer_id');
        $perPage = 25;

        if (!empty($customer_mobile)||!empty($customer_id)||!empty($from)||!empty($to)) {
            $invoices = Invoice::whereNotNull('id');
            if($customer_id){
                $invoices = $invoices->where('customer_id','LIKE',"%$customer_id%");
            }

            if($customer_mobile){
                $customer = Customer::where('primary_mobile',$customer_mobile)->first();
                if(isset($customer->id)){
                    $invoices = $invoices->where('customer_id','LIKE',"%$customer->id%");
                }
            }

            if($from || $to){
                $invoices = $invoices->whereBetween('created_at',[$from,$to]);
            }
            $invoices = $invoices->latest()->paginate($perPage);
        }else{
            $invoices = Invoice::latest()->paginate($perPage);
        }
        // dd($invoices);
        $customer_name = [];
        $customer_address = [];
        $customer_data = Customer::select('name','address','id')->get();
        foreach ($customer_data as $row) {
            $customer_name[$row->id] = $row->name;
            $customer_address[$row->id] = $row->address;

        }
        $customers = Customer::pluck('name','id');
        $customer_mobiles = Customer::pluck('primary_mobile','primary_mobile');
        return view('invoices.index', compact('invoices', 'customers', 'customer_name', 'customer_address', 'customer_mobiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('name','id');
        $products = [];
        $product_data = Product::select('name','size','id')->get();
        foreach ($product_data as $row) {
            $products[$row->id] = $row->name.'('.$row->size.')';
        }
        return view('invoices.create',compact('customers','products'));
    }

    public function invoiceCreateByCustomerId($id)
    {
        $customers = Customer::pluck('name','id');
        $products = [];
        $product_data = Product::select('name','size','id')->get();
        foreach ($product_data as $row) {
            $products[$row->id] = $row->name.'('.$row->size.')';
        }
        return view('invoices.create-by-customer',compact('customers','products','id'));
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
        $this->validate($request, [
            'customer_id'           => 'required',
            'quantity.*'            => 'required_unless:type_of_content,is_information',
        ]);

        $total_quantity = 0;
        foreach($request->quantity as $key=>$value)
        {
            $total_quantity += $value;
            
        }

        $invoice                    = new Invoice();
        $invoice->customer_id       = $request->customer_id;
        $invoice->invoice_id        = $request->invoice_no;
        $invoice->manual_date       = $request->manual_date;
        $invoice->grand_total_price = $request->grand_total_price;
        $invoice->advanced          = $request->advanced;
        $invoice->due_amount        = $request->due_amount;
        $invoice->total_quantity    = $total_quantity;
        $invoice->notebar           = $request->notebar;
        $invoice->user_id           = Auth::user()->id;
        $invoice->save();
        
        foreach($request->product_id as $key=>$value){
            $product_cart               = new ProductCart();
            $product_cart->invoice_id   = $request->invoice_no;
            $product_cart->product_id   = $value;
            $product_cart->sale_price   = $request->sale_price[$key];
            $product_cart->quantity     = $request->quantity[$key];
            $product_cart->total_price  = $request->total_price[$key];
            $product_cart->save();

            

            $stock                      = Stock::where('product_id',$value)->first();
            $after_sale_stock           = $stock->product_stock-$request->quantity[$key];
            $stock->product_stock       = $after_sale_stock;
            $stock->save();

            $stockData              = new stockData();
            $stockData->product_id  = $value;
            $stockData->sale_stock  = $request->quantity[$key];
            $stockData->invoice_no  = $request->invoice_no;
            $stockData->balance     = $after_sale_stock;
            $stockData->save();
        }
        return redirect('/invoices-print/'.$request->invoice_no)->with('success', 'Invoice added!');
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
        $invoice_info = Invoice::where('id',$id)->first();
        // dd($invoice_info);
        $customer_info = Customer::where('id',$invoice_info->customer_id)->first();
        $product_info = ProductCart::join('products','product_carts.product_id','=','products.id')
                        ->where('product_carts.invoice_id',$invoice_info->invoice_id)
                        ->select('products.name','products.size','products.unit_id', 'products.discount', 'products.sale_price','product_carts.quantity','product_carts.total_price', 'product_carts.invoice_id')
                        ->get();
        $company = Company::latest()->first();
        $total_discount = 0;
        $total_price = 0;
        foreach($product_info as $row){
            $total_discount += $row->discount/100*$row->sale_price*$row->quantity;
            $total_price += $row->sale_price*$row->quantity;

        }
        // dd($total_price);
        $invoices = Invoice::where('customer_id', $customer_info->id)->get();
        
        $previous_due = Invoice::where('customer_id', $customer_info->id)->sum('due_amount');
        $total_previous_due = $previous_due-$invoice_info->due_amount;
        $units = Unit::pluck('name', 'id');
        
         $payments = Payment::where('customer_id',$customer_info->id)->latest()->get();
         $total_payment_amount = $payments->sum('amount');
         
        $paid_price = $invoices->sum('advanced')+$total_payment_amount;
        
        $total_due = 0;
        
        $total_due = $total_due + $invoices->sum('grand_total_price') + $customer_info->due - $paid_price;
        
        //return $invoices->sum('grand_total_price');
        
        
        return view('invoices.print',compact('total_discount', 'invoice_info','customer_info','product_info','company', 'total_previous_due', 'total_price', 'units', 'total_due'));
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
        $invoice = Invoice::findOrFail($id);
        $products = Product::pluck('name','id');
        $customers = Customer::pluck('name','id');
        return view('invoices.edit', compact('invoice','products','customers'));
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
        
        $requestData = $request->all();
        
        $invoice = Invoice::findOrFail($id);
        $invoice->update($requestData);

        return redirect('invoices')->with('success', 'Invoice updated!');
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
            Invoice::destroy($id);
            return redirect('invoices')->with('success', 'Invoice deleted!');
        }else{
            return redirect('invoices')->with('error', 'Password Not Matched!');
        }

        
    }


    public function printInvoice($invoice_no)
    {
        $invoice_info = Invoice::where('invoice_id',$invoice_no)->first();
        $customer_info = Customer::where('id',$invoice_info->customer_id)->first();
        $product_info = ProductCart::join('products','product_carts.product_id','=','products.id')
                        ->where('product_carts.invoice_id',$invoice_no)
                        ->select('products.name','products.size','products.unit_id', 'products.discount', 'products.sale_price','product_carts.quantity','product_carts.total_price', 'product_carts.invoice_id')
                        ->get();
        $total_discount = 0;
        $total_price = 0;
        foreach($product_info as $row){
            $total_discount += $row->discount*$row->quantity;
            $total_price += $row->sale_price*$row->quantity;
        }
        $company = Company::latest()->first();
        $previous_due = Invoice::where('customer_id', $customer_info->id)->sum('due_amount');
        $total_previous_due = $previous_due-$invoice_info->due_amount;
        $units = Unit::pluck('name', 'id');
        // dd($total_previous_due
        
        $invoices = Invoice::where('customer_id', $customer_info->id)->get();
        
        $payments = Payment::where('customer_id',$customer_info->id)->latest()->get();
         $total_payment_amount = $payments->sum('amount');
         
        $paid_price = $invoices->sum('advanced')+$total_payment_amount;
        
        $total_due = 0;
        
        $total_due = $total_due + $invoices->sum('grand_total_price') + $customer_info->due - $paid_price;
        return view('invoices.print',compact('total_discount', 'invoice_info','customer_info','product_info','company', 'total_previous_due', 'total_price', 'units', 'total_due'));
    }

    public function printInvoicedata(Request $request)
    {
        $start_serial = $request->query->get('start_serial');
        $perPage = 25;
        $customer_name = [];
        $customer_address = [];
        $customer_data = Customer::select('name','address','id')->get();
        foreach ($customer_data as $row) {
            $customer_name[$row->id] = $row->name;
            $customer_address[$row->id] = $row->address;

        }
        $customers = Customer::pluck('name','id');
        $invoices = Invoice::whereBetween('id', [$request->query->get('first_id'), $request->query->get('last_id')])->latest()->get();
        $company = Company::latest()->first();
        return view('invoices.invoice-index-pdf', compact('invoices', 'customers', 'customer_name', 'customer_address', 'company', 'start_serial'));
    }

    public function sentSmsByInvoice($id)
    {
        $invoice = Invoice::where('id',$id)->first();
        $customer = Customer::where('id',$invoice->customer_id)->first();
        
        $invoices = Invoice::where('customer_id',$customer->id)->get();

        $payments = Payment::where('customer_id',$customer->id)->latest()->get();
        $total_payment_amount = $payments->sum('amount');

        $grand_total_price = $invoices->sum('grand_total_price');
        $paid_price = $invoices->sum('advanced')+$total_payment_amount;
        $due_amount = $grand_total_price+$customer->due-$paid_price;

        $onnorokom_info = Smse::latest()->first();
        
        $sms = "Dear, $customer->name 
            Sub: Invoice Confirmation 
            Invoice No: $invoice->invoice_id 
            Invoice Amount: Tk. $invoice->grand_total_price BDT
            Paid Amount: Tk. $invoice->advanced BDT 
            Total Due Amount: Tk. $due_amount BDT
            -CVHBD
            ";
        // dd($sms);
        // dd($onnorokom_info);
        // onnorokom_sms(['message' => $request->message, 'mobile_number' => $customer->primary_mobile]);
        try{
        $soapClient = new SoapClient("https://api2.onnorokomsms.com/sendsms.asmx?WSDL");
        $paramArray = array(
        'userName'=>$onnorokom_info->username,
        'userPassword'=>$onnorokom_info->password,
        'mobileNumber'=> $customer->primary_mobile,
        'smsText'=>$sms,
        'type'=>"",
        'maskName'=> "",
        'campaignName'=>'CVHBD',
        );
        $value = $soapClient->__call("OneToOne", array($paramArray));

        } catch (dmException $e) {
        // echo $e;
        }
        return redirect()->back()->with('success', 'Successfully Sent Sms!');
    }
}

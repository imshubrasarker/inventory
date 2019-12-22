<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;
use Illuminate\Http\Request;
use App\Invoice;
use App\Payment;
use App\ProductCart;
use App\Company;
use Auth;
use Hash;
use DB;


class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $customer_id = $request->get('customer_id');
        $customer_mobile = $request->get('customer_mobile');

        $perPage = 25;

        if (!empty($customer_id) || !empty($customer_mobile)) {


            $customers = Customer::whereNotNull('id');

            if($customer_id){
                $customers = $customers->where('id',$customer_id);
            }

            if($customer_mobile){
                $customers = $customers->where('primary_mobile', $customer_mobile);
            }

            $customers = $customers->with('invoices', 'payments')->latest()->paginate($perPage);

        } else {
            $customers = Customer::with('invoices', 'payments')->latest()->paginate($perPage);
        }

        //return $customers;

        $page_due = 0;
        $total_due = 0;

        foreach($customers as $customer) {
            $page_due += $customer->invoices->sum('grand_total_price') - ($customer->invoices->sum('advanced') + $customer->payments->sum('amount') + $customer->due);
        }

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

            //$total_due += $customer->invoices->sum('grand_total_price') - ($customer->invoices->sum('advanced') + $customer->payments->sum('amount') + $customer->due);
        }


        $customer = Customer::pluck('name','id');
        $customer_mobiles = Customer::pluck('primary_mobile','primary_mobile');

        return view('customers.index', compact('customers','customer','customer_mobiles', 'page_due', 'total_due'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('customers.create');
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
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path = 'customer_image/';
            $image_url = $path.$image_name;
            $image->move($path,$image_name);
        }else{
             $image_url = null;
        }

        $customer                   = new Customer();
        $customer->name             = $request->name;
        $customer->email            = $request->email;
        $customer->image            = $image_url;
        $customer->primary_mobile   = $request->primary_mobile;
        $customer->alter_mobile     = $request->alter_mobile;
        $customer->address          = $request->address;
        $customer->due              = $request->due;
        $customer->note             = $request->note;
        $customer->quantity         = $request->quantity;
        $customer->save();

        return redirect()->back()->with('success', 'Customer added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $results = array();
        $customer = Customer::findOrFail($id);
        $invoices = Invoice::where('customer_id',$id)->latest()->get();
        $payments = Payment::where('customer_id',$id)->latest()->get();

        if($customer){
            $rows['created_at'] = $customer->created_at;
            $rows['ivno'] = '';
            $rows['qty'] = $customer->quantity;
            $rows['amount'] = 0;
            $rows['ramount'] = 0;
            $rows['damount'] = $customer->due;
            $rows['lamount'] = $customer->due;
            $rows['notebar'] = $customer->note;
            $rows['type'] = 'customer';
            $rows['user_id'] = '';
            $results[] = $rows;
        }
        if($payments){
            foreach ($payments as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = '';
                $rows['qty'] = '';
                $rows['amount'] = 0;
                $rows['ramount'] = $row->amount;
                $rows['damount'] = 0;
                $rows['lamount'] = $row->amount;
                $rows['notebar'] = $row->notebar;
                $rows['type'] = 'payments';
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if($invoices){
            foreach ($invoices as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = $row->invoice_id;
                $rows['qty'] = $row->total_quantity;
                $rows['amount'] = $row->grand_total_price;
                $rows['ramount'] = $row->advanced;
                $rows['damount'] = $row->due_amount;
                $rows['lamount'] = $row->due_amount;
                $rows['notebar'] = '';
                $rows['type'] = 'invoice';
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if($results){
            foreach ($results as $key => $part) {
               $sort[$key] = strtotime($part['created_at']);
            }
            array_multisort($sort, SORT_ASC, $results);
        }
        $total_payment_amount = $payments->sum('amount');
        $company = Company::latest()->first();
        $custom = Customer::pluck('name','id');
        return view('customers.show', compact('customer','payments','invoices','total_payment_amount', 'custom','results'));
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
        $customer = Customer::findOrFail($id);

        return view('customers.edit', compact('customer'));
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
        $customer = Customer::findOrFail($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_name = uniqid().'.'.strtolower($image->getClientOriginalExtension());
            $path = 'customer_image/';
            $image_url = $path.$image_name;
            $image->move($path,$image_name);
            if($customer->image != null){
                unlink($customer->image);
            }
        }else{
             $image_url = $customer->image;
        }

        $customer->name             = $request->name;
        $customer->email            = $request->email;
        $customer->image            = $image_url;
        $customer->primary_mobile   = $request->primary_mobile;
        $customer->alter_mobile     = $request->alter_mobile;
        $customer->address          = $request->address;
        $customer->due              = $request->due;
        $customer->note             = $request->note;
        $customer->quantity         = $request->quantity;
        $customer->save();

        return redirect('customers')->with('success', 'Customer updated!');
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
            $customer = Customer::find($id);
            if($customer->image != null){
                unlink($customer->image);
            }
            Customer::destroy($id);
            return redirect('customers')->with('success', 'Customer deleted!');
        }else{
            return redirect('customers')->with('error','Password Not Matched!');
        }
    }

    public function customerLedgerView($id)
    {
        $customer = Customer::findOrFail($id);
        $invoices = Invoice::where('customer_id',$id)->latest()->get();
        $payments = Payment::where('customer_id',$id)->get();
        $total_payment_amount = $payments->sum('amount');

        $results = array();
        $paymentsl = Payment::where('customer_id',$id)->latest()->get();

        if($customer){
            $rows['created_at'] = $customer->created_at;
            $rows['ivno'] = '';
            $rows['qty'] = $customer->quantity;
            $rows['amount'] = 0;
            $rows['ramount'] = 0;
            $rows['damount'] = $customer->due;
            $rows['lamount'] = $customer->due;
            $rows['notebar'] = $customer->note;
            $rows['type'] = 'customer';
            $rows['user_id'] = '';
            $results[] = $rows;
        }
        if($paymentsl){
            foreach ($payments as $key => $row) {
                $rows['created_at'] = $row->manual_date;
                $rows['ivno'] = '';
                $rows['qty'] = '';
                $rows['amount'] = 0;
                $rows['ramount'] = $row->amount;
                $rows['damount'] = 0;
                $rows['lamount'] = $row->amount;
                $rows['notebar'] = $row->notebar;
                $rows['type'] = 'payments';
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if($invoices){
            foreach ($invoices as $key => $row) {
                $rows['created_at'] = $row->manual_date;
                $rows['ivno'] = $row->invoice_id;
                $rows['qty'] = $row->total_quantity;
                $rows['amount'] = $row->grand_total_price;
                $rows['ramount'] = 0;
                $rows['damount'] = $row->due_amount;
                $rows['lamount'] = $row->due_amount;
                $rows['notebar'] = '';
                $rows['type'] = 'invoice';
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if($results){
            foreach ($results as $key => $part) {
               $sort[$key] = strtotime($part['created_at']);
            }
            array_multisort($sort, SORT_ASC, $results);
        }

        $company = Company::latest()->first();
        return view('customers.print', compact('customer','payments','invoices','total_payment_amount','company','results'));
    }

    public function customerLedgerSearchView()
    {
        $custom = Customer::pluck('name','id');
        return view('customers.custom-ledger-search',compact('custom'));
    }

    public function customerLedgerSearchData(Request $request)
    {
        $from = $request->get('from')." 00:00:00";
        $to = $request->get('to')." 23:59:59";
        $id = $request->get('customer_id');

        // dd($to);
        $customer = Customer::where('id',$id)->first();
        $customerId = $customer->id;
        $invoices = Invoice::where('customer_id',$customer->id)->whereBetween('created_at',[$from,$to])->latest()->get();
            // dd($invoices);
        $payments = Payment::where('customer_id',$customer->id)->whereBetween('created_at',[$from,$to])->get();
        $total_payment_amount = $payments->sum('amount');
        $company = Company::latest()->first();
        $custom = Customer::pluck('name','id');
        return view('customers.show',compact('custom','customer','payments','invoices','total_payment_amount','company', 'customerId'));
    }


    public function printCustomerView(Request $request)
    {
        $perPage = 25;
        $start_serial = $request->query->get('start_serial');
        $customers = Customer::whereBetween('id', [$request->query->get('first_id'), $request->query->get('last_id')])->latest()->paginate($perPage);
        $customer = Customer::pluck('name','id');
        $company = Company::latest()->first();

        $page_due = 0;

        foreach($customers as $customer) {
            $page_due += $customer->invoices->sum('grand_total_price') - ($customer->invoices->sum('advanced') + $customer->payments->sum('amount') + $customer->due);
        }
        return view('customers.customer-index', compact('customers','customer','company', 'start_serial', 'page_due'));
    }

}

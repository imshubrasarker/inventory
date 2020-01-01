<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Supplier;
use Illuminate\Http\Request;
use App\Customer;
use App\Smse;
use SoapClient;
use App\User;
use App\PaymentSms;
use App\Invoice;
use Auth;
use Hash;
use App\Company;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $customer_id = $request->get('customer_id');
        $customer_mobile = ltrim($request->get('customer_mobile'));
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
        $perPage = 25;

        if(!empty($customer_id) || !empty($customer_mobile) || !empty($from) || !empty($to)){

            $payments = Payment::whereNotNull('id');

            if(!empty($customer_id)){
                $payments = $payments->where('customer_id', $customer_id);
            }

            if(!empty($customer_mobile)){
                $payments = $payments->where('mobile_no', $customer_mobile);
            }

            if(!empty($from || $to)){
                $payments = $payments->whereBetween('created_at',[$from,$to]);
            }

           $payments = $payments->latest()->paginate($perPage);
            // dd($payments);
        }else {
            $payments = Payment::latest()->paginate($perPage);
        }

        $customers = Customer::pluck('name','id');
        $customer_mobiles = Customer::pluck('primary_mobile','primary_mobile');
        $users = User::pluck('name','id');
        return view('payments.index', compact('payments','customers','users', 'customer_mobiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $customers = Customer::pluck('name','id');
        return view('payments.create',compact('customers'));
    }

    public function paymentsCreateByCustomer($id)
    {
        $type = $_GET['type'] ?? '';
        if (isset($type) && $type === 'supplier') {
            $suppliers = Supplier::where('id', $id)->pluck('name','id');
            return view('payments.create_by_supplier',compact('suppliers','id', 'type'));
        } else {
            $customers = Customer::pluck('name','id');
            return view('payments.create_by_customer',compact('customers','id'));
        }
    }

    public function supplierIndex(Request $request)
    {
        $customer_id = $request->get('customer_id');
        $customer_mobile = ltrim($request->get('customer_mobile'));
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
        $perPage = 25;

        if(!empty($customer_id) || !empty($customer_mobile) || !empty($from) || !empty($to)){

            $payments = Payment::whereNotNull('id');

            if(!empty($customer_id)){
                $payments = $payments->where('supplier_id', $customer_id);
            }

            if(!empty($customer_mobile)){
                $payments = $payments->where('mobile_no', $customer_mobile);
            }

            if(!empty($from || $to)){
                $payments = $payments->whereBetween('created_at',[$from,$to]);
            }

            $payments = $payments->latest()->paginate($perPage);
            // dd($payments);
        }else {
            $payments = Payment::latest()->paginate($perPage);
        }

        $customers = Supplier::pluck('name','id');
        $customer_mobiles = Supplier::pluck('mobile','mobile');
        $users = User::pluck('name','id');
        return view('payments.supplier-index', compact('payments','customers','users', 'customer_mobiles'));
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
        $payment = new Payment();
        if ($request->customer_id) {
            $payment->customer_id       = $request->customer_id;
        } elseif ($request->supplier_id) {
            $payment->supplier_id       = $request->supplier_id;
        }
        $payment->manual_date       = $request->manual_date;
        $payment->mobile_no         = $request->mobile_no;
        $payment->amount            = $request->amount;
        $payment->payment_method    = $request->payment_method;
        $payment->notebar           = $request->notebar;
        $payment->user_id           = Auth::user()->id;
        $payment->save();

//        if ($request->customer_id) {
//            return redirect('payments')->with('success', 'Payment added!');
//        } elseif ($request->supplier_id) {
//            return view('payments.supplier-index')->with('success', 'Payment added!');
//        }

        $route = 'payments';
        if ($request->get('supplier_id'))
        {
            $route = 'payment/supplier';
        }

        return redirect($route)->with('success', 'Payment added!');
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
        $payment = Payment::findOrFail($id);
        $customers = Customer::pluck('name','id');
        return view('payments.show', compact('payment','customers'));
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
        $payment = Payment::findOrFail($id);
        $customers = Customer::pluck('name','id');
        return view('payments.edit', compact('payment','customers'));
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
        $payment                    = Payment::findOrFail($id);
        $payment->amount            = $request->amount;;
        $payment->user_id           = Auth::user()->id;
        $payment->save();

        return redirect('payments')->with('success', 'Payment updated!');
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
            Payment::destroy($id);
            return redirect('payments')->with('success', 'Payment deleted!');
        }else{
            return redirect('payments')->with('error', 'Password Not Matched!');
        }
    }

    public function sentSmsByPayment($id)
    {
        $payment = Payment::where('id',$id)->first();
        $customer = Customer::where('id',$payment->customer_id)->first();
        $invoices = Invoice::where('customer_id',$customer->id)->get();
        $total_amount = $invoices->sum('grand_total_price');
        $advanced = $invoices->sum('advanced');
        $total_advanced = $payment->amount;

        $cid = $payment->customer_id;

        $onnorokom_info = Smse::latest()->first();

        $customer_due = Customer::findOrFail($cid);
        $invoices2 = Invoice::where('customer_id',$cid)->latest()->get();
        $payments = Payment::where('customer_id',$cid)->latest()->get();
		$total_payment_amount = $payments->sum('amount');

        $grand_total_price = $invoices2->sum('grand_total_price');
        $paid_price = $invoices2->sum('advanced')+$total_payment_amount;
        $due_amount = $grand_total_price+$customer_due->due-$paid_price;
        //$total_due +=$due_amount;

       /* $sms = "Dear, $customer->name
        Sub: Payment Confirmation
        Amount: Tk. $total_amount BDT
        Total Paid: Tk. $total_advanced BDT
        -CVHBD.
        ";*/
        $sms = "Dear, $customer->name
        Sub: Payment Confirmation
        Due amount: Tk. $due_amount BDT
        Total Paid: Tk. $total_advanced BDT
        -CVHBD.
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

    public function printPaymentView(Request $request)
    {
        $perPage = 25;
        $start_serial = $request->query->get('start_serial');
        $payments = Payment::whereBetween('id', [$request->query->get('first_id'), $request->query->get('last_id')])->latest()->get();
        $customers = Customer::pluck('name','id');
        $customer_mobiles = Customer::pluck('primary_mobile','primary_mobile');
        $users = User::pluck('name','id');
        $company = Company::latest()->first();
        return view('payments.payment-index', compact('payments','customers','users', 'customer_mobiles', 'company', 'start_serial'));
    }

    public function printPaymentViewSupplier(Request $request)
    {
        $perPage = 25;
        $start_serial = $request->query->get('start_serial');
        $payments = Payment::whereBetween('id', [$request->query->get('first_id'), $request->query->get('last_id')])->latest()->get();
        $customers = Customer::pluck('name','id');
        $customer_mobiles = Customer::pluck('primary_mobile','primary_mobile');
        $users = User::pluck('name','id');
        $company = Company::latest()->first();
        return view('payments.payment-supplier-index', compact('payments','customers','users', 'customer_mobiles', 'company', 'start_serial'));
    }

    public function paymentsCreateSupplier()
    {
        $suppliers = Supplier::pluck('name','id');
        return view('payments.supplier-create', compact('suppliers'));
    }
}

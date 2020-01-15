<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Http\Requests\AddSupplierRequest;
use App\Payment;
use App\Purchase;
use App\Supplier;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supplier_id = $request->get('supplier_id');
        $supplier_mobile = $request->get('supplier_mobile');
        $sup = Supplier::all();
        $perPage = 25;

        if (!empty($supplier_id) || !empty($supplier_mobile)) {

            if($supplier_id){
                $suppliers = Supplier::where('id', $supplier_id)->orderBy('created_at', 'DESC')->paginate(10);
                $total = $suppliers->sum('balance');
            }

            elseif($supplier_mobile){
                $suppliers = Supplier::where('mobile', $supplier_mobile)->orderBy('created_at', 'DESC')->paginate(10);
                $total = $suppliers->sum('balance');
            }

        }
        else {
            $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(10);
            $total = Supplier::sum('balance');
        }
        return view('supplier.index', compact('suppliers', 'total', 'sup'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSupplierRequest $request)
    {
        Supplier::create($request->all());
        return back()->with('success', 'Supplier Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(AddSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        return back()->with('success', 'Supplier Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Supplier Deleted');
    }

    public function search(Request $request) {
        $keyword = $request->key;
        $suppliers = Supplier::where('name','LIKE', "%$keyword%")
            ->orWhere('mobile', 'LIKE', "%$keyword%")
            ->orWhere('created_at', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(10);

        return view('supplier.index', compact('suppliers'));

    }

    public function printView()
    {
        $company = Company::latest()->first();
        $suppliers = Supplier::orderBy('created_at', 'DESC')->paginate(10);
        $total = Supplier::sum('balance');
        return view('supplier.print', compact('suppliers', 'total', 'company'));
    }

    public function leadgerView($id)
    {
        $payments = Payment::where('supplier_id', $id)->latest()->get();
        $purchases = Purchase::where('supplier_id', $id)->latest()->get();
        $supplier = Supplier::with(['payments', 'purchases'])->where('id', $id)->first();
        $results = array();
        if($supplier){
            $rows['created_at'] = $supplier->created_at;
            $rows['ivno'] = '';
            $rows['qty'] = $supplier->quantity;
            $rows['purAmount'] = '';
            $rows['paidAmount'] = '';
            $rows['amount'] = $supplier->balance;
            $rows['type'] = 'supplier';
            $rows['note'] = $supplier->note;
            $rows['user_id'] = '';
            $results[] = $rows;
        }
        if ($payments) {
            foreach ($payments as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = '';
                $rows['qty'] = '';
                $rows['purAmount'] = '';
                $rows['paidAmount'] = $row->amount;
                $rows['amount'] = $row->amount;
                $rows['type'] = 'payments';
                $rows['note'] = $row->note;
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if ($purchases) {
            foreach ($purchases as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = $row->invoice_num;
                $rows['qty'] = $row->quantity;
                $rows['paidAmount'] = '';
                $rows['amount'] = $row->amount;
                $rows['purAmount'] = $row->amount;
                $rows['type'] = 'purchase';
                $rows['note'] = $row->note;
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
//        return $results;
        $total_payment_amount = $payments->sum('amount');
//        $supplier = Supplier::with(['payments', 'purchases'])->where('id', $id)->first();
////        return $supplier;
        $purchases = Purchase::where('supplier_id', $id)->orderBy('created_at', 'DESC')->get();
        $payments = Payment::where('supplier_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('supplier.leadger', compact('supplier', 'results', 'payments', 'purchases'));
    }

    public function supplyLedgerView($id)
    {
        $payments = Payment::where('supplier_id', $id)->latest()->get();
        $purchases = Purchase::where('supplier_id', $id)->latest()->get();
        $supplier = Supplier::with(['payments', 'purchases'])->where('id', $id)->first();
        $results = array();
        if($supplier){
            $rows['created_at'] = $supplier->created_at;
            $rows['ivno'] = '';
            $rows['qty'] = $supplier->quantity;
            $rows['purAmount'] = '';
            $rows['paidAmount'] = '';
            $rows['amount'] = $supplier->balance;
            $rows['type'] = 'supplier';
            $rows['note'] = $supplier->note;
            $rows['user_id'] = '';
            $results[] = $rows;
        }
        if ($payments) {
            foreach ($payments as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = '';
                $rows['qty'] = '';
                $rows['purAmount'] = '';
                $rows['paidAmount'] = $row->amount;
                $rows['amount'] = $row->amount;
                $rows['type'] = 'payments';
                $rows['note'] = $row->note;
                $rows['user_id'] = $row->user_id;
                $results[] = $rows;
            }
        }
        if ($purchases) {
            foreach ($purchases as $key => $row) {
                $rows['created_at'] = $row->created_at;
                $rows['ivno'] = $row->invoice_num;
                $rows['qty'] = $row->quantity;
                $rows['paidAmount'] = '';
                $rows['amount'] = $row->amount;
                $rows['purAmount'] = $row->amount;
                $rows['type'] = 'purchase';
                $rows['note'] = $row->note;
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
        $purchases = Purchase::where('supplier_id', $id)->orderBy('created_at', 'DESC')->get();
        $payments = Payment::where('supplier_id', $id)->orderBy('created_at', 'DESC')->get();
        $company = Company::latest()->first();
        return view('supplier.leadger-print', compact('supplier', 'results', 'payments', 'purchases', 'company'));
    }
}

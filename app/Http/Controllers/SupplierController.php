<?php

namespace App\Http\Controllers;

use App\Company;
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
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        $total = Supplier::sum('balance');
        return view('supplier.index', compact('suppliers', 'total'));
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
            ->orWhere('created_at', 'LIKE', "%$keyword%")->paginate(10);

        return view('supplier.index', compact('suppliers'));

    }

    public function printView()
    {
        $company = Company::latest()->first();
        $suppliers = Supplier::paginate(10);
        $total = Supplier::sum('balance');
        return view('supplier.print', compact('suppliers', 'total', 'company'));
    }

    public function leadgerView($id)
    {
        $supplier = Supplier::with(['payments', 'purchases'])->where('id', $id)->first();
//        return $supplier;
        $purchases = Purchase::where('supplier_id', $id)->get();
        $payments = Payment::where('supplier_id', $id)->get();
        return view('supplier.leadger', compact('supplier', 'purchases', 'payments'));
    }
}

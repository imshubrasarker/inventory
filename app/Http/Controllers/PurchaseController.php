<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::paginate(15);
        $total = Purchase::sum('amount');
        return view('purchase.index', compact('purchases', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suplliers = Supplier::all();
        return view('purchase.create', compact('suplliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'supplier_id' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'note' => 'required',
        ]);
        $request['invoice_num'] = mt_rand(100000,999999);
        Purchase::create([
            'sl' => $request->sl,
            'date' => $request->date,
            'supplier_id' => $request->supplier_id,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'amount' => $request->amount,
            'note' => $request->note,
            'invoice_num' => $request->invoice_num,
        ]);
        return redirect()->route('purchase.index')->with('success', 'Purchase Created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $suplliers = Supplier::all();
        return view('purchase.edit', compact('purchase', 'suplliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'supplier_id' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'note' => 'required',
        ]);
        Purchase::findOrFail($id)->update([
            'date' => $request->date,
            'supplier_id' => $request->supplier_id,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'amount' => $request->amount,
            'note' => $request->note
        ]);
        return redirect()->route('purchase.index')->with('success', 'Purchase Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchase.index')->with('success', 'Purchase Deleted !!');
    }
}

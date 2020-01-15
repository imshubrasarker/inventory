<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
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
        $purchases = Purchase::orderBy('created_at', 'DESC')->paginate(15);
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
        $suplliers = Supplier::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('purchase.create', compact('suplliers', 'categories'));
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
            'amount' => 'required',
            'invoice' => 'required',
            'category_id' => 'required'
        ]);
        $note = $request->note ?? '';
        Purchase::create([
            'sl' => $request->sl,
            'date' => $request->date,
            'supplier_id' => $request->supplier_id,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'amount' => $request->amount,
            'note' => $note,
            'invoice_num' => $request->invoice,
            'category_id' => $request->category_id
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
        $categories = Category::orderBy('created_at', 'DESC')->get();
        $purchase = Purchase::findOrFail($id);
        $suplliers = Supplier::orderBy('created_at', 'DESC')->get();
        return view('purchase.edit', compact('purchase', 'suplliers', 'categories'));
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
            'amount' => 'required',
            'invoice' => 'required',
            'category_id' => 'required'

        ]);
        $note = $request->note ?? '';
        Purchase::findOrFail($id)->update([
            'date' => $request->date,
            'supplier_id' => $request->supplier_id,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
            'note' => $note,
            'invoice_num' => $request->invoice,
            'category_id' => $request->category_id
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

    public function godown()
    {
        $purchases = Purchase::orderBy('created_at', 'DESC')->paginate(15);
        $total = Purchase::sum('amount');
        return view('godown1.index', compact('purchases', 'total'));
    }

    public function printView()
    {
        $company = Company::latest()->first();
        $purchases = Purchase::orderBy('created_at', 'DESC')->get();
        $total = Purchase::sum('amount');
        return view('purchase.print', compact('purchases', 'total', 'company'));
    }
}

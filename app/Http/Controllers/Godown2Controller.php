<?php

namespace App\Http\Controllers;

use App\Godown2;
use App\GodownUnit;
use App\Product;
use Illuminate\Http\Request;

class Godown2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productions = Godown2::groupBy('product_id')->paginate(15);
        return view('godown2.index', compact('productions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = GodownUnit::all();
        $products = Product::all();
        return view('godown2.create', compact('units', 'products'));
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
            'product_id' => 'required',
            'size' => 'required',
            'color_id' => 'required',
            'qty' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);

        $godown = Godown2::where('product_id', $request->product_id)
            ->where('godown_unit_id', $request->color_id)
            ->first();
        if ($godown)
        {
            $godown->product_id = $request->product_id;
            $godown->size = $request->size;
            $godown->godown_unit_id =$request->color_id;
            $godown->qty = $godown->qty + $request->qty;
            $godown->date = $request->date;
            $godown->note = $request->note;
            $godown->save();
        }
        else {
            Godown2::create([
                'product_id' => $request->product_id,
                'size' => $request->size,
                'godown_unit_id' => $request->color_id,
                'qty' => $request->qty,
                'date' => $request->date,
                'note' => $request->note,
            ]);
        }

        return redirect()->route('godown2.index')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Godown2  $godown2
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = Godown2::where('product_id', $id)->get();
        return view('godown2.show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Godown2  $godown2
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = GodownUnit::all();
        $production = Godown2::findOrFail($id);
        $products = Product::all();
        return view('godown2.edit', compact('production', 'units','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Godown2  $godown2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'size' => 'required',
            'qty' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);
        Godown2::findOrFail($id)->update([
            'product_id' => $request->product_id,
            'size' => $request->size,
            'qty' => $request->qty,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('godown2.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Godown2  $godown2
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Godown2::findOrFail($id);
        $items = Godown2::where('product_id', $prod->product_id)->delete();
        return redirect()->route('godown2.index')->with('success', 'Deleted Successfully');
    }
}

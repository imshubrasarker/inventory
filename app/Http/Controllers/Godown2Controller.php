<?php

namespace App\Http\Controllers;

use App\Godown2;
use App\GodownUnit;
use App\Product;
use App\Stock;
use App\StockData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Godown2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $productions = Godown2::groupBy('product_id')->paginate(15);
        return view('godown2.index', compact('productions', 'products'));
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

    public function moveToProduction(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'size' => 'required|numeric'
        ]);

        $units = GodownUnit::all();
        if (count($units ) < 4)
        {
            return redirect()->back()->with('error', 'Add minimum 4 godown units');
        }
        $sum = 0;
        foreach ( $units as $unit)
        {
            $sum = $sum + $unit->unit_number;
        }
        if ($sum != 12)
        {
            return redirect()->back()->with('error', 'Godown unit doesn\'t meet the dozen requirement please fix that first from Manage godown unit');
        }

     $items = DB::table('godown_units')
           ->join('godown2s','godown_units.id', '=', 'godown2s.godown_unit_id')
           ->get();

       foreach ($items as $item)
       {
           $value = $item->unit_number * $request->size;

           $godown = Godown2::find($item->id);
           $godown->qty = $godown->qty - $value;
           if ($godown->qty <0 )
           {
               $unit = GodownUnit::find($godown->godown_unit_id);
              return redirect()->back()->with('error', 'Inefficient quantity for '.$unit->unit_name);
           }

       }

       $total = 0;
        foreach ($items as $item)
        {
            $value = $item->unit_number * $request->size;

            $godown = Godown2::find($item->id);
            $godown->qty = $godown->qty - $value;
            if ($godown->qty <0 )
            {
                $unit = GodownUnit::find($godown->godown_unit_id);
                return redirect()->back()->with('error', 'Inefficient quantity for '.$unit->unit_name);
            }
            else {
                $godown->save();
                $total  = $total + $value;
            }


        }



        $product_id = $request->product_id;
        $stock      = Stock::where('product_id',$product_id)->first();
        $product    = Product::where('id',$product_id)->first();
        if($stock){
            $after_add_stock            = $stock->product_stock + $request->size;
            $stock->product_stock       = $after_add_stock;
            $stock->save();

            $stockData              = new StockData();
            $stockData->product_id  = $request->product_id;
            $stockData->add_stock   = $request->size;
            $stockData->balance     = $after_add_stock;
            $stockData->note        = "Godown 2 product";
            $stockData->save();
        }else{
            $stock                       = new Stock();
            $stock->product_id           = $request->product_id;
            $stock->product_stock        = $request->size;
            $stock->save();

            $stockData              = new StockData();
            $stockData->product_id  = $request->product_id;
            $stockData->add_stock   = $request->size;
            $stockData->balance     = $request->size;
            $stockData->note        = "Godown 2 product";;
            $stockData->save();
        }

        return redirect()->back()->with('success', 'Item moved to stock');



    }
}

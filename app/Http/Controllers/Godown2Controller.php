<?php

namespace App\Http\Controllers;

use App\Company;
use App\Godown2;
use App\GodownUnit;
use App\Product;
use App\ProductTransaction;
use App\Stock;
use App\StockData;
use App\Supplier;
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
        $productions = Godown2::groupBy('product_id')->orderBy('created_at', 'DESC')->paginate(15);
        return view('godown2.index', compact('productions', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = GodownUnit::orderBy('created_at', 'DESC')->all();
        $products = Product::orderBy('created_at', 'DESC')->all();
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
            'date' => 'required',
        ]);

        $godown = '';
        $godown = Godown2::where('product_id', $request->product_id)
            ->where('godown_unit_id', $request->color_id)
            ->first();
        $note = $request->note?? '';
        if ($godown)
        {
            $godown->product_id = $request->product_id;
            $godown->size = $request->size;
            $godown->godown_unit_id =$request->color_id;
            $godown->qty = $godown->qty + $request->qty;
            $godown->date = $request->date;
            $godown->note = $note;
            $godown->save();
        }
        else {
            $godown = Godown2::create([
                'product_id' => $request->product_id,
                'size' => $request->size,
                'godown_unit_id' => $request->color_id,
                'qty' => $request->qty,
                'date' => $request->date,
                'note' => $note,
            ]);
        }
        ProductTransaction::create([
            'add_qty' => $request->qty,
            'leave_qty' => 0,
            'lost_qty' => 0,
            'godown2s_id' => $godown->id
        ]);

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
        $items = Godown2::where('product_id', $id)->orderBy('created_at', 'DESC')->get();
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
        $units = GodownUnit::orderBy('created_at', 'DESC')->get();
        $production = Godown2::findOrFail($id);
        $products = Product::orderBy('created_at', 'DESC')->get();
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
            'date' => 'required',
        ]);
        $note = $request->note?? '';
        $godown2 = Godown2::findOrFail($id);
        $after_edit_stock = $godown2->qty-$request->qty;
        Godown2::findOrFail($id)->update([
            'product_id' => $request->product_id,
            'size' => $request->size,
            'qty' => $request->qty,
            'date' => $request->date,
            'note' => $note
        ]);

        ProductTransaction::create([
            'add_qty' => 0,
            'leave_qty' => 0,
            'lost_qty' => $after_edit_stock,
            'godown2s_id' => $godown2->id
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

        $units = GodownUnit::where('product_id', $request->get('product_id'))->orderBy('created_at', 'DESC')->get();
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

//     return $items = DB::table('godown_units')
//           ->join('godown2s','godown_units.id', '=', 'godown2s.godown_unit_id')
//            ->groupBy('godown2s.godown_unit_id')
//           ->get();
        $items = Godown2::where('product_id', $request->get('product_id'))->with('godownUnits')->get();

//        return $items;

       foreach ($items as $item)
       {
           $value = $item->godownUnits['unit_number'] * $request->size;

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
            $value = $item->godownUnits['unit_number'] * $request->size;

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

                ProductTransaction::create([
                    'add_qty' => 0,
                    'leave_qty' => $value,
                    'godown2s_id' => $godown->id
                ]);
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

    public function search(Request $request)
    {
        $size = $request->product_size;
        $product_id = $request->product_id;

        if ($product_id && $size) {
            $productions = Godown2::where('product_id', $product_id)->orWhere('size', $size)->orderBy('created_at', 'DESC')->paginate(15);
        }
        elseif ($product_id && !$size) {
            $productions = Godown2::where('product_id', $product_id)->orderBy('created_at', 'DESC')->paginate(15);
        }

        elseif (!$product_id && $size){
            $productions = Godown2::where('size', $size)->orderBy('created_at', 'DESC')->paginate(15);
        }
        $products = Product::orderBy('created_at', 'DESC')->get();

        return view('godown2.index', compact('productions', 'products'));
    }

    public function ledger($id)
    {
        $items = ProductTransaction::where('godown2s_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('godown2.ledger', compact('items', 'id'));
    }

    public function ledgerPrint($id)
    {
        $items = ProductTransaction::where('godown2s_id', $id)->orderBy('created_at', 'DESC')->get();
        $company = Company::latest()->first();
        return view('godown2.print-ledger', compact('items', 'company'));
    }

    public function ledgerSearch(Request $request, $id)
    {
        $from = $request->from;
        $to = $request->to;
        $items = '';
        if(!empty($from || $to)) {
            $items = ProductTransaction::where('godown2s_id', $id)->whereBetween('created_at',[$from,$to])->orderBy('created_at', 'DESC')->get();
        }
        return view('godown2.ledger', compact('items', 'id'));
    }
}

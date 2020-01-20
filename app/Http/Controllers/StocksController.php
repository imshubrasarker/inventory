<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Stock;
use App\StockData;
use Illuminate\Http\Request;
use App\Product;
use App\ProductCart;
use App\Company;
use App\Invoice;
use App\Customer;
use DB;
use Auth;
use Hash;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        //$keyword = $request->get('search');
        $product_id = $request->get('product_id');
        $perPage = 25;

        if (!empty($product_id)) {
            //$products->where('id',$product_id)
            $stocks = Product::where('active', 1)->join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name','products.size','products.sale_price', 'products.alert_quantity')
            ->latest()->groupBy('product_id')->where('products.id',$product_id)->paginate($perPage);

        } else {
            $stocks = Product::where('active',1)->join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name', 'products.size','products.sale_price', 'products.alert_quantity')
            ->latest()->groupBy('product_id')->paginate($perPage);
        }

        $products = Product::where('active',1)->join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name', 'products.size','products.sale_price', 'products.alert_quantity')->latest()->groupBy('product_id')->get();
        /*
        if (!empty($keyword)) {
            $stocks = Stock::where('product_id', 'LIKE', "%$keyword%")
                ->orWhere('product_stock', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $stocks = Product::join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name','products.size','products.sale_price', 'products.alert_quantity')
            ->latest()->groupBy('product_id')->paginate($perPage);
        }
        */
        return view('stocks.index', compact('stocks','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $products = [];
        $product_data = Product::where('active',1)->select('name','size','id')->get();
        foreach ($product_data as $row) {
            $products[$row->id] = $row->name.'('.$row->size.')';
        }
        return view('stocks.create',compact('products'));
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
        $product_id = $request->product_id;
        $stock      = Stock::where('product_id',$product_id)->first();
        $product    = Product::where('id',$product_id)->first();
        if($stock){
            $after_add_stock            = $stock->product_stock+$request->product_stock;
            $stock->product_stock       = $after_add_stock;
            $stock->save();

            $stockData              = new StockData();
            $stockData->product_id  = $request->product_id;
            $stockData->add_stock   = $request->product_stock;
            $stockData->balance     = $after_add_stock;
            $stockData->note        = $request->note;
            $stockData->save();
        }else{
            $stock                       = new Stock();
            $stock->product_id           = $request->product_id;
            $stock->product_stock        = $request->product_stock;
            $stock->save();

            $stockData              = new StockData();
            $stockData->product_id  = $request->product_id;
            $stockData->add_stock   = $request->product_stock;
            $stockData->balance     = $request->product_stock;
            $stockData->note        = $request->note;
            $stockData->save();
        }
        return redirect()->back()->with('success', 'Stock added!');
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
        $stock = Stock::findOrFail($id);
        $product_carts = ProductCart::where('product_id',$stock->product_id)->orderBy('created_at', 'DESC')->get();
        $product = Product::where('active',1)->where('id', $stock->product_id)->first();
        return view('stocks.show', compact('stock', 'product_carts', 'product'));
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
        $stock = Stock::findOrFail($id);
        $products = [];
        $product_data = Product::where('active',1)->select('name','size','id')->get();
        foreach ($product_data as $row) {
            $products[$row->id] = $row->name.'('.$row->size.')';
        }
        return view('stocks.edit', compact('stock','products'));
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
        $stock = Stock::findOrFail($id);
        $after_edit_stock       = $stock->product_stock-$request->product_stock;
        $stock->product_stock   = $request->product_stock;
        $stock->save();

        $stockData              = new StockData();
        $stockData->product_id  = $request->product_id;
        $stockData->lost_stock   = $after_edit_stock;
        $stockData->balance     = $request->product_stock;
        $stockData->note        = $request->note;
        $stockData->save();

        return redirect('stocks')->with('success', 'Stock updated!');
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
            Stock::destroy($id);
            return redirect('stocks')->with('success', 'Stock deleted!');
        }else{
            return redirect('stocks')->with('error', 'Password Not Matched!');
        }


    }

    public function getInvoiceInfo($id)
    {
       $productInvoice =  ProductCart::where('product_id',$id)->orderBy('created_at', 'DESC')->get();
       $products = Product::where('active',1)->pluck('name','id');
       $stock = Stock::where('product_id',$id)->first();
       // dd($stock);
       return view('stocks.invoice-index',compact('productInvoice','id','products','stock'));
    }

    public function productLedgerView($id)
    {
        $stockDatas = StockData::where('product_id',$id)->orderBy('created_at', 'DESC')->get();
        $invoice_no = StockData::where('product_id',$id)->pluck('invoice_no');
        $product_info = Product::where('id',$id)->first();
        $company = Company::latest()->first();
        $productId = $product_info->id;
        $stock = Stock::where('product_id',$id)->first();
        $customers = Customer::pluck('name','id');
        return view('stocks.print',compact('customers', 'stock','productId','stockDatas','product_info','company'));
    }

    public function productLedgerViewPrint($id)
    {
        $stockDatas = StockData::where('product_id',$id)->orderBy('created_at', 'DESC')->get();
        $invoice_no = StockData::where('product_id',$id)->pluck('invoice_no');
        $product_info = Product::where('active',1)->where('id',$id)->first();
        $company = Company::latest()->first();
        $productId = $product_info->id;
        $stock = Stock::where('product_id',$id)->first();
        return view('stocks.product-ledger',compact('stock','productId','stockDatas','product_info','company'));
    }

    public function printStockView(Request $request)
    {
        $perPage = 25;
        $start_serial = 1;
        $stocks = Product::where('active',1)->join('stocks','products.id','=','stocks.product_id')
            ->select('stocks.*','products.name','products.size','products.sale_price', 'products.alert_quantity')
            ->latest()->groupBy('product_id')->paginate($perPage);
        $company = Company::latest()->first();
        return view('stocks.stock-index', compact('stocks', 'company'));
    }
}

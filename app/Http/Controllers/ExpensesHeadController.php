<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpensesHead;
use Illuminate\Http\Request;

class ExpensesHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        if ($request->get('head'))
        {
            $expenses_heads = ExpensesHead::where('id', $request->get('head'))->get();
        }
        else{
            $expenses_heads = ExpensesHead::paginate(10);
        }
        $heads = ExpensesHead::all();

        $total = Expense::sum('amount');
        return view('expenses.index', compact('expenses_heads', 'total', 'heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' => 'required|max:120|unique:expenses_heads',
        ]);
        ExpensesHead::create($request->all());
        return back()->with('success', 'New expense head added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpensesHead  $expensesHead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $head = ExpensesHead::with('expenses')->where('id', $id)->firstOrFail();
        return view('expenses.head-details', compact('head'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpensesHead  $expensesHead
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpensesHead $expensesHead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpensesHead  $expensesHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:120',
        ]);
        $head = ExpensesHead::findOrFail($id);
        $head->title = $request->get('title');
        $head->save();
        return back()->with('success', 'Expenses Head updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpensesHead  $expensesHead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ExpensesHead::destroy($id);
        return back()->with('success', 'Expenses Head deleted!');
    }
}

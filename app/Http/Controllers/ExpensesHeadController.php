<?php

namespace App\Http\Controllers;

use App\ExpensesHead;
use Illuminate\Http\Request;

class ExpensesHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses_heads = ExpensesHead::paginate(10);
        return view('expenses.index', compact('expenses_heads'));
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
            'title' => 'required|max:120',
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
    public function show(ExpensesHead $expensesHead)
    {
        //
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

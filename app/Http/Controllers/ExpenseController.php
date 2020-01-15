<?php

namespace App\Http\Controllers;

use App\Company;
use App\Expense;
use App\ExpensesHead;
use App\Http\Requests\AddExpensesRequest;
use foo\bar;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = Expense::sum('amount');
        $expenses = Expense::orderBy('created_at', 'DESC')->get();
        return view('expenses.manage-expenses', compact('expenses', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads = ExpensesHead::get();
        return view('expenses.create',compact('heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddExpensesRequest $request)
    {
        Expense::create($request->all());
        return back()->with('success', 'Expense added succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {

        return view('expenses.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $heads = ExpensesHead::get();
      return view('expenses.edit', compact('expense', 'heads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(AddExpensesRequest $request, Expense $expense)
    {
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Expense deleted!');
    }

    public function search(Request $request)
    {
        $total = Expense::whereBetween('created_at', [$request->from, $request->to])->sum('amount');
        $expenses = Expense::whereBetween('created_at', [$request->from, $request->to])->orderBy('created_at', 'DESC')->get();

        return view('expenses.manage-expenses', compact('total', 'expenses'));
    }

    public function printShow()
    {
        $company = Company::latest()->first();
        $expenses = Expense::orderBy('created_at', 'DESC')->get();
        $total = Expense::sum('amount');
        return view('expenses.print', compact('expenses', 'company', 'total'));
    }
}

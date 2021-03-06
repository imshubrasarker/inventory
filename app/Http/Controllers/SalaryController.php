<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Expense;
use App\ExpensesHead;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $salaries = Salary::all();
//        return view('salary.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::orderBy('created_at', 'DESC')->get();
        return view('salary.create', compact('employees'));
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
            'employee_id' => 'required',
            'salary' => 'required'
        ]);
        $salary = Salary::create([
            'employee_id' => $request->employee_id,
            'balance' => $request->salary,
            'quantity' => $request->quantity,
            'rate' => $request->rate,
            'note' => $request->note,
            'qty_desc' => $request->quantity,
            'designation' => $request->designation,
            'working_day' => $request->working_day,
            'month' => $request->month,
            'paid_salary' => $request->paid_salary

        ]);
        $eh = ExpensesHead::where('title', 'Salary Purpose')->first();

        Expense::create([
            'title' => $salary->employee->name,
            'amount' => $salary->balance,
            'expenses_head_id' => $eh->id,
            'date'=> Carbon::now(),
            'note' => $salary->note,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Salary Paid Successfuly !!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}

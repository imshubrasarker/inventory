<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee_id = $request->employee_id;
        $employee_mobile = $request->employee_mobile;

        if (!empty($employee_id) || !empty($employee_mobile)) {

            if($employee_id){
                $employees = Employee::where('id', $employee_id)->paginate(10);
            }

            elseif($employee_mobile){
                $employees = Employee::where('mobile', $employee_mobile)->paginate(10);
            }
        }
        else {
            $employees = Employee::paginate(10);
        }
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
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
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'nid_no' => 'required',
            'e_contact' => 'required',
            'salary_type' => 'required'
        ]);
        $employee = Employee::create([
            'name' => $request->name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'nid_no' => $request->nid_no,
            'e_contact' => $request->e_contact,
            'salary_type' => $request->salary_type,
            'previous_salary' => $request->previous_salary,
            'previous_quantity' => $request->previous_quantity,
            'balance' => $request->salary,
            'designation' => $request->designation,
            'rate' => $request->rate,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee added Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::latest()->first();
        $employee = Employee::where('id', $id)->with('salaries')->first();
        return view('employees.show', compact('employee', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'nid_no' => 'required',
            'e_contact' => 'required',
            'salary_type' => 'required'
        ]);
        $employee = Employee::findOrFail($id)->update([
            'name' => $request->name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'nid_no' => $request->nid_no,
            'e_contact' => $request->e_contact,
            'salary_type' => $request->salary_type,
            'previous_salary' => $request->previous_salary,
            'previous_quantity' => $request->previous_quantity,
            'balance' => $request->salary,
            'designation' => $request->designation,
            'rate' => $request->rate,
        ]);
        return redirect()->back()->with('success', 'Employee Updated Successfuly !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee Deleted Successfuly !!');
    }
}

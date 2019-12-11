<?php

namespace App\Http\Controllers;

use App\GodownUnit;
use Illuminate\Http\Request;

class GodownUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dozens = GodownUnit::paginate(15);
        return view('godown1-units.index', compact('dozens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('godown1-units.create');
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
            'unit_name' => 'required',
            'unit_number' => 'required',
        ]);
        GodownUnit::create([
            'unit_name' => $request->unit_name,
            'unit_number' => $request->unit_number
        ]);
        return redirect()->route('godown-unit.index')->with('success', 'Unit Created !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GodownUnit  $godownUnit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dozen = GodownUnit::findOrFail($id);
        return view('godown1-units.show', compact('dozen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GodownUnit  $godownUnit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dozen = GodownUnit::findOrFail($id);
        return view('godown1-units.edit', compact('dozen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GodownUnit  $godownUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_name' => 'required',
            'unit_number' => 'required',
        ]);
        GodownUnit::findOrFail($id)->update([
            'unit_name' => $request->unit_name,
            'unit_number' => $request->unit_number
        ]);
        return redirect()->route('godown-unit.index')->with('success', 'Unit Created !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GodownUnit  $godownUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $godown = GodownUnit::findOrFail($id);
        $godown->delete();
        return redirect()->route('godown-unit.index')->with('success', 'Unit Deleted !!');
    }
}

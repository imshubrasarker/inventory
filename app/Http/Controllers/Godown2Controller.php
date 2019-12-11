<?php

namespace App\Http\Controllers;

use App\Godown2;
use App\GodownUnit;
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
        $productions = Godown2::paginate(15);
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
        return view('godown2.create', compact('units'));
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
            'size' => 'required',
            'color_id' => 'required',
            'qty' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);
        Godown2::create([
            'name' => $request->name,
            'size' => $request->size,
            'godown_unit_id' => $request->color_id,
            'qty' => $request->qty,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('godown2.index')->with('success', 'Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Godown2  $godown2
     * @return \Illuminate\Http\Response
     */
    public function show(Godown2 $godown2)
    {
        //
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
        return view('godown2.edit', compact('production', 'units'));
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
            'name' => 'required',
            'size' => 'required',
            'color_id' => 'required',
            'qty' => 'required',
            'note' => 'required',
            'date' => 'required',
        ]);
        Godown2::findOrFail($id)->update([
            'name' => $request->name,
            'size' => $request->size,
            'godown_unit_id' => $request->color_id,
            'qty' => $request->qty,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('godown2.index')->with('success', 'Updated Successfuly');
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
        $prod->delete();
        return redirect()->route('godown2.index')->with('success', 'Deleted Successfuly');
    }
}

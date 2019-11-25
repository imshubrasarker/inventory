<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Company;
use Illuminate\Http\Request;
use Auth;
use Hash;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $companies = Company::where('name', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->orWhere('adddress', 'LIKE', "%$keyword%")
                ->orWhere('mobile', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $companies = Company::latest()->paginate($perPage);
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
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
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logo_name = uniqid().'.'.strtolower($logo->getClientOriginalExtension());
            $path = 'company_img/';
            $logo_url = $path.$logo_name;
            $logo->move($path,$logo_name);
        }else{
             $logo_url = null;
        }

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->mobile = $request->mobile;
        $company->logo = $logo_url;
        $company->quote = $request->quote;
        $company->save();

        return redirect('companies')->with('success', 'Company added!');
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
        $company = Company::findOrFail($id);

        return view('companies.show', compact('company'));
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
        $company = Company::findOrFail($id);

        return view('companies.edit', compact('company'));
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
        
        $company = Company::findOrFail($id);

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logo_name = uniqid().'.'.strtolower($logo->getClientOriginalExtension());
            $path = 'company_img/';
            $logo_url = $path.$logo_name;
            $logo->move($path,$logo_name);
            if($company->logo != null){
                unlink($company->logo);
            }
        }else{
             $logo_url = $company->logo;
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->mobile = $request->mobile;
        $company->logo = $logo_url;
        $company->quote = $request->quote;
        $company->save();

        return redirect('companies')->with('success', 'Company updated!');
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
            $company = Company::find($id);
            if($company->logo != null){
                unlink($company->logo);
            }
            Company::destroy($id);
            return redirect('companies')->with('success', 'Company deleted!');
        }else{
            return redirect('companies')->with('error','Password Not Matched!');
        }
    }
}

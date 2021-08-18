<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()) {
            return view('auth.login');
            // check if there's an account login
        }

        if (Auth::user()->id == 1) { //display all company for admin
            $companies = Company::all();
        } else { // display all company for designated account
            $companies = Company::all()->where('user_id', '=', Auth::user()->id);
        }
        return view('company.company', ['companies' => $companies,]);
    }
    public function companyTrashed()
    {
        if (!Auth::user()) {
            return view('auth.login');
            // check if there's an account login
        }

        if (Auth::user()->id == 1) { //display all company for admin
            $trasheCompanies = Company::onlyTrashed()->get();
        } else { // display all company for designated account
            $trasheCompanies = Company::onlyTrashed()->get()->where('user_id', '=', Auth::user()->id);
        }
        return view('company.restore', ['trasheCompanies' => $trasheCompanies]);
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
    public function companyRestoreTrashed(Request $request)
    {

        // dd($request);
        $company = Company::withTrashed()->find($request->company_id)->restore();
        return redirect('companies');
    }
    public function store(Request $request)
    {
        $image = $request->file('file');
        $imageName =  $request->name . time()   . '.' . $image->extension();
        $image->move(public_path('images/company'), $imageName);

        $company = new Company();
        $company->user_id = (Auth::user()->id);
        $company->name = $request->name;
        $company->image = $imageName;
        $company->company_type = $request->company_type;
        $company->about = $request->about;
        $company->status_id = 1; //inactive
        $company->save();
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        // Company::all();
        if (!Auth::user()) {
            return view('auth.login');
            // check if there's an account login
        }
        $products = Product::where('company_id', '=', $company->id)->paginate(5);
        return view('company.view-company', ['company' => $company, 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        if ($request->name) //{update data by user
        {
            if ($request->file) {
                $image = $request->file('file');
                $imageName =  $request->name . time()   . '.' . $image->extension();
                $image->move(public_path('images/company'), $imageName);
                $company->image = $imageName;
            }
            $company->name = $request->name;
            $company->company_type = $request->company_type;
            $company->about = $request->about;
        } else { //update the status by admin

            if ($company->status->id == 1) //inactvie
            {
                $company->status_id = 2; //2 is to active
            } else {
                $company->status_id = 1; //1 is to inactive
            }
        }
        $company->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back();
    }
    // public function restore($company)
    // {
    //     dd('as');
    //     $company = Company::withTrashed()->find($company->id)->restore();
    //     return redirect('companies');
    // }
}

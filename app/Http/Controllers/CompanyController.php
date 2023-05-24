<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function viewDetails()
    {
        return view('company_details');
    }
    
    public function viewAddNew()
    {
        return view('create_or_edit_company');
    }
    public function view()
    {
        return view('companies');
    }
    public static function index()
    {
        return Company::all();
    }

    public static function showById(int $id)
    {
        return Company::find($id);
    }

    public function store(CompanyCreateRequest $request)
    {
        Company::create($request->validated());

        return back()->with('success', 'Create company successfully');
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = $request->validated();

        $company->update($data);

        return back()->with('success', 'Update company successfully');
    }

    public function delete(Company $company) {
        $company->delete();

        return view('companies');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
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

        return redirect('/');
    }
}

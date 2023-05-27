<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * index company
     * 
     * @return Collection
     */
    public static function index()
    {
        return Company::all();
    }

    /**
     * show by id
     * 
     * @param int $id
     * @return Collection
     */
    public static function showById(int $id)
    {
        return Company::find($id);
    }

    /**
     * store
     * 
     * @param CompanyCreateRequest $request
     * @return RedirectResponse
    */
    public function store(CompanyCreateRequest $request)
    {
        Company::create($request->validated());

        return back()->with('success', 'Create company successfully');
    }

    /**
     * update company
     * 
     * @param CompanyUpdateRequest $request
     * @param Company $company
     * @return RedirectResponse
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = $request->validated();

        $company->update($data);

        return back()->with('success', 'Update company successfully');
    }

    /**
     * delete company
     * 
     * @param Company $company
     * @return RedirectResponse
     */
    public function delete(Company $company) {
        $company->delete();

        return redirect('/');
    }
}

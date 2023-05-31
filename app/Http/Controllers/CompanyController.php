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
     * store
     *
     * @param CompanyCreateRequest $request
     * @return RedirectResponse
    */
    public function store(CompanyCreateRequest $request): RedirectResponse
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
    public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
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
    public function delete(Company $company): RedirectResponse
    {
        $company->delete();

        return redirect('/');
    }
}

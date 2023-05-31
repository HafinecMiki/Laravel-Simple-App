<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{
    /**
     * checkMainRoute
     *
     * @return mixed
     */
    public function checkMainRoute(): mixed
    {
        if (Auth::check()) {
            $companies = Company::all();

            return view('company.companies', compact('companies'));
        } else {
            return view('login.login');
        }
    }

    /**
     * showLogin
     *
     * @return mixed
     */
    public function showLogin(): mixed
    {
        return view('login.login');
    }

    /**
     * showVerify
     *
     * @return mixed
     */
    public function showVerify(): mixed
    {
        return view('login.confirm_code');
    }

    /**
     * showRegister
     *
     * @return mixed
     */
    public function showRegister(): mixed
    {
        return view('login.register');
    }

    /**
     * showCompanies
     *
     * @return mixed
     */
    public function showCompanies(): mixed
    {
        $companies = Company::all();

        return view('company.companies', compact('companies'));
    }

    /**
     * showCompanyDetails
     *
     * @param Company $company
     * @return mixed
     */
    public function showCompanyDetails(Company $company): mixed
    {
        return view('company.company_details', compact('company'));
    }

    /**
     * showCompanyCreate
     *
     * @return mixed
     */
    public function showCompanyCreate(): mixed
    {
        return view('company.create_or_edit_company');
    }

    /**
     * showCompanyEdit
     *
     * @param Company $company
     * @return mixed
     */
    public function showCompanyEdit(Company $company): mixed
    {
        return view('company.create_or_edit_company', compact('company'));
    }
}

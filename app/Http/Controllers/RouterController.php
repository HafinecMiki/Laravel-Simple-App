<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouterController extends Controller
{

    public function showCompanies()
    {
        $companies = Company::all();

        return view('company.companies', compact('companies'));
    }

    public function checkMainRoute()
    {

        if (Auth::check()) {
            $companies = Company::all();

            return view('company.companies', compact('companies'));
        } else {
            return view('login.login');
        }
    }

    public function showCompanyDetails(Company $company)
    {
        return view('company.company_details', compact('company'));
    }

    public function showCompanyEdit(Company $company)
    {
        return view('company.create_or_edit_company', compact('company'));
    }
}

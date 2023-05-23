<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public static function index()
    {
        return Company::all();
    }

    public function store(Request $request)
    {
        return Company::create([
            'name' => $request->name,
            'tax_number' => $request->tax_number,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
    }
}

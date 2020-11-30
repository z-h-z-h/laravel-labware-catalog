<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Company $company)
    {


        return view('public/company/index', ['company' => $company]);

    }
}

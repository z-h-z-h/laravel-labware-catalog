<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class PublicCompanyController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $company = Company::
        when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })
            -> paginate();
        return view('public/company/index', ['companies' => $company, 'search' => $search]);
    }
}

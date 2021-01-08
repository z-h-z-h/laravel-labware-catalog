<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $companies = Company::when($search, function ($query, $search) {
           $query->search($search);
        })
            ->paginate();

        return view('public/mainIndex', ['companies' => $companies, 'search' => $search]);
    }
}

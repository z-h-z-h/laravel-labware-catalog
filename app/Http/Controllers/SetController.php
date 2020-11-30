<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    public function index(Company $company, Category $parentCategory, Category $nestedCategory, Set $set)
    {
        return view('public/set/index', ['set' => $set]);
    }
}

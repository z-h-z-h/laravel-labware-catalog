<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    public function index(Company $company, Category $parentCategory)
    {
        return view('public/category/parentIndex', ['parentCategory' => $parentCategory, 'company' => $company]);
    }
}

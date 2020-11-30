<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Http\Request;

class NestedCategoryController extends Controller
{
    public function index(Company $company, Category $parentCategory, Category $nestedCategory)
    {
        $sets = Set::where('category_id', $nestedCategory->id)->get();
        return view('public/category/nestedIndex', ['company' => $company,
            'parentCategory' => $parentCategory, 'nestedCategory' => $nestedCategory, 'sets' => $sets]);
    }
}

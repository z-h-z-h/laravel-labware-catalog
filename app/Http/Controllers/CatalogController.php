<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function company(Company $company)
    {
        return view('public/company/index', ['company' => $company]);
    }

    public function parentCategory(Company $company, Category $category)
    {
        return view('public/category/parentIndex', ['category' => $category, 'company' => $company]);
    }

    public function nestedCategory(Company $company, Category $category, Category $nestedCategory)
    {
        return view('public/category/nestedIndex', [
            'company' => $company, 'category' => $category, 'nestedCategory' => $nestedCategory, 'sets' => $nestedCategory->sets]);
    }

    public function set(Company $company, Category $category, Category $nestedCategory, Set $set)
    {
        return view('public/set/index', ['set' => $set]);
    }

 }

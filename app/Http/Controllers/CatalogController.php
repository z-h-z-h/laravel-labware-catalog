<?php

namespace App\Http\Controllers;

use App\Http\Resources\SetResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function company(Company $company)
    {
        $parentCategories = Category::forCompany($company->id)->parents()
            ->addSelect([
                'sets_count' => Set::selectRaw('count(id)')
                    ->whereIn('category_id', function ($query) {
                        $query->selectRaw('nested_categories.id')->from('categories as nested_categories')
                            ->where('nested_categories.parent_id', DB::raw('categories.id'));
                    })
            ])
            ->get();

        return view('public/company/index', [
            'company' => $company,
            'parentCategories' => $parentCategories
        ]);
    }

    public function parentCategory(Company $company, Category $category)
    {
        return view('public/category/parentIndex', ['category' => $category, 'company' => $company]);
    }

    public function nestedCategory(Company $company, Category $category, Category $nestedCategory)
    {
        return view('public/category/nestedIndex', [
            'company' => $company,
            'category' => $category,
            'nestedCategory' => $nestedCategory,
            'sets' => $nestedCategory->sets,
        ]);
    }

    public function set(Request $request, Company $company, Category $category, Category $nestedCategory, Set $set)
    {
//        $data = $request->session()->get('set_ids', []);
//
//            if (array_search($set->id, $data) === false) {
//                if (count($data) >= 5) {
//                    $request->session()->pull('set_ids.' . min(array_keys($data)));
//                }
//                $request->session()->push('set_ids', $set->id);
//            }

        $setIds = $request->session()->get('set_ids', []);

        if(array_search($set->id, $setIds) === false) {
            $setIds[] = $set->id;
        }

        $setIds = array_slice($setIds, -5, 5);

        $request->session()->put('set_ids', $setIds);

        return view('public/set/index', [
            'company' => $company,
            'category' => $category,
            'nestedCategory' => $nestedCategory,
            'set' => $set,

        ]);
    }

    public function search(Request $request)
    {
        $search = htmlentities(strip_tags($request->get('input')));
        $sets = Set::search($search)
            ->leftJoin('categories as nested_categories', 'sets.category_id', '=', 'nested_categories.id')
            ->leftJoin('categories as parent_categories', 'nested_categories.parent_id', '=', 'parent_categories.id')
            ->leftJoin('companies', 'parent_categories.company_id', '=', 'companies.id')
            ->select('sets.*',
                'nested_categories.slug as nested_category_slug', 'nested_categories.title as nested_category_title',
                'parent_categories.slug as parent_category_slug', 'parent_categories.title as parent_category_title',
                'companies.slug as company_slug', 'companies.title as company_title'
            )->orderBy('companies.id')
            ->get();

        return SetResource::collection($sets);
    }
}

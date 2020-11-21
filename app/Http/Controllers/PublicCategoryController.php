<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PublicCategoryController extends Controller
//здесь возможно стоит показать только вложенные категории
{
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $category = Category::
        when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })
            ->whereParent_id(null)->
            paginate(3);
        return view('public/category/index', ['categories' => $category, 'search' => $search]);

    }
// думаю неь смысла показывать категорию
//    public function show($id)
//    {
//        $category = Category::find($id);
//        //->select( 'id', 'title', 'description', 'code');
//        // ->get();
//
//
//        return view('public/category/show', ['category' => $category]);
//    }
}

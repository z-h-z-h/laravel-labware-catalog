<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');


        $categories = Category::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')->paginate(15);

        },
            function ($query) {
                return $query->whereParentId(0)->
                paginate(3);
            } );

        return view('admin/category/index', ['categories' => $categories, 'search' => $search]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::where('parent_id', 0)->get(['id', 'title']);



        $companies = Company::all(['id', 'title']);
        return view('admin/category/create', [
            'parentCategories' => $parentCategories,
            'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = $request->validated();


        Category::create($category);

        return redirect()->route('category.index')->with('message', 'Категория успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

       $parentCategories = Category::whereParentId(0)->get(['id', 'title']);
        $companies = Company::all(['id', 'title']);

        return view('admin/category/edit', ['category' => $category,
        'parentCategories' =>$parentCategories,
            'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, Category $category)
    {

        $data = $request->validated();

        $category->update($data);

        return redirect()->route('category.index')->with('message', 'успешно изменено!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

        return redirect()->route('category.index')->with('message', 'успешно удалено!!!');
    }
}

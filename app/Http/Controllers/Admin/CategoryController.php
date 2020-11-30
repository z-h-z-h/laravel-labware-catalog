<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');


        $categories = Category::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')->paginate(15);

        },
            function ($query) {
                return $query->where('parent_id', null)
                    ->orderBy('company_id')
                    ->paginate(3);// красиво выглядит и ровно когда одинаковое количество вложенных категорий иначе надо что то переделать
            });

        return view('admin/category/index', ['categories' => $categories, 'search' => $search]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get(['id', 'title','company_id']);

        $companies = Company::all(['id', 'title']);
        return view('admin/category/create', [
            'parentCategories' => $parentCategories,
            'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        $parentCategories = Category::whereNull('parent_id')->get(['id', 'title', 'company_id']);
        $companies = Company::all(['id', 'title']);

        return view('admin/category/edit', ['category' => $category,
            'parentCategories' => $parentCategories,
            'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategory $request
     * @param Category $category
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
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if (count($category->nestedCategories) == 0) {
            $category->delete();
            return redirect()->route('category.index')->with('message', 'успешно удалено!!!');
        }
        else{
            return redirect()->route('category.index')->with('message', 'Сначала разберись с вложенными категориями , а потом удаляй!!!');}
    }
}

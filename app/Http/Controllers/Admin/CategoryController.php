<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditCategory;
use App\Http\Requests\StoreCategory;
use App\Models\Category;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::when($search,
            function ($query, $search) {
                $query->search($search);
            },
            function ($query) {
                $query->parents();
            }
        )
            ->paginate();

        return view('admin/category/index', ['categories' => $categories, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/category/create', [
            'parentCategories' => Category::parents()->get(),
            'companies' => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
     * @return Response
     */
    public function store(StoreCategory $request)
    {
        $data = $request->validated();
        $category = new Category($data);

        if (empty($data['slug'])) {
            $category->slug = Str::slug($data['title']);
        }

        $category->save();

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('category.index')->with('message', 'Категория добавлена.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        return view('admin/category/edit', [
            'category' => $category,
            'parentCategories' => Category::forCompany($category->company_id)->parents()->get(),
            'image' => $category->getFirstMediaUrl('photo')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategory $request
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function update(EditCategory $request, Category $category)
    {
        $data = $request->validated();
        $category->fill($data);

        if (empty($data['slug'])) {
            $category->slug = Str::slug($data['title']);
        }

        $category->save();

        if ($request->hasFile('image')) {
            $category->clearMediaCollection('photo');
            $category->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('category.index')->with('message', 'Категория изменена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        if ($category->nestedCategories()->count() === 0 && $category->sets()->count() === 0) {
            $category->delete();
            $msg = 'Категория удалена.';
        }

        return redirect()->route('category.index')->with('message', $msg ?? 'Нельзя удалить, пока есть зависимые категории или комплекты.');
    }
}

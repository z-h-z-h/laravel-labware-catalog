<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;

use App\Models\Category;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
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
                return $query->where('title', 'LIKE', '%' . $search . '%')->paginate(15);
            },
            function ($query) {
                return $query->where('parent_id', null)
                    ->orderBy('company_id')
                    ->paginate(3);
            }
        );
        return view('admin/category/index', ['categories' => $categories, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get(['id', 'title', 'company_id']);

        $companies = Company::all(['id', 'title']);
        return view('admin/category/create', [
            'parentCategories' => $parentCategories,
            'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
     * @return Response
     */
    public function store(StoreCategory $request)
    {
        $category = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->title);
            $category = array_merge($category, ['slug' => $slug]);
        }

        $category = Category::create($category);
        if (!empty($request->file('image'))) {
            $category->addMediaFromRequest('image')
                ->preservingOriginal()
//            ->usingName()
                ->toMediaCollection('categories');
        }
        return redirect()->route('category.index')->with('message', 'Категория успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit(Category $category)
    {
        $image = $category->getFirstMedia('categories');
        if (!empty($image)) {
            $image = $image->getUrl();
        } else {
            $image = Storage::url('0/no_photo.png');
        }
        $parentCategories = Category::where('company_id', $category->company_id)->whereNull('parent_id')->get(['id', 'title', 'company_id']);



        return view('admin/category/edit', ['category' => $category,
            'parentCategories' => $parentCategories,

            'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCategory $request
     * @param Category $category
     * @return Response
     * @throws Exception
     */
    public function update(StoreCategory $request, Category $category)
    {
        $data = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->title);
            $data = array_merge($data, ['slug' => $slug]);
        }

        $category->update($data);

        if (!empty($request->file('image'))) {
            if (!empty($category->getFirstMedia('categories'))) {
                $category->getFirstMedia('categories')->delete();
            }
            $category->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('categories');
        }
        return redirect()->route('category.index')->with('message', 'успешно изменено!!!');
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
        if (count($category->nestedCategories) == 0 && count($category->sets) == 0) {
            $category->delete();
            return redirect()->route('category.index')->with('message', 'успешно удалено!!!');
        } else {
            return redirect()->route('category.index')->with('message', 'Нельзя удалить, пока есть зависимые категории или комплекты');
        }
    }
}

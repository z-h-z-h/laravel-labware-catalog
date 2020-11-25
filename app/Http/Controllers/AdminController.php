<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use App\Http\Requests\StoreSet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $search = $request->input('search');;
        $sets = Set::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%');
        })
            ->paginate();

        return view('admin/set/index', ['sets' => $sets, 'search' => $search]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {   $companies = Company::all();
        $parentCategories = Category::where('parent_id', 0)->get();
        $nestedCategories = Category::where('parent_id','>', 0)->get();


        return view('admin/set/create', ['nestedCategories' => $nestedCategories,'parentCategories' => $parentCategories, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSet $request)
    {


        $set = $request->validated();
        $slug = Str::slug($request->title);
        $set = array_merge($set, ['slug' => $slug]);
        Set::create($set);

        return redirect()->route('set.index')->with('message', 'комплект успешно добавлен');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Set $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Set $set
     * @return \Illuminate\Http\Response
     */
    public function edit(Set $set)
    {

        $companies = Company::all();
        $parentCategories = Category::where('parent_id', 0)->get();
        $nestedCategories = Category::where('parent_id','>', 0)->get();

        return view('admin/set/edit', [
            'set' => $set,
            'companies' => $companies,
            'parentCategories' =>  $parentCategories,
            'nestedCategories' => $nestedCategories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Set $set
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSet $request, Set $set)
    {

        $slug = Str::slug($request->title);
        $data = $request->validated();


        $set->update(array_merge($data, ['slug' => $slug]));


        return redirect()->route('set.index')->with('message', 'успешно изменено!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Set $set
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Set::destroy($id);


        return redirect()->route('set.index')->with('message', 'успешно удалено!!!');
    }
}

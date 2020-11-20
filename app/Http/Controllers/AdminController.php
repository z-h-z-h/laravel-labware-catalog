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
        $set = Set::when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })
            ->paginate(10);

        return view('admin/set/index', ['sets' => $set, 'search' => $search]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $categories = Category::select('id', 'title')->get();

        return view('admin/set/create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSet $request)
    {
        //$validated = $request->validated(); включил -выключил разницы не понял

        $set = $request->input();
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
    public function edit($id)
    {
        $set = Set::find($id);
        $categories = Category::select('id', 'title')->get();

        return view('admin/set/edit', ['set' => $set, 'categories' => $categories]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Set $set
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSet $request, $id)
    {

        $slug = Str::slug($request->title);
        $data = $request->input();


        Set::find($id)->update(array_merge($data, ['slug' => $slug]));


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
        $destroyer = Set::destroy($id);


        return redirect()->route('set.index')->with('message', 'успешно удалено!!!');
    }
}

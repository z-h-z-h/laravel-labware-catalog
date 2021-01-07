<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use App\Http\Requests\StoreSet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $sets = Set::when($search, function ($query, $search) {
            $query->search($search);
        })
            ->orderBy('category_id')
            ->paginate();

        return view('admin/set/index', ['sets' => $sets, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/set/create', [
            'nestedCategories' => Category::nested()->get(),
            'parentCategories' => Category::parents()->get(),
            'companies' => Company::CutCompany()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSet $request
     * @return Response
     */
    public function store(StoreSet $request)
    {
        $data = $request->validated();
        $set = new Set($data);
        if (empty($data['slug'])) {
            $set->slug = Str::slug($data['code']);
        }
        $set->save();
        if ($request->hasFile('image')) {
            $set->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('set.index')->with('message', 'Комплект добавлен.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Set $set
     * @return Response
     */
    public function edit(Set $set)
    {
        return view('admin/set/edit', [
            'set' => $set,
            'companies' => Company::cutCompany(),
            'parentCategories' => Category::parents()->with('nestedCategories')->get(),
            'nestedCategories' => Category::nested()->get(),
            'image' => $set->getFirstMediaUrl('photo')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSet $request
     * @param Set $set
     * @return Response
     */
    public function update(StoreSet $request, Set $set)
    {
        $data = $request->validated();
        $set->fill($data);
        if (empty($data['slug'])) {
            $set->slug = Str::slug($data['code']);
        }
        $set->save();

        if ($request->hasFile('image')) {
            $set->clearMediaCollection('photo');
            $set->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('set.index')->with('message', 'Комплект изменен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Set $set
     * @return Response
     * @throws Exception
     */
    public function destroy(Set $set)
    {
        $set->delete();

        return redirect()->route('set.index')->with('message', 'Комплект удален.');
    }
}

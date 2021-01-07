<?php

namespace App\Http\Controllers\Admin;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompany;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $companies = Company::when($search, function ($query, $search) {
            $query->search($search);
        })
            ->paginate();

        return view('admin/company/index', ['companies' => $companies, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin/company/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(StoreCompany $request)
    {
        $data = $request->validated();
        $company = new Company($data);
        if (empty($data['slug'])) {
            $company->slug = Str::slug($data['title']);
        }
        $company->save();
        if ($request->hasFile('image')) {
            $company
                ->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('company.index')->with('message', 'Компания добавлена.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        return view('admin/company/edit', [
            'company' => $company,
            'image' => $company->getFirstMediaUrl('photo')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCompany $request
     * @param Company $company
     * @return Response
     */
    public function update(StoreCompany $request, Company $company)
    {
        $data = $request->validated();
        $company->fill($data);
        if (empty($data['slug'])) {
            $company->slug = Str::slug($data['title']);
        }
        $company->save();

        if ($request->hasFile('image')) {
            $company->clearMediaCollection('photo');
            $company
                ->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('photo');
        }

        return redirect()->route('company.index')->with('message', 'Компания изменена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return Response
     * @throws Exception
     */
    public function destroy(Company $company)
    {
        if ($company->categories()->count() === 0) {
            $company->delete();
            $msg = 'Компания удалена.';
        }

        return redirect()->route('company.index')
            ->with('message', $msg ?? 'Нельзя удалить компанию с существующими категориями, сначала удалите категории.');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompany;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $companies = Company::
        when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })
            ->paginate();
        return view('admin/company/index', ['companies' => $companies, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/company/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $company = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->title);
            $company = array_merge($company, ['slug' => $slug]);
        }
        $company = Company::create($company);
        if (!empty($request->file('image'))) {
            $company
                ->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('companies');
        }


        return redirect()->route('company.index')->with('message', 'компания успешно добавлена');
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
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $image = $company->getFirstMedia('companies');
        if (!empty($company->getFirstMedia('companies'))) {
            $image = $image->getUrl();
        }
        else {
            $image = Storage::url('0/no_photo.png');
        }
        return view('admin/company/edit', [
            'company' => $company,
            'image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCompany $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, Company $company)
    {
        $data = $request->validated();
        if (empty($request->slug)) {
            $slug = Str::slug($request->title);
            $data = array_merge($data, ['slug' => $slug]);
        }

        $company->update($data);
        if (!empty($request->file('image'))) {
            if (!empty($company->getFirstMedia('companies'))) {
                $company->getFirstMedia('companies')->delete();
            }
            $company
                ->addMediaFromRequest('image')
                ->preservingOriginal()
                ->toMediaCollection('companies');
        }


        return redirect()->route('company.index')->with('message', 'успешно изменено!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        if (count($company->categories) == 0) {
            $company->delete();
            return redirect()->route('company.index')->with('message', 'успешно удалено!!!');
        } else {
            return redirect()->route('company.index')
                ->with('message', 'Нельзя удалить компанию с существующими категориями, сначала удалите категории!!!');
        }
    }
}

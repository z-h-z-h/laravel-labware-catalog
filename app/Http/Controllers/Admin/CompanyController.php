<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompany;
use App\Models\Company;
use Illuminate\Http\Request;

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
            -> paginate();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $company = $request->validated();

        Company::create($company);

        return redirect()->route('company.index')->with('message', 'Дистрибьютор успешно добавлен');
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
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin/company/edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCompany $request
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request,Company $company)
    {
        $data = $request->validated();

        $company->update($data);

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
        $company->delete();

        return redirect()->route('company.index')->with('message', 'успешно удалено!!!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;

class PublicSetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');;
        $set = Set::
        when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', '%' . $search . '%');
        })
            ->
            paginate(15);
        return view('public/set/index', ['sets' => $set, 'search' => $search]);

    }



    public function show($id)
    {
        $set = Set::find($id);
            //->select( 'id', 'title', 'description', 'code');
           // ->get();
       // dd($set);

        return view('public/set/show', ['set' => $set]);
    }



}

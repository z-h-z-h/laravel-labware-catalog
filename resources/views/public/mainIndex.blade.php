@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row m-0 p-2">
                        <div class="col-6 d-flex align-items-end"><h5>Все компании</h5></div>

                        <form class="form-inline col-6 d-flex justify-content-end" action="{{route('main.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="Поиск"
                                   autofocus>
                            <button class="ml-1 btn btn-outline-primary" type="submit">Искать</button>
                        </form>

                    </div>

                    <div class="card-body">
                        <table class="table-hover">

                            <div class="table-info text-center">
                                @isset($search)
                                    {{ 'по запросу  '.$search.'  найдено  '.$companies->total().'  записей' }}
                                @endisset
                            </div>


                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название компании</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($companies as $company)

                                <tr>

                                    <td class="text-muted" style="width: 3%">
                                        {{$company->id}}
                                    </td>
                                    <td class="w-75">
                                        <a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a>
                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="pagination">{{ $companies->withQueryString()->links() }}</div>

        </div>
    </div>

@endsection


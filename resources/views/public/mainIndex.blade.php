@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Название сервиса</div>

                        <form class="form-inline col-5 justify-content-end" action="{{route('company.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК" autofocus>
                            <button class="ml-1 btn btn-primary" type="submit">ИСКАТЬ</button>
                        </form>

                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$companies->total().'  записей' }}
                            @endisset
                        </div>


                        <thead>
                        <tr>
                            <th>#</th>
                            <th>название компании</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)

                            <tr>

                                <td class="text-muted" style="width: 10%">
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

    <div class="container">
        <div class="row justify-content-center">

            <div class="pagination">{{ $companies->withQueryString()->links() }}</div>

        </div>
    </div>

@endsection


@extends('admin.layouts.app')

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
                        <a class="btn btn-primary col-2 justify-content-end" role="button"
                           href="{{route('company.create')}}">
                            ДОБАВИТЬ
                        </a>
                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$companies->total().'  записей' }}
                            @endisset
                        </div>

                        <div class="table-success text-center">
                            {{ session ('message') }}

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
                                    {{$company->title}}
                                </td>


                                <td>
                                    <a class="btn btn-outline-primary" role="button"
                                       href="{{route('company.edit',$company->id)}}">РЕДАКТИРОВАТЬ</a>
                                </td>
                                <td>
                                    <form class="" method="post" enctype="multipart/form-data"
                                          action="{{route('company.destroy', $company->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">УДАЛИТЬ</button>
                                    </form>
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

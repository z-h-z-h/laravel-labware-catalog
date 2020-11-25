@extends('admin.layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Удаленный суперсклад всего!!!</div>

                        <form class="form-inline col-5 justify-content-end" action="{{route('set.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК" autofocus>
                            <button class="ml-1 btn btn-primary" type="submit">ИСКАТЬ</button>
                        </form>
                        <a class="btn btn-primary col-2 justify-content-end" role="button" href="{{route('set.create')}}">
                            ДОБАВИТЬ
                        </a>
                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$sets->total().'  записей' }}
                            @endisset
                        </div>

                        <div class="table-success text-center">
                            {{ session ('message') }}

                        </div>
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>название</th>
                            <th>артикул</th>
                            <th>категория</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sets as $set)
                            <tr>
                                <td>
                                    <div class="col text-muted">{{$set->id}}</div>
                                </td>
                                <td>
                                    <div class="col">{{$set->title}}</div>
                                </td>

                                <td>
                                    <div class="col">{{$set->code}}</div>
                                </td>
                                <td>
                                    <div class="col">{{$set->category->title}}</div>
                                </td>


                                <td style="width: 10%">
                                    <a class="btn btn-outline-primary col mr-0 " role="button"
                                       href="{{route('set.edit',$set->id)}}">РЕДАКТИРОВАТЬ</a>
                                </td>

                                <td style="width: 10%">
                                <form class="col ml-0 pl-0" method="post" enctype="multipart/form-data"
                                      action="{{route('set.destroy', $set->id)}}">
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

                    <div class="pagination">{{ $sets->withQueryString()->links() }}</div>

        </div>
    </div>

@endsection

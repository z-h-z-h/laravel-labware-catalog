
@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col">Удаленный суперсклад всего!!!</div>

                        <form class="form-inline col justify-content-end" action="{{route('set.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК" autofocus>
                            <button class="btn btn-primary" type="submit">ИСКАТЬ</button>
                        </form>

                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$sets->total().'  записей' }}
                            @endisset
                        </div>

                        <thead>
                        <tr>
                            <th>название</th>
                            <th>описание</th>
                            <th>артикул</th>
                            <th>категория</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sets as $set)
                            <tr>

                                <td>
                                    <div class="col">
                                        <a href="{{route('public.set.show', $set->id)}}">{{$set->title}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="col">{{$set->description}}</div>
                                </td>
                                <td>
                                    <div class="col">{{$set->code}}</div>
                                </td>
                                <td>
                                    <div class="col">{{$set->category->title}}</div>
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

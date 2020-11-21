@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Категории всего!!!</div>

                        <form class="form-inline col-7 justify-content-end" action="{{route('category.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК" autofocus>
                            <button class="btn btn-primary" type="submit">ИСКАТЬ</button>
                        </form>

                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
{{--                                поиск выводит количество переданных в него паренткатегорий а надо всех--}}
                                {{ 'по запросу  '.$search.'  найдено  '.$categories->total().'  записей' }}
                            @endisset
                        </div>

                        <thead>


                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <tr>
                                <td>
                                    <div class="ml-3 text-left font-weight-bold">
                                        {{$category->title }}
                                    </div>
                                </td>
                            </tr>

                                @foreach($category->nestedCategories as $nestedCategory)

                                        <tr>
                                            <td>
                                                <div class="ml-3 text-left">
                                                   --{{$nestedCategory->title }}
                                                </div>
                                            </td>
                                        </tr>

                                @endforeach

                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="pagination">{{ $categories->withQueryString()->links() }}</div>

        </div>
    </div>

@endsection

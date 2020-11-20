@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Удаленный суперсклад всего!!!</div>

                        <form class="form-inline col-5 justify-content-end" action="{{route('category.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК">
                            <button class="btn btn-primary" type="submit">ИСКАТЬ</button>
                        </form>
                        <a class="btn btn-primary col-2 justify-content-end" role="button"
                           href="{{route('category.create')}}">
                            ДОБАВИТЬ
                        </a>
                    </div>

                    <table class="table-hover">

                        <div class="table-info text-center">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$categories->total().'  записей' }}
                            @endisset
                        </div>

                        <div class="table-success text-center">
                            {{ session ('message') }}

                        </div>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>название категории</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <tr>
                                <td>
                                    <div class="col mr-0 pl-2 pr-0">
                                       {{$category->id}}
                                    </div>
                                </td>


                                <td class="w-75">
                                    <div class="col text-left  font-weight-bold">
                                                                             {{$category->title }}
                                    </div>
                                </td>



                                <td>
                                    <a class="btn btn-outline-primary col" role="button"
                                       href="{{route('category.edit',$category->id)}}">РЕДАКТИРОВАТЬ</a>
                                </td>


                                <form class="col" method="post" enctype="multipart/form-data"
                                      action="{{route('category.destroy', $category->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <td>
                                        <button type="submit" class="btn btn-outline-danger">УДАЛИТЬ</button>
                                    </td>
                                </form>

                            </tr>

                                @foreach($category->nestedCategories as $nestedCategory)

                                        <tr>
                                            <td>
                                                <div class="col mr-0 pl-2 pr-0">
                                                    {{$nestedCategory->id}}
                                                </div>
                                            </td>


                                            <td class="w-75">
                                                <div class="col text-left">
                                                   --{{$nestedCategory->title }}
                                                </div>
                                            </td>


                                            <td>
                                                <a class="btn btn-outline-primary col" role="button"
                                                   href="{{route('category.edit',$nestedCategory->id)}}">РЕДАКТИРОВАТЬ</a>
                                            </td>


                                            <form class="col" method="post" enctype="multipart/form-data"
                                                  action="{{route('category.destroy', $nestedCategory->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <td>
                                                    <button type="submit" class="btn btn-outline-danger">УДАЛИТЬ
                                                    </button>
                                                </td>
                                            </form>

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

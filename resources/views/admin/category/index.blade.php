@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Удаленный суперсклад всего!!!</div>

                        <form class="form-inline col-5 justify-content-end" action="{{route('category.index')}}">
                            <input class="form-control" name="search" type="text" value="" placeholder="ПОИСК"
                                   autofocus>
                            <button class="ml-1 btn btn-primary" type="submit">ИСКАТЬ</button>
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
                            @if(isset ($search))
                                <th class="text-left">Родительская категория</th>
                            @endif
                            <th>Дистрибьютор</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)

                            <tr>
                                <td class="text-light ml-2 pl-2" style="">{{$category->id}}</td>
                                <td class="
                                @if(isset($search))
                                    w-25
                                    @else
                                    w-50
                                @endif
                                @if($category->parent_id == 0)
                                    font-weight-bold
                                    @endif
                                    ">{{$category->title }}</td>
                                @isset($search)
                                    <td class="w-25 text-muted"
                                        style="">
                                        @if($category->parent_id !== 0)
                                            {{$category->parentCategory->title}}
                                        @endif
                                    </td>
                                @endisset
                                <td class="w-25 text-muted">
                                    {{ $category->company->title }}
                                </td>
                                <td><a class="btn btn-outline-primary" role="button"
                                       href="{{route('category.edit',$category->id)}}">РЕДАКТИРОВАТЬ</a>
                                </td>
                                <td class="" style="">
                                    <form class="" method="post" enctype="multipart/form-data"
                                          action="{{route('category.destroy', $category->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">УДАЛИТЬ</button>
                                    </form>
                                </td>
                            </tr>

                            @if(empty($search))
                                @foreach($category->nestedCategories as $nestedCategory)

                                    <tr>
                                        <td>
                                            <div class="text-light col mr-0 pl-2 pr-0">
                                                {{$nestedCategory->id}}
                                            </div>
                                        </td>


                                        <td class="">
                                            <div class="w-50 text-left">
                                                --{{$nestedCategory->title }}
                                            </div>
                                        </td>

                                        <td class="w-25 text-muted">
                                            {{ $category->company->title }}
                                        </td>

                                        <td>
                                            <a class=" btn btn-outline-primary " role="button"
                                               href="{{route('category.edit',$nestedCategory->id)}}">РЕДАКТИРОВАТЬ</a>
                                        </td>


                                        <form class="" method="post" enctype="multipart/form-data"
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
                            @endif
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

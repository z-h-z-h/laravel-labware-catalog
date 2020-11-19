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

                    <table class="table-striped ">

                        <div class="message" style="background-color: #4cd213">
                            @isset($search)
                                {{ 'по запросу  '.$search.'  найдено  '.$categories->total().'  записей' }}
                            @endisset
                        </div>

                        <div class="message" style="background-color: #4cd213">
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


                                <td>

                                    @if($category->parent_id == null)
                                        <div class="col text-left  font-weight-bold">
                                            {{$category->title }}

                                            @else
                                                <div class="col text-left  ">
                                                    {{'---'. $category->title}}
                                                    @endif
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

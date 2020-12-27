@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header row m-0 p-2">
                <div class="col-5  d-flex align-items-end"><h5>Категории</h5></div>

                <a class="btn  btn-outline-primary d-flex ml-auto mr-3" role="button"
                   href="{{route('category.create')}}">
                    Добавить
                </a>
            </div>

            <div class="card-body">
                <form class="form-inline mb-3" action="{{route('category.index')}}">
                    <input class="form-control form-control-sm col" name="search" type="text" value="{{$search}}"
                           placeholder="Поиск" autofocus>
                    <button class="ml-1 mr-1 d-flex justify-content-end btn btn-sm btn-outline-secondary" type="submit">
                        Искать
                    </button>
                </form>
                <table class="table table-hover table-sm table-borderless">
                    @if(!empty($search))
                        <div class="alert alert-info mr-1 pb-0 pt-0 " role="alert">
                            {{'По запросу  ' . '"' . $search . '" ' . App\Helpers::quantity($categories->count(),['найдена ', 'найдено ', 'найдено ']).
                              $categories->count() . App\Helpers::quantity($categories->count(),[' запись', ' записи', ' записей'])}}
                        </div>
                    @endif
                    @if(!empty(session ('message')))
                        <div class="alert alert-success mr-1  pb-0 pt-0" role="alert">
                            {{ session ('message') }}

                        </div>
                    @endif
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название категории</th>
                        @if(!empty($search))
                            <th>Родительская категория</th>
                        @endif
                        <th>Компания</th>
                        <th>Дата создания</th>
                        <th>Дата обновления</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)

                        <tr>
                            <td class="text-muted" style="width: 3%">{{$category->id}}</td>
                            <td style="width:18%" class="

                                @if(empty($category->parent_id))
                                    font-weight-bold
                                @endif
                                ">{{$category->title }}</td>
                            @if(!empty($search))
                                <td class="text-muted"
                                    style="width: 22%">
                                    @if($category->parent_id)
                                        {{$category->parentCategory->title}}
                                    @endif
                                </td>
                            @endisset
                            <td style="width: 18%" class="text-muted">
                                {{ $category->company->title }}
                            </td>
                            <td style="width: 18%" class="text-muted">
                                {{ $category->created_at->format('Y-m-d') }}
                            </td>

                            <td style="width: 22%" class="text-muted">
                                {{ $category->updated_at->format('Y-m-d') }}
                            </td>
                            <td><a class="btn btn-outline-secondary btn-sm" role="button"
                                   href=" {{route('category.edit',$category->id)}}">Редактировать</a>
                            </td>
                            <td>
                                <form class="" method="post" enctype="multipart/form-data"
                                      action="{{route('category.destroy', $category->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Удалить</button>
                                </form>
                            </td>
                        </tr>

                        @empty($search)
                            @foreach($category->nestedCategories as $nestedCategory)

                                <tr>
                                    <td style="width: 3%" class="text-muted">
                                        {{$nestedCategory->id}}
                                    </td>


                                    <td style="width: 20%" class="  ">
                                        - {{$nestedCategory->title }}
                                    </td>

                                    <td style="width: 20%" class="text-muted">
                                        {{ $nestedCategory->company->title }}
                                    </td>
                                    <td style="width: 20%" class=" text-muted">
                                        {{ $nestedCategory->created_at->format('Y-m-d') }}
                                    </td>

                                    <td style="width: 22%" class=" text-muted">
                                        {{ $nestedCategory->updated_at->format('Y-m-d') }}
                                    </td>

                                    <td>
                                        <a class="btn btn-outline-secondary btn-sm" role="button"
                                           href="{{route('category.edit',$nestedCategory->id)}}">Редактировать</a>
                                    </td>

                                    <td>
                                        <form method="post" enctype="multipart/form-data"
                                              action="{{route('category.destroy', $nestedCategory->id)}}">
                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-outline-secondary btn-sm">Удалить
                                            </button>

                                        </form>
                                    </td>

                                </tr>

                            @endforeach
                        @endempty
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>


    <div class="container">
        <div class=mt-3>

            <div class="pagination">{{ $categories->withQueryString()->links() }}</div>

        </div>
    </div>

@endsection

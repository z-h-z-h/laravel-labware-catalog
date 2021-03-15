@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header row m-0 p-2">

                <div class="col-5 d-flex align-items-end">
                    <h5>Комплекты</h5>
                </div>

                <a class="btn btn-outline-primary d-flex ml-auto mr-3" role="button"
                   href="{{route('set.create')}}">
                    Добавить
                </a>
            </div>

            <div class="card-body">

                <form class="form-inline mb-3" action="{{route('set.index')}}">
                    <input class="form-control form-control-sm col" name="search" type="text" value="{{$search}}"
                           placeholder="Поиск" autofocus>
                    <button class="ml-1 mr-1 d-flex justify-content-end btn btn-sm btn-outline-secondary" type="submit">
                        Искать
                    </button>
                </form>

                <table class="table table-hover table-sm table-borderless">
                    @if(!empty($search))
                        <div class="alert alert-info mr-1 pb-0 pt-0" role="alert">
                            {{ 'По запросу ' . '"' . $search . '" ' . App\Helpers::quantity($sets->total(),['найдена ', 'найдено ', 'найдено ']).
                               $sets->total() . App\Helpers::quantity($sets->total(),[' запись', ' записи', ' записей'])}}
                        </div>
                    @endif
                        @if(!empty(session('message')))

                        <div class="alert alert-success mr-1 pb-0 pt-0" role="alert">
                            {{ session ('message') }}
                        </div>
                    @endif

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название</th>
                        <th>Код</th>
                        <th>Категория</th>
                        <th>Дата создания</th>
                        <th>Дата обновления</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sets as $set)
                        <tr>
                            <td style="width: 4%">
                                <div class="text-muted">{{$set->id}}</div>
                            </td>
                            <td style="width: 18%">
                                <div class="">{{$set->title}}</div>
                            </td>
                            <td style="width: 18%">
                                <div class="">{{$set->code}}</div>
                            </td>
                            <td style="width: 18%">
                                <div class="">{{$set->category->title}}</div>
                            </td>
                            <td style="width: 18%">
                                <div class="text-muted">{{$set->created_at->format('Y-m-d')}}</div>
                            </td>
                            <td style="width: 20%">
                                <div class="text-muted">{{$set->updated_at->format('Y-m-d')}}</div>
                            </td>
                            <td>
                                <a class="btn btn-outline-secondary btn-sm" role="button"
                                   href=" {{route('set.edit',$set->id)}}">Редактировать</a>
                            </td>
                            <td>
                                <form method="post" enctype="multipart/form-data"
                                      action="{{route('set.destroy', $set->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

            </div>
       </div>
    </div>

    <div class="container">
        <div class="mt-3">
            <div class="pagination">{{ $sets->withQueryString()->links() }}</div>
        </div>
    </div>

@endsection


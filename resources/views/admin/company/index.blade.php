@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header row m-0 p-2">

                <div class="col-5 d-flex align-items-end"><h5>Компании</h5></div>

                <a class="btn btn-outline-primary d-flex ml-auto mr-3" role="button"
                   href="{{route('company.create')}}">
                    Добавить
                </a>
            </div>

            <div class="card-body">

                <form class="form-inline mb-3" action="{{route('company.index')}}">
                    <input class="form-control form-control-sm col" name="search" type="text" value="{{"$search"}}"
                           placeholder="Поиск" autofocus>
                    <button class="ml-1 mr-1 d-flex justify-content-end btn btn-sm btn-outline-secondary" type="submit">
                        Искать
                    </button>
                </form>

                <table class="table table-hover table-sm table-borderless">
                    @if(!empty($search))
                        <div class="alert alert-info mr-1 pb-0 pt-0" role="alert">
                            {{ 'По запросу  ' . '"' . $search . '" ' . App\Helpers::quantity($companies->total(),['найдена ', 'найдено ', 'найдено ']).
                               $companies->total() . App\Helpers::quantity($companies->total(),[' запись', ' записи', ' записей']) }}
                        </div>
                    @endif
                    @if(!empty(session ('message')))
                        <div class="alert alert-success mr-1 pb-0 pt-0" role="alert">
                            {{ session ('message') }}
                        </div>
                    @endif

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Название компании</th>
                        <th>Дата создания</th>
                        <th>Дата обновления</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td class="text-muted" style="width: 3%">
                                {{$company->id}}
                            </td>
                            <td class="w-50">
                                {{$company->title}}
                            </td>
                            <td class="w-25">
                                {{$company->created_at->format('Y-m-d')}}
                            </td>
                            <td class="w-25">
                                {{$company->updated_at->format('Y-m-d')}}
                            </td>
                            <td>
                                <a class="btn btn-outline-secondary btn-sm set" role="button"
                                   href="{{route('company.edit',$company->id)}}">Редактировать</a>
                            </td>
                            <td>
                                <form method="post" enctype="multipart/form-data"
                                      action="{{route('company.destroy', $company->id)}}">
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
            <div class="pagination">{{ $companies->withQueryString()->links() }}</div>
        </div>
    </div>

@endsection

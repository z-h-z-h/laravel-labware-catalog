@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data"
          action="{{route('company.update',$company->id)}}">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Редактируемые данные</div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="form-row">
                                <div class="col-md-6">
                                    <img class="card-img-right "
                                         src="{{$image}}" alt="Значок [200 x 250]"
                                         style="width: 100%">
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="$category-title"
                                               class="col-form-label text-md-right">Название компании</label>

                                        <input type="text" class="form-control" name="title"
                                               value="{{$company->title}}"
                                               autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="category-description"
                                               class="col-form-label text-md-right">Описание компании</label>

                                        <textarea type="text" class="form-control" name="description">
                                            {{$company->description}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="category-slug"
                                               class="col-form-label text-md-right">Url(slug) компании</label>

                                        <input type="text" class="form-control" name="slug"
                                               value="{{$company->slug}}">
                                    </div>


                                    <div class="form-group custom-file mt-4 mb-4 ">
                                        <label class="custom-file-label" for="customFile">Изменить/добавить
                                            изображение</label>
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header">Нередактируемые данные</div>
                        <div class="card-body d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary justify-content-center">
                                ИЗМЕНИТЬ
                            </button>
                        </div>
                    </div>

                    <div class="card d-flex justify-content-center">
                        <div class="card-body d-flex justify-content-center">
                            ID:{{$company->id}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Создано</label>

                                <input type="text" class="form-control" name="created_at"
                                       value="{{$company->created_at}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Редактировано</label>

                                <input type="text" class="form-control" name="updated_at"
                                       value="{{$company->updated_at}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

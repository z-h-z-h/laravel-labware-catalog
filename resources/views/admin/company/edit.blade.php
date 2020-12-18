@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data"
          action="{{route('company.update',$company->id)}}">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pt-2 pb-2"><h5 class="mt-2 ">Редактирование компании
                                #{{$company->id}}</h5></div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger pb-1">
                                    <ul class="list-unstyled mb-1 mt-n1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <div class="form-row">
                                <div class="col-md-4 pr-3">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Фотография</label>
                                        <img class="card-img-right bg-light"
                                             src="{{$image}}" alt="Значок [200 x 250]"
                                             style="width: 100%">
                                    </div>
                                    <div class="form-group custom-file">
                                        <label class="custom-file-label" for="customFile">Изменить/добавить
                                            изображение</label>
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Название</label>

                                        <input type="text" class="form-control" name="title"
                                               @if(empty(old()))
                                                value="{{$company->title}}"
                                               @else
                                                value="{{old('title')}}"
                                               @endif
                                               autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug"
                                               class="col-form-label">URL</label>

                                        <input type="text" class="form-control" name="slug"
                                               @if(empty(old()))
                                                value="{{$company->slug}}"
                                               @else
                                                value="{{old('slug')}}"
                                            @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="description"
                                               class="col-form-label">Описание компании</label>

                                        <textarea type="text" class="form-control" rows="6" name="description">
                                            @if(empty(old()))
                                                {{$company->description}}
                                            @else
                                                {{old('description')}}
                                            @endif
                                        </textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-primary">
                                            Изменить
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
@endsection

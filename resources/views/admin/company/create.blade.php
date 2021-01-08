@extends('admin.layouts.app')
@section('content')

    <div class="container">
        <div class="card">

            <div class="card-header pt-2 pb-2"><h5 class="mt-2">Создание компании</h5></div>

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

                <form method="post" enctype="multipart/form-data" action="{{route('company.store')}}">
                    @csrf

                    <div class="form-row">

                        <div class="col-md-4 pr-3">
                            <div class="form-group">
                                <label for="image" class="col-form-label">Фотография</label>
                                <img class="card-img-right bg-light"
                                     src="{{'/img/no_photo.png'}}" alt=""
                                     style="width: 100%">
                            </div>

                            <div class="form-group custom-file">
                                <label class="custom-file-label" for="image">Добавить
                                    изображение компании</label>
                                <input type="file" name="image" class="custom-file-input" id="customFile">
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="title" class="col-form-label">
                                    Название
                                </label>
                                <input type="text" class="form-control" name="title" autofocus
                                       value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="slug" class="col-form-label">URL компании</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Описание компании</label>
                                <textarea type="text" class="form-control" rows="6" name="description">
                                        {{ old('description') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">
                                    Сохранить
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

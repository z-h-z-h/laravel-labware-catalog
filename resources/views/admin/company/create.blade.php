@extends('admin.layouts.app')
@section('content')


    <form method="post" enctype="multipart/form-data" action="{{route('company.store')}}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">Создание</div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">Название
                                    компании</label>
                                <div class="col-md-10">

                                    <input type="text" class="form-control" name="title" autofocus  value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">Описание
                                    компании</label>
                                <div class="col-md-10">
                                    <textarea type="text" class="form-control" name="description">
                                        {{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-2 col-form-label text-md-right">Url(slug)
                                    компании</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="slug"  value="{{ old('slug') }}">
                                </div>
                            </div>

                            <div class="form-inline d-flex justify-content-end">
                                <div class="">
                                    <button type="submit" class="mr-2 btn btn-primary justify-content-center">
                                        ДОБАВИТЬ
                                    </button>
                                </div>
                                <div class=" custom-file  col-md-10 ">
                                    <label class="custom-file-label ml-1" for="image">Добавить
                                        изображение компании</label>
                                    <input type="file" name="image" class="custom-file-input" id="customFile">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>
@endsection

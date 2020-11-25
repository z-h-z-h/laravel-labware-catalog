@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('category.store')}}">
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
                        <div class="card-header">Созидай давай</div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">Название
                                    категории</label>
                                <div class="col-md-10">

                                    <input type="text" class="form-control" name="title" autofocus
                                           value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">Описание
                                    категории</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="description"
                                           value="{{ old('description') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-2 col-form-label text-md-right">url(slug)
                                    категории</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="parent-id" class="col-md-2 col-form-label text-md-right">Родительская
                                    категория</label>
                                <div class="col-md-10">

                                    <select name="parent_id"
                                            class="form-control"
                                            placeholder="Выберите категорию"
                                            required>

                                        @foreach($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}">
                                                {{ $parentCategory->title }}
                                            </option>
                                        @endforeach
                                        <option value="{{ $parentCategory->id = 0}}">Родительская</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="company_id"
                                       class="col-md-2 col-form-label text-md-right">Дистрибьютор</label>
                                <div class="col-md-10">
                                    <select name="company_id"
                                            class="form-control"
                                            placeholder="Выберите дистрибьютора"
                                            required>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">
                                                {{ $company->title }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="custom-file mb-4 col-md-10 offset-md-2">
                                <label class="custom-file-label mt-3" for="image">Изменить/добавить
                                    изображение комплекта</label>
                                <input type="file" name="image" class="custom-file-input" id="customFile">

                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header">Созидание</div>
                        <div class="card-body d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary justify-content-center">
                                ДОБАВИТЬ
                            </button>
                        </div>
                    </div>

                    <div class="card d-flex justify-content-center">
                        <div class="card-body d-flex justify-content-center">
                            ID:
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Создано</label>

                                <input type="text" class="form-control" name="created_at"
                                       value="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Редактировано</label>

                                <input type="text" class="form-control" name="updated_at"
                                       value="" disabled>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </form>
@endsection

@extends('admin.layouts.app')
@section('content')

    <div class="container">

        <div class="card">

            <div class="card-header pt-2 pb-2">
                <h5 class="mt-2">
                    Редактирование категории #{{$category->id}}
                </h5>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger pb-1">
                        <ul class="list-unstyled mb-1 mt-n1">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" enctype="multipart/form-data"
                      action="{{route('category.update',$category->id)}}">
                    @method('put')
                    @csrf

                    <div class="form-row">
                        <div class="col-md-4 pr-3">

                            <div class="form-group">
                                <label for="image" class="col-form-label">Фотография</label>
                                <img class="card-img-right bg-light"
                                     src="{{$image}}" alt=""
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
                                <label for="category-title"
                                       class="col-form-label">Название</label>
                                <input type="text" class="form-control" name="title"
                                       value="{{empty(old('title')) ? $category->title : old('title')}}" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="category-slug"
                                       class="col-form-label">URL</label>
                                <input type="text" class="form-control" name="slug"
                                       value="{{empty(old('slug')) ? $category->slug : old('slug')}}">
                            </div>

                            <div class="form-group">
                                <label for="company_id"
                                       class="col-form-label">Компания</label>
                                <select name="company_id"
                                        id="company"
                                        class="form-control"
                                        required>
                                    <option value="{{$category->company_id}}" selected>
                                        {{$category->company->title}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="parent-id" class="col-form-label">Родительская
                                    категория</label>
                                <select name="parent_id"
                                        class="parentCategory form-control">
                                    <option value=""
                                            @empty($category->parent_id)
                                                selected
                                            @endempty
                                    >
                                        Родительская
                                    </option>
                                    @foreach($parentCategories as $parentCategory)
                                        @if($parentCategory->id !== $category->id)

                                            <option value="{{$parentCategory->id}}"
                                                    @if(($parentCategory->id == old('parent_id')) || (old('parent_id', false) === false && $parentCategory->id === $category->parent_id))
                                                        selected
                                                    @endif
                                            >
                                                {{$parentCategory->title}}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>

                            </div>
                            <div class="form-group">
                                <label for="category-description"
                                       class="col-form-label">Описание категории</label>
                                <textarea type="text" class="form-control" rows="6" name="description">
                           {{empty(old('description')) ? $category->description : old('description')}}
                                </textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary">
                                    Изменить
                                </button>
                            </div>

                        </div>
                    </div>
                </form>

                <form class="d-flex justify-content-end mt-3" method="post" enctype="multipart/form-data"
                      action="{{route('category.destroy', $category->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Удалить</button>
                </form>

            </div>
        </div>

    </div>


@endsection

@extends('admin.layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Редактировай давай</div>

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

                        <form method="post" enctype="multipart/form-data"
                              action="{{route('set.update',$set->id)}}">
                            @method('put')
                            @csrf


                            <div class="form-row">
                                <div class="col-md-6">
                                    <img class="card-img-right "
                                         src="{{--Storage::url($set -> image)--}}" alt="Значок [200 x 250]"
                                         style="width: 100%">
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label text-md-right">Название комплекта</label>

                                        <input type="text" class="form-control" name="title"
                                               value="{{$set->title}}"
                                               autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label text-md-right">Описание комплекта</label>


                                        <input type="text" class="form-control" name="description"
                                               value="{{$set->description}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label text-md-right">Артикул комплекта</label>


                                        <input type="text" class="form-control" name="code"
                                               value="{{$set->code}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id"
                                               class="col-form-label ">Категория комплекта</label>

                                        <select name="category_id"
                                                class="form-control"
                                                placeholder="Выберите категорию"
                                                required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if (
                                                            $category->id == $set->category_id)
                                                        selected
                                                    @endif
                                                >
                                                    {{ $category->title }}</option>

                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group custom-file mt-4 ">
                                        <label class="custom-file-label" for="customFile">Изменить/добавить
                                            изображение комплекта</label>
                                        <input type="file" name="image" class="custom-file-input" id="customFile">

                                    </div>


                                    <div class="button mt-2 offset-md-9">
                                        <button type="submit" class="btn btn-primary ">
                                            {{ __('ИЗМЕНИТЬ') }}
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

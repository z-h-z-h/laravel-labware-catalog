@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data"
          action="{{route('category.update',$category->id)}}">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
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

                            <div class="form-row">
                                <div class="col-md-6">
                                    <img class="card-img-right "
                                         src="{{--Storage::url($set -> image)--}}" alt="Значок [200 x 250]"
                                         style="width: 100%">
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="$category-title"
                                               class="col-form-label text-md-right">Название категории</label>

                                        <input type="text" class="form-control" name="title"
                                               value="{{$category->title}}"
                                               autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="category-description"
                                               class="col-form-label text-md-right">Описание категории</label>


                                        <input type="text" class="form-control" name="description"
                                               value="{{$category->description}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="category-slug"
                                               class="col-form-label text-md-right">url(slug)</label>


                                        <input type="text" class="form-control" name="slug"
                                               value="{{$category->slug}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="company_id"
                                               class="col-form-label">Дистрибьютор комплекта</label>

                                        <select name="company_id"
                                                id="company"
                                                class="form-control"
                                                required>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"

                                                        @if (
                                                            $company->id == $category->company_id)
                                                        selected
                                                    @endif
                                                >
                                                    {{ $company->title }}</option>

                                            @endforeach
                                        </select>

                                    </div>

                                    <script>
                                        const parentCategories = <?= json_encode($parentCategories); ?>;

                                        const selectElement = document.getElementById('company');

                                        selectElement.addEventListener('change', (event) => {
                                            const parentCategory = document.querySelector('.parentCategory')
                                            // parentCategory.innerHTML = `<optgroup label="паренткатегории"></optgroup>`;
                                            parentCategory.innerHTML = `<option value="0">Родительская</option>`
                                            for (let i = 0; i < parentCategories.length; i++) {
                                                if (parentCategories[i]['company_id'] == event.target.value) {
                                                    parentCategory.insertAdjacentHTML('beforeend', `<option value="${parentCategories[i]['id']}">
                                                                ${parentCategories[i]['title']}</option>`)
                                                }

                                            }
                                        })

                                    </script>


                                    <div class="form-group">
                                        <label for="parent-id" class=" col-form-label ">Родительская
                                            категория</label>
                                        @if ($category->parent_id == 0)
                                            <select name="parent_id"
                                                    class="parentCategory form-control"
                                                    required>


                                                <option value="{{0}}" selected>
                                                    Родительская
                                                </option>

                                                @foreach($parentCategories as $parentCategory)
                                                    @if($parentCategory->company_id == $category->company_id
                                                              &&$parentCategory->title !== $category->title)
                                                        <option value="{{ $parentCategory->id }}">
                                                            {{ $parentCategory->title }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="parent_id"
                                                    class="parentCategory form-control"
                                                    required>


                                                <option value="{{0}}">
                                                    Родительская
                                                </option>

                                                @foreach($parentCategories as $parentCategory)
                                                    @if($parentCategory->company_id == $category->company_id)
                                                        <option value="{{ $parentCategory->id }}"
                                                                @if($parentCategory->id == $category->parent_id)
                                                                selected
                                                            @endif
                                                        >
                                                            {{ $parentCategory->title }}
                                                        </option>
                                                    @endif
                                                @endforeach

                                            </select>
                                        @endif
                                    </div>


                                    <div class="form-group custom-file mt-4 mb-4 ">
                                        <label class="custom-file-label" for="customFile">Изменить/добавить
                                            изображение комплекта</label>
                                        <input type="file" name="image" class="custom-file-input" id="customFile">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header">Редактировай давай</div>
                        <div class="card-body d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary justify-content-center">
                                ИЗМЕНИТЬ
                            </button>
                        </div>
                    </div>

                    <div class="card d-flex justify-content-center">
                        <div class="card-body d-flex justify-content-center">
                            ID:{{$category->id}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Создано</label>

                                <input type="text" class="form-control" name="created_at"
                                       value="{{$category->created_at}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Редактировано</label>

                                <input type="text" class="form-control" name="updated_at"
                                       value="{{$category->updated_at}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection

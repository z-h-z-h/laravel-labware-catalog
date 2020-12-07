@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('set.store')}}">
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
                                    комплекта</label>
                                <div class="col-md-10">

                                    <input type="text" class="form-control" name="title" autofocus
                                           value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">Описание
                                    комплекта</label>
                                <div class="col-md-10">
                                    <textarea type="text" class="form-control" name="description">
                                        {{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-2 col-form-label text-md-right">Артикул
                                    комплекта</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug" class="col-md-2 col-form-label text-md-right">Url(slug)
                                    комплекта</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>
                            </div>

                            <div class="form-group row mb-4" id="company">
                                <label for="company_id"
                                       class="col-md-2 col-form-label text-md-right">Компания</label>
                                <div class="col-md-10">
                                    <select name="company_id"
                                            class="form-control"
                                            id="company"
                                            required>
                                        <option>
                                            Выберите компанию
                                        </option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}"
                                                    @if(old('company_id') == $company->id)
                                                    selected
                                                @endif
                                            >
                                                {{ $company->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <script>
                                const parentCategories = <?= json_encode($parentCategories); ?>;
                                const nestedCategories = <?= json_encode($nestedCategories); ?>;
                                const selectElement = document.getElementById('company');

                                selectElement.addEventListener('change',  (event) => {
                                    const category = document.querySelector('.category');
                                    category.innerHTML = `<optgroup label="все категории выбранного компании" class="text-light bg-secondary"></optgroup>`
                                    for (let i = 0; i < parentCategories.length; i++) {
                                        if (parentCategories[i]['company_id'] == event.target.value) {
                                            category.insertAdjacentHTML('beforeend', `<optgroup label="${parentCategories[i]['title']}"></optgroup>`);

                                            for (let k = 0; k < nestedCategories.length; k++) {
                                                if (nestedCategories[k]['parent_id'] == parentCategories[i]['id']) {
                                                    category.insertAdjacentHTML('beforeend', `<option value="${nestedCategories[k]['id']}">${nestedCategories[k]['title']}</option>`);

                                                }
                                            }
                                        }
                                    }
                                });
                            </script>

                            <div class="form-group row pb-3">
                                <label for="category_id" class="col-md-2 col-form-label text-md-right">Категория
                                    комплекта</label>
                                <div class="col-md-10 mt-3">
                                    <select name="category_id"
                                            class="category  form-control"
                                           required>

                                        @foreach($companies as $company)
                                            @if(old('company_id') == $company->id)
                                                @foreach($company->categories as $category)
                                                    @if($category->parent_id == null )
                                                        <optgroup label="{{$category->title}}"></optgroup>
                                                    @else
                                                    <option value="{{$category->id}}"
                                                        @if($category->id == old('category_id'))
                                                        selected
                                                        @endif
                                                    >

                                                        {{$category->title}}
                                                    </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
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
                                        изображение</label>
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

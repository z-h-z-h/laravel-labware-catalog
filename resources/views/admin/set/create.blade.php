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
                        <div class="card-header">Созидай давай</div>
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
                                    <input type="text" class="form-control" name="description"
                                           value="{{ old('description') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-2 col-form-label text-md-right">Артикул
                                    комплекта</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="code" value="{{ old('code') }}">
                                </div>
                            </div>

                            <div class="form-group row mb-4" id="company">
                                <label for="company_id"
                                       class="col-md-2 col-form-label text-md-right">Дистрибьютор</label>
                                <div class="col-md-10">
                                    <select name="company"
                                            class="form-control"
                                            id="company"
                                            required>
                                        <option>
                                            Выберите дистрибьютора
                                        </option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">
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

                                selectElement.addEventListener('change', (event) => {
                                    const category = document.querySelector('.category');

                                    for (let i = 0; i < parentCategories.length; i++) {
                                        if (parentCategories[i]['company_id'] == event.target.value) {
                                            category.innerHTML = `<optgroup label="${parentCategories[i]['title']}"></optgroup>`;

                                            for (let k = 0; k < nestedCategories.length; k++) {
                                                if (nestedCategories[k]['parent_id'] == parentCategories[i]['id']) {
                                                    category.insertAdjacentHTML('beforeend', `<option value="${nestedCategories[k]['id']}">${nestedCategories[k]['title']}</option>`);

                                                }
                                            }
                                        }
                                    }
                                });
                            </script>

                            <div class="form-group  row">
                                <label for="category_id" class="col-md-2 col-form-label text-md-right">Категория
                                    комплекта</label>
                                <div class="col-md-10 mt-3">
                                    <select name="category_id"
                                            class="category  form-control"
                                            placeholder="Выберите категорию"
                                            required>
                                    </select>
                                </div>
                            </div>

                            <div class="custom-file  mb-4 col-md-10 offset-md-2">
                                <label class="custom-file-label mt-3 mb-3" for="image">Изменить/добавить
                                    изображение комплекта</label>
                                <input type="file" name="image" class="custom-file-input" id="customFile">
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-3">

                    <div class="card">
                        <div class="card-header d-flex justify-content-center">СОЗИДАТЕЛЬСТВО</div>
                        <div class="card-body d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                СОЗДАТЬ
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            ID
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

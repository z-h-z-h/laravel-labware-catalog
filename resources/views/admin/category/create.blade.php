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

                            <div class="form-group row ">
                                <label for="company_id"
                                       class="col-md-2 col-form-label text-md-right">Дистрибьютор</label>
                                <div class="col-md-10  mb-4">
                                    <select name="company_id"
                                            id="company"
                                            class="form-control"
                                            required>
                                        <option>
                                            Выберите дистрибьютора
                                        </option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">
                                                {{ $company->title }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <script>
                                const parentCategories = <?= json_encode($parentCategories); ?>;

                                const selectElement = document.getElementById('company');

                                selectElement.addEventListener('change', (event) => {
                                    const category = document.querySelector('.category')

                                   // category.innerHTML = `<optgroup label="паренткатегории"></optgroup>`;
                                    //пока я не поставил сюда оптгрупп работало иначе: добавлялся каждый выбранный парент каждый шелчок + парент или несколько парентов, понимая почему, не понимаю как этого избежать(ну кроме как добавлением innerhtml перед циклом)
                                    category.innerHTML = `<option value="0">Родительская</option>`
                                    for (let i = 0; i < parentCategories.length; i++) {
                                        if (parentCategories[i]['company_id'] == event.target.value) {

                                            category.insertAdjacentHTML('beforeend', `<option value="${parentCategories[i]['id']}">
                                                                    ${parentCategories[i]['title']}</option>`)
                                        }
                                    }
                                })
                            </script>

                            <div class="form-group row ">
                                <label for="parent-id" class="col-md-2 col-form-label text-md-right">Родитель</label>
                                <div class="col-md-10">

                                    <select name="parent_id"
                                            class="category form-control"
                                            required>

                                            <option>Выберите категорию</option>
                                    </select>
                                </div>
                            </div>

                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="parent-id" class=" col-form-label ">Родительская--}}
                            {{--                                    категория</label>--}}
                            {{--                                @if ($category->parent_id == 0)--}}
                            {{--                                    <select name="parent_id"--}}
                            {{--                                            class="parentCategory form-control"--}}
                            {{--                                            required>--}}


                            {{--                                        <option value="{{0}}" selected>--}}
                            {{--                                            Родительская--}}
                            {{--                                        </option>--}}
                            {{--                                        <optgroup label="паренткатегории"></optgroup>--}}
                            {{--                                        @foreach($parentCategories as $parentCategory)--}}
                            {{--                                            @if($parentCategory->company_id == $category->company_id--}}
                            {{--                                                      &&$parentCategory->title !== $category->title)--}}
                            {{--                                                <option value="{{ $parentCategory->id }}">--}}
                            {{--                                                    {{ $parentCategory->title }}--}}
                            {{--                                                </option>--}}
                            {{--                                            @endif--}}
                            {{--                                        @endforeach--}}
                            {{--                                    </select>--}}
                            {{--                                @else--}}
                            {{--                                    <select name="parent_id"--}}
                            {{--                                            class="parentCategory form-control"--}}
                            {{--                                            required>--}}


                            {{--                                        <option value="{{0}}">--}}
                            {{--                                            Родительская--}}
                            {{--                                        </option>--}}
                            {{--                                        <optgroup label="паренткатегории"></optgroup>--}}
                            {{--                                        @foreach($parentCategories as $parentCategory)--}}
                            {{--                                            @if($parentCategory->company_id == $category->company_id)--}}
                            {{--                                                <option value="{{ $parentCategory->id }}"--}}
                            {{--                                                        @if($parentCategory->id == $category->parent_id)--}}
                            {{--                                                        selected--}}
                            {{--                                                    @endif--}}
                            {{--                                                >--}}
                            {{--                                                    {{ $parentCategory->title }}--}}
                            {{--                                                </option>--}}
                            {{--                                            @endif--}}
                            {{--                                        @endforeach--}}

                            {{--                                    </select>--}}
                            {{--                                @endif--}}
                            {{--                            </div>--}}

                            <div class="custom-file mt-2 mb-4 col-md-10 offset-md-2">
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

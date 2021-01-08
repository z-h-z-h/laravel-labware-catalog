@extends('admin.layouts.app')
@section('content')

    <div class="container">
        <div class="card">

            <div class="card-header pt-2 pb-2"><h5 class="mt-2">Создание категории</h5></div>

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

                <form method="post" enctype="multipart/form-data" action="{{route('category.store')}}">
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
                                    изображение категории</label>
                                <input type="file" name="image" class="custom-file-input" id="customFile"
                                       value="">
                            </div>

                        </div>

                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="title" class="col-form-label">Название</label>

                                <input type="text" class="form-control" name="title" autofocus
                                       value="{{ old('title') }}">

                            </div>

                            <div class="form-group">
                                <label for="code" class="col-form-label">URL</label>

                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">

                                <label for="company_id"
                                       class="col-form-label">Компания</label>

                                <select name="company_id"
                                        id="company"
                                        class="form-control"
                                        required>
                                    <option hidden>
                                        Выберите компанию
                                    </option>

                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}"
                                                @if(old('company_id') == $company->id)
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

                                    const category = document.querySelector('.category')
                                    category.innerHTML = `<option value="">Родительская</option>`

                                    for (let i = 0; i < parentCategories.length; i++) {
                                        if (parentCategories[i]['company_id'] == event.target.value) {

                                            category.insertAdjacentHTML('beforeend', `<option value="${parentCategories[i]['id']}">
                                                                    ${parentCategories[i]['title']}</option>`)
                                        }
                                    }
                                })
                            </script>

                            <div class="form-group">
                                <label for="parent-id" class="col-form-label">Родительcкая категория</label>
                                <select name="parent_id"
                                        class="category form-control">
                                    <option value="">Родительская</option>
                                    @if(old('company_id') && $company = $companies->find(old('company_id')))
                                        @foreach($company->categories as $category)
                                            @empty($category->parent_id)

                                                <option value="{{$category->id}}"
                                                        @if($category->id == old('parent_id'))
                                                        selected
                                                    @endif
                                                >
                                                    {{$category->title}}
                                                </option>
                                            @endempty
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Описание категории</label>
                                <textarea type="text" class="form-control" rows="6" name="description">
                                        {{ old('description') }}
                                </textarea>
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

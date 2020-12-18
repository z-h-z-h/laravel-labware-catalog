@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data" action="{{route('category.store')}}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger pb-1">
                <ul class="list-unstyled mb-1 mt-n1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pt-2 pb-2"><h5 class="mt-2 ">Создание категории</h5></div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4 pr-3">

                                    <div class="form-group">
                                        <label for="image" class="col-form-label">Фотография</label>
                                        <img class="card-img-right bg-light"
                                             src="{{Storage::url('0/no_photo.png')}}" alt=""
                                             style="width: 100%">
                                    </div>
                                    <div class="form-group custom-file">
                                        <label class="custom-file-label" for="image">Добавить
                                            изображение категории</label>
                                        <input type="file" name="image" class="custom-file-input" id="customFile"
                                               value="{{old('image')}}">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label">Название</label>

                                        <input type="text" class="form-control" name="title" autofocus
                                               value="{{ old('title') }}">

                                    </div>

                                    <div class="form-group">
                                        <label for="code" class="col-form-label ">URL</label>

                                        <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="company_id"
                                               class="col-form-label">Компания</label>
                                        <div class="">
                                            <select name="company_id"
                                                    id="company"
                                                    class="form-control"
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
                                            category.innerHTML = `<option value="">Родительская</option>`//здесь value пусто а не null, потому что null не integer - база ругается

                                            for (let i = 0; i < parentCategories.length; i++) {
                                                if (parentCategories[i]['company_id'] == event.target.value) {

                                                    category.insertAdjacentHTML('beforeend', `<option value="${parentCategories[i]['id']}">
                                                                    ${parentCategories[i]['title']}</option>`)
                                                }
                                            }
                                        })
                                    </script>

                                    <div class="form-group">
                                        <label for="parent-id" class=" col-form-label">Родительcкая категория</label>

                                        <select name="parent_id"
                                                class="category form-control"
                                        >
                                            {{--                                             <option>Выберите категорию</option>--}}

                                            <option value="">Родительская</option>
                                            @foreach($companies as $company)
                                                @if(old('company_id') == $company->id)
                                                    @foreach($company->categories as $category)
                                                        @if($category->parent_id == null )

                                                            <option value="{{$category->id}}"
                                                                    @if($category->id == old('parent_id'))
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
                                    <div class="form-group">
                                        <label for="description" class="col-form-label">Описание категории</label>

                                        <textarea type="text" class="form-control" rows="6" name="description">
                                        {{ old('description') }}</textarea>

                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="">
                                            <button type="submit" class="btn btn-outline-primary">
                                                Сохранить
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

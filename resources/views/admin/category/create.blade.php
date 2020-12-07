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
                                    <textarea type="text" class="form-control" name="description">
                                        {{ old('description') }}</textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-md-2 col-form-label text-md-right">Url(slug)
                                    категории</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}">
                                </div>
                            </div>

                            <div class="form-group row ">
                                <label for="company_id"
                                       class="col-md-2 col-form-label text-md-right">Компания</label>
                                <div class="col-md-10  mb-4">
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

                            <div class="form-group row pb-4">
                                <label for="parent-id" class="col-md-2 col-form-label text-md-right">Родитель</label>
                                <div class="col-md-10">

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
                                    <input type="file" name="image" class="custom-file-input" id="customFile" value="{{old('image')}}">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection

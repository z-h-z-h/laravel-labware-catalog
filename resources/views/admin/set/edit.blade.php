@extends('admin.layouts.app')
@section('content')
    <form method="post" enctype="multipart/form-data"
          action="{{route('set.update',$set->id)}}">
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
                                               class="col-form-label ">Дистрибьютор</label>

                                        <select name="company"
                                                class="form-control"
                                                id="company"
                                                required>

                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}"
                                                        @if($company->id == $set->category->company_id)
                                                        selected
                                                    @endif
                                                >
                                                    {{ $company->title }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <script>
                                        const parentCategories = <?= json_encode($parentCategories); ?>;
                                        const nestedCategories = <?= json_encode($nestedCategories); ?>;
                                        const selectElement = document.getElementById('company');

                                        selectElement.addEventListener('change', (event) => {
                                            const category = document.querySelector('.category')

                                            for (let i = 0; i < parentCategories.length; i++) {
                                                if (parentCategories[i]['company_id'] == event.target.value) {
                                                    category.innerHTML = `<optgroup label="${parentCategories[i]['title']}"></optgroup>`;

                                                    for (let k = 0; k < nestedCategories.length; k++) {
                                                        if (nestedCategories[k]['parent_id'] == parentCategories[i]['id']) {
                                                            category.insertAdjacentHTML('beforeend', `<option value="${nestedCategories[k]['id']}">
                                                                ${nestedCategories[k]['title']}</option>`)
                                                        }
                                                    }
                                                }
                                            }
                                        })


                                    </script>

                                    <div class="form-group">
                                        <label for="category_id"
                                               class="col-form-label ">Категория комплекта</label>

                                        <select name="category_id"
                                                class="category form-control"
                                                required>

                                            <option value="{{$set->category_id}}">
                                                {{$set->category->title}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group custom-file mt-4 mb-4 ">
                                        <label class="custom-file-label" for="customFile">Изменить/добавить
                                            изображение </label>
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

                    <div class="card">
                        <div class="card-body d-flex justify-content-center">
                            ID:{{$set->id}}
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Создано</label>

                                <input type="text" class="form-control" name="created_at"
                                       value="{{$set->created_at}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label text-md-right">Редактировано</label>

                                <input type="text" class="form-control" name="updated_at"
                                       value="{{$set->updated_at}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>

@endsection
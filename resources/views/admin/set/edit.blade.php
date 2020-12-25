@extends('admin.layouts.app')
@section('content')

    <div class="container">

        <div class="card">
            <div class="card-header pt-2 pb-2"><h5 class="mt-2 ">Редактирование комплекта #{{$set->id}}</h5>
            </div>
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

                <form method="post" enctype="multipart/form-data"
                      action="{{route('set.update',$set->id)}}">
                    @method('put')
                    @csrf
                    <div class="form-row">

                        <div class="col-md-4 pr-3">
                            <label for="image"
                                   class="col-form-label">Фотография</label>
                            <img class="card-img-left bg-light"
                                 src="{{$image}}"
                                 style="width: 100%">
                            <div class="form-group custom-file mt-3 ">
                                <label class="custom-file-label" for="customFile">Изменить/добавить
                                    изображение </label>
                                <input type="file" name="image" class="custom-file-input" id="customFile">
                            </div>
                        </div>


                        <div class="col-md-8">

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label">Название</label>

                                <input type="text" class="form-control" name="title"
                                       @if(empty(old()))
                                       value="{{$set->title}}"
                                       @else
                                       value="{{old('title')}}"
                                       @endif
                                       autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label">Код</label>
                                <input type="text" class="form-control" name="code"
                                       @if(empty(old()))
                                       value="{{$set->code}}"
                                       @else
                                       value="{{old('code')}}"
                                    @endif>
                            </div>
                            <div class="form-group">
                                <label for="slug"
                                       class="col-form-label ">URL</label>


                                <input type="text" class="form-control" name="slug"
                                       @if(empty(old()))
                                       value="{{$set->slug}}"
                                       @else
                                       value="{{old('slug')}}"
                                    @endif>
                            </div>

                            <div class="form-group">
                                <label for="company_id"
                                       class="col-form-label">Компания</label>

                                <select name="company_id"
                                        class="form-control"
                                        id="company"
                                        required>

                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}"
                                                @if(old('company_id') == $company->id)
                                                selected

                                                @elseif($company->id == $set->category->company_id)
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
                                    category.innerHTML = ""
                                    for (let i = 0; i < parentCategories.length; i++) {
                                        if (parentCategories[i]['company_id'] == event.target.value) {
                                            category.insertAdjacentHTML('beforeend', `<optgroup label="${parentCategories[i]['title']}"></optgroup>`);

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
                                       class="col-form-label">Категория комплекта</label>

                                <select name="category_id"
                                        class="category form-control"
                                        required>


                                    @foreach($parentCategories as $parentCategory)

                                        @if($parentCategory->company_id == old('company_id'))
                                            <optgroup label="{{$parentCategory->title}}"></optgroup>
                                            @foreach($parentCategory->nestedCategories as $nestedCategory)
                                                <option value="{{$nestedCategory->id}}"
                                                        @if(old('category_id') == $nestedCategory->id)
                                                        selected
                                                    @endif
                                                >
                                                    {{$nestedCategory->title}}
                                                </option>
                                            @endforeach

                                        @elseif(empty( old('company_id')) && $parentCategory->company_id == $set->category->company_id)
                                            <optgroup label="{{$parentCategory->title}}"></optgroup>

                                            @foreach($parentCategory->nestedCategories as $nestedCategory)

                                                <option value="{{$nestedCategory->id}}"

                                                        @if($nestedCategory->id == $set->category_id)
                                                        selected
                                                    @endif
                                                >
                                                    {{$nestedCategory->title}}
                                                </option>

                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password"
                                       class="col-form-label">Описание комплекта</label>

                                <textarea type="text" class="form-control" rows="6" name="description">
                                            @if(empty(old()))
                                        {{$set->description}}
                                    @else
                                        {{old('description')}}
                                    @endif
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
                <form class=" d-flex justify-content-end mt-3" method="post" enctype="multipart/form-data"
                      action="{{route('set.destroy', $set->id)}}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Удалить</button>
                </form>
            </div>
        </div>
    </div>




@endsection

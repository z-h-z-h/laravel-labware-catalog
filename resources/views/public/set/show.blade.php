@extends('public.layouts.publicApp')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Выбранный комплект</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <img class="card-img-right "
                                     src="{{--Storage::url($set -> image)--}}" alt="Значок [200 x 250]"
                                     style="width: 100%">
                            </div>

                            <div class="col-md-6">
                                <h5 class="card-title">{{$set->title}}</h5>
                                <p class="card-text">{{$set->description}}</p>
                                <p class="card-text">какую нибудь инструкцию сюда еще можно затолкать</p>
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="password"--}}
                                {{--                                           class="col-form-label">Название комплекта</label>--}}

                                {{--                                    <input type="text" readonly class="form-control" name="title"--}}
                                {{--                                           value="{{$set->title}}">--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="password"--}}
                                {{--                                           class="col-form-label">Описание комплекта</label>--}}


                                {{--                                    <input type="text" readonly class="form-control" name="description"--}}
                                {{--                                           value="{{$set->description}}">--}}
                                {{--                                </div>--}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">Дополнительная информация</div>
                </div>

                <div class="card">
                    <div class="card-body">
                        ID:{{$set->id}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="card-title text-muted">
                            Артикул
                        </div>

                        <div class="card-text">
                            {{$set->code}}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="card-title text-muted">
                            Категория
                        </div>

                        <div class="card-text">
                            {{$set->category->title}}
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-muted">
                            Создано
                        </div>
                        <div class="card-text">
                            {{$set->created_at}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-title text-muted">
                            Редактировано
                        </div>
                        <div class="card-text">
                            {{$set->updated_at}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection

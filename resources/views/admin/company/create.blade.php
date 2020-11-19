@extends('admin.layouts.app')
@section('content')


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
            <div class="col-md-12">


                <form method="post" enctype="multipart/form-data" action="{{route('company.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-right">Название дистрибьютора</label>
                        <div class="col-md-10">

                            <input type="text" class="form-control" name="title" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">Описание дистрибьютора</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="code" class="col-md-2 col-form-label text-md-right">url(slug) дистрибьютора</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="slug">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-10 offset-md-2 mt-5">
                            <button type="submit" class="btn btn-primary">
                                ДОБАВИТЬ
                            </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>

@endsection

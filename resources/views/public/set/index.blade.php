@extends('public.layouts.publicApp')

@section('content')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('public.category.index', [$company->slug, $category->slug])}}">{{$category->title}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('public.nestedCategory.index', [$company->slug, $category->slug, $nestedCategory->slug])}}">
                        {{$nestedCategory->title}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$set->title}}</li>
            </ol>
        </nav>

        <div class="set my-4">
            <h5 class="text-uppercase">{{$set->title}}</h5>
            <div class="row">
                <div class="col-12 col-md-6">
                    <img class=""
                         src="{{$set->getFirstMediaUrl('photo') ?? url('/img/no_photo.png')}}"
                         style="width: 100%" alt="{{$set->title}}">
                    {{$set->description}}
                </div>
                <div class="col-12 col-md-6">
                    <table class="table my-4">
                        <tr>
                            <td>Категория оборудования</td>
                            <td>{{$set->category->title}}</td>
                        </tr>
                        <tr>
                            <td>URL оборудования</td>
                            <td>{{$set->slug}}</td>
                        </tr>
                        <tr>
                            <td>Код оборудования</td>
                            <td>{{$set->code}}</td>
                        </tr>
                        <tr>
                            <td>Дата создания оборудования</td>
                            <td>{{$set->created_at}}</td>
                        </tr>
                        <tr>
                            <td>Дата обновления оборудования</td>
                            <td>{{$set->updated_at}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>

@endsection

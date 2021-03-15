@extends('public.layouts.publicApp')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$category->title}}</li>
            </ol>
        </nav>

        <div class="category">
            <h5 class="text-uppercase">{{$category->title}}</h5>
            <div class="row">
                <div class="col-12 col-sm-3 col-md-2 col-lg-1 mr-lg-3">
                    <img class=""
                         src="{{$category->getFirstMediaUrl('photo') ?? url('/img/no_photo.png')}}"
                         style="max-width: 100px" alt="{{$category->title}}">
                </div>
                <div class="col-12 col-md-6 ml-lg-3 ml-xl-2">
                    {{$category->description}}
                </div>
            </div>
        </div>

        <div class="nestedCategories my-4">
            <h5 class="text-uppercase">Учебное лабораторное оборудование {{$category->title}}</h5>
            <table class="">
                @foreach($category->nestedCategories as $nestedCategory)
                    <tr>
                        <td>
                            <div class="">
                                <a href="{{route('public.nestedCategory.index',[$company->slug, $category->slug, $nestedCategory->slug])}}">
                                    {{$nestedCategory->title}}</a>
                                <p style="font-size: small" class="text-muted my-0" >
                                    {{$nestedCategory->sets->count().' '.\App\Helpers::quantity($nestedCategory->sets->count(),['позиция','позиции','позиций'])}}
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

@endsection

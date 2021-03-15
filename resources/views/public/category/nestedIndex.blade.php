@extends('public.layouts.publicApp')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a></li>
                <li class="breadcrumb-item"><a href="{{route('public.category.index', [$company->slug, $category->slug])}}">{{$category->title}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$nestedCategory->title}}</li>
            </ol>
        </nav>

        <div class="mx-auto">
            <div class="nestedCategory my-4">
                <h5 class="text-uppercase">{{$nestedCategory->title}}</h5>
                <div class="row">
                    <div class="col-12 col-sm-3 col-md-2 col-lg-1 mr-lg-3">
                        <img class=""
                             src="{{$nestedCategory->getFirstMediaUrl('photo') ?? url('/img/no_photo.png')}}"
                             style="max-width: 100px" alt="{{$nestedCategory->title}}">
                    </div>
                    <div class="col-12 col-md-6 ml-lg-3 ml-xl-2">
                        {{$nestedCategory->description}}
                    </div>
                </div>
            </div>

            <div class="sets my-4">
                <h5 class="text-uppercase">Учебное лабораторное оборудование {{$nestedCategory->title}}</h5>

                @foreach($sets as $set)
                    <div class="row">
                        <img class="col-12 col-md-8 col-lg-5 col-xl-4"
                             src="{{$set->getFirstMediaUrl('photo') ?? url('/img/no_photo.png')}}"
                        >
                        <h5 class="col-12">
                            <a href="{{route('public.set.index', [$company->slug, $category->slug, $nestedCategory->slug, $set->slug])}}">
                                {{$set->title}}
                            </a>
                        </h5>
                    </div>

                @endforeach

            </div>
        </div>

    </div>

@endsection


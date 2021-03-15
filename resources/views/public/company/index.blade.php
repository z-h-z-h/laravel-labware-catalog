@extends('public.layouts.publicApp')

@section('content')
    <div class="container">

        <div class="company my-4">
            <h1 class="text-uppercase">{{$company->title}}</h1>
            <div class="row">
                <div class="col-12 col-sm-3 col-md-2 col-lg-1 mr-lg-3">
                    <img class="float-left" src="{{ $company->getFirstMediaUrl('photo') ?? url('/img/no_photo.png') }}"
                         style="max-width: 100px" alt="{{$company->title}}">
                </div>
                <div class="col-12 col-md-6 ml-lg-3 ml-xl-2">
                    {{$company->description}}
                </div>
            </div>
        </div>

        <div class="categories my-4">
            <h5 class="text-uppercase">Учебное лабораторное оборудование {{$company->title}}</h5>
            <ul class="list-unstyled">
                @foreach($parentCategories as $parentCategory)

                    <li>
                        <a href="{{route('public.category.index', [$company->slug, $parentCategory->slug])}}">
                            {{$parentCategory->title}}</a>
                        <p style="font-size: small" class="text-muted my-0">
                            {{$parentCategory->sets_count.' '.\App\Helpers::quantity($parentCategory->sets_count,['позиция','позиции','позиций'])
                            }}
                        </p>
                    </li>

                @endforeach
            </ul>
        </div>

    </div>

@endsection

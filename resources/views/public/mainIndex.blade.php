@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
            <div class="table-info text-center">
                @isset($search)
                    {{ 'по запросу  '.$search.'  найдено  '.$companies->total().'  записей' }}
                @endisset
            </div>
            <div class="companies">
                <h5 class="text-uppercase">Производители</h5>
                <div class="row">
                    <div class="col-12 col-md-3 my-2 my-md-0">
                        <ul class="list-group list-group-flush">
                            @foreach($companies->where('id', '<=', 4) as $company)

                                <li class="list-group-item">
                                    <a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a>
                                    <p style="font-size: small" class="text-muted my-0" >
                                        {{$company->sets->count().' '.\App\Helpers::quantity($company->sets->count(),['позиция','позиции','позиций'])}}
                                    </p>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 my-2 my-md-0">
                        <ul class="list-group list-group-flush">
                            @foreach($companies->where('id', '>', 4)->where('id', '<=', 8) as $company)

                                <li class="list-group-item">
                                    <a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a>
                                    <p style="font-size: small" class="text-muted my-0" >
                                        {{$company->sets->count().' '.\App\Helpers::quantity($company->sets->count(),['позиция','позиции','позиций'])}}
                                    </p>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 my-2 my-md-0">
                        <ul class="list-group list-group-flush">
                            @foreach($companies->where('id', '>', 8)->where('id', '<=', 12) as $company)

                                <li class="list-group-item">
                                    <a href="{{route('public.company.index', [$company->slug])}}">{{$company->title}}</a>
                                    <p style="font-size: small" class="text-muted my-0" >
                                        {{$company->sets->count().' '.\App\Helpers::quantity($company->sets->count(),['позиция','позиции','позиций'])}}
                                    </p>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

    </div>
@endsection


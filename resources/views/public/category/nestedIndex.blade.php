@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Категории всего!!!</div>
                    </div>

                    <table>

                        <thead>
                        <tr>
                            <th>название категории</th>
                            <th>описание категории</th>
                            <th>комплекты категории</th>
{{--                            <th>изображение комплекта</th>--}}
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td class="w-25 ml-4 pl-4 text-left font-weight-bold">
                                {{$nestedCategory->title }}
                            </td>

                            <td class="w-25 text-left">
                                {{$nestedCategory->description }}
                            </td>

                            <td class="w-50 table-hover">
                                <table class="w-100">
                                    @foreach($sets as $set)
                                        <tr>
                                            <td>
                                                <div class=" ml-3 mr-4 pr-4 text-left">
                                                    <a class=""
                                                       href="{{route('public.set.index', [$company->slug, $category->slug, $nestedCategory->slug, $set->slug])}}">
                                                        {{$set->title}}</a>
                                                </div>
                                            </td>

                                            @if(!empty($set->getFirstMedia('images')))
                                                <td class="ml-4 mr-0 pr-0  d-flex justify-content-end">
                                                    <img class="card-img-right "
                                                         src="{{$set->getFirstMedia('images')->getUrl('thumb')}}"
                                                         style="width: 100%">
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}

    {{--            <div class="pagination">{{ $categories->withQueryString()->links() }}</div>--}}

    {{--        </div>--}}
    {{--    </div>--}}

@endsection


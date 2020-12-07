@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Категории</div>
                    </div>

                    <table>

                        <thead>
                        <tr>
                            <th>название категории</th>
                            <th>описание категории</th>
                            <th>категории категории</th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td class="w-25 ml-4 pl-4 text-left font-weight-bold">
                                {{$category->title }}


                                    <img class="card-img-right " src="
                                         @if(!empty($category->getFirstMedia('categories')))
                                         {{$category->getFirstMedia('categories')->getUrl('thumb')}}
                                         @else
                                         {{ Storage::url('0/no_photo.png')}}
                                         @endif
                                             "
                                         style="width: 100%">


                            </td>

                            <td class="w-50 text-left">
                                {{$category->description }}
                            </td>

                            <td class="w-25 table-hover">
                                <table>
                                    @foreach($category->nestedCategories as $nestedCategory)
                                        <tr>
                                            <td>
                                                <div class="ml-3 text-left">
                                                    <a href="{{route('public.nestedCategory.index',[$company->slug, $category->slug, $nestedCategory->slug])}}">
                                                        {{$nestedCategory->title}}</a>
                                                </div>
                                            </td>
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

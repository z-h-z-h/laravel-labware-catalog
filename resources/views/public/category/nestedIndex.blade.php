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
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td class="w-25 ml-4 pl-4 text-left font-weight-bold">
                                {{$nestedCategory->title }}
                            </td>

                            <td class="w-50 text-left">
                                {{$nestedCategory->description }}
                            </td>

                            <td class="w-25 table-hover">
                                <table>
                                    @foreach($sets as $set)
                                        <tr>
                                            <td>
                                                <div class="ml-3 text-left">
                                                    <a href="{{route('public.set.index', [$company->slug, $parentCategory->slug, $nestedCategory->slug, $set->slug])}}">
                                                        {{$set->title}}</a>
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


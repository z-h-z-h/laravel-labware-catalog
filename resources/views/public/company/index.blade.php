@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Название сервиса</div>

                    </div>

                    <table>


                        <thead>
                        <tr>
                            <th>#</th>
                            <th>название компании</th>
                            <th>описание компании</th>
                            <th>категории компании</th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr>
                            <td>
                                {{$company->id}}
                            </td>
                            <td class="w-50">
                                {{$company->title}}
                                <img class="card-img-right "
                                     src="
                                @if(!empty($company->getFirstMedia('companies')))
                                     {{$company->getFirstMedia('companies')->getUrl()}}
                                     @else
                                     {{ Storage::url('0/no_photo.png')}}
                                     @endif
                                         "
                                     style="width: 100%" alt="Card image cap">
                            </td>
                            <td class="w-25">
                                {{$company->description}}
                            </td>
                            <td>
                                <table class="table-hover">
                                    @foreach($company->categories->where('parent_id', null) as $parentCategory)
                                        <tr>
                                            <td>
                                                <a href="{{route('public.category.index', [$company->slug, $parentCategory->slug])}}">
                                                    {{$parentCategory->title}}</a>
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


@endsection

@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header row mr-0 ml-0">
                        <div class="col-5">Удаленный суперсклад всего!!!</div>

                    </div>

                    <table class="table-hover">

                        <thead>
                        <tr>
                            <th>название комплекта</th>
                            <th>описание комплекта</th>
                            <th>артикул</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>
                                {{$set->title}}
                            </td>
                            <td class="w-75">
                                {{$set->description}}
                            </td>
                            <td class="">
                                {{$set->code}}
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

    {{--            <div class="pagination">{{ $companies->withQueryString()->links() }}</div>--}}

    {{--        </div>--}}
    {{--    </div>--}}

@endsection

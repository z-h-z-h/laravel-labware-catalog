@extends('public.layouts.publicApp')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="card">
                    <div class="card-header">
                        Коплект
                    </div>
                    <div class="card-body p-0 d-flex justify-content-center">


                        <img class="card-img-right "
                             src="
                                @if(!empty($set->getFirstMedia('sets')))
                             {{$set->getFirstMedia('sets')->getUrl()}}
                             @else
                             {{ Storage::url('0/no_photo.png')}}
                             @endif
                                 "
                             style="width: 100%" alt="Card image cap">


                    </div>

                </div>
            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        Коплект
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary justify-content-center">
                            ЗАКАЗАТЬ
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        АРТИКУЛ:{{$set->code}}
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <h5 class="card-title">{{$set->title}}</h5>
                        </div>
                        <div class="form-group">
                            {{$set->description}}
                        </div>
                    </div>
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

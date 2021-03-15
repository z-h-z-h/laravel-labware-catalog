<!doctype html>
<html lang="en" class="h-100">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Учебное лабораторное оборудование</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="flex-row flex-lg-column navbar navbar-expand-lg navbar-light bg-light" id="nav">
        <div class="col-lg-12 d-flex justify-content-between px-0 px-sm-3">
            <button class="navbar-toggler align-self-start mr-3" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="text-decoration-none text-center" href="{{ route('main.index') }}">
                <h4 class="font-weight-bold"
                    style="color: #1b1e21">Учебное лабораторное оборудование</h4>
            </a>
            <button class="btn btn-sm btn-outline-primary align-self-start ml-2" id="button"
                    type="submit">Найти
            </button>

        </div>

        <div class="collapse navbar-collapse order-lg-2" id="navbarCollapse">
            <ul class="navbar-nav mt-2 d-flex flex-column flex-lg-row flex-lg-wrap ">

                @foreach($publicCompanies as $publicCompany)
                    <li class="nav-item
                    @if(Str::startsWith(URL::current(), 'http://laravel-labware-catalog.test/'.$publicCompany->slug))
                        active font-weight-bold
                    @endif
                        ">
                        <a class="text-uppercase mx-2"
                           href="{{ route('public.company.index', [$publicCompany->slug]) }}">{{$publicCompany->title}}</a>
                    </li>

                @endforeach

            </ul>
        </div>

    </nav>
    <div class="col-12 col-md-10 col-lg-8 offset-md-1 offset-lg-2">
        <input class="form-control form-control-plaintext mt-2 px-3" style="display: none" type="text"
               name="search" id="search" placeholder="Поиск" aria-label="Поиск">
        <ul id="searchOutput" style="position:absolute; top: 42px; left: 0px; z-index: 1"
            class="col-12 rounded"></ul>
    </div>

</header>

<main role="main" id="main" class="flex-shrink-0">
    <div class="container pt-3 pt-md-4 pt-lg-5">
        @yield('content')
        @if (session('set_ids'))
            <x-history :set-ids="session('set_ids')"/>
        @endif
    </div>
    </div>
</main>

<footer class="footer mt-auto py-2">
    <div class="container">
        <ul class="row list-unstyled mb-0">
            <li>
                <a class="nav-link" href="{{ route('company.index') }}">Производители</a>
            </li>
            <li class="nav-item
             @if(Str::startsWith(Route::currentRouteName(),'category.'))
                active
               @endif
                ">
                <a class="nav-link" href="{{ route('category.index') }}">Категории</a>
            </li>
            <li class="nav-item
             @if(Str::startsWith(Route::currentRouteName(),'set.'))
                active
             @endif
                ">
                <a class="nav-link" href="{{ route('set.index') }}">Стенды</a>
            </li>
        </ul>
    </div>
</footer>
</body>
<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script>

    const searchButton = document.querySelector('#button')
    const search = document.querySelector('#search')
    const nav = document.querySelector('#nav')
    const mainSelect = document.querySelector('#main')
    const result = document.querySelector('#searchOutput');

    <!-- Ajax query send function-->

    function sendData(input) {
        return $.ajax({
            type: 'POST',
            url: '{{route('search.index')}}',
            dataType: 'json',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                input
            }
        }).then(showResults)

    }

    <!-- Response processing and show function-->

    function showResults(response) {
        let htmlResult = '';
        Object.keys(response.data).forEach(el => {
            htmlResult += `<li class="list-group-item">
                                <p style="font-size: small" class="text-muted mb-1 mt-0">
                                   ${response['data'][el]['company_title']} /
                                   ${response['data'][el]['parent_category_title']} /
                                   ${response['data'][el]['nested_category_title']}
                                </p>
                                <a style="font-size: large" href="${response['data'][el]['url']}">${response['data'][el]['title']}</a>
                           </li>`;
        })
        result.innerHTML = htmlResult;
        result.style.display = ''
    }

    searchButton.addEventListener('click', () => {
        nav.style.display = 'none'
        search.style.display = ''
        search.focus()
    })

    let timeout;
    search.addEventListener('keyup', () => {
        if (timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(sendData, 1500, search.value)

    })

    mainSelect.addEventListener('click', () => {
        nav.style.display = ''
        search.style.display = 'none'
        search.value = ''
        result.style.display = 'none'
    })

</script>

</html>


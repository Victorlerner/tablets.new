<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('/plugins/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- ===== Plugin CSS ===== -->
    <link rel="stylesheet" href="{{ asset('/plugins/dropify/dist/css/dropify.min.css') }}">

    <!-- Styles -->

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">

        <div class="container">
            <div class="navbar-header">
                <button type="button"
                        class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">{{ __('Toggle navigation') }}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> {{ config('app.name', 'Laravel') }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse ">
                <ul class="nav navbar-nav">
                    @guest
                    @else
                    <li class="active"><a href="{{route('admin.add.index')}}">{{ __('Add tablet') }}</a></li>
                    @endguest

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret">

                                            </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>


    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- jQuery file upload -->

<script src="{{ asset('plugins/dropify/dist/js/dropify.min.js') }}"></script>
<script>

    jQuery(document).ready(function ($) {

        // Basic
        $('.dropify').dropify();



        $('#add-tablet').submit(function (e) {
            e.preventDefault();




            var formData = new FormData($('#add-tablet')[0]);
            formData.append('image', $('input[type=file]')[0].files[0]);

            $.ajax({
                url: '{{route('admin.add.store')}}',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    console.log(data);
                    if (data.error) {
                        for (var k in data.error) {

                            $('#add-tablet .respond').append(' <div class="alert alert-danger" role="alert">\n' +
                                '                                   \n' + data.error[k] +
                                '                                </div>');
                        }
                        setTimeout(function () {
                            $('#add-tablet .respond').html('');
                        },2500);

                    } else if(data.status) {
                        $('#add-tablet .respond').append(' <div class="alert alert-success" role="alert">\n' +
                            '                                   \n' + data.status +
                            '                                </div>');
                        setTimeout(function () {
                            $('#add-tablet .respond').html('');
                        },5000);
                        if(data.img.length > 2){
                            $('.dropify-render img').attr('src',data.img);
                        }
                    }



                }
            });
        })

    });

</script>

</body>
</html>

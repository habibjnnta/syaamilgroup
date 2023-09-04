<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/assets/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('assets/admin/assets/img/favicon.png') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ $page_title ?? config('app.name', 'Laravel') }}</title>

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('assets/template-user/css/styles.css') }}" rel="stylesheet" />

        <!-- New -->
        <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

        <!-- Custom Style -->
        @yield('page-style')

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ url('ppdb') }}">PPDB</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-primary px-lg-3 py-3 py-lg-4" href="{{ url('login') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Content -->
        @yield('content')
        
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; <b>{{ config('app.name', 'Laravel') }}</b> {{ date('Y') }}</div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="{{ asset('assets/landingpage/scripts/jquery.min.js?ver=1.1.0') }}"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    
        {{-- Sweet Alert --}}
        <script type="text/javascript" src="{{ asset('assets/vendor/SweetAlert2/sweetalert2.all.min.js') }}"></script>
        
        <script>
            @if (Session::has('successMsg'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ Session::get('successMsg') }}"
                })
            @endif
            @if (Session::has('infoMsg'))
                Swal.fire({
                    icon: 'info',
                    title: 'Information',
                    text: "{{ Session::get('infoMsg') }}"
                })
            @endif
            @if (Session::has('warningMsg'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: "{{ Session::get('warningMsg') }}"
                })
            @endif
            @if (Session::has('errorMsg'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('errorMsg') }}"
                })
            @endif
            @if (Session::has('errors'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('errors')->first() }}"
                })
            @endif
        </script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('assets/template-user/js/scripts.js') }}"></script>

        <!-- Custom JS -->
        @yield('page-script')

    </body>
</html>
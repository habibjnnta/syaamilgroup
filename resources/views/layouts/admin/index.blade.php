<!--
=========================================================
* Material Dashboard 2 - v3.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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

    <!-- New -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('page-style')

</head>

<body class="">
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        {{-- Navbar --}}
        @include('layouts.admin.navbar')

        <div class="pcoded-main-container">
            @yield('content')
        </div>
    </main>
    <!--   Core JS Files   -->
    {{-- <script src="{{ asset('assets/admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/core/bootstrap.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>

    <!--   Dashboard JS Files   -->
    <script src="{{ asset('assets/admin/assets/js/plugins/chartjs.min.js') }}"></script>


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script type="text/javascript" src="{{ asset('assets/landingpage/scripts/jquery.min.js?ver=1.1.0') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
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
    @yield('page-script')

    <!-- new -->
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ripple.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>


    <!-- custom-chart js -->
    <script src="{{ asset('assets/js/pages/dashboard-main.js') }}"></script>
</body>

</html>

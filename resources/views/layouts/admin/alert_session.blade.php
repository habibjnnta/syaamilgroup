@if (Session::has('successMsg'))
    <div class="alert alert-success alert-dismissible text-white">
        {{ Session::get('successMsg') }}
    </div>
@endif
@if (Session::has('warningMsg'))
    <div class="alert alert-warning alert-dismissible text-white">
        {{ Session::get('warningMsg') }}
    </div>
@endif
@if (Session::has('errorMsg'))
    <div class="alert alert-danger alert-dismissible text-white">
        {{ Session::get('errorMsg') }}
    </div>
@endif
@if (Session::has('errors'))
    <div class="alert alert-danger alert-dismissible text-white">
        {{ Session::get('errors') }}
    </div>
@endif

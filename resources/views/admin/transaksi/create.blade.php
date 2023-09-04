@extends('layouts.admin.index')

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Data Transaksi</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Data Transaksi</a></li>
                        <li class="breadcrumb-item"><a href="#!">Tambah Transaksi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <form role="form" class="text-start" method="POST" action="{{ route('transaksi.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- [ form-element ] start -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h5>Transaksi</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="perusahaan_id">Perusahaan</label>
                                            <select class="form-control" name="perusahaan_id" aria-describedby="basic-addon2">
                                            @foreach($perusahaan as $row) :
                                                <option value="{{ $row->id }}"> {{ $row->nama }} </option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="box">
                                            <div id="fieldAddON">
                                                <div class="form-group">
                                                    <label for="barang_id">Nama Barang</label>
                                                    <select class="form-control" name="barang_id[]" aria-describedby="basic-addon2">
                                                    @foreach($barang as $row) :
                                                        <option value="{{ $row->id }}"> {{ $row->nama }} - {{ 'Rp. '.number_format($row->harga, 0, ',' , '.') }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" class="form-control" value="{{ old('jumlah') }}" id="jumlah"
                                                        name="jumlah[]" placeholder="Jumlah">
                                                </div>
                                                <div class="form-group btnActionPlus">
                                                    <a href="#" id="btnPlus" class="btnPlus"><i class="fa fa-plus-circle"></i>Tambah Barang</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-footer text-center">
                                <a href="{{ route('transaksi.index') }}" class="btn  btn-danger">Batal</a>
                                <a href="{{ route('transaksi.create') }}" class="btn  btn-danger">Reset</a>
                                <button type="submit" class="btn  btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <!-- [ form-element ] end -->
                </div>
            </form>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
@endsection

@section('page-style')
@endsection

@section('page-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>                                                        
    <script>
        $('document').ready(function()
	    {
            $('#btnPlus').click(function (e) {

                e.preventDefault();
            
                var dataClone = $('#fieldAddON').val(null).clone(true);
            
                dataClone.value = '';
            
                var removeEl = dataClone.appendTo('.box');
                
                removeEl.find('.btnActionPlus').remove();
            
                return false;
            
            });
        });
    </script>
@endsection
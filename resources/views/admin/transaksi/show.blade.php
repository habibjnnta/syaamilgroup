@extends('layouts.admin.index')

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Detail Transaksi #{{ $transaksi->no_invoice }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Data Transaksi</a></li>
                        <li class="breadcrumb-item"><a href="#!">Detail Transaksi #{{ $transaksi->no_invoice }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Transaksi</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><h4>Nama Perusahaan : {{ $transaksi->perusahaan->nama }}</h4></p>
                                    <p><h4>Total : {{ 'Rp. '.number_format($transaksi->total, 0, ',' , '.') }}</h4></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example" class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                        No
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Nama Barang
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Jumlah
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Harga
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                ?>
                                                @if (count($detail) == 0)
                                                <tr>
                                                    <td class="align-middle text-center" colspan="4">
                                                        <span class="text-secondary text-xs font-weight-bold">
                                                            Tidak ada data
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endif
                                                @foreach ($detail as $key => $details)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ $key + $i }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ $details->barang->nama }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                                {{ $details->jumlah }}
                                                            </span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-xs font-weight-bold">
                                                            {{ 'Rp. '.number_format($details->harga, 0, ',' , '.') }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{ $detail->links() }}
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-footer text-center">
                                <a href="{{ route('transaksi.index') }}" class="btn  btn-danger">Back</a>
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
@endsection
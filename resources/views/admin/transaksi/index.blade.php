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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Transaksi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                            <a href="{{ route('transaksi.create') }}" class="btn btn-success float-right">
                                <i class="feather icon-plus"></i>
                                Tambah Transaksi
                            </a>
                    </div>
                    <div class="card-body table-border-style">
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
                                            No Invoice
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama Perusahaan
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>
                                        <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @if (count($transaksis) == 0)
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                Tidak ada data
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach ($transaksis as $key => $transaksi)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $key + $i }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $transaksi->no_invoice }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $transaksi->perusahaan->nama }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                {{ 'Rp. '.number_format($transaksi->total, 0, ',' , '.') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ $transaksi->getLinkDetailAttribute() }}" class="btn  btn-icon btn-info"><i class="feather icon-eye"></i></a>
                                                <a href="{{ $transaksi->getExport() }}" title="export" class="btn  btn-icon btn-info"><i class="feather icon-file-text"></i></a>
                                                <button type="button" class="btn  btn-icon btn-danger" onclick="deleteForm({{$transaksi}})"><i class="feather icon-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

@endsection

@section('page-style')
@endsection

@section('page-script')
    <script>
        function deleteForm(data) {
            console.log(data);
            Swal.fire({
                title: 'Hapus transaksi ' + data.no_invoice + ' ?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('transaksi') }}" + "/" + data.id, {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                    })
                    .done(function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data berhasil dihapus.'
                        }).then(function() {
                            location.reload();
                        });
                    })
                    .fail(function(data) {
                        console.log(data)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Gagal menghapus data"
                        });
                    })
                }
            })
        }
    </script>
@endsection
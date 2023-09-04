@extends('layouts.admin.index')

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Daftar Barang</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Daftar Barang</a></li>
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
                            <button type="button" class="btn btn-success float-right" data-bs-toggle="modal" data-bs-target="#simpanModal">
                                <i class="feather icon-plus"></i>
                                Tambah Barang
                            </button>
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
                                            Nama barang
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stok
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Harga
                                        </th>
                                        <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = $barangs->firstItem();
                                    ?>
                                    @if ($barangs->total() == 0)
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                Tidak ada data
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach ($barangs as $key => $barang)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $key + $i }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $barang->nama }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $barang->stok }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ 'Rp. '.number_format($barang->harga, 0, ',' , '.') }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn  btn-icon btn-info" onclick="editForm({{$barang}})"><i class="feather icon-edit"></i></button>
                                                <button type="button" class="btn  btn-icon btn-danger" onclick="deleteForm({{$barang}})"><i class="feather icon-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $barangs->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="simpanModal" tabindex="-1" role="dialog" aria-labelledby="simpanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form role="form" class="text-start" method="POST" action="{{ route('barang.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="simpanModalLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="floating-label" for="nama">Nama Barang </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="stok">Stok </label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}">
                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="harga">Harga </label>
                            <input type="num" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="editForm" role="form" class="text-start" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="floating-label" for="namaedit">Nama Barang </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="namaedit" name="nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="stokedit">Stok </label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stokedit" name="stok" value="{{ old('stok') }}">
                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="floating-label" for="hargaedit">Harga </label>
                            <input type="num" class="form-control @error('harga') is-invalid @enderror" id="hargaedit" name="harga" value="{{ old('harga') }}">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-save" class="btn btn-primary" value="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function editForm(data) {
            console.log(data);
            $('#namaedit').attr('value',data.nama);
            $('#stokedit').attr('value',data.stok);
            $('#hargaedit').attr('value',data.harga);
            $('#editForm').attr('action',"{{url('barang')}}/"+data.id);
            $('#editModal').modal('show');
        }
        function deleteForm(data) {
            Swal.fire({
                title: 'Hapus data ' + data.nama + ' ?',
                text: "Data tidak bisa dikembalikan setelah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ url('barang') }}" + "/" + data.id, {
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.msg
                        });
                    })
                }
            })
        }
    </script>
@endsection
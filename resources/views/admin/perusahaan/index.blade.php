@extends('layouts.admin.index')

@section('content')
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Perusahaan</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Perusahaan</a></li>
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
                                Tambah Perusahaan
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
                                            Nama Perusahaan
                                        </th>
                                        <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @if (count($perusahaans) == 0)
                                    <tr>
                                        <td class="align-middle text-center" colspan="3">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                Tidak ada data
                                            </span>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach ($perusahaans as $key => $perusahaan)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $key + $i }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    {{ $perusahaan->nama }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <button type="button" class="btn  btn-icon btn-info" onclick="editForm({{$perusahaan}})"><i class="feather icon-edit"></i></button>
                                                <button type="button" class="btn  btn-icon btn-danger" onclick="deleteForm({{$perusahaan}})"><i class="feather icon-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $perusahaans->links() }}
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
                <form role="form" class="text-start" method="POST" action="{{ route('perusahaan.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="simpanModalLabel">Tambah Perusahaan</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                            @error('nama')
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
                        <h5 class="modal-title" id="editModalLabel">Edit Perusahaan</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_edit">Nama </label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama_edit" name="nama">
                            @error('nama')
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
    <script>
        function editForm(data) {
            console.log(data);
            $('#nama_edit').attr('value',data.nama);
            $('#editForm').attr('action',"{{url('perusahaan')}}/"+data.id);
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
                    $.post("{{ url('perusahaan') }}" + "/" + data.id, {
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
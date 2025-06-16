@extends('layouts.backoffice.main')

@section('container-backoffice')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Daftar Barang
                        <a href="/backoffice/add-item" class="btn btn-primary">Tambah</a>
                    </h5>

                    <table id="tabel-data" class="table datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Tahun Pengadaan</th>
                                <th>Kode Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$item)
                                <tr>
                                    <td class="text-center" width="5%">{{ ++$key }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->repository->code ?? "-" }}</td>
                                    <td width="20%">
                                        {{-- <a href="/backoffice/item/generate-qr/{{ $item->id }}" class="btn btn-sm btn-info">Generate QR</a> --}}
                                        <button type="button" class="btn btn-sm btn-info datatable-viewQR-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-qr="{{ $item }}">
                                            Generate QR
                                        </button>
                                        <a href="/backoffice/edit-item/{{ $item->id }}" class="btn btn-sm btn-secondary">Edit</a>
                                        <form id="delete-item-{{$item->id}}" action="/backoffice/item/{{ $item->id }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteConfirm('delete-item-{{$item->id}}')" >Hapus</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Generate QR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 text-center">
                        <div class="col-md-12" id="bodyPreviewQR">
                            <div id="previewQR" class="mb-3 mt-4"></div>
                            <p class="font-weight-bold">
                                <span id="previewQRCode">-</span> /
                                <span id="previewQRName">-</span>
                            </p>
                        </div>
                        <canvas id="canvas" hidden></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="button" class="btn btn-primary" id="downloadQR">Download</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
    
    $(document).on('click', '.datatable-viewQR-btn', function(event) {
        event.preventDefault();
        const qr_data = $(this).data("qr");

        $('#previewQR').html(qr_data.qrcode);
        $('#previewQRCode').html(qr_data.code);
        $('#previewQRName').html(qr_data.name);
    });


    deleteConfirm = function(formId)
    {
        console.log('klik')
        Swal.fire({
            icon: 'warning',
            text: 'Apakah Anda yakin akan menghapus data?',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#e3342f',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endsection
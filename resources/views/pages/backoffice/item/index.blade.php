@extends('layouts.backoffice.main')

@section('container-backoffice')
<style>
    .row-qr {
        border: 1px solid black;
    }

    .col-border-right {
        border-right: 1px solid black;
    }

    .col-border-top {
        border-top: 1px solid black;
    }

    #bodyPreviewQR {
        font-weight: 600;
        font-size: 14pt;
    }
</style>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Daftar Barang
                        <a href="/backoffice/add-item" class="btn btn-primary">Tambah</a>
                    </h5>

                    <div class="table-responsive">
                        <table id="tabel-data" class="table datatable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nomor Registrasi</th>
                                    <th>Nama Barang</th>
                                    <th>Cara Perolehan</th>
                                    <th>Tahun Perolehan</th>
                                    <th>Kondisi</th>
                                    <th>Pengguna Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$item)
                                    <tr>
                                        <td class="text-center" width="5%">{{ ++$key }}</td>
                                        <td>{{ $item->sub_sub_category_item->code }}</td>
                                        <td>{{ $item->registration_number }}</td>
                                        <td>{{$item->sub_sub_category_item->name }}</td>
                                        <td>{{$item->item_origin->name }}</td>
                                        <td>{{$item->entry_year }}</td>
                                        <td>{{$item->item_condition->name }}</td>
                                        <td>{{$item->user }}</td>
                                        <td>{{$item->price }}</td>
    
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Generate QR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 text-center row-qr" id="bodyPreviewQR">
                        <div class="col-lg-2 col-2 col-border-right d-flex justify-content-center align-items-center py-2">
                            <img src="{{ url('assets/images/logo-bpsdm.png') }}" alt="logo-bpsdm" width="100%">
                        </div>
                        <div class="col-lg-10 col-10 my-auto py-3">
                            <p>BADAN PENGEMBANGAN SUMBER DAYA MANUSIA</p>
                            <p>PROVINSI JAWA BARAT</p>
                        </div>
                        <div class="col-lg-8 col-12 text-start col-border-right col-border-top py-3">
                            <p id="previewQRCode">-</p>
                            <p id="previewQRName">-</p>
                            <p id="previewQRPopularName" class="mt-5"></p>
                        </div>
                        <div class="col-lg-4 col-12 col-border-top">
                            <div id="previewQR" class="mb-3 mt-4"></div>
                        </div>
                    </div>
                    <canvas id="canvas" hidden></canvas>
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
        $('#tabel-data').DataTable({
            responsive: true
        });
    });

    $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    
    $(document).on('click', '.datatable-viewQR-btn', function(event) {
        event.preventDefault();
        const qr_data = $(this).data("qr");

        $('#previewQRCode').html(qr_data.sub_sub_category_item.code);
        $('#previewQRName').html(qr_data.sub_sub_category_item.name);
        $('#previewQRPopularName').html(`Nama Populer: ${qr_data.popular_name}`);
        
        $.ajax({
            type:'GET',
            url:`/backoffice/json/qr-code/item/${qr_data.id}/`,
            success:function(response){
                const data = response.data
                
                $('#previewQR').html(data);
            },
        });
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
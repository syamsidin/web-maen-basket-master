@extends('layouts.backoffice.main')

@section('container-backoffice')
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        Daftar Dokumen Standarisasi
                        <a href="/backoffice/add-document" class="btn btn-primary">Tambah</a>
                    </h5>
                    <table id="tabel-data" class="table datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Filename</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$item)
                                <tr>
                                    <td class="text-center" width="10%">{{ ++$key }}</td>
                                    <td>{{ $item->file_name }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td width="20%">
                                        <a href="/backoffice/edit-document/{{ $item->id }}" class="btn btn-sm btn-secondary">Edit</a>
                                        <form id="delete-document-{{$item->id}}" action="/backoffice/document/{{ $item->id }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteConfirm('delete-document-{{$item->id}}')" >Hapus</a>
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
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
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
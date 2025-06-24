@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Dokumen Standarisasi</h5>

                            <form action="/backoffice/document" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="description" id="description" placeholder="Tuliskan deskripsi" value="{{ $data->description }}" required/>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <label class="form-label">File</label>
                                        @if($data->file_name != null)
                                            <div class="col-6">
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="text" id="file_exist" name="file_exist" value="{{ $data->file_name }}" readonly>
                                                    <a href="{{ $path_file . $data->id . '/' . $data->file_name }}" class="btn btn-info" target="_blank">Lihat</a>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-{{ $data->file_name != null ? '6' : '12'}}">
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" type="file" id="file" name="file" value="{{ $data->file_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
                                <a href="/backoffice/document" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
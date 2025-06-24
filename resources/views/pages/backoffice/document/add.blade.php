@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Dokumen Standarisasi</h5>

                            <form action="/backoffice/document" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="description" id="description" placeholder="Tuliskan deskripsi" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">File <span class="span-required">*</span></label>
                                            <input type="file" class="form-control" name="file" id="file" required/>
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
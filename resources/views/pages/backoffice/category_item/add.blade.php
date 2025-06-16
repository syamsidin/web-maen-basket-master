@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Kategori</h5>

                            <form action="/backoffice/category-item" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nama <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Tuliskan nama kategori" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kuota <span class="span-required">*</span></label>
                                            <input type="number" class="form-control" name="max" id="max" placeholder="Tuliskan maksimal kuota kategori" required/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
                                <a href="/backoffice/category-item" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
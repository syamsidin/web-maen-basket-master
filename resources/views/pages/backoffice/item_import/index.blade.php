@extends('layouts.backoffice.main')

@section('container-backoffice')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            Import Barang
                            <a href="/assets/files/Template Import Barang.xlsx" class="btn btn-info" download>Download Tempalate</a>
                        </h5>
                        
                        <form action="/backoffice/import/item" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose Excel File</label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Ruangan</h5>

                            <form action="/backoffice/repository" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kode Lokasi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Tuliskan kode barang" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Daftar Barang <span class="span-required">*</span></label>
                                            <select name="list_item[]" id="list_item" class="form-control" multiple="multiple">
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Gambar</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" type="file" id="img_file" name="img_file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#list_item').select2()
    });
</script>
@endsection
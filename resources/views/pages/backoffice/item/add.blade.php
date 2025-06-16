@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Barang</h5>

                            <form action="/backoffice/item" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kategori <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="category_id" id="category_id" required>
                                                <option value="">--Pilih kategori--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" id="field-pic-name" style=" display: none;">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pemegang Barang</label>
                                            <input type="text" class="form-control" name="pic_name" id="pic_name" placeholder="Tuliskan nama pemegang barang" value="{{ old('pic_name') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kode <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Tuliskan kode barang" value="{{ old('code') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nomor Registrasi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control"name="register_number" id="register_number" placeholder="Tuliskan nomor registrasi" value="{{ old('register_number') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nama <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Tuliskan nama barang" value="{{ old('name') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Tahun Pengadaan <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="year" id="year" placeholder="Tuliskan tahun pengadaan" value="{{ old('year') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pemilik <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Tuliskan nama pemilik barang" value="{{ old('owner_name') }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Status <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="status_id" required>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? "selected" : "" }}>{{ $status->name }}</option>
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
                                <a href="/backoffice/item" class="btn btn-secondary">Kembali</a>
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

        var category_has_pic_ids = <?php echo json_encode($category_has_pic_ids) ?>;

        $('#category_id').change(function () {
            var selected_category = parseInt($(this).val())
            if (category_has_pic_ids.includes(selected_category)) {
                $('#field-pic-name').show();
            }
            else $('#field-pic-name').hide(); // hide div if value is not "custom"
        });
    });
</script>
@endsection
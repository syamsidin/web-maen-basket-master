@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Barang</h5>
                        </div>
                        <div class="card-body">
                            <form action="/backoffice/not-used-item" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kategori <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="category_id" id="category_id" required>
                                                <option value="">--Pilih kategori--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $data->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" id="field-pic-name" style="display: {{ in_array($data->category_id, $category_has_pic_ids) ? '' : 'none'}};">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pemegang Barang</label>
                                            <input type="text" class="form-control" name="pic_name" id="pic_name" value="{{ $data->pic_name }}" placeholder="Tuliskan nama pemegang barang"/>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kode <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Tuliskan kode barang" value="{{ $data->code }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nomor Registrasi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="register_number" id="register_number" placeholder="Tuliskan nomor registrasi" value="{{ $data->register_number }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kode Lokasi</span></label>
                                            <input type="text" class="form-control" name="repository_name" id="repository_name" value="{{ $data->repository->code ?? "-" }}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nama <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Tuliskan nama barang" value="{{ $data->name }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Tahun Pengadaan <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="year" id="year" placeholder="Tuliskan tahun pengadaan" value="{{ $data->year }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pemilik <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Tuliskan nama pemilik barang" value="{{ $data->owner_name }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Status <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="status_id" required>
                                                @foreach ($statuses as $status)
                                                    <option value="{{ $status->id }}" {{ $status->id == $data->current_status_id ? 'selected' : ''}}>{{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Deskripsi Kerusakan</label>
                                            <textarea class="form-control" id="damage_description" name="damage_description" rows="3">{{ $data->damage_description }}</textarea>
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
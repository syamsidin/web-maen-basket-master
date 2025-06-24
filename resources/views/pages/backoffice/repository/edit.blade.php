@extends('layouts.backoffice.main')

@section('container-backoffice')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Ruangan</h5>
                        </div>
                        <div class="card-body">
                            <form action="/backoffice/repository" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Gedung</label>
                                            <input type="text" class="form-control" name="building_name" id="building_name" value="{{ $data->floor->building->name }}" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Lantai</label>
                                            <input type="text" class="form-control" name="floor_name" id="floor_name" value="{{ $data->floor->name }}" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Ruangan</label>
                                            <input type="text" class="form-control" name="repository_name" id="repository_name" value="{{ $data->name }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Daftar Barang <span class="span-required">*</span></label>
                                            <select name="list_item[]" id="list_item" class="form-control" multiple="multiple">
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}" {{ in_array($item->id, $repository_item_ids) ? 'selected' : ''}}>{{ $item->sub_sub_category_item->code }} - {{ $item->sub_sub_category_item->name }} ({{ $item->entry_date }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-5">
                                            <label class="form-label">Gambar</label>
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" type="file" id="img_file" name="img_file[]">
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <label class="form-label">Deskripsi Gambar</label>
                                            <input type="text" class="form-control" name="img_desc[]" id="img_desc"/>
                                        </div>
                                        <div class="col-2">
                                            <label class="form-label">Aksi</label><br>
                                            <button type="button" id="btn-add" class="btn btn-primary btn-add w-100">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="div-copy-img-files" class="mb-3">
                                </div>
                                <div id="div-exist-img-files" class="mb-3">
                                    @foreach($data->repository_images as $key=>$image)
                                        <div class="div-img-files" id="div-img-files-{{ $key }}">
                                            <div class="row mt-3">
                                                <div class="col-5">
                                                    <div class="input-group input-group-merge">
                                                        <input class="form-control" type="text" id="img_file_exist_id" name="img_file_exist_id[]" value="{{ $image->id }}" hidden>
                                                        <input class="form-control" type="text" id="img_file_exist" name="img_file_exist[]" value="{{ $image->file_name }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <input type="text" class="form-control" name="img_desc[]" id="img_desc" value="{{ $image->description }}" disabled/>
                                                </div>
                                                <div class="col-1">
                                                    <a href="{{ $path_image . $data->id . '/' . $image->file_name }}" class="btn btn-info w-100" target="_blank">Lihat</a>
                                                </div>
                                                <div class="col-1">
                                                    <button type="button" id="btn-remove" class="btn btn-danger btn-remove w-100">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
        $('#list_item').select2();
        
        var count_img_files = 1;
        $('#btn-add').click(function(){
            var content = '<div class="row mt-3">\
                                <div class="col-5">\
                                    <div class="input-group input-group-merge">\
                                        <input class="form-control" type="file" id="img_file" name="img_file[]">\
                                    </div>\
                                </div>\
                                <div class="col-5">\
                                    <input type="text" class="form-control" name="img_desc[]" id="img_desc"/>\
                                </div>\
                                <div class="col-2">\
                                    <button type="button" id="btn-remove" class="btn btn-danger btn-remove w-100">-</button>\
                                </div>\
                            </div>'

            var new_content = '<div class="div-img-files" id="div-img-files-'+ count_img_files +'">' + content + '</div>';
            $("#div-copy-img-files").append(new_content);

            count_img_files++;
        });

        $("#div-exist-img-files").on("click", "button.btn-remove", function(){
            console.log('cli')
            var id_parent = $(this).closest('.div-img-files').attr('id');
            $('#' + id_parent).remove();
        });

        $("#div-copy-img-files").on("click", "button.btn-remove", function(){
            var id_parent = $(this).closest('.div-img-files').attr('id');
            $('#' + id_parent).remove();
        });
    })
</script>
@endsection
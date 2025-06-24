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
                            <form action="/backoffice/item" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="mb-3">
                                    <div class="row">
                                        <label class="form-label">Barang <span class="span-required">*</span></label>
                                        <input type="hidden" name="item_id" id="item_id" value="{{ $data->sub_sub_category_item->id }}"/>

                                        <div class="col-5">
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Kode barang" value="{{ $data->sub_sub_category_item->code }}" disabled/>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama barang" value="{{ $data->sub_sub_category_item->name }}" disabled/>
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#categoryItemModal">
                                                <i class="bi bi-search"></i> Cari Barang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Tahun Perolehan <span class="span-required">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="entry_year" id="entry_year" placeholder="Tuliskan tahun pengadaan" value="{{ $data->entry_year }}" required/>
                                                <span class="input-group-text">4 digit (mis: 2018)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Harga Satuan <span class="span-required">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" name="price" id="price" placeholder="Tuliskan harga satuan" value="{{ $data->price }}" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Masa Manfaat <span class="span-required">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="usage_life" id="usage_life" value="{{ $data->sub_sub_category_item->usage_life }}" disabled/>
                                                <span class="input-group-text">Tahun</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Jumlah <span class="span-required">*</span></label>
                                            <input type="number" class="form-control" name="qty" id="qty" placeholder="1" value="{{ $data->qty }}" required/>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Satuan <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="item_unit_id" required>
                                                <option value="">--Pilih Satuan--</option>
                                                @foreach ($item_units as $unit)
                                                    <option value="{{ $unit->id }}" {{ $unit->id == $data->item_unit_id ? 'selected' : ''}}>{{ $unit->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Nama Populer <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="popular_name" id="popular_name" placeholder="Tuliskan nama populer" value="{{ $data->popular_name }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Asal Usul/Cara Perolehan <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="item_origin_id" required>
                                                <option value="">--Pilih Asal Usul--</option>
                                                @foreach ($item_origins as $origin)
                                                    <option value="{{ $origin->id }}" {{ $origin->id == $data->item_origin_id ? 'selected' : ''}}>{{ $origin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kondisi <span class="span-required">*</span></label><br>
                                            <select class="form-select" name="item_condition_id" required>
                                                <option value="">--Pilih Kondisi--</option>
                                                @foreach ($item_conditions as $condition)
                                                    <option value="{{ $condition->id }}" {{ $condition->id == $data->item_condition_id ? 'selected' : ''}}>{{ $condition->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Tanggal Perolehan <span class="span-required">*</span></label>
                                            <input type="date" class="form-control" name="entry_date" id="entry_date" value="{{ $data->entry_date }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" class="form-control" name="address" id="address" value="3, Jl. Kolonel Masturi No.KM, RW.5, Cipageran, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40511" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pengguna Barang</label>
                                            <input type="text" class="form-control" name="user" id="user" value="Badan Pengembangan Sumber Daya Manusia" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Kuasa Pengguna Barang</label>
                                            <input type="text" class="form-control" name="owner_user" id="owner_user" value="Sekretariat Badan Pengembangan Sumber Daya Manusia" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div id="div-holder-name" class="mb-3" style="display: {{ $field_name == 'PERALATAN DAN MESIN' ? 'block' : 'none' }}">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Pemegang Barang</label>
                                            <input type="text" class="form-control" name="holder_name" id="holder_name" placeholder="Tuliskan nama pemegang barang" value="{{ $data->holder_name }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Penanggung Jawab Barang</label>
                                            <input type="text" class="form-control" name="pic_name" id="pic_name" placeholder="Tuliskan nama penanggung jawab barang" value="{{ $data->pic_name }}"/>
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
                                    @foreach($data->item_images as $key=>$image)
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
                                <a href="/backoffice/item" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="categoryItemModal" tabindex="-1" aria-labelledby="categoryItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="categoryItemModalLabel">Cari Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Bidang</label><br>
                <select class="form-select" name="field_id" id="field_id" required>
                    <option value="">--Pilih Bidang--</option>
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->name }}</option>
                    @endforeach
                </select>
                
                <label class="form-label mt-3">Kategori</label><br>
                <select class="form-select" name="category_id" id="category_id" required>
                    <option value="">--Pilih Kategori--</option>
                </select>
                
                <label class="form-label mt-3">Sub Kategori</label><br>
                <select class="form-select" name="sub_category_id" id="sub_category_id" required>
                    <option value="">--Pilih Sub Kategori--</option>
                </select>
                
                <label class="form-label mt-3">Sub Sub Kategori</label><br>
                <select class="form-select" name="sub_sub_category_id" id="sub_sub_category_id" required>
                    <option value="">--Pilih Sub Sub Kategori--</option>
                </select>
                
                <label class="form-label mt-3">Barang</label><br>
                <select class="form-select" name="sub_sub_category_item_id" id="sub_sub_category_item_id" required>
                    <option value="">--Pilih Barang--</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btn-select-item">Pilih</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
        async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        dropdown_hierarchy = [
            {
                'dropdown_id': 'field_id',
                'child_dropdown_id': 'category_id',
                'child_api': 'categories',
            },
            {
                'dropdown_id': 'category_id',
                'child_dropdown_id': 'sub_category_id',
                'child_api': 'sub_categories',
            },
            {
                'dropdown_id': 'sub_category_id',
                'child_dropdown_id': 'sub_sub_category_id',
                'child_api': 'sub_sub_categories',
            },
            {
                'dropdown_id': 'sub_sub_category_id',
                'child_dropdown_id': 'sub_sub_category_item_id',
                'child_api': 'sub_sub_category_items',
            }
        ];

        dropdown_hierarchy.forEach(item => {
            
            $(`#${item.dropdown_id}`).select2({
                dropdownParent: $('.modal'),
                theme: 'bootstrap-5'
            })
            
            $(`#${item.dropdown_id}`).on('change', function() {

                $.ajax({
                    type:'GET',
                    url:`/backoffice/json/${item.child_api}/` + this.value,
                    success:function(response){
                        const data = response.data

                        $(`#${item.child_dropdown_id}`).find('option:not(:first)').remove();
                        data.forEach(element => {
                            $(`#${item.child_dropdown_id}`).append($('<option>', {
                                value: element.id,
                                text: element.name
                            }));
                        });
                    },
                });
            });
        });


        $(`#sub_sub_category_item_id`).select2({
            dropdownParent: $('.modal'),
            theme: 'bootstrap-5'
        })

        $('#btn-select-item').click(function(){
            const selected_item = $('#sub_sub_category_item_id').find(":selected").val();

            $.ajax({
                type:'GET',
                url:'/backoffice/json/sub_sub_category_items/detail/' + selected_item,
                success:function(response){
                    const data = response.data
                    // console.log('data', data)
                    $('#code').val(data.code);
                    $('#name').val(data.name);
                    $('#item_id').val(data.id);
                    $('#usage_life').val(data.usage_life);
                    $('#categoryItemModal').modal('toggle');

                    var field_name = data.field_name
                    var peralatan_name = "PERALATAN DAN MESIN"
                    if(field_name.toUpperCase() == peralatan_name.toUpperCase()){
                        $('#div-holder-name').css('display', 'block');
                    }else{
                        $('#div-holder-name').css('display', 'none');
                    }
                },
            });
        });
        
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
        
        $("#price").keyup(function(e){
            $(this).val(formatRp($(this).val()));
        });

        var formatRp = function(num){
            var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
            if(str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for(var j = 0, len = str.length; j < len; j++) {
                if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
                }
            }
            formatted = output.reverse().join("");
            return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
    })
</script>
@endsection
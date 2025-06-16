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
                                            <label class="form-label">Kode Lokasi <span class="span-required">*</span></label>
                                            <input type="text" class="form-control" name="code" id="code" placeholder="Tuliskan kode barang" value="{{ $data->code }}" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Daftar Barang <span class="span-required">*</span></label>
                                            <select name="list_item[]" id="list_item" class="form-control" multiple="multiple">
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}" {{ in_array($item->id, $repository_item_ids) ? 'selected' : ''}}>{{ $item->code }} - {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="row">
                                        <label class="form-label">Gambar</label>
                                        @if($data->img_filename != null)
                                            <div class="col-6">
                                                <div class="input-group input-group-merge">
                                                    <input class="form-control" type="text" id="img_file_exist" name="img_file_exist" value="{{ $data->img_filename }}" readonly>
                                                    <a href="{{ $path_image . $data->id . '/' . $data->img_filename }}" class="btn btn-info" target="_blank">Lihat</a>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-{{ $data->img_filename != null ? '6' : '12'}}">
                                            <div class="input-group input-group-merge">
                                                <input class="form-control" type="file" id="img_file" name="img_file" value="{{ $data->img_filename }}">
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
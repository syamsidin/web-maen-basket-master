@extends('layouts.frontoffice.main')

@section('container-frontoffice')
<section class="about" id="item">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Informasi Barang</h2>
            <p>Manajement Barang dan Aset BPSDM Provinsi Jawa Barat</p>
        </div>
    
        <div class="row gy-4">
            <div class="col-lg-6">
                
                <h5>Kategori</h5>
                <p class="lead mb-4">{{ $data->category->name }}</p>
                <h5>Kode Barang</h5>
                <p class="lead mb-4">{{ $data->code }}</p>
                <h5>Kode Lokasi</h5>
                <p class="lead mb-4">{{ $data->repository->code ?? "-" }}</p>
                <h5>Nomor Register</h5>
                <p class="lead mb-4">{{ $data->register_number }}</p>
                <h5>Nama Barang</h5>
                <p class="lead mb-4">{{ $data->name }}</p>
                <h5>Tahun Pengadaan</h5>
                <p class="lead mb-4">{{ $data->year }}</p>
                <h5>Pemilik</h5>
                <p class="lead mb-4">{{ $data->owner_name }}</p>
                <h5>Status</h5>
                <p class="lead mb-4">
                    <span class="badge bg-{{ $data->status->name == "Aktif" ? 'success' : 'dark' }}">{{ $data->status->name }}</span>
                </p>
            </div>
            <div class="col-lg-6">
                <div class="content ps-0 ps-lg-5">
                    <div class="position-relative mt-4">
                        <img src="{{ $path_image . $data->id . '/' . $data->img_filename }}" class="img-fluid rounded-4" alt="">
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</section>
<script>
    $(document).ready(function(){
        document.getElementById('item').scrollIntoView();
    });
</script>
@endsection

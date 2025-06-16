@extends('layouts.frontoffice.main')

@section('container-frontoffice')
<section class="about" id="repository">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Informasi Ruangan</h2>
            <p>Manajement Barang dan Aset BPSDM Provinsi Jawa Barat</p>
        </div>
    
        <div class="row gy-4">
            <div class="col-lg-6">
                
                <h5>Kode Lokasi</h5>
                <p class="lead mb-4">{{ $data->code ?? "-" }}</p>
                @foreach ($item_per_category as $category)                
                    <h5><b>{{ $category->total }}</b> {{ $category->category_name }}</h5>
                @endforeach
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
        document.getElementById('repository').scrollIntoView();
    });
</script>
@endsection

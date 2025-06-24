@extends('layouts.frontoffice.main')

@section('container-frontoffice')
<style>
    table, th, td {
        border: 1px solid black;
    }
    .table>thead{
        vertical-align: middle;
        text-align: center;
    }
    .carousel .carousel-item img {
        max-height: 768px;
        min-width: auto;
    }
</style>
<section class="about" id="building">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Informasi Gedung</h2>
            <p>Manajemen Inventarisasi Barang dan Kelengkapan Aset</p>
        </div>
        @if($data != null)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-2">
                            <h5>Kode</h5>
                            <h5>Nama Gedung</h5>
                        </div>
                        <div class="col-1" style="text-align: center">
                            <h5>:</h5>
                            <h5>:</h5>
                        </div>
                        <div class="col-6">
                            <h5>{{ $data->code ?? "-" }}</h5>
                            <h5>{{ $data->name ?? "-" }}</h5>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table id="tabel-data" class="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Lantai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key=>$item)
                                    <tr>
                                        <td class="text-center" width="5%">{{ ++$key }}</td>
                                        <td>{{ $item->code }} {{ $item->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-12">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($data->building_images as $key=>$image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $path_image . $data->id . '/' . $image->file_name }}" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <h3 style="background-color:rgba(0, 0, 0, 0.7); padding: 1rem 0; border-radius: 10px;">{{ $image->description}}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="row gy-4">
                <div class="col-lg-12">
                    Gedung tidak ditemukan.
                </div>
            </div>
        @endif
    </div>
</section>
<script>
    $(document).ready(function(){
        document.getElementById('building').scrollIntoView();
    });
</script>
@endsection

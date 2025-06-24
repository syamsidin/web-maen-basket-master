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
<section class="about" id="repository">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Informasi Ruangan</h2>
            <p>Manajemen Inventarisasi Barang dan Kelengkapan Aset</p>
        </div>
        @if($data != null)
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-2">
                            <h5>Kode Lokasi</h5>
                            <h5>Nama Ruangan</h5>
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
                                    <th rowspan="2" class="text-center">No.</th>
                                    <th rowspan="2">NIBAR</th>
                                    <th rowspan="2">Nomor Register</th>
                                    <th rowspan="2">Kode Barang</th>
                                    <th rowspan="2">Nama Barang</th>
                                    <th rowspan="2">Spesifikasi Nama Barang</th>
                                    <th colspan="2">Spesifikasi Barang</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Ket.</th>
                                </tr>
                                <tr>
                                    <th>Merek/Tipe</th>
                                    <th>Tahun Perolehan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key=>$item)
                                    <tr>
                                        <td class="text-center" width="5%">{{ ++$key }}</td>
                                        <td></td>
                                        <td>{{$item->registration_number }}</td>
                                        <td>{{$item->sub_sub_category_item->code }}</td>
                                        <td>{{$item->sub_sub_category_item->name }}</td>
                                        <td></td>
                                        <td>{{$item->popular_name }}</td>
                                        <td>{{$item->entry_year }}</td>
                                        <td>{{$item->qty }}</td>
                                        <td>{{$item->item_unit->name }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p>Catatan: Tidak dibenarkan memindahkan barang-barang yang ada pada daftar barang ini tanpa sepengetahuan pengurus barang pengugna / pengurus barang pembantu dan penanggungjawab ruangan.</p>
                    <div class="row" style="text-align: center">
                        <div class="col-6">
                            <p>&nbsp;</p>
                            <p>Pengurus Barang Pengguna</p>
                            <br><br><br>
                            <p>NIP: ..................................................</p>
                        </div>
                        <div class="col-6">
                            <p>.............., ........................ 20xx</p>
                            <p>Penanggungjawab Ruangan</p>
                            <br><br><br>
                            <p>NIP: ..................................................</p>
                        </div>
                    </div>
                    {{-- @foreach ($item_per_category as $category)                
                        <h5><b>{{ $category->total }}</b> {{ $category->category_name }}</h5>
                    @endforeach --}}
                </div>
                <div class="col-lg-6">
                    <div class="content ps-0 ps-lg-5">
                        <div class="position-relative mt-4">
                            <img src="{{ $path_image . $data->id . '/' . $data->img_filename }}" class="img-fluid rounded-4" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($data->repository_images as $key=>$image)
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
                    Ruangan tidak ditemukan.
                </div>
            </div>
        @endif
    </div>
</section>
<script>
    $(document).ready(function(){
        document.getElementById('repository').scrollIntoView();
    });
</script>
@endsection

@extends('layouts.frontoffice.main')

@section('container-frontoffice')

<!-- ======= About Us Section ======= -->
<section id="about" class="about">
    <div class="container" data-aos="fade-up">

    <div class="section-header">
        <h2>Tentang Kami</h2>
        <p>Manajement Barang dan Aset BPSDM Provinsi Jawa Barat</p>
    </div>

    <div class="row gy-4">
        <div class="col-lg-6">
            <p><b>Aplikasi Maen Basket dapat Meningkatkan kapasitas dan skalabilitas sistem untuk mengelola barang dan aset dengan lebih efisien,  sistem penginputan inventarisasi barang dan aset di BPSDM. Memperkuat keamanan sistem inventarisasi untuk melindungi data.</b></p>
            <img src="{{ url('assets/images/frontoffice/about.jpg') }}" class="img-fluid rounded-4 mb-4" alt="">
            <div class="content">
                <p>
                    Manfaat Eksternal
                </p>
                <ul>
                <li><i class="bi bi-check-circle-fill"></i> Mengelola proses inventaris barang dan aset secara online;</li>
                <li><i class="bi bi-check-circle-fill"></i> Tersedianya informasi bagi pihak terkait tentang barang dan aset di BPSDM Provinsi Jawa Barat;</li>
                <li><i class="bi bi-check-circle-fill"></i> Pengambilan kebijakan yang cepat dan tepat sasaran;</li>
                <li><i class="bi bi-check-circle-fill"></i> Pelayanan Informasi Publik.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
                <p>
                    Manfaat Aplikasi Internal
                </p>
                <ul>
                <li><i class="bi bi-check-circle-fill"></i> Memberikan informasi tentang inventaris barang dan aset;</li>
                <li><i class="bi bi-check-circle-fill"></i> Sebagai alat bantu menghilangkan human error dalam pelaksanaan pekerjaan;</li>
                <li><i class="bi bi-check-circle-fill"></i> Meningkatnya efektifitas dan efisiensi kinerja penginventaris barang  dan aset (Pengurus Barang dan Aset);</li>
                <li><i class="bi bi-check-circle-fill"></i> Memberi kemudahan untuk dapat mengakses informasi Inventaris barang dan aset;</li>
                <li><i class="bi bi-check-circle-fill"></i> Tersedianya Pemutakhiran Sistem Input Inventaris Barang dan Aset Berbasis QR Code.</li>
                </ul>

                <div class="position-relative mt-4">
                <img src="{{ url('assets/images/frontoffice/about-2.jpg') }}" class="img-fluid rounded-4" alt="">
            </div>
        </div>
        </div>
    </div>

    </div>
</section><!-- End About Us Section -->

<!-- ======= Portfolio Section ======= -->
<section id="gallery" class="portfolio sections-bg">
    <div class="container" data-aos="fade-up">

    <div class="section-header">
        <h2>Galeri</h2>
        <p>Kumpulan gambar barang</p>
    </div>

    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

        <div>
        <ul class="portfolio-flters">
            <li data-filter="*" class="filter-active">Semua</li>
            {{-- <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-product">Product</li>
            <li data-filter=".filter-branding">Branding</li>
            <li data-filter=".filter-books">Books</li> --}}
            @foreach ($category_items as $category)
                <li data-filter=".filter-{{ $category->name }}">{{ $category->name }}</li>
            @endforeach
        </ul><!-- End Portfolio Filters -->
        </div>

        <div class="row gy-4 portfolio-container">
            @foreach ($items as $item)
            <div class="col-xl-4 col-md-6 portfolio-item filter-{{ $item->category->name }}">
                <div class="portfolio-wrap">
                <a href="#" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ $path_image . $item->id . '/' . $item->img_filename }}" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                    <h4><a href="portfolio-details.html" title="More Details">{{ $item->name }}</a></h4>
                    <p>{{ $item->code }}</p>
                </div>
                </div>
            </div><!-- End Portfolio Item -->
        @endforeach

        </div><!-- End Portfolio Container -->

    </div>

    </div>
</section><!-- End Portfolio Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

    <div class="section-header">
        <h2>Kontak</h2>
        <p>Hubungi kami melaui kontak BPSDM Provinsi Jawa Barat</p>
    </div>

    <div class="row gx-lg-0 gy-4">

        <div class="col-lg-4">

        <div class="info-container d-flex flex-column align-items-center justify-content-center">
            <div class="info-item d-flex">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
                <h4>Alamat:</h4>
                <p>3, Jl. Kolonel Masturi No.KM, RW.5, Cipageran, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40511</p>
            </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
                <h4>Email:</h4>
                <p>bpsdm@jabarprov.go.id</p>
            </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
            <i class="bi bi-phone flex-shrink-0"></i>
            <div>
                <h4>No. Telepon:</h4>
                <p>(022) 6649471</p>
            </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
            <i class="bi bi-clock flex-shrink-0"></i>
            <div>
                <h4>Jam Operasional:</h4>
                <p>Senin-Jumat 09:00 - 17:00</p>
            </div>
            </div><!-- End Info Item -->
        </div>

        </div>

        <div class="col-lg-8">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9421.581715307591!2d107.5414704061905!3d-6.856145777092398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7d5aa75e017%3A0x57cefe41ac66e257!2sBPSDM%20Provinsi%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1715129702262!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>

    </div>
</section><!-- End Contact Section -->
@endsection

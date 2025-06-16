
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>MAEN BASKET</h2>
          <p>Manajement Barang dan Aset </p>
          @if($page_name == "landing")
            <div class="d-flex justify-content-center justify-content-lg-start">
              <a href="#about" class="btn-get-started">Get Started</a>
            </div>
          @endif
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="{{ url('assets/images/frontoffice/QR-code-management-animate.svg') }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>

    @if($page_name == "landing")
      <div class="icon-boxes position-relative">
        <div class="container position-relative">
          <div class="row gy-4 mt-5">

            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-box-seam"></i></div>
                <h4 class="title"><a href="" class="stretched-link">{{ $summary['item'] }} Barang</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-door-open"></i></div>
                <h4 class="title"><a href="" class="stretched-link">{{ $summary['repository'] }} Ruangan</a></h4>
              </div>
            </div><!--End Icon Box -->

            <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-archive"></i></div>
                <h4 class="title"><a href="" class="stretched-link">{{ $summary['not_used_item'] }} Barang Tak Terpakai</a></h4>
              </div>
            </div><!--End Icon Box -->
          </div>
        </div>
      </div>
    @endif

    </div>
</section>
<!-- End Hero Section -->
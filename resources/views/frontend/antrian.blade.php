<!DOCTYPE html>
<html lang="en">

<head>
  <title>LAPAS KELAS IIB CIAMIS</title>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">

    <style>
      body {
        background: linear-gradient(90deg,rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);
        min-height: 100vh;
        margin: 0;
      }
      
      #example1 {
        border: 0px solid;
        box-shadow: 10px 10px 10px 0px #00f9ee;
      }

      .petunjuk {
        pointer-events: none;
      }

      .card-header {
        background: radial-gradient(circle,rgba(247, 240, 141, 1) 0%, rgba(203, 223, 245, 1) 100%);
      }
      
      .custom-container {
        padding-left: 0px;
        padding-right: 0px;
      }
      
      img {
        width: 724px;
        border: 0px solid;
        box-shadow: 0px 0px 10px 10px #00f9ee;
      }

      .marquee-container {
        width: 100%;
        overflow: hidden;
        background-color: transparent;
      }

      .marquee-text {
        font-family: "Audiowide", sans-serif;
        display: inline-block;
        white-space: nowrap;
        animation: scroll-left 40s linear infinite;
        font-size: 28px;
        padding: 0px;
        color: white;
        text-shadow: 0 0 10px #FF0000;
      }

    @keyframes scroll-left {
      0% {
          transform: translateX(45%);
      }
      100% {
          transform: translateX(-100%);
      }
    }
    </style>
</head>

<body class="homepage">
  <!-- Navigasi -->
  <!-- <nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">
        <div class="col-auto">
          <img src="/images/logo/logo_kemenimipas_pemasyarakatan.png" width="100px">
        </div>
      </div>
    </div>
  </nav> -->

  <!-- Konten -->
  <section id="billboard" class="py-3">
    <!-- grid  -->
    <div class="container text-center custom-container">
      <div class="row">
        <div class="col-8">
          <!-- <iframe width="700" height="400" id="youtubePlayer" src="https://www.youtube.com/embed/rkqP23zo7bI"></iframe> -->
            <img src="{{ asset('images/infobox/'.$infobox['image']) }}" width="" class="img-fluid rounded">
        </div>
        
        <div class="col-4">
          <div class="card mb-3" id="example1">
            <div class="card-header head-informasi">
              <b>LAYANAN INFORMASI</b>
            </div>
            <div class="card-body body-informasi">
              <h5 class="card-title">NOMOR ANTRIAN</h5>
              <p class="card-text">
                <h4 id="antrian_informasi">TUTUP</h4>
              </p>
              <a href="#" class="btn btn-primary petunjuk">MENUJU MEJA LAYANAN INFORMASI</a>
            </div>
          </div>

          <div class="col">
            <div class="card mb-3" id="example1">
              <div class="card-header">
                <b>LAYANAN PENGADUAN</b>
              </div>
              <div class="card-body">
                <h5 class="card-title">NOMOR ANTRIAN</h5>
                <p class="card-text">
                  <h4 id="antrian_pengaduan">TUTUP</h4>
                </p>
                <a href="#" class="btn btn-primary petunjuk">MENUJU MEJA LAYANAN PENGADUAN</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col ">
          <div class="card" id="example1">
            <div class="card-header">
              <b>LAYANAN KUNJUNGAN SESI 1</b>
            </div>
            <div class="card-body">
              <h5 class="card-title">NOMOR ANTRIAN</h5>
              <p class="card-text"><h4 id="antrian_kunjungan1">TUTUP</h4></p>
              <a href="#" class="btn btn-primary petunjuk">MENUJU MEJA LAYANAN KUNJUNGAN</a>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card" id="example1">
            <div class="card-header">
              <b>LAYANAN KUNJUNGAN SESI 2</b>
            </div>
            <div class="card-body">
              <h5 class="card-title">NOMOR ANTRIAN</h5>
              <p class="card-text"><h4 id="antrian_kunjungan2">TUTUP</h4></p>
              <a href="#" class="btn btn-primary petunjuk">MENUJU MEJA LAYANAN KUNJUNGAN</a>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card" id="example1">
            <div class="card-header">
              <b>LAYANAN KUNJUNGAN SESI 3</b>
            </div>
            <div class="card-body">
              <h5 class="card-title">NOMOR ANTRIAN</h5>
              <p class="card-text"><h4 id="antrian_kunjungan3">TUTUP</h4></p>
              <a href="#" class="btn btn-primary petunjuk">MENUJU MEJA LAYANAN KUNJUNGAN</a>
            </div>
          </div>
        </div>
      </div> 
    </div>
        
    <!-- perluas baground abu-abu -->
    <div class="row">
      <div class="swiper main-swiper"></div>
    </div>
  </section>

  <footer id="footer">
    <div class="marquee-container">
      <div class="marquee-text">
          <b>{{$tulisan_berjalan->value}}</b>
      </div>
    </div>
  </footer>
  
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
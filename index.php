<!doctype html>
<html lang="en">
<head>

  <?php
  include "koneksi.php";
  include "fuzzy/fuzzy.php";
  include "fuzzy/handler.php";

  $fuzzy = new fuzzy();
  $conn = mysqli_connect("localhost","root","","kantinum");
  ?>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">

  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <!-- Bootstrap core CSS-->
    <link href="dist/table/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="dist/table/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="dist/table/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dist/table/css/sb-admin.css" rel="stylesheet">

  <title>Menu</title>
</head>
<body class="bg-dark">
    
    <!-- navbar -->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm fixed-top">
      <img class="my-0 mr-md-auto" src="img/logo2.png" height="25px">
      <nav class="my-2 my-md-0 mr-md-3 text-center">
        <a class="p-2 text-dark" style="text-decoration: underline;" href="#">MENU</a>
        <a class="p-2 text-dark" href="identitas.php">PEMESANAN</a>
        <a class="p-2 text-dark" href="rating.php">RATING</a>
        <a class="p-2 text-dark" href="transaksi.php">TRANSAKSI</a>
      </nav>
    </div><!-- navbar -->

    <main role="main">

      <!-- carousel -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/bg4.png" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/bg5.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/bg6.png" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div><!-- carousel -->

      <div class="album p-4 bg-light">
        <div class="container" style="margin-top: 30px;">

          <!-- navbar2 -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
              <ul class="navbar-nav nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#pills-all" role="tab" aria-controls="pills-all" aria-selected="true">ALL</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-makanan-tab" data-toggle="pill" href="#pills-makanan" role="tab" aria-controls="pills-makanan" aria-selected="false">MAKANAN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-minuman-tab" data-toggle="pill" href="#pills-minuman" role="tab" aria-controls="pills-minuman" aria-selected="false">MINUMAN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-snack-tab" data-toggle="pill" href="#pills-snack" role="tab" aria-controls="pills-snack" aria-selected="false">SNACK</a>
                </li>
                
                <li class="nav-item">
                  <form class="form-inline my-2 my-2 my-md-0" method="POST">
                    <div class="input-group">
                      <input type="text" name="cari" class="form-control" placeholder="Mencari Menu . . ." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="tombol">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </div>
          </nav><!-- navbar2 -->

          <div class="tab-content" id="pills-tabContent">
            <!-- all -->
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
              <div class="row py-5">

                <?php
                  include "koneksi.php";
                  $conn = mysqli_connect("localhost","root","","kantinum");
                 
                 if(isset($_POST["cari"]) && !empty($_POST["cari"])) {
                  $cari = '%'.$_POST["cari"].'%'; }
                  else {$cari = false;} 

                if(isset($_POST['tombol'])){
                $pencarian = mysqli_query($conn, "SELECT * FROM menu where status='ada' AND nama like '$cari'");
               
               while($data = mysqli_fetch_array($pencarian)){ 

                $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasilfuzzy = $fuzzy->defuzzyfikasi($array);

        if ($hasilfuzzy>0) 
            { ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm" style="background-color: #ffff80;">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <table  style="margin-top: -10px;"><tr><td>
                  <h5><?php echo $data['nama']; ?></h5></td><td>
                  <img src="img/best2.jpg" height="50"></td></tr></table>
                  <p  style="margin-top: -10px;">Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
    <?php } 

    else { ?>
    <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <h5><?php echo $data['nama']; ?></h5>
                  <p>Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
        <?php }} } ?>
                </div>
                <hr>

                <!-- all -->
            <div class="row py-5">
             <?php
               $user = mysqli_query($conn, "SELECT * FROM menu where status='ada' ");

                                      while($data = mysqli_fetch_array($user)){

            $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasilfuzzy = $fuzzy->defuzzyfikasi($array);

        if ($hasilfuzzy>0) 
            { ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm" style="background-color: #ffff80;">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <table  style="margin-top: -10px;"><tr><td>
                  <h5><?php echo $data['nama']; ?></h5></td><td>
                  <img src="img/best2.jpg" height="50"></td></tr></table>
                  <p  style="margin-top: -10px;">Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
    <?php } 

    else { ?>
    <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <h5><?php echo $data['nama']; ?></h5>
                  <p>Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
        <?php }  } ?>
              </div>
            </div><!-- all -->

            <!-- makanan -->
            <div class="tab-pane fade" id="pills-makanan" role="tabpanel" aria-labelledby="pills-makanan-tab">
              <div class="row py-5">

                <?php
                  $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                      $user = mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis like 'makanan' ");
                     while($data = mysqli_fetch_array($user)){

                $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasilfuzzy = $fuzzy->defuzzyfikasi($array);

        if ($hasilfuzzy>0) 
            { ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm" style="background-color: #ffff80;">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <table  style="margin-top: -10px;"><tr><td>
                  <h5><?php echo $data['nama']; ?></h5></td><td>
                  <img src="img/best2.jpg" height="50"></td></tr></table>
                  <p  style="margin-top: -10px;">Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
    <?php } 

    else { ?>
    <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <h5><?php echo $data['nama']; ?></h5>
                  <p>Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
        <?php } } ?>
              </div>
            </div><!-- makanan -->

            <!-- minuman -->
            <div class="tab-pane fade" id="pills-minuman" role="tabpanel" aria-labelledby="pills-minuman-tab">
              <div class="row py-5">

                <?php
                  $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                      $user = mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis like 'minuman' ");
                                      while($data = mysqli_fetch_array($user)){ 

                $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasilfuzzy = $fuzzy->defuzzyfikasi($array);

        if ($hasilfuzzy>0) 
            { ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm" style="background-color: #ffff80;">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <table  style="margin-top: -10px;"><tr><td>
                  <h5><?php echo $data['nama']; ?></h5></td><td>
                  <img src="img/best2.jpg" height="50"></td></tr></table>
                  <p  style="margin-top: -10px;">Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
    <?php } 

    else { ?>
    <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <h5><?php echo $data['nama']; ?></h5>
                  <p>Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
        <?php }  } ?>
              </div>
            </div><!-- minuman -->

            <!-- snack -->
            <div class="tab-pane fade" id="pills-snack" role="tabpanel" aria-labelledby="pills-snack-tab">
              <div class="row py-5">

                <?php
                  $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                      $user = mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis like 'snack' ");
                                      while($data = mysqli_fetch_array($user)){ 
                
                $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasilfuzzy = $fuzzy->defuzzyfikasi($array);

        if ($hasilfuzzy>0) 
            { ?>

            <div class="col-md-3">
              <div class="card mb-4 shadow-sm" style="background-color: #ffff80;">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                 <table  style="margin-top: -10px;"><tr><td>
                  <h5><?php echo $data['nama']; ?></h5></td><td>
                  <img src="img/best2.jpg" height="50"></td></tr></table>
                  <p  style="margin-top: -10px;">Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
    <?php } 

    else { ?>
    <div class="col-md-3">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="<?php echo $data['gambar']; ?>" >
                <div class="card-body">
                  <h5><?php echo $data['nama']; ?></h5>
                  <p>Rp <?php echo $data['harga']; ?></p>
                  <div class="rating-block text-center">
                    <?php 
                        if ($data['rating'] == 1) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 2) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 
                    
                    if ($data['rating'] == 3) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    <?php } 
                    
                    if ($data['rating'] == 4) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i></button>
                    <?php } 

                    if ($data['rating'] == 5) { ?>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } 

                    if ($data['rating'] == 0) { ?>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
                      <i class="fas fa-star text-white"></i>
                    </button>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
        <?php }  } ?>
              </div>
            </div>
          </div><!-- snack -->

        </div>
      </div>
    </main>

    <footer class="text-white bg-dark" style="margin-top: 20px;">
      <div class="container">
        <p class="float-right">
          <a class="text-white" href="#">Back to top</a>
        </p>
        <p>&copy; 2018 CANTEEN UM</p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="dist/js/jquery-3.3.1.slim.min.js"></script>
    <script src="dist/js/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

  </body>
</html>
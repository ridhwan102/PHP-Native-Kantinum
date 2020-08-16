<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <?php
  include ("koneksi.php");
  ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">

    <title>Rating</title>
  </head>
  <body class="bg-dark">
    
    <!-- navbar -->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm fixed-top">
      <img class="my-0 mr-md-auto" src="img/logo2.png" height="25px">
      <nav class="my-2 my-md-0 mr-md-3 text-center">
        <a class="p-2 text-dark" href="index.php">MENU</a>
        <a class="p-2 text-dark" href="identitas.php">PEMESANAN</a>
        <a class="p-2 text-dark" style="text-decoration: underline;" href="#">RATING</a>
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
        <h1 class="p-3 jumbotron-heading text-center" style="margin-top: -10px;">Mohon Isi Sesuai Data Saat Memesan</h1>
        <div class="container" style="margin-top: 30px;">
          <div class="card">
            <div class="card-header bg-dark">
              -
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Atas Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Sesuai Nama Pemesan" required="">
                  </div>

                  <div class="form-group col-md-6">
                   <label for="inputAddress">No Telp</label>
                  <input type="text" name="notelp" class="form-control" placeholder="Sesuai No. Telepon Pemesan" required="">
                  </div>
                </div>

                <div class="form-group text-danger">
                  <label for="inputAddress">Note :<br>Harap mengisi form diatas sebelum memberi rating. Terimakasih.</label>
                </div>
              
            </div>
            <div class="card-footer text-muted">
              <div class="text-center">
                <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
                <button class="btn btn-success" type="submit" name="next">Next</button>
              </div>
            </div>
          </form>
          </div>
          <br>
        </div>
      </div>
    </main>

<?php
include "koneksi.php";
//session_start();
if(isset($_POST['next'])){
  $nama = $_POST['nama'];
  $notelp =$_POST['notelp'];

  $conn = mysqli_connect("localhost","root","","kantinum");
          $input = mysqli_query ($conn,"SELECT * FROM konsumen WHERE nama = '$nama' AND no_telp = '$notelp'");
          
  if (mysqli_num_rows($input) == 0){
    echo "<script>alert('Nama Pemesan Atau No.Telp Salah'); </script>";
  }

  else{ 
    echo "<script>alert('Silahkan Memberi Rating'); window.location='rating2.php'</script>";
    $_SESSION['nama'] = $nama;
    $_SESSION['notelp'] = $notelp;
  }
}

?>

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
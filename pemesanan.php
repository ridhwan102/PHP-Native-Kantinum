<?php 
session_start(); 

include "koneksi.php";

$nama = $_SESSION['nama'];
$tempat = $_SESSION['tempat'];
$notelp = $_SESSION['notelp'];
$waktu = $_SESSION['waktu'];

$conn = mysqli_connect("localhost","root","","kantinum");
   
$idq = mysqli_query($conn, "SELECT * FROM konsumen where nama='$nama' AND tempat = '$tempat' AND no_telp = '$notelp' AND waktu_pesan = '$waktu'");
          while($hasil = mysqli_fetch_array($idq)){
            $id= $hasil['id_pesanan'];
          }
$_SESSION['id'] = $id;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pemesanan</title>

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

  </head>
  <body class="bg-dark" id="page-top">

    <!-- navbar -->
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm fixed-top">
      <img class="my-0 mr-md-auto" src="img/logo2.png" height="25px">
      <nav class="my-2 my-md-0 mr-md-3 text-center">
        <a class="p-2 text-dark" href="index.php">MENU</a>
        <a class="p-2 text-dark" style="text-decoration: underline;" href="#">PEMESANAN</a>
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
        <h1 class="p-3 jumbotron-heading text-center" style="margin-top: -10px;">Pemesanan Makanan</h1>
        <div class="container" style="margin-top: 30px;">

          <!-- navbar 2 -->
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08"><!-- style="margin-top: -10px; margin-bottom: -10px" -->
              <ul class="navbar-nav nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">MAKANAN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">MINUMAN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">SNACK</a>
                </li>
              </ul>
            </div>
          </nav><br/><!-- navbar 2 -->

          <form method="POST" action="pemesanan_act.php">
          <div class="tab-content" id="myTabContent">
            
            <!-- makanan -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="table-responsive">
                <table class="table table-bordered" id="tbl1" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Pesan</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                    <?php
                        $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                        $user= mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis = 'makanan' ");
                                      while($hasil = mysqli_fetch_array($user)){ ?>

                    <tr>
                      <td width="50px"><img class="card-img-top" src="<?php echo $hasil['gambar'] ?>" alt="makanan" width="50"></td>
                      <td><?php echo $hasil['nama'] ?></td>
                      <td><?php echo $hasil['harga'] ?></td>
                     
                      <td>
                          <input type="number" min="0" name="jumlah[]" class="form-control" value="0">

                          <input type="text" name="array[]" readonly value="<?php echo $hasil['nama'],'/',$hasil['harga'] ?>" style="display: none;">
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div><!-- makanan -->

            <!-- minuman -->
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="table-responsive">
                <table class="table table-bordered" id="tbl2" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Pesan</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                    <?php
                        $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                        $user= mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis = 'minuman' ");
                                      while($hasil = mysqli_fetch_array($user)){ ?>

                    <tr>
                      <td width="50px"><img class="card-img-top" src="<?php echo $hasil['gambar'] ?>" alt="minuman" width="50"></td>
                      <td><?php echo $hasil['nama'] ?></td>
                      <td><?php echo $hasil['harga'] ?></td>
                     
                      <td>
                          <input type="number" min="0" name="jumlah[]" class="form-control" value="0">

                          <input type="text" name="array[]" readonly value="<?php echo $hasil['nama'],'/',$hasil['harga'] ?>" style="display: none;">
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div><!-- minuman -->

            <!-- snack -->
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <div class="table-responsive">
                <table class="table table-bordered" id="tbl3" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Pesan</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                    <?php
                        $conn = mysqli_connect("localhost","root","","kantinum");
                                      
                        $user= mysqli_query($conn, "SELECT * FROM menu where status='ada' AND jenis = 'snack' ");
                                      while($hasil = mysqli_fetch_array($user)){ ?>

                    <tr>
                      <td width="50px"><img class="card-img-top" src="<?php echo $hasil['gambar'] ?>" alt="snack" width="50"></td>
                      <td><?php echo $hasil['nama'] ?></td>
                      <td><?php echo $hasil['harga'] ?></td>

                      <td>
                          <input type="number" min="0" name="jumlah[]" class="form-control" value="0">

                          <input type="text" name="array[]" readonly value="<?php echo $hasil['nama'],'/',$hasil['harga'] ?>" style="display: none;">
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div><!-- snack -->

          </div><br/>
          <div class="text-center">
            <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
            <button name="next" type="submit" value="Submit" class="btn btn-success">Next</button>
          </div>
        </form>
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


    <!-- Bootstrap core JavaScript-->
    <script src="dist/table/vendor/jquery/jquery.min.js"></script>
    <script src="dist/table/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="dist/table/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="dist/table/vendor/datatables/jquery.dataTables.js"></script>
    <script src="dist/table/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="dist/table/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="dist/table/js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
      $(function(){
        $('#tbl1').dataTable();
      });
      $(function(){
        $('#tbl2').dataTable();
      });
      $(function(){
        $('#tbl3').dataTable();
      });
    </script>
  </body>
</html>

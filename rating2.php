<?php 
session_start(); 
$nama = $_SESSION['nama'];
$notelp =  $_SESSION['notelp'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rating</title>

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
        <a class="p-2 text-dark" href="identitas.php">PEMESANAN</a>
        <a class="p-2 text-dark" href="#" style="text-decoration: underline;">RATING</a>
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
        <h1 class="p-3 jumbotron-heading text-center" style="margin-top: -10px;">Rating Makanan Kantin UM</h1>
        <div class="container" style="margin-top: 30px;">


          <form method="POST" action="rating_act.php">
          <div class="tab-content" id="myTabContent">
            
            <!-- table -->
              <div class="table-responsive">
                <table class="table table-bordered" id="tbl1" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Rating</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                    <?php
                        $conn = mysqli_connect("localhost","root","","kantinum");
                        $getid = mysqli_query($conn, "SELECT * FROM konsumen where nama = '$nama' AND no_telp = '$notelp' ");
                       while($hasilid = mysqli_fetch_array($getid)){

                        $user= mysqli_query($conn, "SELECT * FROM pesanan a, menu b, konsumen c WHERE a.id_pesanan = c.id_pesanan AND a.id_pesanan = '$hasilid[id_pesanan]' AND a.menu = b.nama");
                                      while($hasil = mysqli_fetch_array($user)){ ?>

                    <tr>
                      <td width="50px"><img class="card-img-top" src="<?php echo $hasil['gambar'] ?>" alt="makanan" width="50"></td>
                      <td><?php echo $hasil['menu'] ?></td>
                      <td><?php echo $hasil['harga'] ?></td>                     
                      <td>
                        <div class="form-group">
                          <select name="rating[]" class="form-control" id="exampleFormControlSelect1">
                            <option>-</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>

                          <input type="text" name="array[]" readonly value="<?php echo $hasil['menu'],'/',$hasil['id_pesanan']  ?>" style="display: none;">

                        </div>
                      </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div><!-- table -->

          </div><br/>
          <div class="text-center">
            <a class="btn btn-danger" href="index.php" role="button">Cancel</a>
            <button name="next" type="submit" value="Submit" class="btn btn-success">Rate !!!</button>
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

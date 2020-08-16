<?php
$id = $_GET['id'];
include 'koneksi.php';

$conn = mysqli_connect("localhost","root","","kantinum");
$update = mysqli_query ($conn,"UPDATE konsumen SET status = 'diterima' WHERE id_pesanan='$id'");
if ($update == TRUE){
    echo "<script>alert('Diterima');window.location='transaksi.php'</script>";
    
  }

  else{ 
    echo "<script>alert('Gagal'); window.location='transaksi.php'</script>";
  }
?>
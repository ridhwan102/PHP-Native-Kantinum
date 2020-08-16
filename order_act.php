<?php
session_start();
$id = $_SESSION['id'];
include "koneksi.php";

if(isset($_POST['cancel'])){
  $conn = mysqli_connect("localhost","root","","kantinum");

  $delete = mysqli_query ($conn,"DELETE FROM pesanan WHERE id_pesanan = '$id'");
  $delete2 = mysqli_query($conn, "DELETE FROM konsumen WHERE id_pesanan = '$id'");
    
  if ($delete == TRUE and $delete2 == TRUE){
    echo "<script>window.location='index.php'</script>";
    
  }

  else{ 
    echo "<script>alert('Gagal'); window.location='order.php'</script>";
  }

} 
?>
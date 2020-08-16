<?php
session_start();
$id = $_SESSION['id'];
$menu = $_GET['menu'];

$conn = mysqli_connect("localhost","root","","kantinum");
                                      
$delete= mysqli_query($conn, "DELETE FROM pesanan where id_pesanan = '$id' AND menu = '$menu'");
                                

if ($delete == TRUE){
    echo "<script>window.location='order.php'</script>";
    
  }

  else{ 
    echo "<script>alert('Gagal'); window.location='order.php'</script>";
  }
 ?>
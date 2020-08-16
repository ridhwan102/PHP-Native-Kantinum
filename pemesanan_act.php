<?php
session_start();
$id = $_SESSION['id'];
include "koneksi.php";

$menu = $_POST['array'];
$jumlah =  $_POST['jumlah'];


if(isset($_POST['next'])){
$conn = mysqli_connect("localhost","root","","kantinum");

  for ($i=0; $i < sizeof($jumlah) ; $i++) 
  { 
    $array= explode('/',$menu[$i]);
    $nama_menu = $array[0];
    $harga = $array[1] * $jumlah[$i] ;

    if ($jumlah[$i]>0) 
    {

      $cek = mysqli_query ($conn,"SELECT * FROM pesanan WHERE id_pesanan = '$id' AND menu = '$nama_menu'");
    
      if (mysqli_num_rows($cek) == 0) 
      { 
        $input = mysqli_query ($conn,"INSERT INTO pesanan VALUES ('$id', '$nama_menu', '$jumlah[$i]','$harga','')");
      }
    
      else 
      {
        $update = mysqli_query ($conn,"UPDATE pesanan SET jumlah = '$jumlah[$i]', harga = '$harga' WHERE id_pesanan='$id' AND menu = '$nama_menu'");      
      }
    }
    }     

  if ($input == TRUE or $update == TRUE){
    echo "<script>alert('Silahkan Diperiksa Kembali');window.location='order.php'</script>";
    
  }

  else{ 
    echo "<script>alert('Gagal'); window.location='pemesanan.php'</script>";
  }

} 
?>
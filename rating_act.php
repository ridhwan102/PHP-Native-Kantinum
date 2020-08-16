<?php
session_start(); 
include "koneksi.php";
$nama = $_SESSION['nama'];
$notelp =  $_SESSION['notelp'];

$array = $_POST['array'];
$rating =  $_POST['rating'];

if(isset($_POST['next']))
{
$conn = mysqli_connect("localhost","root","","kantinum");

  for ($i=0; $i < sizeof($array) ; $i++) 
  { 
    $array2= explode('/',$array[$i]);
    $nama_menu = $array2[0];
    $id = $array2[1];

    if ($rating[$i]>0) 
    {
        $update = mysqli_query ($conn,"UPDATE pesanan SET rating = '$rating[$i]' WHERE id_pesanan='$id' AND menu = '$nama_menu'");  
        $updatemenu = mysqli_query ($conn,"UPDATE menu SET rating= (SELECT AVG(rating) FROM pesanan WHERE menu='$nama_menu' AND rating != 0) WHERE nama='$nama_menu'");
    }    
  }
        

    if ($update == TRUE)
    {
    echo "<script>alert('Terima Kasih Sudah Memberi Penilaian');window.location='index.php'</script>";
    }
  else
  { 
    echo "<script>alert('Gagal'); window.location='rating2.php'</script>";
  }

} 
?>
<?php
session_start();
include 'koneksi.php';
$id = $_SESSION['id'];

$conn = mysqli_connect("localhost","root","","kantinum");


$user= mysqli_query($conn, "SELECT * FROM pesanan where id_pesanan = '$id' ");
    while($hasil = mysqli_fetch_array($user))
{ 
	$update = mysqli_query ($conn,"UPDATE menu SET jumlah = jumlah + $hasil[jumlah] WHERE nama = '$hasil[menu]'");
}
?>

<script>window.location='transaksi.php'</script>
<?php

// konfigurasi database
$host       =   "localhost";
$user       =   "root";
$password   =   "";
$database   =   "kantinum";
// perintah php untuk akses ke database
$db = mysqli_connect($host, $user, $password, $database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
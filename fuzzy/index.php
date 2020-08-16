<?php
    include "koneksi.php";
    include "fuzzy.php";
    include "handler.php";

    //$koneksi = new koneksi();
    $fuzzy = new fuzzy();
    $conn = mysqli_connect("localhost","root","","kantinum");
    // while($getuser = mysqli_fetch_array($user)){

    // $data_training = array();

?>
<form action="" method="post">
    <table border="1">

            <?php
        $query = mysqli_query($conn,"SELECT * FROM menu");
        while($data = mysqli_fetch_array($query)) 
        {
            $array = array($data['harga'], $data['jumlah'], $data['rating']);
            $fuzzy->mesinInferensiTsukamoto($data['harga'], $data['jumlah'], $data['rating']);
            $hasil = $fuzzy->defuzzyfikasi($array);

        ?>
            <tr>
                
                <td><?=$data['nama']?></td>
                <td><?=$hasil?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</form>
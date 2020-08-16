<?php
include "koneksi.php";

class fuzzy {
    private $harga_murah;
    private $harga_mahal;
    private $pembeli_rendah;
    private $pembeli_tinggi;
    private $rating_rendah;
    private $rating_tinggi;

    private function fuzzifikasiHarga($harga) {
        if ($harga <= 10000) {
            $this->harga_murah = 1;
            $this->harga_mahal = 0;
        } else if ($harga >= 10000 && $harga <= 20000) {
            $this->harga_murah = (20000 - $harga) / (20000 - 10000);
            $this->harga_mahal = ($harga - 10000) / (20000 - 10000);
        } else {
            $this->harga_murah = 0;
            $this->harga_mahal = 1;
        }
    }

    private function fuzzifikasiPembeli($pembeli) {
        if ($pembeli <= 15) {
            $this->pembeli_rendah = 1;
            $this->pembeli_tinggi = 0;
        } else if ($pembeli > 15 && $pembeli <= 30) {
            $this->pembeli_rendah = (30 - $pembeli) / (30 - 15);
            $this->pembeli_tinggi = ($pembeli - 15) / (30 - 15);
        } else {
            $this->pembeli_rendah = 0;
            $this->pembeli_tinggi = 1;
        }
    }

    private function fuzzifikasiRating($rating) {
        if ($rating <= 1) {
            $this->rating_rendah = 1;
            $this->rating_tinggi = 0;
        } else if ($rating > 1 && $rating < 5) {
            $this->rating_rendah = (5 - $rating) / (5 - 1);
            $this->rating_tinggi = ($rating - 1) / (5 - 1);
        } else {
            $this->rating_rendah = 0;
            $this->rating_tinggi = 1;
        }
    }

    public function mesinInferensiTsukamoto($harga, $pembeli, $rating) {
        $this->fuzzifikasiHarga($harga);
        $this->fuzzifikasiPembeli($pembeli);
        $this->fuzzifikasiRating($rating);

        $a1 = min($this->harga_murah, $this->pembeli_rendah, $this->rating_rendah);
        $z1 = 2;
        $a2 = min($this->harga_murah, $this->pembeli_rendah, $this->rating_tinggi);
        $z2 = 6;
        $a3 = min($this->harga_murah, $this->pembeli_tinggi, $this->rating_rendah);
        $z3 = 4;
        $a4 = min($this->harga_murah, $this->pembeli_tinggi, $this->rating_tinggi);
        $z4 = 8;
        $a5 = min($this->harga_mahal, $this->pembeli_rendah, $this->rating_rendah);
        $z5 = 1;
        $a6 = min($this->harga_mahal, $this->pembeli_rendah, $this->rating_tinggi);
        $z6 = 5;
        $a7 = min($this->harga_mahal, $this->pembeli_tinggi, $this->rating_rendah);
        $z7 = 3;
        $a8 = min($this->harga_mahal, $this->pembeli_tinggi, $this->rating_tinggi);
        $z8 = 7;

        // return array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8);
        // return array($z1, $z2, $z3, $z4, $z5, $z6, $z7, $z8);
    }

    public function defuzzyfikasi($data) {
        $total_a = 0;
        $total_z = 0;

        $a1 = min($this->harga_murah, $this->pembeli_rendah, $this->rating_rendah);
        $z1 = 2;
        $a2 = min($this->harga_murah, $this->pembeli_rendah, $this->rating_tinggi);
        $z2 = 6;
        $a3 = min($this->harga_murah, $this->pembeli_tinggi, $this->rating_rendah);
        $z3 = 4;
        $a4 = min($this->harga_murah, $this->pembeli_tinggi, $this->rating_tinggi);
        $z4 = 8;
        $a5 = min($this->harga_mahal, $this->pembeli_rendah, $this->rating_rendah);
        $z5 = 1;
        $a6 = min($this->harga_mahal, $this->pembeli_rendah, $this->rating_tinggi);
        $z6 = 5;
        $a7 = min($this->harga_mahal, $this->pembeli_tinggi, $this->rating_rendah);
        $z7 = 3;
        $a8 = min($this->harga_mahal, $this->pembeli_tinggi, $this->rating_tinggi);
        $z8 = 7;

        $total_a = ($a1*$z1)+($a2*$z2)+($a3*$z3)+($a4*$z4)+($a5*$z5)+($a6*$z6)+($a7*$z7)+($a8*$z8);
        $total_z = $z1+$z2+$z3+$z4+$z5+$z6+$z7+$z8;

        $hasil = ($total_a/$total_z)*100;
        if ($hasil>20){
            return $hasil;
        }
        
    }
}
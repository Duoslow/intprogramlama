<?php
require_once 'config.php';
if (isset($_POST["kayit"])){
    $k_ad = $_POST["k_adi"];
    $k_soyadi = $_POST["k_soyadi"];
    $k_sifre = $_POST["k_sifre"];
    $k_kuladi = $_POST["k_kuladi"];	

    $sql = "INSERT INTO kullanicilar (k_kulad, k_ad, k_soyad, k_sifre)
    VALUES ('".$k_kuladi."','".$k_ad."','".$k_soyadi."','".password_hash($k_sifre, PASSWORD_DEFAULT)."')";
  
    if ($baglanti->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('Yeni Kullanici Eklendi');window.location.href = 'kayit.php';</script>";
    }
    else {
    echo "<script type= 'text/javascript'>alert('Aynı Kullaniciyi Ekleyemezsin');window.location.href = 'kayit.php';</script>";
    }
    $baglanti->close();
}

?>
<?php
include('templates/main.php');
require_once("config.php");
?>
<div class="kutuphane kul-baslik">
  <form action="" method="post" class="kuldetay">
    <div>
      <span>
        Kullanıcı adı:
      </span>
      <span>
      <input type="text" name="k_kuladi"><br>
      </span>
    </div>
    <div>
      <span>Şifre:</span>
      <span>
        <input type="password" value="şifre gir" name="k_sifre">
      </span>
    </div>
    <div>
      <br>
      <span>
        <input type="submit" value="Kaydol" name="kayit">
      </span>
    </div>
  </form>
  <!-- AYRIM NOKTASI -->
</div>
<?php
require_once 'config.php';
if (isset($_POST["kayit"])){
    $k_kuladi = $_POST["k_kuladi"];	
    $k_sifre = $_POST["k_sifre"];

    $sql = "INSERT INTO kullanicilar (k_kulad, k_sifre)
    VALUES ('".$k_kuladi."','".password_hash($k_sifre, PASSWORD_DEFAULT)."')";
  
    if ($baglanti->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('Yeni Kullanici Eklendi');window.location.href = 'kayit.php';</script>";
    }
    else {
    echo "<script type= 'text/javascript'>alert('Aynı Kullaniciyi Ekleyemezsin');window.location.href = 'kayit.php';</script>";
    }
    $baglanti->close();
}

?>
<?php
include('templates/bottom.php');
?>
<?php
include('templates/main.php');
require_once("config.php");
?>
<div class="kutuphane kul-baslik">
  <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post" class="kuldetay">
    <div>
      <span>
        Kullanıcı:
      </span>
      <span>
        <input type="text" placeholder="isim gir" name="kul_ad">
      </span>
    </div>
    <div>
      <span>Şifre:</span>
      <span>
        <input type="password" placeholder="şifre gir" name="kul_sifre">
      </span>
    </div>
    <div>
      <br>
      <span>
        <input type="submit" value="giriş" name="giris">
      </span>
    </div>
  </form>
</div>
<?php
if (isset($_POST['giris'])) {
  $sifre = "SELECT * FROM kullanicilar";
  $sifreQuery = mysqli_query($baglanti,$sifre);

  while ($sifreFetch = mysqli_fetch_array($sifreQuery)) {
   if ($_POST['kul_ad'] == $sifreFetch["k_kulad"]) {
     $sifre = $sifreFetch["k_sifre"];
     $k_id = $sifreFetch["k_id"];
   }
  }

  if (password_verify($_POST['kul_sifre'], $sifre)) {
    $_SESSION["kullanici"] = $_POST["kul_ad"];
    $_SESSION["kullanici_id"] = $k_id;
    header('LOCATION:index.php');
  }else{
    echo "<script type= 'text/javascript'>alert('Kullanıcı adı veya şifresi yanlış!');</script>";
  }
}
?>
<?php
include('templates/bottom.php');
?>
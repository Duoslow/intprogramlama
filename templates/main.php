<?php
session_start();
if(isset($_GET['logout'])) {
    $_SESSION['kullanici'] = '';
    $_SESSION['kullanici_id'] = '';
    header('LOCATION:index.php'); die();
}
?>
<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="navbar-nav">
      <nav>
        <ul class="nav-bar">
          <li><a href="index.php">anasayfa</a></li>
          <li><a href="istatistik.php">istatistik</a></li>
          
          <?php
           if($_SESSION['kullanici']){
            echo '<li><a href="kullanici.php">',$_SESSION['kullanici'],'</a></li>';
            echo'<li class="sag-nav"><a id="login" class="login"  href="?logout=1" name="login-link">çıkış</a></li>';
           }
           else {
            echo'<li><a href="kayit.php">kayıt</a></li>';
            echo' 	<li class="sag-nav"><a id="login" class="login" href="giris.php" onclick="button(this)" name="login-link">GİRİŞ</a></li>';
           }
           ?>
        </ul>
      </nav>
    </div>
    <div class="icerik">
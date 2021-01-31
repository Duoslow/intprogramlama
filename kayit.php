<?php
include('templates/main.php');
require_once("config.php");
?>
<div class="kutuphane kul-baslik">
  <form action="kayit_kul.php" method="post" class="kuldetay">
    <div>
      <span>
        Kullanıcı adı:
      </span>
      <span>
      <input type="text" name="k_kuladi"><br>
      </span>
    </div>
    <div>
      <span>
        Adı:
      </span>
      <span>
      <input type="text" name="k_adi"><br>
      </span>
    </div>
    <div>
      <span>
        Soyadı:
      </span>
      <span>
      <input type="text" name="k_soyadi"><br>
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
include('templates/bottom.php');
?>
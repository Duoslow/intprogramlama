<?php
include('templates/main.php');
require_once("config.php");
?>
<script type="text/javascript">
  function test1(val) {
    $.ajax({
      type: "POST",
      url: "/listeleme/ilcelist.php",
      data: 'il_id=' + val,
      success: function(data) {
        $("#ilceler").html(data);
      }
    });
  }

  function test2(val) {
    $.ajax({
      type: "POST",
      url: "/listeleme/unifakulte.php",
      data: 'uni_ad=' + val,
      success: function(data) {
        $("#fakulteler").html(data);
      }
    });
  }

  function test3(val, val2) {
    $.ajax({
      type: "POST",
      url: "/listeleme/unibolum.php",
      data: {
        'uni_ad': document.getElementById('uniler').value,
        'fakulte': val
      },
      success: function(data) {
        $("#bolumler").html(data);
      }
    });
  }
</script>
<form method="post" class="kuldetay">

  <div><span>Adınız:</span> <span><input type="text" name="k_adi" required></span></div>
  <div><span>Soyadınız:</span> <span><input type="text" name="k_soyadi" required></span></div>
  <div><span>Adres:</span>
    <span>
      <label for="il">İl:</label>
      <select name="k_il" id='il' onchange="test1(this.value)">
        <option value='0'>-</option>
        <?php
        require_once 'config.php';
        $sqli = "SELECT il_id,il FROM `iller` ORDER BY il_id";
        $result = mysqli_query($baglanti, $sqli);
        while ($row = mysqli_fetch_array($result)) {
          echo '<option value=' . $row['il_id'] . '>' . $row['il'] . '</option>';
        }
        ?>
      </select><br>
      <label for="ilceler">İlçe:</label>
      <select name="k_ilce" id="ilceler">
        <option value="">Lütfen önce il seçin!</option>
      </select><br>
      <label for="adres">Adres:</label><br><textarea rows="6" style="min-width: 300px;" type="text" id="adres" name="k_adres"></textarea>
    </span>
  </div>

  <div><span>Üniversite:</span>
    <span>
      <label for="uniler">Üniversite:</label>
      <select name="k_uni" id='uniler' onchange="test2(this.value)" style="width: 200px !important; min-width: 200px; max-width: 200px;">
        <option value='0'>-</option>
        <?php
        require_once 'config.php';
        $sqli = "select u_id,adi from uniler group by adi having count(*) >1 order by u_id";
        $result = mysqli_query($baglanti, $sqli);
        while ($row = mysqli_fetch_array($result)) {
          echo '<option value="' . $row['adi'] . '">' . $row['adi'] . '</option>';
        }
        ?>
      </select><br>
      <label for="fakulteler">Fakülte:</label>
      <select name="k_fakulte" id="fakulteler" onchange="test3(this.value)">
        <option value="-">Lütfen önce Üniversite seçin!</option>
      </select><br>
      <label for="bolumler">Bölüm:</label>
      <select name="k_bolum" id="bolumler">
        <option value="-">Lütfen önce fakülte seçin!</option>
      </select>
    </span>
  </div>

  <div><span>E-posta:</span><span> <input type="email" name="k_email"></span></div>
  <div><span>Telefon Numarası:</span><span> <input type="tel" placeholder="111-111-1111" name="k_telno"></span></div>
  <div><span>Cinsiyet</span>
    <span>
      <input type="radio" id="bay" name="k_cinsiyet" value="erkek">
      <label for="Erkek">Erkek</label>
      <input type="radio" id="bayan" name="k_cinsiyet" value="kadın">
      <label for="Kadın">Kadın</label>
      <input type="radio" id="diger" name="k_cinsiyet" value="Belirtmek İstemiyor">
      <label for="Belirtmek İstemiyor">Belirtmek İstemiyor</label>
    </span>
  </div>
  <div><span>Doğum Tarihi:</span><span> <input type="date" name="k_dogumtarihi"></span></div>
  <div><span>Doğum Yeri:</span><span> <input type="text" name="k_dogumyeri"></span></div>
  <div><span>Medeni Durum</span>
    <span>
      <input type="radio" id="Bekar" name="k_medeni" value="Bekar">
      <label for="Bekar">Bekar</label>
      <input type="radio" id="Evli" name="k_medeni" value="Evli">
      <label for="Evli">Evli</label>
      <input type="radio" id="Bosanmış" name="k_medeni" value="Bosanmış">
      <label for="Bosanmış">Boşanmış</label>
    </span>
  </div>
  <div><span>Ehliyet</span>
    <span>
      <input type="radio" id="Var" name="k_ehliyet" value="Var">
      <label for="Var">Var</label>
      <input type="radio" id="Yok" name="k_ehliyet" value="Yok">
      <label for="Yok">Yok</label>
    </span>
  </div>
  <button type="submit" id="kul_gnc" name="kul_gnc">Bilgilerimi Güncelle</button>
</form>
<a class="kuldetay" href="?hsil=1" style="float:right;color:red;">Hesabımı sil</a>
<?php
require_once 'config.php';
if (isset($_POST["kul_gnc"])) {
  $k_id = $_SESSION['kullanici_id'];
  $k_adi = $_POST["k_adi"];
  $k_soyadi = $_POST["k_soyadi"];
  $k_il = $_POST["k_il"];
  $k_ilce = $_POST["k_ilce"];
  $k_adres = $_POST["k_adres"];
  $k_uni = $_POST["k_uni"];
  $k_fakulte = $_POST["k_fakulte"];
  $k_bolum = $_POST["k_bolum"];
  $k_email = $_POST["k_email"];
  $k_telno = $_POST["k_telno"];
  $k_cinsiyet = $_POST["k_cinsiyet"];
  $k_dogumtarihi = $_POST["k_dogumtarihi"];
  $k_dogumyeri = $_POST["k_dogumyeri"];
  $k_medeni = $_POST["k_medeni"];
  $k_ehliyet = $_POST["k_ehliyet"];
  $k_foto = $_POST["k_foto"];
  
  $sqlsilme = "DELETE FROM kullanici_detaylari WHERE k_id = ".$k_id."";
  $silmeq = mysqli_query($baglanti, $sqlsilme);

  $sqli1 = "select u_id from uniler WHERE adi = '" . $_POST["k_uni"] . "' AND fakulte = '" . $_POST["k_fakulte"] . "' AND bolum = '" . $_POST["k_bolum"] . "'";
  $result1 = mysqli_query($baglanti, $sqli1);
  $row1 = mysqli_fetch_array($result1);


  $sql = "INSERT INTO kullanici_detaylari (k_id, k_adi, k_soyadi, k_il, k_ilce, k_adres, u_id, k_email, k_telno, k_cinsiyet, k_dogumtarihi, k_dogumyeri, k_medeni, k_ehliyet)
    VALUES ('" . $k_id . "' , '" . $k_adi . "' , '" . $k_soyadi . "' ,'" . $k_il . "' , '" . $k_ilce . "' , '" . $k_adres . "' , '" . $row1['u_id'] . "' , '" . $k_email . "' , '" . $k_telno . "' , '" . $k_cinsiyet . "' , '" . $k_dogumtarihi . "' , '" . $k_dogumyeri . "' , '" . $k_medeni . "' , '" . $k_ehliyet . "')";

  if ($baglanti->query($sql) === TRUE) {
    echo "<script type= 'text/javascript'>alert('Bilgiler Güncellendi');window.location.href = 'fotoyukle.php';</script>";
  } else {
    echo "<script type= 'text/javascript'>alert('Aynı Kullaniciyi Ekleyemezsin');window.location.href = 'kayit.php';</script>";
  }
  $baglanti->close();
}
if(isset($_GET['hsil'])) {
  $sqla = "DELETE FROM kullanicilar WHERE k_id='".$_SESSION['kullanici_id']."';";
  $sqla1 = "DELETE FROM kullanici_detaylari WHERE k_id='".$_SESSION['kullanici_id']."';";
  $sqla2 = "DELETE FROM kullanici_fotolar WHERE k_id='".$_SESSION['kullanici_id']."';";
  $sqla3 = "DELETE FROM main_chat WHERE c_kullanici='".$_SESSION['kullanici_id']."';";
  $sqla4 = "DELETE FROM profil_chati WHERE c_kullanici='".$_SESSION['kullanici_id']."';";
  $hesab_sil1 = $baglanti->query($sqla); 
  $hesab_sil2 = $baglanti->query($sqla1);  
  $hesab_sil3 = $baglanti->query($sqla2);  
  $hesab_sil4 = $baglanti->query($sqla3);      
  $hesab_sil5 = $baglanti->query($sqla4);  
  if($hesab_sil5->num_rows > 0){
  while($row = $hesab_sil5->fetch_assoc()) {
    $_SESSION['kullanici_id'] = '';
    $_SESSION['kullanici_adi'] = '';
    echo "<script type= 'text/javascript'>alert('Kullanici Silindi');window.location.href = 'giris.php';</script>";
    die();
    
  }
  }
  $_SESSION['kullanici_id'] = '';
  $_SESSION['kullanici_adi'] = '';
  echo "<script type= 'text/javascript'>alert('Kullanici Silindi');window.location.href = 'giris.php';</script>";
  die();
}

?>
<?php
include('templates/bottom.php');
?>
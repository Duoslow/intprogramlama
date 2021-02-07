<?php
include('templates/main.php');
require_once("config.php");
if ($_SESSION["kullanici_id"] == ""){
  header('LOCATION:giris.php'); die();
}
if(isset($_GET["p_name"])){
  $_SESSION['p_kullanici']=$_GET["p_name"];
}else{
  $_SESSION['p_kullanici']='';
  $_SESSION["p_kullanici_id"] = $_SESSION['kullanici_id'];
}
?>

<div id="kullanıcı_alani">
  <div class='kul_foto' >
  <script type="text/javascript">
      window.onload = function(){test22()};
          function test22() {
            $.ajax({
              type: "GET",
              url: "fotogetir.php",
              success: function(data) {
                $(".kul_foto").html(data);
              }
            });
          }
          function ajax(){
          var req=new XMLHttpRequest();
          req.onreadystatechange=function(){
          if(req.readyState==4 && req.status==200){
          document.getElementsByClassName('kul_foto').innerHTML=req.responseText;
            
        }

        }
        req.open('GET','fotogetir.php',true);
        req.send();
        }

	      </script>

  </div>
    <div style="display: flex; margin: 8px 0 8px 0;">
    <?php
          require_once 'config.php';
      if($_SESSION['p_kullanici']==''){
        $kulid = $_SESSION["kullanici_id"];
      }else{
        $sqla = "SELECT k_id FROM kullanicilar WHERE k_kulad='".$_SESSION['p_kullanici']."'";
        $profil_bilgi = $baglanti->query($sqla);   
        if($profil_bilgi->num_rows > 0){
          while($row = $profil_bilgi->fetch_assoc()) {
            $kulid = $row['k_id'];
          }
        }else
        {
          header('LOCATION:kullanici.php'); die();
        } 

      }
      $sql = "SELECT k_adi,k_soyadi FROM kullanici_detaylari WHERE k_id=".$kulid."";
      $kul_bilgiler = $baglanti->query($sql);    
      while($row = $kul_bilgiler->fetch_assoc()) {
        echo "<h1 style='margin-right: auto; font-size: 20px;'>".$row['k_adi']." ".$row['k_soyadi']."</h1>";
      }

        ?>
      
      <div>
        <a href="kullanici_bilgi.php">Bilgilerimi Güncelle</a><br>
        <a href="fotoyukle.php">Fotoğraf Güncelle</a>
      </div>
    </div>
    <hr style="margin-bottom: 8px;"></hr>
    <div class="kullanici-grid">
      <div class="kullanici-bilgi">
      <?php 
      require_once 'config.php';
      if($_SESSION['p_kullanici']==''){
        $kulid = $_SESSION["kullanici_id"];
      }else{
        $sqla = "SELECT k_id FROM kullanicilar WHERE k_kulad='".$_SESSION['p_kullanici']."'";
        $profil_bilgi = $baglanti->query($sqla);   
        if($profil_bilgi->num_rows > 0){
          while($row = $profil_bilgi->fetch_assoc()) {
            $kulid = $row['k_id'];
            $_SESSION["p_kullanici_id"] = $row['k_id'];
          }
        }else
        {
          header('LOCATION:kullanici.php'); die();
        } 

      }
      
      $sql = "SELECT k.*, il, ilce, adi, fakulte, bolum FROM iller, ilceler, kullanici_detaylari k join uniler u on k.u_id = u.u_id WHERE  k_id =".$kulid." AND k_il= il_id AND k_ilce=ilce_id GROUP BY k_id";
      $kul_bilgiler = $baglanti->query($sql);    
      while($row = $kul_bilgiler->fetch_assoc()) {
        echo "<span><label>Memleketi:</label> ".$row['il'].",".$row['ilce']."</span><br>";
        echo "<span><label>Doğum Yeri:</label> ".$row['k_dogumyeri']."</span><br>";
        echo "<span><label>Doğum Tarihi:</label>".$row['k_dogumtarihi']."</span><br>";
        echo "<span><label>E-posta:</label> <a href=mailto:".$row['k_email'].">".$row['k_email']."</a></span><br>";
        echo "<span><label>Telefon:</label> ".$row['k_telno']."</span><br>";
        echo "<span><label>Cinsiyet:</label> ".$row['k_cinsiyet']."</span><br>";
        echo "<span><label>Medeni Durum:</label> ".$row['k_medeni']."</span><br>";
        echo "<span><label>Ehliyet Durum:</label> ".$row['k_ehliyet']."</span><br><br>";
        echo "<span>".$row['adi']." ".$row['fakulte']." ".$row['bolum']." 'de Okuyor</span><br>";
      }
      
      ?>

      </div>
      <div style="height: 500px;">
        <div class="chat-main">
        </div>
        <form action="" method="post" style="height: 15%;">
        <div class="mesaj-alani">
        <script type="text/javascript">
          function test2() {
            $.ajax({
              type: "GET",
              url: "chat.php",
              success: function(data) {
                $(".chat-main").html(data);
              }
            });
          }
          function ajax(){
          var req=new XMLHttpRequest();
          req.onreadystatechange=function(){
          if(req.readyState==4 && req.status==200){
          document.getElementsByClassName('chat-main').innerHTML=req.responseText;
            
        }

        }
        req.open('GET','chat.php',true);
        req.send();
        }
	      setInterval(function(){test2()},1000);

	      </script>
          
          <input type="text" name="p_chat_icerik"placeholder="Mesaj..." />
          <button type="submit" name="p_chat" placeholder="Mesaj..." >Yolla</button>
          
          <?php
            require_once 'config.php';
            if (isset($_POST["p_chat"])){
                $p_chat_icerik = $_POST["p_chat_icerik"];	
                $c_kullanici = $_SESSION['kullanici'];

                if ($_SESSION["p_kullanici_id"]){
                  $c_hedef_k = $_SESSION["p_kullanici_id"];
                }else{
                  $c_hedef_k = $_SESSION['kullanici_id'];
                }
                
                $sql = "INSERT INTO profil_chati (c_kullanici, c_hedef_k, mesaj)
                VALUES ('".$_SESSION['kullanici_id']."','".$c_hedef_k."','".$p_chat_icerik."')";
              
                if ($baglanti->query($sql) === TRUE) {
                echo "<script type= 'text/javascript'>location.reload();return false;</script>";
                }
                else {
                echo "<script type= 'text/javascript'>alert('HATA');window.location.href = 'kullanici.php';</script>";
                }
                $baglanti->close();
            }

          ?>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
// echo $_SESSION["kullanici_id"];
include('templates/bottom.php');
?>
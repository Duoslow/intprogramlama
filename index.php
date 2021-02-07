<?php
include('templates/main.php');
require_once("config.php");
if ($_SESSION["kullanici_id"] == ""){
  header('LOCATION:giris.php'); die();
}
?>
    <div class="kullanici-grid">
      <div class="kullanici-bilgi">
          <span><h2 style="font-size: x-large;text-align: center;">Kullanicilar</h2></span>
      <?php 
      require_once 'config.php';
      $sql = "SELECT * FROM kullanicilar";
      $kul_bilgiler = $baglanti->query($sql);    
      while($row = $kul_bilgiler->fetch_assoc()) {
        echo "<span><a href='kullanici.php?p_name=".$row['k_kulad']."'>".$row['k_kulad']."</a></span><br>";
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
              url: "mainchat.php",
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
                $sql = "INSERT INTO main_chat (c_kullanici, mesaj)
                VALUES ('".$_SESSION['kullanici_id']."','".$p_chat_icerik."')";
              
                if ($baglanti->query($sql) === TRUE) {
                echo "<script type= 'text/javascript'>window.location.href = 'index.php';</script>";
                }
                else {
                echo "<script type= 'text/javascript'>alert('HATA');window.location.href = 'index.php';</script>";
                }
                $baglanti->close();
            }

          ?>
        </div>
        </form>
      </div>

<?php
include('templates/bottom.php');
?>
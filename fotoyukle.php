<?php
include('templates/main.php');
require_once("config.php");
?>
<form method="post" enctype="multipart/form-data" action ="" class="kuldetay">
  <div><span>Profil Fotoğrafı</span>
    <span>
    <input type="file" name="image">
    </span>
  </div>
  <button type="submit" id="foto_gnc" name="foto_gnc">Bilgilerimi Güncelle</button>
</form>
<?php
require_once 'config.php';
if (isset($_POST["foto_gnc"])) {
  $k_id = $_SESSION['kullanici_id'];
  $status = 'error'; 
  if(!empty($_FILES["image"]["name"])) { 
      $fileName = basename($_FILES["image"]["name"]); 
      $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
      $allowTypes = array('jpg','png','jpeg','gif'); 
      if(in_array($fileType, $allowTypes)){ 
          $image = $_FILES['image']['tmp_name']; 
          $imgContent = addslashes(file_get_contents($image)); 
          $sqlsilme = "DELETE FROM kullanici_fotolar WHERE k_id = ".$k_id."";
          $silme = mysqli_query($baglanti, $sqlsilme);
          $insert = $baglanti->query("INSERT into kullanici_fotolar (k_id, k_foto) VALUES ('$k_id','$imgContent')"); 
           
          if($insert){ 
              echo "<script type= 'text/javascript'>alert('Fotoğraf Güncellendi');window.location.href = 'kullanici.php';</script>";
          }else{ 
              echo "<script type= 'text/javascript'>alert('HATA Tekrar deneyiniz');</script>";
          }  
      }else{ 
          echo "<script type= 'text/javascript'>alert('Lütfen Sadece JPG,JPEG,PNG Yükleyin');</script>";
      } 
  }else{ 
    echo "<script type= 'text/javascript'>alert('Lütfen Fotoğraf seçin');</script>";
  } 
}

?>
<?php
include('templates/bottom.php');
?>
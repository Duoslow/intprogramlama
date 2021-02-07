<?php 
require_once 'config.php';
session_start();
    $result = $baglanti->query("SELECT k_foto FROM kullanici_fotolar WHERE k_id=".$_SESSION["p_kullanici_id"].""); 
     if($result->num_rows > 0){  
            while($row = $result->fetch_assoc()){ 
               echo" <img width='150' height='150' src='data:image/jpg;charset=utf8;base64,".base64_encode($row['k_foto'])."' /> ";
             } 
     }else{ 
       echo "<img width='150' height='150'  src='/assets/pp.png'></img>";
     } ?>
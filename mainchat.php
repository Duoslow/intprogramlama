<?php
require_once 'config.php';
session_start();


$sql = "SELECT main_chat.*, k1.k_kulad kaynak
FROM main_chat
JOIN kullanicilar as k1
ON k1.k_id = c_kullanici";

$kul_bilgiler = $baglanti->query($sql);    
while($row = $kul_bilgiler->fetch_assoc()) {
echo "<div class='chat-kutu1'><div>&#126;".$row['kaynak']."&#126;<br>".$row['mesaj']."</div></div>";

}

?>
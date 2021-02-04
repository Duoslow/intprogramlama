<?php
require_once 'config.php';
$sql = "SELECT * FROM profil_chati ORDER BY p_id ASC ";
$kul_bilgiler = $baglanti->query($sql);    
while($row = $kul_bilgiler->fetch_assoc()) {
echo "<div class='chat-kutu'><div>".$row['c_kullanici'].": ".$row['mesaj']."</div></div>";

}

?>
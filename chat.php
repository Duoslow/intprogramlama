<?php
require_once 'config.php';
session_start();


$sql = "SELECT profil_chati.*, k1.k_kulad kaynak, k2.k_kulad hedef
FROM profil_chati
JOIN kullanicilar as k1
ON k1.k_id = c_kullanici
JOIN kullanicilar as k2
ON k2.k_id = c_hedef_k
WHERE c_hedef_k = ".$_SESSION["p_kullanici_id"]."
ORDER BY p_id ASC ";

$kul_bilgiler = $baglanti->query($sql);    
while($row = $kul_bilgiler->fetch_assoc()) {
echo "<div class='chat-kutu'><div>&#126;".$row['kaynak']."&#126;<br>".$row['mesaj']."</div></div>";

}

?>
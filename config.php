<?php
$db_name = "intprog";
$db_uname = "root";
$db_pass = "UtsNrTHvWjd8J3A5";
$db_host = "127.0.0.1";
$baglanti = new mysqli($db_host, $db_uname, $db_pass, $db_name);
// Check connection
if ($baglanti->connect_error) {
  die("Connection failed: " . $baglanti->connect_error);
}

?>
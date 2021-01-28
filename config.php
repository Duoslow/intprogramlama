<?php
$db_name = "intprog";
$db_uname = "admin";
$db_pass = "admin123";
$db_host = "127.0.0.1";
$connection = mysqli_connect($db_host, $db_uname, $db_pass, $db_name) or die("connection failed 😡");
$connection->query("SET NAMES utf8");
?>
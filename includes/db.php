<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ecommerce_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}
?>

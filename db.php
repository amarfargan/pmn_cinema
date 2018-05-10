<?php
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("localhost", "root","" ,"movies");

if ($conn -> connect_error) {
  # code...
  die("koneksi gagal". $conn->connect_error);
}

 ?>

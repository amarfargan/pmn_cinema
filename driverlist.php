<?php
header("Access-Control-Allow-Origin: *");
$conn = new mysqli("localhost", "root","" ,"taxionline");

if ($conn -> connect_error) {
  # code...
  die("koneksi gagal". $conn->connect_error);
}
  $cari = $_GET['cari'];
  $sql = $conn->query("SELECT * FROM driver WHERE name LIKE '%".$cari."%' ORDER by name ASC");

  if($sql->num_rows>0){
          $drivers = array();
          $i = 0;
        while ($obj = $sql->fetch_assoc()) {
          $drivers[$i]['id'] = addslashes(htmlentities($obj['id']));
          $drivers[$i]['name'] = addslashes(htmlentities($obj['name']));
          $drivers[$i]['license'] = addslashes(htmlentities($obj['license']));
          $drivers[$i]['bod'] = addslashes(htmlentities($obj['bod']));
          $drivers[$i]['kind'] = addslashes(htmlentities ($obj['kind']));
          $drivers[$i]['brand'] = addslashes(htmlentities ($obj['brand']));
          $i++;

        }
}
echo json_encode($drivers);
$conn->close();
 ?>

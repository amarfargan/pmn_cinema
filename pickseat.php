<?php
require 'db.php';
if (isset($_POST['id_film'])) {
  $id_film = $_POST['id_film'];
  $id_jam = $_POST['jam'];


$sql =$conn->query("SELECT id_seat FROM ticket WHERE id_film = '$id_film' AND id_jam = '$id_jam' AND id_seat != '' ");

    if ($sql ->num_rows>0) {
      $array = array();
      while ($row = $sql->fetch_array()) {
        $array[] = $row['id_seat'];
      }
      //print_r($array);

      $result = implode(",.", $array);
      echo $result;

    }
}

 ?>

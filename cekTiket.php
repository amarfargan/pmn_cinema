<?php
require 'db.php';
$id = $_POST['id'];
$showtime = $_POST['pickshowtime'];
$numbticket = $_POST['numbticket'];

$sql = $conn->query("SELECT COUNT(id_film) AS jumlahSeatTerpilih FROM ticket
                                        WHERE id_film='$id' AND id_jam ='$showtime' AND id_seat != '' ");
if ($sql->num_rows>0) {
    while ($rows = $sql->fetch_array()) {

        $jumlahSeatTersedia = 15 - $rows['jumlahSeatTerpilih'];
        if ($numbticket > $jumlahSeatTersedia) {
          echo "Jumlah ticket yang dipilih melibihi jumlah seat yang tersedia ";
        }
        else {
          echo "";
        }
        //echo number_format($jumlahSeatTersedia);
      }

    }


 ?>

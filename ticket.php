<?php
      require 'db.php';
      date_default_timezone_set("Asia/Jakarta");

      $date = date("Y-m-d H:i:s");


        $email = $_POST['email'];
        $id_film = $_POST['id_film'];
        $id_jam = $_POST['jam'];
        $jmlTiket = $_POST['jmlTiket'];
        $seat = $_POST['seat'];
        $arrSeat = count($seat);
        for ($i=0; $i < $arrSeat ; $i++) {
            $id_seat = $conn->escape_string($seat[$i]);
            $sql = $conn->query("INSERT INTO ticket (`email`, `id_film`, `id_jam`, `jmlTicket`, `id_seat`, `date`)
                                                  VALUES ('$email', '$id_film', '$id_jam', '$jmlTiket', '$id_seat', '$date')");

        }
        if ($sql == true) {
          //$s = $conn->escape_string($seat[$i]);
          //$insert_toHistory  = $conn->query("INSERT INTO history(email, id_film, id_jam, jmlTiket, seat , 'date')
                                                                  //      VALUES ('$email', '$id_film', '$id_jam', '$jmlTiket', '$s', '$date') ");
          echo $date;
        }
        else {
          echo $conn->error;
        }
        //echo "INSERT INTO ticket (`email`, `id_film`, `id_jam`, `jmlTicket`, `id_seat`, `date`)
                                              //VALUES ('$email', '$id_film', '$id_jam', '$jmlTiket', '$arraySeat', '$date')";
        /*$sql = $conn->query("INSERT INTO ticket (`email`, `id_film`, `id_jam`, `jmlTicket`, `id_seat`, `date`)
                                              VALUES ('$email', '$id_film', '$id_jam', '$jmlTiket', '$arraySeat', '$date')");
        if ($sql == true) {
          echo "string";
        }
        else {
          echo $conn->error;
        }
          //$sql = $conn->query("")
          /*for ($count=0; $count < count($seat); $count++) {
            $seat_new = $seat[$count];
            echo $seat_new;
          }*/



 ?>

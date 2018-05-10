<?php
  require 'db.php';





 if (isset($_POST['id_film'])) {

      $id_film = $_POST['id_film'];
      $jam =  $_POST['jam'];
      $email = $_POST['email'];
      $date = $_POST['date'];

      $sql = $conn-> query("SELECT film.judul, ticket.date, ticket.jmlTicket, jam.waktu, seat.noKursi FROM(( ticket INNER JOIN film ON ticket.id_film = film.id) INNER JOIN jam ON ticket.id_jam = jam.id_jam) INNER JOIN seat ON ticket.id_seat = seat.id_seat
      WHERE id_film = '$id_film' AND ticket.id_jam = '$jam' AND email = '$email' AND date = '$date' ");


      if ($sql ->num_rows>0) {

          $data  = array();
          while ($row = $sql -> fetch_array()) {

                  $data[] = $row;
          }

          $count = count(array_column($data, 'noKursi'));
          $date  = $data[0]['date'];
          $newDate = date("j/m/Y", strtotime($date) );
          print_r('Your Ticket :
                    <h4 id="judul"> <b>'.$data[0]['judul'].'</b> </h4>
                    <p id="showdate">Show Date : '.$newDate.'</p>
                    <p id="showtime">Show Time : '.$data[0]['waktu'].'</p>
                    <p id="seat">Seat : ' .implode("," ,array_column($data, 'noKursi') ).'('.count(array_column($data, 'noKursi')).' tickets)</p>
                    <div class="row">
                      <button class="col button button-fill button-round back-home" >Back to Home</button>
                    </div>'
                  );
          $seat = implode("," ,array_column($data, 'noKursi') );

          $insert_toHistory = $conn->query("INSERT INTO history( email, id_film, id_jam, jmlTicket, seat, date)
                                                                 VALUES ( '$email', '$id_film', '$jam', '$count', '$seat ', '$date') ");

      }





  }
  $conn->close();

 ?>

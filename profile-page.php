<?php
require 'db.php';
if (isset($_POST['stat']) ) {

  if ( $_POST['stat'] == "edit-Profile") {

      $firstName = $_POST['fname'];
      $lastName = $_POST['lname'];
      $email = $_POST['email'];

      $update =  $conn->query("UPDATE users SET first_name = '$firstName' , last_name = '$lastName'
                                                    WHERE users.email = '$email' ");
      if ($update === TRUE) {
       echo "1";

  }
  else {
    echo $conn->error ;
  }
}

else if ( $_POST['stat'] == "history") {


  $email = $_POST['email'];

  $select = $conn->query("SELECT film.judul, history.date, history.jmlTicket, jam.waktu, history.seat
                                  FROM(( history INNER JOIN film ON history.id_film = film.id)
                                  INNER JOIN jam ON history.id_jam = jam.id_jam) WHERE email = '$email' " );
  if ($select->num_rows> 0 ) {
      $data = array();
      $i = 0;
      while ($row =  $select->fetch_assoc() ) {
            $date  = $row['date'];
            $newDate = date("j/m/Y H:i:s", strtotime($date) );
          $data[$i]['judul'] =  addslashes(htmlentities($row['judul']) );
          $data[$i]['date'] = addslashes(htmlentities($newDate) );
          $data[$i]['waktu'] =  addslashes(htmlentities($row['waktu']) );
          $data[$i]['seat'] = addslashes(htmlentities($row['seat']) );
          $data[$i]['jmlTicket'] = addslashes(htmlentities($row['jmlTicket']) );
          $i++;
      }
        echo json_encode($data);
    }
    else if($select->num_rows == 0) {

      echo "No Purchase History";
    }

  }


}
else {
  echo "string";
}

 ?>

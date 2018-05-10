<?php
include 'db.php';


if(isset($_GET['id_film'])){
  $id_film = $_GET['id_film'];
$sql = $conn->query("SELECT * FROM film WHERE id = '$id_film' ");

if ($sql->num_rows>0) {
    $data = array();
    $i = 0;
    while ($row = $sql->fetch_assoc() ) {
      $data[$i]['id'] = addslashes(htmlentities($row['id']));
      $data[$i]['judul'] = addslashes(htmlentities($row['judul']));
      $data[$i]['deskripsi'] = addslashes(htmlentities($row['deskripsi']));
      $data[$i]['gambar'] = addslashes(htmlentities($row['gambar']));
      $i++;
      /*echo '<div class="card demo-card-header-pic">
        <div style="background-image:url(http://localhost/pmn/'.$row['gambar'].')" class="card-header align-items-flex-end">'.$row['judul'].'</div>
        <div class="card-content card-content-padding">
          <p class="date">Showtime 13.00 | 15.30 | 18.00</p>
          <p>'.$row['deskripsi'].'</p>
        </div>
        <div class="card-footer"><a href="#" class="link">Buy Ticket</a></div>
    </div>';*/

    }
}
echo json_encode($data);
}
else {
  $id = $_POST['id'];
  $showtime = $_POST['pickshowtime'];
  $sql2= $conn->query("SELECT COUNT(id_film) AS jumlahSeatTerpilih FROM ticket
                                          WHERE id_film='$id' AND id_jam ='$showtime' AND id_seat != '' ");
  if ($sql2->num_rows>0) {
      while ($rows = $sql2->fetch_array()) {
        if ($rows['jumlahSeatTerpilih'] == 0) {
          echo number_format('15');
        }
        else {
          $jumlahSeatTersedia = 15 - $rows['jumlahSeatTerpilih'];

          echo number_format($jumlahSeatTersedia);
        }

      }
  }
}
$conn->close();


 ?>

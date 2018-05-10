<?php
include 'db.php';

$sql = $conn->query("SELECT * FROM film");

if ($sql->num_rows>0) {
    $data = array();
    $i = 0;
    while ($row = $sql->fetch_assoc() ) {
      $data[$i]['id'] = addslashes(htmlentities($row['id']));
      $data[$i]['judul'] = addslashes(htmlentities($row['judul']));
      $data[$i]['deskripsi'] = $row['deskripsi'];
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
$conn->close();


 ?>

<?php
  header("Access-Control-Allow-Origin: *");
  $conn = new mysqli("localhost", "root","" ,"taxionline");

  if ($conn -> connect_error) {
    # code...
    die("koneksi gagal". $conn->connect_error);
  }
  else {
    $name = $_POST['name'];
		$bod = $_POST['bod'];
		$license = $_POST['license'];
		$brand = $_POST['brand'];
		$kind = $_POST['kind'];
    $radio = $_POST['radio'];

    $sql = "INSERT INTO driver (id, name, bod, license, brand, kendaraan, kind)  VALUES ('','$name',
                '$bod', '$license', '$brand', '$radio', '$kind')";

        if ($conn ->query($sql) === TRUE) {
          echo "Sukses!";
        }
        else {
        echo  $conn->error;
        }
  }
  $conn->close();

 ?>

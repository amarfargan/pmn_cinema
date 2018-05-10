<?php
  require 'db.php';
    $email = "amar.fargan@gmail.com";
    $hash = $conn->escape_string(md5( rand(0,1000) ));


    $newpass = "fargan";
    for ($i=0; $i < 1; $i++) {
      # code...
      $pass = $conn->escape_string(password_hash($newpass[$i], PASSWORD_BCRYPT));

    }

    $sql =  $conn->query("UPDATE  users SET password= '$pass', active= 0 , hash= '$hash' WHERE email = '$email' ");
    if($sql === TRUE)
    {
      echo "1";
      $to  = $email;
      $subject = 'Account Verification ( u-movies.com )';
      $message_body = '

      Thank you for signing up!

      Please click this link to activate your account:

      http://localhost/pmn/verify.php?email='.$email.'&hash='.$hash;

      mail($email, $subject, $message_body);
    }
    else {
      echo $conn->error;
    }




 ?>

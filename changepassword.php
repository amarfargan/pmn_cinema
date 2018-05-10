<?php
  require 'db.php';
    $email = $_POST['email'];
    $hash = $conn->escape_string(md5( rand(0,1000) ));
  if (isset($_POST['currPass'])) {

    $currPass = $_POST['currPass'];

    $check_email = $conn->query("SELECT * FROM users WHERE email = '$email' ");

    while ($user = $check_email->fetch_assoc()) {
        if (password_verify($currPass, $user['password']) )
        {
            echo "string";
        }
        else
        {
            echo "Incorrect Password!";
        }
    }

  }
  else if(isset($_POST['newpassword'])){
    $newpass = $_POST['newpassword'];
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

      Please click this link to Confirm new password for  your account:

      http://localhost/pmn/verify-password.php?email='.$email.'&hash='.$hash;

      mail($email, $subject, $message_body);
    }
    else {
      echo $conn->error();
    }



  }

 ?>

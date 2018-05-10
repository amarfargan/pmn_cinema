<?php

require 'db.php';
$email = $conn->escape_string($_POST['email']);
$password = $conn->escape_string($_POST['password']);

$check_email = $conn->query("SELECT * FROM users WHERE email = '$email' ");

if ($check_email->num_rows == 0) {
    echo "User with that email doesn't exist!";
}
else {

  $data =  array();
  $i =0;

        while ($user = $check_email->fetch_assoc()) {
          if (password_verify($_POST['password'], $user['password']) )  {
                  $check_verify = $conn->query("SELECT active FROM users WHERE email ='$email' AND active != 0 ");
                  if ($check_verify->num_rows > 0) {
                    # code...

                    $data[$i]['email'] = addslashes(htmlentities($user['email']));
                    $data[$i]['first_name'] = addslashes(htmlentities($user['first_name']));
                    $data[$i]['last_name'] = addslashes(htmlentities($user['last_name']));
                    $i++;
                      echo json_encode($data);
                  }
                  else {
                    echo "Please verify your e-mail !!!";
                  }
          }
          else {
            echo "Incorrect Password!";
          }


}

}

 ?>

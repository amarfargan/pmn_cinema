<?php
include 'db.php';

$fname = $conn->escape_string($_POST['FirstName']);
$lname = $conn->escape_string($_POST['LastName']);
$email  = $conn->escape_string($_POST['email']);
$password = $conn->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $conn->escape_string(md5( rand(0,1000) ));


$check_email = $conn->query("SELECT * FROM users WHERE email = '$email' ");
if ($check_email->num_rows>0) {
  echo "User with this email already exists!";
}
else { //Email doesn't already exist in a database, proceed...
  $sql = "INSERT INTO users (first_name, last_name, email, password, hash)
               VALUES ('$fname', '$lname', '$email', '$password', '$hash' )";
    if ($conn->query($sql) === TRUE) {
        echo "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";
        $to  = $email;
        $subject = 'Account Verification ( u-movies.com )';
        $message_body = '
        Hello '.$fname.',

        Thank you for signing up!

        Please click this link to activate your account:

        http://localhost/pmn/verify.php?email='.$email.'&hash='.$hash;

        mail($to, $subject, $message_body);


    }
}
 ?>

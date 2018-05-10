<?php
require 'db.php';

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $conn->escape_string($_GET['email']);
    $hash = $conn->escape_string($_GET['hash']);

    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    {
        echo  "Account has already been activated or the URL is invalid!";


    }
    else {
        echo "Your account has been activated!";

        // Set the user status to active (active = 1)
        $conn->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);

    }
}
else {
    echo "Invalid parameters provided for account verification!";
    
}

 ?>

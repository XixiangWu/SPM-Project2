<?php
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // username and password sent from form 
        $u_username = $_POST['username'];
        $u_password = $_POST['password'];
        
        
        $sql = "SELECT * FROM user_db WHERE username = '$u_username' and password = '$u_password'";
        $result = mysqli_query($db,$sql);        
        
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        
        $count = mysqli_num_rows($result);
      
        // If result matched $u_username and $u_password, table row must be 1 row
        if($count == 1) {
            $_SESSION['login_user'] = $u_username;
            echo 'Login!';
        }else {
            echo 'error';
            $error = "Your Login Name or Password is invalid";
        }
        
    }

?>
<?php
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // username and password sent from form 
        $u_email = $_POST['email'];
        $u_username = $_POST['username'];
        $u_password = $_POST['password'];
        
        
        $sql = "SELECT * FROM user_db WHERE username = '$u_username'";
        $result = mysqli_query($db,$sql);        
        
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        
        $count = mysqli_num_rows($result);
              
        // If result matched $u_username and $u_password, table row must be 1 row
        if($count >= 1) {
            echo 'error';
            $error = "Duplicate Username";
        }else {
            $sql = "INSERT INTO `user_db` (`id`, `username`, `password`, `address`, `mobile_num`, `home_num`, `work_num`, `email`) VALUES (NULL, '$u_username', '$u_password', NULL, NULL, NULL, NULL, '$u_email');";
            mysqli_query($db, $sql);
            
            echo 'Registered';
            $_SESSION['login_user'] = $u_username;
        }
        
    }

?>
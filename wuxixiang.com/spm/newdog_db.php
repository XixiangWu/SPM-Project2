<?php
    include("session.php");
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $dob = $_POST['dob'];
        $dogname = $_POST['name'];
        $breed = $_POST['breed'];
        
        $dog_sql = "INSERT INTO `dog_db` (`id`, `name`, `breed`, `dob`, `owner`, `owner_id`) VALUES (NULL, '$dogname', '$breed', '$dob', '$login_session', '$login_id');";
        $result = mysqli_query($db,$dog_sql);
        
    }

?>
<?php
    include("session.php");
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if ($_POST['op'] == "READ") {
            
            $dog_id = $_POST['value'];
            $dog_sql = "SELECT * FROM dog_db WHERE id = '$dog_id'";
            $result = mysqli_query($db,$dog_sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

            $profilePack->dogname = $row['name'];
            $profilePack->dogbreed = $row['breed'];
            $profilePack->dogdob = $row['dob'];
            
            $profileJson = json_encode($profilePack);
            echo $profileJson;
        }
        
        if ($_POST['op'] == "MODI") {
            // Modify the user profile database
//            echo $_POST['address'];
            
            $dog_id = $_POST['value'];
            $new_name = $_POST['name'];
            $new_breed = $_POST['breed'];
            $new_dob = $_POST['dob'];
            
            $user_sql = "UPDATE `dog_db` SET `name` = '$new_name', `breed` = '$new_breed', `dob` = '$new_dob' WHERE `dog_db`.`id` = $dog_id";

            mysqli_query($db,$user_sql);     
            echo $user_sql;
            return;
        }
    }


?>
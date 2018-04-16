<?php
    include("session.php");
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        // Retrieve the user profile from the current login session.
        $profilePack->username = $login_session;
        $profilePack->id = $login_id;
        $profilePack->address = $login_address;
        $profilePack->home_num = $login_home_num;
        $profilePack->mobile_num = $login_mobile_num;
        $profilePack->home_num = $login_home_num;
        $profilePack->work_num = $login_work_num;
        $profilePack->email = $login_email;
            
        // Retrieve the dog profile based on the login session from dog_db in the server.
        $dog_sql = "SELECT * FROM dog_db WHERE owner_id = '$login_id'";
        $result = mysqli_query($db,$dog_sql);
        
        $row_count = mysqli_num_rows($result);
        $dogLst = array();
        
        // Read dogs' file into a array.
        for ($i = 0; $i < $row_count; $i++) {                    
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $dogLst[$i] = $row['name'];
//            echo $dogLst[$i];
        }
//        
        $profilePack->dog_list = $dogLst;
        
        $profileJson = json_encode($profilePack);
        echo $profileJson;
    }
?>
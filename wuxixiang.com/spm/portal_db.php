<?php
    include("session.php");
    include("dbconnect.php");
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if ($_POST['op'] == "READ") {
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
            $dog_sql = "SELECT * FROM dog_db";
            $result = mysqli_query($db,$dog_sql);

            $row_count = mysqli_num_rows($result);
            $dogLst = array();
            $dogBreedLst = array();
            $dogDobLst = array();

            // for convenience transformation from id to name
            $dog_id_rela = array();
                
            // Read dogs' file into an array.
            for ($i = 0; $i < $row_count; $i++) {                    
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $dog_id_rela[$row['id']] = $row['name'];
                $dogLst[$i] = $row['name'];
                $dogBreedLst[$i] = $row['breed'];
                $dogDobLst[$i] = $row['dob'];
            }
            
            // add all dogs information to json
            $profilePack->no_dog = $row_count;
            $profilePack->dogLst = $dogLst;
            $profilePack->dogBreedLst = $dogBreedLst;
            $profilePack->dogDobLst = $dogDobLst;
            
                        
            $appointment_sql = "SELECT * FROM appointment_db";
            $appointment_result = mysqli_query($db,$appointment_sql);
            $no_app = mysqli_num_rows($appointment_result);
            
            
            // retrieve appointment data from database
            $appIdLst = array();
            $appDogLst = array();
            $appTimeLst = array();
            $appOptLst = array();
            $appNoteLst = array();
            
            // Read appointment file into an array
             for ($i = 0; $i < $no_app; $i++) {                    
                $row = mysqli_fetch_array($appointment_result,MYSQLI_ASSOC);
                
                $c_dog_id = $row['dog_id'];

                $appIdLst[$i] = $row['id'];
                $appDogLst[$i] = $dog_id_rela[$c_dog_id];
                $appOptLst[$i] = $row['groom_opt'];
                $appTimeLst[$i] = $row['time'];
                $appNoteLst[$i] = $row['note'];
            }
            
            $profilePack->no_app = $no_app;
            $profilePack->appIdLst = $appIdLst;
            $profilePack->appDogLst = $appDogLst;
            $profilePack->appTimeLst = $appTimeLst;
            $profilePack->appOptLst = $appOptLst;
            $profilePack->appNoteLst = $appNoteLst;
            
            
            $profileJson = json_encode($profilePack);
            echo $profileJson;
            return;
        }
        
    }


?>
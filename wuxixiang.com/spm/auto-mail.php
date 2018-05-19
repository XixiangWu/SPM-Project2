<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
    include("session.php");
    include("dbconnect.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

//    $profilePack->username = $login_session;
//    $profilePack->id = $login_id;
//    $profilePack->address = $login_address;
//    $profilePack->home_num = $login_home_num;
//    $profilePack->mobile_num = $login_mobile_num;
//    $profilePack->home_num = $login_home_num;
//    $profilePack->work_num = $login_work_num;
//    $profilePack->email = $login_email;
//
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
        $dogIdLst[$i] = $row['id'];
        $dogLst[$i] = $row['name'];
        $dogBreedLst[$i] = $row['breed'];
        $dogDobLst[$i] = $row['dob'];
    }

    // add all dogs information to json
    $profilePack->no_dog = $row_count;
    $profilePack->dogLst = $dogLst;
    $profilePack->dog_id_rel_lst = $dog_id_rela;
    $profilePack->dogIdLst = $dogIdLst;
    $profilePack->dogBreedLst = $dogBreedLst;
    $profilePack->dogDobLst = $dogDobLst;


    $appointment_sql = "SELECT * FROM appointment_db";
    $appointment_result = mysqli_query($db,$appointment_sql);
    $no_app = mysqli_num_rows($appointment_result);


    // retrieve appointment data from database
    $appDogLst = array();
    $appTimeLst = array();
    $appOptLst = array();
    $appNoteLst = array();

    // Read appointment file into an array
     for ($i = 0; $i < $no_app; $i++) {                    
        $row = mysqli_fetch_array($appointment_result,MYSQLI_ASSOC);
         
        $user_idLst[$i] = $row['user_id'];
         
        $c_dog_id = $row['dog_id'];
        $appDogLst[$i] = $dog_id_rela[$c_dog_id];
        $appOptLst[$i] = $row['groom_opt'];
        $appTimeLst[$i] = $row['time'];
        $appNoteLst[$i] = $row['note'];
    }


    $profilePack->no_app = $no_app;
    $profilePack->appDogLst = $appDogLst;
    $profilePack->appTimeLst = $appTimeLst;
    $profilePack->appOptLst = $appOptLst;
    $profilePack->appNoteLst = $appNoteLst;


    $profileJson = json_encode($profilePack);
    echo $profileJson.'<br>';

    
    // check against the current time
    date_default_timezone_set("Australia/Melbourne");
    $c_dateTime = date('Y-m-d H', strtotime(' +1 day '));
//    $c_dateTime = date('Y-m-d H', strtotime(' +7 hours '));
    
    echo $c_dateTime;

    $index = 0;
    $needNotify = 0;
    $target_email = "";
    $mailBody = "";

    for ($i = 0; $i < $no_app; $i++) {
        if ($c_dateTime == substr($appTimeLst[$i],0,13)){
            $index = $i;
            $needNotify = 1;
            echo substr($appTimeLst[$i],0,13);
            break;
        }
    }

    if ($needNotify) {
        
        $user_id = $user_idLst[$index];
        $noti_sql = mysqli_query($db,"SELECT * FROM user_db WHERE id = '$user_id'");
        $row = mysqli_fetch_array($noti_sql,MYSQLI_ASSOC);
        $target_username = $row['username'];
        $target_email = $row['email'];
        
        $mailBody = "Dear $target_username,<br>
        This email is an automatically reminder. <br>
        You have an appointment at tomorrow $c_dateTime. <br>
        <br>
        Sincerely,<br>
        Melbourne Dog Clinic<br>
        ";
        
        
        echo $target_email.'<br>';
        echo $target_username.'<br>';
        echo $mailBody.'<br>';
        
    }


// Check if there is a appointment in approaching
if (!$needNotify) {
//if (1) {
    echo "not yet";
    return;
} else {

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'sub5.mail.dreamhost.com';              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@wuxixiang.com';                 // SMTP username
        $mail->Password = 'xindefengbao12';                           // SMTP password
    //    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('info@wuxixiang.com', 'Melbourne Dog Clinic | SPM ass2');
        $mail->addAddress($target_email);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'AutoReminder from Melbourne DogClinic Pty Ltd.';
        $mail->Body    = $mailBody;
        $mail->AltBody = $mailBody;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
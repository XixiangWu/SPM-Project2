<?php
   include('dbconnect.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from user_db where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   

    // Retrieve all te data that will be used from the database.

    // ================= User Data ===================
    $login_session = $row['username'];
    $login_id = $row['id'];
    $login_address = $row['address'];
    $login_mobile_num = $row['mobile_num'];
    $login_home_num = $row['home_num'];
    $login_work_num = $row['work_num'];
    $login_email = $row['email'];
    // ================= User Data ===================

   if(!isset($_SESSION['login_user'])){
      header("location: login.php");
   }
?>
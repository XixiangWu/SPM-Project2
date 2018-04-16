<?php
   include('session.php');
    
?>
    <html>
    <?php include_once('navbar.php'); ?>

        <head>
            <title>Welcome </title>
        </head>

        <body>
            <h1>Welcome <?php echo $login_session; ?></h1>
            <h2><a href = 'user_profile.php'/> Edit user profile </h2>
            <h2><a href = "logout.php">Sign Out</a></h2> </body>

    </html>
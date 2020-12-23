<?php
    require('connection.php');

    session_start();
    //If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['member_id'])){
        header("location:access-denied.php");
    }
?>
<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link href="css/user_styles.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <center><b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
        <div id="page">
            <div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">STUDENT HOME </h1>
                <a href="student.php" style="font-size:20px;">Home</a> |
        <a href="vote.php" style="font-size:20px;">Current Polls</a> |
        <a href="manage-profile.php" style="font-size:20px;">Manage My Profile</a>
        | <a href="changepass.php" style="font-size:20px;">Change Password</a>|
        <a href="logout.php" style="font-size:20px;">Logout</a>
            </div>
            <div id="container">
            <p style="font-size: 24px;"> Click a link above to do some stuff.</p>
            </div>
            <div id="footer">
                <!----->
            </div>
        </div>
    </body>
</html>
<?php
    session_start();
    require('../connection.php');
    //If your session isn't valid, it returns you to the login screen for protection
    if(empty($_SESSION['admin_id'])){
        header("location:access-denied.php");
    }
?>

<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body bgcolor="tan">
        <center><a href ="admin.php"><img src = "images/vitlogo.png" width="100px" alt="site logo"></a></center><br>     
        <center><b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
        <div id="page">
            <div id="header" style="font-size:20px;color:white">
                <h1 style="padding: 20px;">ADMINISTRATION CONTROL PANEL </h1>
                <a href="admin.php" style="font-size:20px;">Home</a> | 
                <a href="positions.php" style="font-size:20px;">Manage Positions</a> | 
                <a href="candidates.php" style="font-size:20px;">Manage Candidates</a> | 
                <a href="refresh.php" style="font-size:20px;">Poll Results</a>| 
                <a href="manage-admins.php" style="font-size:20px;">Manage Account</a>| 
                <a href="change-pass.php" style="font-size:20px;">Change Password</a>| 
                <a href="logout.php" style="font-size:20px;">Logout</a>
            </div>
            <p align="center">&nbsp;</p>

            <div id="container">
                <p>Click a link above to perform an administrative operation.</p>
            </div>
            
            <div id="footer">
                <!----->
            </div>
        </div>
    </body>
</html>
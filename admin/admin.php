<?php
session_start();
require('../connection.php');
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}
?>
<html><head>
<link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
</head><body bgcolor="tan">
<center><b><font color = "black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
<div id="page">
<div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">ADMINISTRATION CONTROL PANEL </h1>
    <a href="student.php" style="font-size:20px;">Home</a> | 
    <a href="vote.php" style="font-size:20px;">Current Polls</a> | 
    <a href="manage-profile.php" style="font-size:20px;">Manage My Profile</a> | 
    <a href="changepass.php" style="font-size:20px;">Change Password</a>| 
    <a href="logout.php" style="font-size:20px;">Logout</a></div>
<p align="center">&nbsp;</p>
<div id="container">

<p style="font-size:16px">Click a link above to perform an administrative operation.</p>


</div>
</div>
</body></html>
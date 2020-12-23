<?php
session_start();
require('connection.php');

//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['member_id'])){
 header("location:access-denied.php");
} 
//retrive student details from the tbmembers table
$result=mysqli_query($con, "SELECT * FROM tbMembers WHERE member_id = '$_SESSION[member_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $stdId = $row['member_id']; 
  $encpass= $row['password'];
}
?>
<?php
// updating sql query
if (isset($_POST['changepass'])){
$myId =  $_REQUEST['id'];
$oldpass = md5($_POST['oldpass']);
$newpass = $_POST['newpass'];
$conpass = $_POST['conpass'];
if($encpass == $oldpass)
{
  if($newpass == $conpass)
  {
    $newpassword = md5($newpass); //This will make your password encrypted into md5, a high security hash
    $sql = mysqli_query($con,"UPDATE tbmembers SET password='$newpassword' WHERE member_id = '$myId'" );
    echo "<script>alert('Password Change')</script>";
  }
  else
  {
    echo "<script>alert('New and Confirm Password Not Match')</script>";
  }

}
else
{
    echo "<script>alert('Old password not match')</script>";
}


// redirect back to profile
// header("Location: manage-profile.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<title>VI-Voting Platform</title>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
</script>
</head>
<body bgcolor="tan">
     
<center><b><font color = "black" size="6">VI-Voting Platform</font></b></center><br><br>
<div id="page" style="width: 800px; padding-bottom: 50px;">
<div id="header" style="font-size:20px;padding: 20px;color: white">
  <h1 style="padding-bottom: 20px;">MANAGE MY PROFILE</h1>
  <a href="student.php" style="font-size:20px">Home</a> | 
  <a href="vote.php" style="font-size:20px">Current Polls</a> | 
  <a style="font-size:20px" href="manage-profile.php">Manage My Profile</a> | 
  <a href="changepass.php" style="font-size:20px">Change Password</a>| 
  <a href="logout.php" style="font-size:20px">Logout</a>
</div>
<div id="container">
<table border="0" width="620" align="center">
<CAPTION><h2>CHANGE PASSWORD</h2></CAPTION>
<form action="changepass.php?id=<?php echo $_SESSION['member_id']; ?>" method="post">
<table align="center">
<tr><td style="font-size:14px">Old Password:</td><td><input class="effect-2" type="password" name="oldpass" maxlength="5" value=""></td></tr>
<tr><td style="font-size:14px">New Password:</td><td><input class="effect-2" type="password" name="newpass" maxlength="5" value=""></td></tr>
<tr><td style="font-size:14px">Confirm New Password:</td><td><input class="effect-2" type="password" name="conpass" maxlength="15" value=""></td></tr>
<tr><td>&nbsp;</td></td><td><input class="butn" type="submit" name="changepass" value="Update Profile"></td></tr>
</table>
</form>
</div>
</div>
</body>
</html>
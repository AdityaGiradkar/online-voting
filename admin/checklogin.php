<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>VI-Voting Platform Access Denied</title>
    <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
  </head>

  <body bgcolor="tan">
    <center><b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>

    <div id="page">
      <div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">Invalid Credentials Provided </h1>
        <p align="center">&nbsp;</p>
      </div>

      <div id="container">
        <?php
          ini_set ("display_errors", "1");
          error_reporting(E_ALL);

          ob_start();
          session_start();
          require('../connection.php');

          $tbl_name="tbAdministrators"; // Table name


          // Defining your login details into variables
          $myusername=$_POST['myusername'];
          $mypassword=$_POST['mypassword'];

          $encrypted_mypassword=$mypassword; //MD5 Hash for security

          // MySQL injection protections
          $myusername = stripslashes($myusername);
          $mypassword = stripslashes($encrypted_mypassword);


          $sql=mysqli_query($con, "SELECT * FROM tbadministrators WHERE email='$myusername' and password='$mypassword'");
          // Checking table row
          $count = mysqli_num_rows($sql);

          // If username and password is a match, the count will be 1
          if($count){
          // If everything checks out, you will now be forwarded to admin.php
            $user=mysqli_fetch_assoc($sql); 
            $_SESSION['admin_id'] = $user['admin_id'];
            header("location:admin.php");
          }
          //If the username or password is wrong, you will receive this message below.
          else {
            echo "Wrong Username or Password<br><br>Return to <a href=\"login.html\">login</a>";
          }
            
          ob_end_flush();
        ?> 
      </div>

      <div id="footer"> 
        <!----->
      </div>
    </div>
  </body>
</html>
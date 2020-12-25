<?php 
  if(isset($_POST['myusername']) && isset($_POST['mypassword'])){
?>
<!DOCTYPE html>
<html>
  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>VI-Voting Platform Access Denied</title>
    <link href="css/user_styles.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
  <center>
      <a href="https://www.vit.edu"
        ><img src="images/vitlogo.png" width="40px" alt="site logo"
      /></a>
      <br />
    </center>
    <center>
      <br />
      <img src="images/graphic.jpg" class="imgae" width="30%" />

      <br />

      <b>
        <font
          size="6"
          style="font-size: 46px; color: black; font-family: Helvetica, sans-serif"
        >
          VI-Voting Platform
        </font>
      </b>
    </center><br><br>
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
        require('connection.php');


        // Defining your login details into variables
        $myusername=$_POST['myusername'];
        $mypassword=$_POST['mypassword'];

        $encrypted_mypassword=md5($mypassword); //MD5 Hash for security
        // MySQL injection protections
        $myusername = stripslashes($myusername);
        echo $mypassword = stripslashes($mypassword);
        

        $sql=mysqli_query($con, "SELECT * FROM tbmembers WHERE `email`='$myusername' and `password`='$encrypted_mypassword'");

        // Checking table row
        $count = mysqli_num_rows($sql);
        // If username and password is a match, the count will be 1

        if($count == 1){
          // If everything checks out, you will now be forwarded to student.php
          $user = mysqli_fetch_assoc($sql);
          $_SESSION['member_id'] = $user['member_id'];
          header("location:student.php");
        }
        //If the username or password is wrong, you will receive this message below.
        else {
        echo "Wrong Username or Password<br><br>Return to <a href=\"index.html\">login</a>";
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
<?php 
  }else{
    echo "<script>
            alert('Invalid access.');
            window.location.href='index.html';
          </script>";
  }
?>
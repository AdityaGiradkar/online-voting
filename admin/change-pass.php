<?php
    session_start();
    require('../connection.php');
?>

<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="js/admin.js"></script>
    </head>
    
    <body bgcolor="tan">
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

            <div id="container">
                <?php
                    //If your session isn't valid, it returns you to the login screen for protection
                    if(empty($_SESSION['admin_id'])){
                        header("location:access-denied.php");
                    }

                    //fetch data for update file
                    $result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
                    if (mysqli_num_rows($result)<1){
                        $result = null;
                    }
                    $row = mysqli_fetch_array($result);
                    if($row){
                        // get data from db
                        $encPass = $row['password'];
                    }

                    //Process
                    if (isset($_GET['id']) && isset($_POST['update'])){
                        $myId = addslashes( $_GET['id']);
                        $mypassword = md5($_POST['oldpass']);
                        $newpass= $_POST['newpass'];
                        $confpass= $_POST['confpass'];
                        if($encPass==$mypassword){
                            if($newpass==$confpass){
                                $newpass = md5($newpass); //This will make your password encrypted into md5, a high security hash
                                $sql = mysqli_query($con, "UPDATE tbadministrators SET password='$newpass' WHERE admin_id = '$myId'" );
                                echo "<script>alert('Your password updated');</script>";
                            } else {
                                echo "<script>alert('Your new pass and confirm pass not match');</script>";
                            }    
                        } else {
                            echo "<script>alert('Your old pass not match');</script>";
                        }
                    }
                ?>

                <table align="center">
                    <form action="change-pass.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
                        <CAPTION><h4>CHANGE PASSWORD</h4></CAPTION>
                        <table align="center">  
                            <tr>
                                <td style="font-size:14px">Old Password:</td>
                                <td><input type="password" class="effect-2" name="oldpass" maxlength="15" value=""></td>
                            </tr>
                            <tr>
                                <td style="font-size:14px">New Password:</td>
                                <td><input type="password" class="effect-2" name="newpass" maxlength="15" value=""></td>
                            </tr>
                            <tr>
                                <td style="font-size:14px">Confirm Password:</td>
                                <td><input type="password" class="effect-2" name="confpass" maxlength="15" value=""></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" class="butn"  name="update" value="Update Account"></td>
                            </tr>
                        </table>
                    </form>
                </table>
            </div>

            <div id="footer">
                <!----->
            </div>
        </div>
    </body>
</html>
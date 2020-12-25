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
    
    <body>
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
                        $adminId = $row['admin_id'];
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];
                        $email = $row['email'];
                    }

                    //Process
                    if (isset($_GET['id']) && isset($_POST['update'])){
                        $myId = addslashes( $_GET['id']);
                        $myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
                        $myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
                        $myEmail = $_POST['email'];

                        $sql = mysqli_query($con, "UPDATE tbAdministrators SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail' WHERE admin_id = '$myId'" );
                    }
                ?>
                <table align="center">
                    <form action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
                        <CAPTION><h4>UPDATE ACCOUNT</h4></CAPTION>    
                        <table align="center">
                            <tr>
                                <td style="font-size:14px">First Name:</td>
                                <td><input type="text" class="effect-2" name="firstname" maxlength="15" value="<?php echo $firstName ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-size:14px">Last Name:</td>
                                <td><input type="text" class="effect-2" name="lastname" maxlength="15" value="<?php echo $lastName ?>"></td>
                            </tr>
                            <tr>
                                <td style="font-size:14px">Email Address:</td>
                                <td><input type="text" class="effect-2" name="email" maxlength="100" value="<?php echo $email?>"></td>
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
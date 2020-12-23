<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link href="css/user_styles.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" src="js/user.js"></script>
    </head>
    
    <body bgcolor="tan">
        <center><b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
        <div id="page">
            <div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">Student Registration </h1>
                <div class="news">
                    <!----->
                </div>
            </div>

            <div id="container">
            <?php
                require('connection.php');
                //Process
                if (isset($_POST['submit']))
                {

                    $myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
                    $myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
                    $myEmail = $_POST['email'];
                    $myPassword = $_POST['password'];

                    $newpass = md5($myPassword); //This will make your password encrypted into md5, a high security hash

                    $register = "INSERT INTO tbMembers(`first_name`, `last_name`, `email`, `password`) 
                                VALUES ('$myFirstName', '$myLastName', '$myEmail', '$newpass')";
                    $sql = mysqli_query($con, $register);

                    die( "You have registered for an account.<br><br>Go to <a href=\"index.php\">Login</a>" );
                }
                ?>
                <h3 style="text-align:center;">Register an account by filling in the needed information below:</h3><br><br>
                <form action="registeracc.php" method="post" onsubmit="return registerValidate(this)">
                    <table align="center">
                        <tr>
                            <td>First Name:</td>
                            <td><input class="effect-2" type='text' style='background-color:#999999; font-weight:bold;' name='firstname' maxlength='15' value=''></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><input class="effect-2" type='text' style='background-color:#999999; font-weight:bold;' name='lastname' maxlength='15' value=''></td>
                        </tr>
                        <tr>
                            <td>Email Address:</td>
                            <td><input class="effect-2" type='email' style='background-color:#999999; font-weight:bold;' pattern="[a-z0-9._%+-]+@vit\.edu$" name='email' maxlength='100' id='email'value=''>
                            <small><span id='result' style='color:red;'></span></small></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input class="effect-2" type='password' style='background-color:#999999; font-weight:bold;' name='password' maxlength='15' value=''></td>
                        </tr>
                        <tr>
                            <td>Confirm Password:</td>
                            <td><input class="effect-2" type='password' style='background-color:#999999; font-weight:bold;' name='ConfirmPassword' maxlength='15' value=''></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input class="butn" type='submit' name='submit' value='Register Account'/></td>
                        </tr>
                        <tr>
                            <td colspan = '2'><p>Already have an account? <a href='index.html'><b>Login Here</b></a></td>
                        </tr>
                    </table>
                </form>
            </div> 


            <div id="footer">
                <!----->
            </div>
        </div>
    </body>

    <script src="js/jquery-1.2.6.min.js"></script>

    <script>

        //check if email id already present or not 
        $(document).ready(function(){
            $('#email').blur(function(event){
                event.preventDefault();
                var emailId = $('#email').val();
                $.ajax({url:'checkuser.php',
                        method:'post',
                        data:{email:emailId},  
                        dataType:'html',
                        success:function(message)
                        {
                            $('#result').html(message);
                        }
                });
            });
        });
    </script>
</html>
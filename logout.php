<?php
    session_start();
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
    <h1 style="padding: 20px;">Logged Out Successfully </h1>
                <p align="center">&nbsp;</p>
            </div>

            <?php
                session_destroy();
            ?>
            You have been successfully logged out.<br><br>
            Return to <a href="index.php">Login</a>
            <div id="footer">
                <!----->
            </div>
        </div>
    </body>
</html>
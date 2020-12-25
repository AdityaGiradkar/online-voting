<html>
    <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <center><b><font color = "black" size="6">VI-Voting Platform</font></b></center><br><br>
        <div id="page">
            <div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">Logged Out Successfully </h1>
                <p align="center">&nbsp;</p>
            </div>
            <?
            session_start();
            session_destroy();
            ?>
            You have been successfully logged out of your control panel.<br><br><br>
            Return to <a href="login.html">Login</a>
            <div id="footer">
                <!----->
            </div>
        </div>
    </body>
</html>
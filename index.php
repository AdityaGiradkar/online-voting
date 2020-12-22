<html><head>
<link href="css/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="js/user.js">
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
</script>
</head>
<body bgcolor="#e6e6e6";>

<center><b><font color = "black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
<div id="page">
<div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">Student Login </h1></div>
<div id="container">
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<form name="form1" method="post" action="checklogin.php" onSubmit="return loginValidate(this)">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="tan">
<tr>
<td width="78" style="font-size:14px">Username/Email</td>
<td width="6">:</td>
<td width="294"><input class="effect-2" name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td style="font-size:14px">Password</td>
<td>:</td>
<td><input class="effect-2" name="mypassword" type="password" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input class="butn" type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<center>
<br>Not yet registered? <a href="registeracc.php"><b>Register Here</b></a>
</center>
</div>
</div>
</body></html>
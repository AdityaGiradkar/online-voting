<?php
  require('../connection.php');
  // retrieving candidate(s) results based on position
  if (isset($_POST['Submit'])){   
    $position = addslashes( $_POST['position'] );
    
    $results = mysqli_query($con, "SELECT * FROM `tbCandidates` where `candidate_position`='$position'");

    $row1 = mysqli_fetch_array($results); // for the first candidate
    $row2 = mysqli_fetch_array($results); // for the second candidate
    if ($row1){
      $candidate_name_1=$row1['candidate_name']; // first candidate name
      $candidate_1=$row1['candidate_cvotes']; // first candidate votes
    }

    if ($row2){
      $candidate_name_2=$row2['candidate_name']; // second candidate name
      $candidate_2=$row2['candidate_cvotes']; // second candidate votes
    }
  }
?> 

<?php
  // retrieving positions sql query
  $positions=mysqli_query($con, "SELECT * FROM tbPositions");
?>

<?php
  session_start();
  //If your session isn't valid, it returns you to the login screen for protection
  if(empty($_SESSION['admin_id'])){
  header("location:access-denied.php");
  }
?>

<?php if(isset($_POST['Submit'])){$totalvotes=$candidate_1+$candidate_2;} ?>

<html>
  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="js/admin.js"></script>
  </head>
  
  <body>
    <center><b><font color = "black" size="6">VI-Voting Platform</font></b></center><br><br>
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
        <form name="fmNames" id="fmNames" method="post" action="refresh.php" onSubmit="return positionValidate(this)">
          <table width="420" align="center">
            <tr>
              <td>Choose Position</td>
              <td>
                <SELECT NAME="position" id="position">
                  <option VALUE="select">select</option>
                  <?php 
                    //loop through all table rows
                    while ($row=mysqli_fetch_array($positions)){
                      echo "<option VALUE=$row[position_name]>$row[position_name]</option>"; 
                    }
                  ?>
                </SELECT>
              </td>
              <td><input type="submit" class="butn"  name="Submit" value="See Results" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td> 
              <td>&nbsp;</td>
            </tr>
          </table>
        </form> 

        <?php if(isset($_POST['Submit'])){echo $candidate_name_1;} ?>:<br>
<img src="images/candidate-1.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>'
height='20'>
<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_1/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_1;} ?>
<br>
<br>
<?php if(isset($_POST['Submit'])){ echo $candidate_name_2;} ?>:<br>
<img src="images/candidate-2.gif"
width='<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>'
height='20'>
<?php if(isset($_POST['Submit'])){ if ($candidate_2 || $candidate_1 != 0){echo(100*round($candidate_2/($candidate_2+$candidate_1),2));}} ?>% of <?php if(isset($_POST['Submit'])){echo $totalvotes;} ?> total votes
<br>votes <?php if(isset($_POST['Submit'])){ echo $candidate_2;} ?>
</div>
<div id="footer">
<!----->
</div>
</div>
</body></html>
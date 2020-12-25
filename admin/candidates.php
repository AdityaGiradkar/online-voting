<?php
  session_start();
  require('../connection.php');
  //If your session isn't valid, it returns you to the login screen for protection
  if(empty($_SESSION['admin_id'])){
    header("location:access-denied.php");
  } 
  //retrive candidates from the tbcandidates table
  $result=mysqli_query($con,"SELECT * FROM tbCandidates");
  if (mysqli_num_rows($result)<1){
      $result = null;
  }
?>

<?php
  // retrieving positions sql query
  $positions_retrieved=mysqli_query($con, "SELECT * FROM tbPositions");
  
?>

<?php
// inserting sql query
if (isset($_POST['Submit'])){
  $newCandidateName = addslashes( $_POST['name'] ); //prevents types of SQL injection
  $newCandidatePosition = addslashes( $_POST['position'] ); //prevents types of SQL injection

  $sql = mysqli_query($con, "INSERT INTO tbCandidates(candidate_name,candidate_position) VALUES ('$newCandidateName','$newCandidatePosition')" );

  // redirect back to candidates
  header("Location: candidates.php");
}
?>

<?php
  // deleting sql query
  // check if the 'id' variable is set in URL
  if (isset($_GET['id']))
  {
    // get id value
    $id = $_GET['id'];
    
    // delete the entry
    $result = mysqli_query($con, "DELETE FROM `tbCandidates` WHERE `candidate_id`='$id'");
    
    // redirect back to candidates
    header("Location: candidates.php");
  }
     
?>


<!DOCTYPE html >
<html>
  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Administration Control Panel: Candidates</title>
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
        <form name="fmCandidates" id="fmCandidates" action="candidates.php" method="post" onsubmit="return candidateValidate(this)">
          <CAPTION><h2>ADD NEW CANDIDATE</h2></CAPTION>
          <table width="90%" align="center">
            <tr>
              <td style="font-size:14px">Candidate Name</td>
              <td><input class="effect-2" type="text" name="name" /></td>
            </tr>
            <tr>
              <td style="font-size:14px">Candidate Position</td>
              <!--<td><input type="combobox" name="position" value="<?php echo $positions; ?>"/></td>-->
              <td>
                <SELECT NAME="position" id="position">
                  <option VALUE="select">select</option>
                  <?php
                    //loop through all table rows
                    while ($row=mysqli_fetch_array($positions_retrieved)){
                      echo "<option VALUE=$row[position_name]>$row[position_name]</option>";
                    }
                  ?>
                </SELECT>
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input type="submit" class="butn"  name="Submit" value="Add" /></td>
            </tr>
          </table>
        </form>

        <hr>
        
        <table border="0" width="90%" align="center">
          <CAPTION><h2>AVAILABLE CANDIDATES</h2></CAPTION>
          <tr>
            <th>Candidate ID</th>
            <th>Candidate Name</th>
            <th>Candidate Position</th>
            <th>Delete Candidate</th>
          </tr>

          <?php
            //loop through all table rows
            $inc=1;
            while ($row=mysqli_fetch_array($result)){
          ?>    
            <tr>
              <td><?php echo $inc; ?></td>
              <td><?php echo $row['candidate_name']; ?></td>
              <td><?php echo $row['candidate_position']; ?></td>
              <td><a href="candidates.php?id=<?php echo $row['candidate_id']; ?>">Delete</a></td>
            </tr>
          <?php
            $inc++;
            }
          ?>
        </table>

        <hr>
      </div>
      <div id="footer"> 
        <!----->
      </div>
    </div>
  </body>
</html>
<?php
  session_start();
  require('../connection.php');
  //If your session isn't valid, it returns you to the login screen for protection
  if(empty($_SESSION['admin_id'])){
    header("location:access-denied.php");
  }
  //retrive positions from the tbpositions table
  $result=mysqli_query($con, "SELECT * FROM tbPositions");
  if (mysqli_num_rows($result)<1){
      $result = null;
  }
?>

<?php
// inserting sql query
  if (isset($_POST['Submit'])){
    $newPosition = addslashes( $_POST['position'] ); //prevents types of SQL injection
    $sql = mysqli_query($con, "INSERT INTO tbpositions (position_name) VALUES ('$newPosition')");

    // redirect back to positions
    header("Location: positions.php");
  }
?>

<?php
  // deleting sql query
  // check if the 'id' variable is set in URL
  if (isset($_GET['id'])){
    // get id value
    $id = $_GET['id'];
    
    // delete the entry
    $result = mysqli_query($con, "DELETE FROM `tbPositions` WHERE `position_id`='$id'");
    
    // redirect back to positions
    header("Location: positions.php");
  }else
 // do nothing
    
?>

<?php
include('../connection.php');
//echo "<script>alert('$id');</script>";
  // toggle status
  // check if the 'id' variable is set in URL
  if (isset($_GET['status_id'])){
    // get id value
    $id = $_GET['status_id'];
    echo "<script>alert('$id');</script>";
    $check_status = "SELECT `status` FROM `tbpositions` WHERE `position_id`='$id'";
    $check_status_run = mysqli_query($con, $check_status);
    $check_status_res = mysqli_fetch_assoc($check_status_run);

    $current_status = $check_status_res['status'];

    $new_status = '';
    if($current_status == 'start'){
      $new_status = 'stop';
    }else{
      $new_status = 'start';
    }

    $update_status = "UPDATE `tbpositions` SET `status`='$new_status' WHERE `position_id`='$id'";
    $update_status_run = mysqli_query($con, $update_status);
    
    // redirect back to positions
    header("Location: positions.php");
  }
 // do nothing
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Administration Control Panel:Positions</title>
    <link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="js/admin.js"></script>
  </head>

  <body>
      <center><b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
      <div id="page">
        <div id="header">
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
          <form name="fmPositions" id="fmPositions" action="positions.php" method="post" onsubmit="return positionValidate(this)">
            <CAPTION><h2>ADD NEW POSITION</h2></CAPTION>  
            <table width="380" align="center">
              <tr>
                  <td>Position Name</td>
                  <td><input class="effect-2" type="text" name="position" required/></td>
                  <td><input type="submit" class="butn"  name="Submit" value="Add" /></td>
              </tr>
            </table>
          </form>

          <hr>
          
          <CAPTION><h2>AVAILABLE POSITIONS</h2></CAPTION>
          <table  width="420" align="center">
            <tr>
              <th>Sr. No.</th>
              <th>Position Name</th>
              <th>Voting status</th>
              <th>Delete Position</th>
            </tr>

            <?php
              //loop through all table rows
              $inc=1;
              while ($row=mysqli_fetch_array($result)){
            ?>
                <tr>
                  <td><?php echo $inc; ?></td>
                  <td><?php echo $row['position_name']; ?></td>
                  <td><a href="positions.php?status_id=<?php echo $row['position_id']; ?>"><?php echo $row['status']; ?></td>
                  <td><a href="positions.php?id=<?php echo $row['position_id']; ?>">Delete</a></td>
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
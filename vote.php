<?php
  require('connection.php');
  session_start();
  
  if(empty($_SESSION['member_id'])){
    echo "<script>window.location.href='access-denied.php'</script>";
  }
?>

<?php
  // retrieving positions sql query
  $positions = mysqli_query($con, "SELECT * FROM tbPositions WHERE `status`='start'");
?> 

<?php
    // retrieval sql query
  // check if Submit is set in POST
  if (isset($_POST['Submit']))
  {
    // get position value
    $position = addslashes( $_POST['position'] ); //prevents types of SQL injection
 
    // retrieve based on position
    $result = mysqli_query($con,"SELECT * FROM tbCandidates WHERE candidate_position='$position'");
    // redirect back to vote
    //header("Location: vote.php");
  }
  
?>
<html>
  <head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>VI-Voting Platform: Voting Page</title>

    <link href="css/user_styles.css" rel="stylesheet" type="text/css" />   
    <script language="JavaScript" src="js/user.js"></script>

    <script type="text/javascript">
      function getVote(int){
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        if(confirm("Your vote is for " + int)){
          var pos = document.getElementById("str").value;
          var id = document.getElementById("hidden").value;
          xmlhttp.open("GET", "save.php?vote=" + int + "&user_id=" + id + "&position=" + pos, true);
          xmlhttp.send();

          xmlhttp.onreadystatechange =function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
              //  alert("dfdfd");
              document.getElementById("error").innerHTML=xmlhttp.responseText;
            }
          }
        } else {
          alert("Choose another candidate ");
        }
      }

      function getPosition(String){
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {// code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET", "vote.php?position=" + String, true);
        xmlhttp.send();
      }
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        var j = jQuery.noConflict();
          j(document).ready(function()
          {
              j(".refresh").everyTime(1000,function(i){
                  j.ajax({
                    url: "admin/refresh.php",
                    cache: false,
                    success: function(html){
                      j(".refresh").html(html);
                    }
                  })
              })
              
          });
        j('.refresh').css({color:"green"});
      });
    </script>
  </head>

  <body>
    <center>
    <b><font color="black" size="6" style="font-size: 36px">VI-Voting Platform</font></b>
  </center>
    <br><br>

    <div id="page">
      <div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">CURRENT POLLS</h1>
        <a href="student.php" style="font-size:20px;">Home</a> |
        <a href="vote.php" style="font-size:20px;">Current Polls</a> |
        <a href="manage-profile.php" style="font-size:20px;">Manage My Profile</a>
        | <a href="changepass.php" style="font-size:20px;">Change Password</a>|
        <a href="logout.php" style="font-size:20px;">Logout</a>
      </div>
  
      <div class="refresh">
      </div>

      <div id="container">
        
        <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
          <table width="420" align="center">  
            <tr>
              <td>Choose Position</td>
              <td>
                <SELECT NAME="position" id="position" onclick="getPosition(this.value)">
                  <option value="select">select</option>
                  <?php 
                    //loop through all table rows
                    while ($row = mysqli_fetch_array($positions)){
                      echo "<option value = '$row[position_name]'>$row[position_name]</option>"; 
                    }
                  ?>
                </SELECT>
              </td>
              <td><input type="hidden" id="hidden" value="<?php echo $_SESSION['member_id']; ?>" /></td>
              <td><input type="hidden" id="str" value="<?php echo $_REQUEST['position']; ?>" /></td>
              <td><input type="submit" class="butn"  name="Submit" value="See Candidates" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td> 
              <td>&nbsp;</td>
            </tr>
          </table>
        </form> 

        <form>
          <table width="270" align="center">
            <tr>
                <th>Candidates:</th>
            </tr>

            <?php
              //loop through all table rows
              //if (mysql_num_rows($result)>0){
              if (isset($_POST['Submit'])){
                while ($row=mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>" . $row['candidate_name']."</td>";
                  echo "<td><input type='radio' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)' /></td>";
                  echo "</tr>";
                }
                mysqli_free_result($result);
                mysqli_close($con);
              }else
            // do nothing
            ?>

            <tr>
                <h3>NB: Click a circle under a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</h3>
                <td>&nbsp;</td>
            </tr>
          </table>
        </form>

        <center><span id="error"></span></center>
      </div>

      <div id="footer"> 
        <!----->
      </div>
    </div>
  </body>
</html>
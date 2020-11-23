<?php

define("HOST", "localhost");

// Database user
define("DBUSER", "root");

// Database password
define("PASS", "");

// Database name
define("DB", "library");

// Database Error - User Message
define("DB_MSG_ERROR", 'Could not connect!<br />Please contact the site\'s administrator.');

############## Make the mysql connection ###########

$conn = mysqli_connect(HOST, DBUSER, PASS,DB) or die(DB_MSG_ERROR);

$query = mysqli_query($conn,"SELECT * FROM studentdetails WHERE ID='".$_POST['value']."'");

?>

<?php
while ($data = mysqli_fetch_array($query)) {

  ?>
  <table class="table">
      <tr>
          <th>Student ID</th>
          <td><input type="text" name="studentid" id="sid" value="<?php echo $data['ID'];?>"></td>
          <th>Student Name</th>
          <td><input type="text" name="studentname" id="" value="<?php echo $data['sname'];?>"></td>
          <th>Gender</th>
          <td><input type="text" name="sgender" value="<?php echo $data['sgender'];?>"></td>
          <th>Department</th>
          <td><input type="text" name="sdep" value="<?php echo $data['sdep'];?>"></td>       
        </tr>
<?php }

echo '</table>';

?>
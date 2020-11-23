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

$query = mysqli_query($conn,"SELECT * FROM bookdetails WHERE bnumber='".$_POST['value']."'");

?>
<div style="padding-bottom:20px;">
<table cellpadding="20" cellspacing="10" class="table table-hover search">
				<tr>
					<th>Book Number</th>
					<th>Book Name</th>
					<th>Author Name</th>
					<th>Publication</th>
				</tr>
<?php
while ($data = mysqli_fetch_array($query)) {

  ?>
  <tr id="book1">
    <td id="bid"><?php echo $data["bnumber"];?></td>
    <td id="bname"><?php echo $data["bname"];?></td>
    <td id="bauthor"><?php echo $data["bauthor"];?></td>
    <td id="bpublication"><?php echo $data["bpublication"];?></td>
  </tr>

<?php }

echo '</table>';

?>
<?php include'main.php';?>
<script type="text/javascript">
		function check(){
			if(document.getElementById("sname").value==""||document.getElementById("id").value=="")
			{
				alert("fields cannot be empty");
				return false;
			}
			else{
				alert("Student is Added");
				return true;
			}
		}
	

</script>
		<div class="col-sm-10" style="background-color: ;" id="view1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="vb" id="vm1" onClick="vb()">View Student Details</li>
					<li class="ab" id="am1" onClick="ab()">Add Student</li>
					
				</ul>
			</div>

			<div style="padding-left:100px; padding-bottom:20px;">

			<form method="post" action="student.php" style="padding-bottom: 20px; padding-left: 40px;">
			<input type="text" name="search" placeholder="search-student by ID" id="searchbox">
			<input type="submit" name="searchbtn" value="search"><br>
			</form>	
			<?php if (count($errors)>0):?> 
				<div class="errors">
					<?php foreach ($errors as $error):?> 
			 			<?php echo $error; ?><br>
					<?php endforeach ?>
				</div>
			<?php endif ?>
			
			<table cellpadding="20" cellspacing="10" class="table table-hover table-condensed">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Gender</th>
					<th>Department</th>
				</tr>
				<?php
				if(isset($_POST['searchbtn'])&& !empty($_POST['search']))
				{
					
						$key=$_POST['search'];
						$sql="SELECT * FROM studentdetails where ID LIKE'%$key%'";
			 			$a=$conn->query($sql);
			 			while($b=$a->fetch_assoc())
			 			{
			 				echo "<tr><td>".$b["ID"]."</td><td>".$b["sname"]."</td><td>".$b["sgender"]."</td><td>".$b["sdep"]."</td><tr>";
			 			}
			 			echo "</table>";
			
				}
					else
					{
					$result_per_page=5;
					$sql="SELECT * FROM studentdetails";
			 		$a=mysqli_query($conn,$sql);
			 		$no_of_results=mysqli_num_rows($a);
			 		$no_f_pages=ceil($no_of_results/$result_per_page);
			 		if(!isset($_GET['page']))
			 			{
			 				$page=1;	
			 			}
			 		else
			 			{
			 				$page=$_GET['page'];
			 			}

			 		$this_page_first_result=($page-1)*$result_per_page;
			 		$sql="SELECT * FROM studentdetails ORDER BY id DESC LIMIT $this_page_first_result , $result_per_page";
			 		$a = mysqli_query($conn,$sql);
			 		while ($b=mysqli_fetch_array($a)) {
			 				echo "<tr><td>".$b["ID"]."</td><td>".$b["sname"]."</td><td>".$b["sgender"]."</td><td>".$b["sdep"]."</td><tr>";
			 				}
			 				echo "</table>";?>
			 			<div class="pagination">
				 			<?php for($page=1; $page<=$no_f_pages; $page++) :?> 
				 				<li><?php echo '<a href="student.php?page='.$page.'">'.$page.'</a>';?>
				 			<?php endfor?>
			 			</div>	
			 	<?php }?>
				
			
			</div>
			</div>
	<div class="col-sm-10" style="background-color: ;" id="add1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="ab" id="vm2" onClick="vb()">View Student Details</li>
					<li class="vb" id="am2" onClick="ab()">Add Student</li>
				</ul>
			</div>
		<div style="padding-left:100px; padding-bottom:20px;padding-top:20px;">
			<form class="mform" method="post" action="student.php">
			<?php if (count($errors)>0):?> 
				<div class="errors">
					<?php foreach ($errors as $error):?> 
			 			<?php echo $error; ?><br>
					<?php endforeach ?>
				</div>
			<?php endif ?>

			<label>Student Name</label><br>
			<input type="text" placeholder="student name" name="studentname" id="sname"><br>
			<label>Gender</label><br>
			<select name="gender">
				<option>--Select Gender--</option>
				<option>Male</option>
				<option>Female</option>
			</select>
			<br>
			<label>Department</label><br>
				<select name="department">
				<option>--Select Department--</option>
				<option>BE-CSE</option>
				<option>BE-ECE</option>
				<option>BE-EEE</option>
				<option>BE-CIVIL</option>
				<option>BE-MECH</option>
				<option>MBA</option>
				<option>MCA</option>
			</select>
			
			<br>
			<label>ID</label><br>
			<input type="text" placeholder="ID" name="id" id="id"><br>
			<input type="submit" name="addstudent" value="ADD STUDENT" onclick="">	
			</form>
		</div>
	</div>


</div>
</div>
<?php include'footer.php';?>
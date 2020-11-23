<?php include'main.php';?>
<script type="text/javascript">
		function check(){
			if(document.getElementById("bname").value==""||document.getElementById("publication").value=="")
			{
				alert("fields cannot be empty");
				return false;
			}
		}
	

</script>
		<div class="col-sm-10" style="background-color: ;" id="view1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="vb" id="vm1" onClick="vb()">View Books</li>
					<li class="ab" id="am1" onClick="ab()">Add Books</li>
					
				</ul>
			</div>

			<div style="padding-left:100px; padding-bottom:20px;">

			<form method="post" action="bookdetails.php" style="padding-bottom: 20px; padding-left: 40px;">
			<input type="text" name="search" placeholder="search-book by Book Name" id="searchbox">
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
					<th>Book Number</th>
					<th>Book Name</th>
					<th>Author Name</th>
					<th>Publication</th>
				</tr>
				<?php
				if(isset($_POST['searchbtn'])&& !empty($_POST['search']))
				{
					
						$key=$_POST['search'];
						$sql="SELECT * FROM bookdetails where bname LIKE'%$key%'";
			 			$a=$conn->query($sql);
			 			while($b=$a->fetch_assoc())
			 			{
			 				echo "<tr><td>".$b["bnumber"]."</td><td>".$b["bname"]."</td><td>".$b["bauthor"]."</td><td>".$b["bpublication"]."</td><tr>";
			 			}
			 			echo "</table>";
			
				}
					else
					{
					$result_per_page=5;
					$sql="SELECT * FROM bookdetails";
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
			 		$sql="SELECT * FROM bookdetails ORDER BY bnumber DESC LIMIT $this_page_first_result , $result_per_page";
			 		$a = mysqli_query($conn,$sql);
			 		while ($b=mysqli_fetch_array($a)) {
			 				echo "<tr><td>".$b["bnumber"]."</td><td>".$b["bname"]."</td><td>".$b["bauthor"]."</td><td>".$b["bpublication"]."</td><tr>";
			 				}
			 				echo "</table>";?>
			 			<div class="pagination">
				 			<?php for($page=1; $page<=$no_f_pages; $page++) :?> 
				 				<li><?php echo '<a href="bookdetails.php?page='.$page.'">'.$page.'</a>';?>
				 			<?php endfor?>
			 			</div>	
			 	<?php }?>
				
			
			</div>
			</div>
	<div class="col-sm-10" style="background-color: ;" id="add1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="ab" id="vm2" onClick="vb()">View Books</li>
					<li class="vb" id="am2" onClick="ab()">Add Books</li>
				</ul>
			</div>
		<div style="padding-left:100px; padding-bottom:20px;padding-top:20px;">
			<form class="mform" method="post" action="bookdetails.php">
			<?php if (count($errors)>0):?> 
				<div class="errors">
					<?php foreach ($errors as $error):?> 
			 			<?php echo $error; ?><br>
					<?php endforeach ?>
				</div>
			<?php endif ?>

			<label>Book Number</label><br>
			<input type="text" placeholder="book number" name="booknumber"><br>
			<label>Book Name</label><br>
			<input type="text" placeholder="book name" name="bookname" id="bname"><br>
			<label>Author Name</label><br>
			<input type="text" placeholder="author name" name="authorname"><br>
			<label>Publication</label><br>
			<input type="text" placeholder="publication" name="publication" id="publication"><br>
			<input type="submit" name="addbook" value="ADD BOOK" onclick="check()">	
			</form>
		</div>
	</div>


</div>
</div>
<?php include'footer.php';?>
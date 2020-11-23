<?php include 'main.php';?>

<div class="col-sm-10" style="background-color: ;" >



		<div style="padding-left:150px;">
			<div style="position: absolute;">
				<h1 style="padding-left: 40px;">Students</h1>
				<img src="student1.png" width="150px"/>	
				<?php 
				$sql="SELECT count(ID) FROM studentdetails";
				$a=$conn->query($sql);
				$b=$a->fetch_assoc();?>
				<h2 style="font-size: 80px; display: inline; padding-left:40px;"><?php echo $b["count(ID)"];?></h2>
			</div>
			<div style="position:absolute; padding-left: 400px;">
				<h1 style="padding-left: 40px;">Books</h1>
				<img src="bookdetail.png" width="150px"/>	
				<?php 
				$sql="SELECT count(bnumber) FROM bookdetails";
				$a=$conn->query($sql);
				$b=$a->fetch_assoc();?>
				<h2 style="font-size: 80px; display: inline; padding-left:40px;"><?php echo $b["count(bnumber)"];?></h2>
			</div>
		</div>
			<div style="position:absolute; padding-left:25%; padding-top: 250px;">
				<h1 style="padding-left: 40px;">Books Issued</h1>
				<img src="outofstock.png" width="150px"/>	
				<?php 
				$sql="SELECT count(bnumber) FROM issuebook";
				$a=$conn->query($sql);
				$b=mysqli_fetch_array($a);?>
				<h2 style="font-size: 80px; display: inline; padding-left:40px;"> <?php echo $b["count(bnumber)"];?></h2>
			</div>
			

</div>
		


</div>
</div>
<?php include 'footer.php';?>
<?php include 'main.php';
?>
<style type="text/css">
		input[type=text]{
			font-size: 16px;
			width: 150px;
			height: 30px;
			border:1px solid #C70039;
			margin-left: 0px;
		}
</style>
<div class="col-sm-10" style="background-color: ;" id="view1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="vb" id="vm1">Book Renewal</li>
				</ul>
			</div>

			<div style="padding-left:50px; padding-bottom:20px;padding-top:20px;">	
				<form method="post" action="bookrenewal.php" id="lets_search">
						<label>Student-ID</label>
						<span style="padding-left:25px;"><input type="text" placeholder="ID" name="id" id="id"></span>
						<input type="submit" value="search" name="send" id="send">
				</form>
			</div>
				
			<form method="post" action="bookrenewal.php">
    			
    			<table cellpadding="20" cellspacing="10" class="table table-hover table-condensed">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Department</th>
                </tr>
            	    	<?php
            	    	$booknumber = array();
            	    	$newrenewal=0;
            	    	$renewcount=0;
	                        if(isset($_POST['send'])&& !empty($_POST['id']))
	                        {
		                        $key=$_POST['id'];
		                       	$sql="SELECT * FROM issuebook where ID='$key'";
		                        $a=$conn->query($sql);
		                    	$imp=$a->fetch_assoc();
		                        if(mysqli_num_rows($a)>0)
		                        {
			                        	$sql1="SELECT * FROM studentdetails where ID='$key'";
			                        	$result=$conn->query($sql1);
			                        	while($b=$result->fetch_assoc())
				                        	{

				                            echo "<tr><td><input name='studid' id='' type='text' style='width:150px;text-align:center;font-size:20px;' value='".$b["ID"]."'></td><td>".$b["sname"]."</td><td>".$b["sgender"]."</td><td>".$b["sdep"]."</td></tr>";
				                        	}
		                        	?></table>
			                        	<table cellpadding="20" cellspacing="10" class="table table-hover table-condensed">
						                <tr>
						                    <th>Book Number</th>
						                    <th>Book Name</th>
						                    <th>Last Due Date</th>
						                    <th>Fine/Next Renewal Date</th>
						                </tr>
						             
					         		<?php
					         		
					         			$count=0;
				                       	$sql="SELECT bnumber,renewaldate FROM issuebook where ID='$key'";
				                        $as=$conn->query($sql);
				                        while($c=$as->fetch_assoc())
				                        {	
				                        	$searchbook=$c["bnumber"];
				                        	$sql1="SELECT * FROM bookdetails where bnumber='$searchbook'";
				                        	$result=$conn->query($sql1);
				                        	
				                        	while($b=$result->fetch_assoc())
				                        	{
				                        			
				                        		$fine=0;
				                        		$date2=date_create($c["renewaldate"]);
				                        		$date1=date_create(date('Y-m-d'));
				                        		$diff=date_diff($date2,$date1);
				                        		$estimatedate=$diff->format("%R%a");
				                        		
				                       
				                        		if($estimatedate>0)
					                        		{
					                        			$fine=$estimatedate*0.5;
					                        		}
					                        	$count=$count+1;
				                            	echo "<tr><td>".$b["bnumber"]."</td><td>".$b["bname"]."</td><td>".$c["renewaldate"]."</td>";
				                            	if($fine>0)
				                           			{
				                           				$booknumber[]=$b["bnumber"];
				                           				$renewcount=$renewcount+1;
				                           				$date=date_create(date('Y-m-d'));
				       									date_add($date,date_interval_create_from_date_string("15 days"));
				        								$newrenewal=date_format($date,'Y-m-d');
					                            		echo "<td><input name='newrenewal[]' id='fineamount".$count."' type='text' style='width:150px;text-align:center; color:red; font-size:20px;' value='".$fine."'></td><td><input id='".$count."' type='button' value='pay' onclick='callmeur(this.id);' name='payfine'></td></tr>";
			                        				}

		                        				else
		                        					{	
		                        						$date=date_create($c["renewaldate"]);
				                        				date_add($date,date_interval_create_from_date_string("15 days"));
				                        				$newrenewal=date_format($date,'Y-m-d');
		                        						if($estimatedate>-5 && $estimatedate<0)
		                        						{
		                        						$renewcount=$renewcount+1;
		                        						echo "<td><input name='newrenewal[]' id='fineamount".$count."' type='text' style='width:150px;text-align:center; color:red; font-size:20px;' value='".$newrenewal."'></td></tr>";
		                        						}
		                        						else{
		                        						echo "<td>Book cannot be renewed(only 5 days before last due date)</td></tr>";	
		                        						}
		                        					}
		                        				
		                        			}
		                        		}
		                        	}
	                        else
	                        {
	                        	array_push($errors,"Student don't have any book records");
	                        }
                    }

                    
                    if(isset($_POST['updaterenewal']))
                    {	
                    	$totalfineamount=$_POST['totalfineamount'];
                    	if($totalfineamount==0){
                    		array_push($errors, "No fine amount!!!");	
                    	}
                    	else
                    	{
                       	for ($i=0; $i < $_POST['items'] ; $i++)
                    	{
                    		$sql="UPDATE issuebook SET renewaldate='".$_POST['newrenewal'][$i]."' WHERE ID='".$_POST['studid']."' AND bnumber='".$_POST['booknumber'][$i]."'";
                    		$conn->query($sql);
                    	}
                    	$date=date_create(date('Y-m-d'));
                    	$newdate=date_format($date,'Y-m-d');
                    	$sql="INSERT INTO recipitdetails VALUES('','".$_POST['StudentId']."','".$_POST['totalfineamount']."','$newdate')";
                    		$conn->query($sql);
                    	$_SESSION['totalfineamount']=$_POST['totalfineamount'];
                    	$_SESSION['StudentIdPrint']=$_POST['StudentId'];
                    	$_SESSION['date']=$newdate;
        				echo ("<script>location.href='print.php';</script>");
                    }
                    }
                    
                    ?>
                    </table>
                   	<?php if (count($errors)>0):?> 
						<div class="errors">
							<?php foreach ($errors as $error):?> 
			 				<?php echo $error; ?><br>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				
				
				<div style="padding-left: 150px;padding-top: 50px;">
				<label>Total Fine Amount</label>
				<input type="text" name="totalfineamount" id="totalfineamount" style="text-align:center; color:red; font-size:20px;">
				<input type="hidden" name="items" value="<?php echo $renewcount;?>">
							<?php foreach ($booknumber as $bnum):?> 
			 	<input type="hidden" name="booknumber[]" value="<?php echo $bnum?>">			
							<?php endforeach ?>
				<input type="hidden" name="StudentId" value="<?php echo $key?>">
				<input type="submit" name="updaterenewal" value="Renewal Books" id="updaterenewal" >

				</div>
				</form>

</div>
</div>
</form>
</div>
<?php include'footer.php';?>

			         
					<script type="text/javascript">
			              document.getElementById("totalfineamount").value=0;
			              function callmeur(x){
			               var e=parseFloat(document.getElementById("fineamount"+x).value);
			               document.getElementById("totalfineamount").value=parseFloat(document.getElementById("totalfineamount").value)+e;
			               document.getElementById("fineamount"+x).value="<?php  echo $newrenewal;?>";
			         	}
			         </script>



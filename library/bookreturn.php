<?php include 'main.php';
?>

<div class="col-sm-10" style="background-color: ;" id="view1">
			<div style="padding-left:60px; padding-top:20px; margin-bottom: 0px;" class="library" >
				<ul>
					<li class="vb" id="vm1">Book Return</li>
				</ul>
			</div>

			<div style="padding-left:50px; padding-bottom:20px;padding-top:20px;">	
				<form method="post" action="bookreturn.php" id="lets_search">
						<label>Student-ID</label>
						<span style="padding-left:25px;"><input type="text" placeholder="ID" name="id" id="id"></span>
						<input type="submit" value="search" name="send" id="send">
				</form>
			</div>

			<form method="post" action="bookreturn.php">
    			
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
		                        	?>
		                        </table>
		                        		<table cellpadding="20" cellspacing="10" class="table table-hover table-condensed">
						                <tr>
						                    <th>Book Number</th>
						                    <th>Book Name</th>
						                    <th>Last Due Date</th>
						                    <th>Return Book</th>
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
				                            	$bnumber=$b["bnumber"];
				                            	if($fine>0)
				                           			{
				                           
				                           				$date=date_create(date('Y-m-d'));
				       									date_add($date,date_interval_create_from_date_string("15 days"));
				        								$newrenewal=date_format($date,'Y-m-d');
					                            		echo "<td><input name='newrenewal[]' id='fineamount".$count."' type='text' style='width:150px;text-align:center; color:red; font-size:20px;' value='".$fine."'></td></tr>";
			                        				}

		                        				else
		                        					{	
		                        						$renewcount=$renewcount+1;
		                        						echo "<td><input id='".$count."' type='button' value='Return' onclick='callmeur(this.id,".$b["bnumber"].");' name='returnbook'></td></tr>";
		                        					}
		                        				
		                        			}
		                        		}
		                        	}
	                        else
	                        {
	                        	array_push($errors,"Student don't have any book records");
	                        }

	                       
                    }
                    
                      if(isset($_POST['returnbook']))
                    {	
                    	
                       	for ($i=0; $i < $_POST['items'] ; $i++)
                    	{
                    		$sql="DELETE FROM issuebook WHERE ID='".$_POST['studid']."' AND bnumber='".$_POST['returnbook'][$i]."'";
                    		$conn->query($sql);
                    		array_push($errors, "Book No. : ".$_POST['returnbook'][$i]." returned sucessfully!");
                    	}
                    	
                    }
                    


                    ?></table>
                         	<?php if (count($errors)>0):?> 
						<div class="errors">
							<?php foreach ($errors as $error):?> 
			 				<?php echo $error; ?><br>
							<?php endforeach ?>
						</div>
					<?php endif ?>
			
				<div  id="container">
				
				
				<input type="hidden" name="items" value="<?php echo $renewcount;?>">
							
				<input type="hidden" name="StudentId" value="<?php echo $key?>">
				<input type="submit" name="returnbook" value="Return Books" id="returnbook" >
				</div>
				</form>
				</div>
				</div>
			</div>
				</form>

					<script type="text/javascript">
			              
			              function callmeur(x,y)
			             {
			               var e=y;
			         		var container = document.getElementById("container");
			         		var input = document.createElement("input");
                			input.type = "hidden";
                			input.name = "returnbook[]"
                			input.value=e;
                			container.appendChild(input);
                			document.getElementById(x).value="<?php  echo 'Submitted for return, Save Once!';?>";
			         	}
			         	

			         </script>
				

<?php include'footer.php';?>
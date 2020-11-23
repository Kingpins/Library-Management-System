<?php include'main.php';
if (isset($_POST['issuebook'])) {
		$sid=$_POST['studentid'];
		$issuedate=$_POST['issuedate'];
		$renewaldate=$_POST['renewaldate'];
		$bnumber=$_POST['id'];
		$items=$_POST['items'];
		for ($i=0; $i < $_POST['items']; $i++)
        { 
        		$sql="SELECT * FROM issuebook WHERE bnumber='".$_POST['id'][$i]."'";
        		$a=mysqli_query($conn,$sql);
        		if(mysqli_num_rows($a)>0){
        			array_push($errors, "Book already Issued - ".$_POST['id'][$i]."");
        		}
        		if($items>1 && $_POST['id'][$i]==$_POST['id'][++$i]){
        			array_push($errors, "Duplicate records not allowed");
        		}
        }
      	
		
        if(count($errors)==0){
		for ($i=0; $i < $_POST['items']; $i++)
        { 		
        		$sql="INSERT INTO issuebook VALUES('$sid','$issuedate','$renewaldate','".$_POST['id'][$i]."')";
        		mysqli_query($conn,$sql);
        		array_push($errors, "Book No. : ".$_POST['id'][$i]." issued.");
		}
        //echo ("<script>location.href='issue.php';</script>");
    }
}?>
<script type="text/javascript">
		function mess(){
			if(document.getElementById("id1").value==""||document.getElementById("bname1").value==""||document.getElementById("sid").value=="")
			{
				alert("fields cannot be empty");
				return false;
			}
			else{
				alert("Book is Added");
				return true;
			}
		}

		$(function() {
        $("#lets_search").bind('submit',function() {
          var value = $('#id').val();
           $.post('try.php',{value:value}, function(data){
             $("#search_results").html(data);
           });
           return false;
        });
      	});
		
		$(function() {
        $("#booksearch").bind('submit',function() {
          var value = $('#bnumber').val();
           $.post('booksearch.php',{value:value}, function(data){
             $("#book_result").html(data);
           });
           return false;
        });
      	});	

		  function addtocart(){
      	
      	if (document.getElementById("id1").value=="") {
          document.getElementById("id1").value=document.getElementById("bid").innerHTML;
          document.getElementById("bname1").value=document.getElementById("bname").innerHTML;
          document.getElementById("bauthor1").value=document.getElementById("bauthor").innerHTML;
          document.getElementById("bpublication1_1").value=document.getElementById("bpublication").innerHTML;
		}
		else if(document.getElementById("id1_2").value==""){
			asd(2);
        	}
        	else if(document.getElementById("id1_3").value==""){
        	asd(3);
        	}
        	else if(document.getElementById("id1_4").value==""){
        	asd(4);
        	}
        }
        
        function asd(count){
        	document.getElementById("id1_"+count).value=document.getElementById("bid").innerHTML;
          	document.getElementById("bname1_"+count).value=document.getElementById("bname").innerHTML;
          	document.getElementById("bauthor1_"+count).value=document.getElementById("bauthor").innerHTML;
          	document.getElementById("bpublication1_"+count).value=document.getElementById("bpublication").innerHTML;

        }
         $(document).ready(function()
        {
        	var count=1;

        	
	        	$('#new').click(function()
	        	{	
	        		if(count<=3)
	        		{
		        		count =count+1;
		        		var html='';
		        		html+='<tr id="newtable_'+count+'">';
		        		html+='<td><input type="text" name="id[]" id="id1_'+count+'"></td>';
		        		html+='<td><input type="text" name="mname[]" id="bname1_'+count+'"></td>';
		        		html+='<td><input type="text" name="type[]" id="bauthor1_'+count+'"></td>';
		        		html+='<td><input type="text" name="price[]" id="bpublication1_'+count+'"></td>';
		        		html+='<td><input type="button" name="" class="remove" id="'+count+'" value="-"></td></tr>';
		        		$('#table').append(html);
		        		$('#items').val(count);
		        	}	
	        	});
    		


        	$('.remove').live('click',function(event)
        	{
                var x=$('#items').val();
                var a=parseInt($(this).attr("id"));
                $(this).parent().parent().remove();
        		for(i=a;i<x;i++){
                var exid=i+1;
                $('#newtable_'+exid).attr("id","newtable_"+i);
                $('#id1_'+exid).attr("id","id1_"+i);
                $('#bname1_'+exid).attr("id","bname1_"+i);
                $('#bauthor1_'+exid).attr("id","bauthor1_"+i);
                $('#bpublication1_'+exid).attr("id","bpublication1_"+i);
                $('#'+exid).attr("id",""+i);
        		}
                count=count-1;
                $('#items').val(count);

        	});

        });
</script>
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
					<li class="vb" id="vm1">Issue Details</li>
				</ul>
			</div>

		
			
			<?php if (count($errors)>0):?> 
				<div class="errors">
					<?php foreach ($errors as $error):?> 
			 			<?php echo $error; ?><br>
					<?php endforeach ?>
				</div>
			<?php endif ?>

		<div style="padding-left:25%; padding-bottom:20px;padding-top:20px;">	
			<form method="post" action="" id="lets_search">
					<label>Student-ID</label>
					<span style="padding-left:25px;"><input type="text" placeholder="ID" name="studentid" id="id"></span>
					<input type="submit" value="search" name="send" id="send">
			</form>
			
			<form method="post" action="" id="booksearch">
					<label>Book Number</label>
					<input type="text" placeholder="Book Number" name="" id="bnumber">
					<input type="submit" value="search" name="send" id="send">
			</form>

		</div>	
			<div id="book_result"></div>
			<form method="post" action="issue.php">
    			<input type="button" name="add" value="Add to cart" onclick="addtocart();" style="margin-bottom: 20px;">
                <input type="button" name="" id="new" value="+" style="margin-bottom: 20px">
    			<table class="table table-hover table-bordered" id="table">
				<div id="search_results"></div>
				<tr>
					<th class="just">Issue Date</th>
					<td><input type="text" name="issuedate" value="<?php echo date('Y-m-d')?>"></td>
					<th class="ignorejust">Renewal-Date</th>
					<td><input type="text" name="renewaldate" value="<?php $date=date_create(date('Y-m-d'));
					date_add($date,date_interval_create_from_date_string("20 days")); echo date_format($date,'Y-m-d');?>"></td>
				</tr>
				<tr>
					<th>Book Number</th>
					<th>Book Name</th>
					<th>Author Name</th>
					<th>Publication</th>
				</tr>
    			<tr id="newtable">
    				<td><input type="text" name="id[]" id="id1"></td>
   					<td><input type="text" name="bname[]" id="bname1"></td>
    				<td><input type="text" name="bauthor[]" id="bauthor1"></td>
    				<td><input type="text" name="bpublication[]" id="bpublication1_1" class="price"></td>
  				</tr>
    			</table>
    			<div style="padding-bottom: 30px; float: right;">
					<input type="submit" name="issuebook" id="" value="Issue Book" onclick="">
				</div>
    			<input type="hidden" name="items" value="1" id="items">
    			</form>
			
		
	</div>


</div>
</div>

<?php include'footer.php';?>


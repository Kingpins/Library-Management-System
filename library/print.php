<?php
ob_start();
include 'server.php';
require('pdf/fpdf.php');
	$servername="localhost";
	$users='root';
	$password='';
	$db='library';
	$conn= mysqli_connect($servername,$users,$password,$db);
		if($conn->connect_error){
			die("Connection Failed :".$conn->connect_error);
		}
if(isset($_SESSION['totalfineamount']) & isset($_SESSION['StudentIdPrint']))
{
$totalfineamount=$_SESSION['totalfineamount'];
$studentid=$_SESSION['StudentIdPrint'];
$date=$_SESSION['date'];
$sql="SELECT * FROM studentdetails WHERE ID='$studentid'";
$a=mysqli_query($conn,$sql);
$b=mysqli_fetch_array($a);
$sql1="SELECT * FROM recipitdetails WHERE studentid='$studentid' AND totalmoney='$totalfineamount' AND date='$date'";
$a1=mysqli_query($conn,$sql1);
$b1=mysqli_fetch_array($a1);
//width=219mm
//horizontal writable=189mm
$pdf=new FPDF('p','mm','A4');
$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);
//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(130 ,5,'LIBRARY MANAGEMENT SYSTEM',0,1);
//end of line
$pdf->Cell(59 ,5,'',0,1);//end of line
//set font to arial, regular, 12pt
$pdf->Cell(130 ,5,'FINE RECIPIT',0,1);
$pdf->Cell(59 ,5,'',0,1);//end of line
$pdf->SetFont('Arial','',12);
$pdf->Cell(130 ,5,'[City, Country, ZIP]',0,1);

$pdf->Cell(130 ,5,'Phone [+12345678]',0,1);

$pdf->Cell(130 ,5,'',0,1);//end of line

$pdf->Cell(25 ,5,'Invoice ',0,0);
$pdf->Cell(34 ,5,'# '.$b1['invoiceid'],0,1);//end of line
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);//end of line


$pdf->Cell(34 ,5,'',0,1);//end of line


//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,3,'',0,1);//end of line

//billing address
$pdf->Cell(100 ,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(40 ,5,'Student Name :',0,0);
$pdf->Cell(40 ,5,$b['sname'],0,1);


$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(40 ,5,'Student Reg.No:',0,0);
$pdf->Cell(40 ,5,$studentid,0,1);



//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(50 ,8,'Total Fine',1,0);
$pdf->Cell(35 ,8,'Rs '.$b1['totalmoney'],1,0);
/*$pdf->Cell(40 ,8,'Price/Medicine',1,0);
$pdf->Cell(30 ,8,'Quantity',1,0);
$pdf->Cell(34 ,8,'Amount',1,1);//end of line
$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

/*$pdf->Cell(50 ,5,$b['mname'],1,0);
$pdf->Cell(35 ,5,$b['type'],1,0);
$pdf->Cell(40 ,5,$b['price'],1,0,'R');
$pdf->Cell(30 ,5,$b['qty'],1,0,'R');
$pdf->Cell(34 ,5,$b['amount'],1,1,'R');//end of line
//summary

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(35 ,5,'Tax of 7%',0,0);
$pdf->Cell(34 ,5,'tax',1,1,'R');//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(35 ,5,'SubTotal',0,0);
$pdf->Cell(34 ,5,'akosk',1,1,'R');//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(35 ,5,'Discount of 4%',0,0);
$pdf->Cell(4,5,'-',1,0);
$pdf->Cell(30 ,5,'jidja',1,1,'R');//end of line

$pdf->Cell(120 ,5,'',0,0);
$pdf->Cell(35 ,5,'Total',0,0);
$pdf->Cell(34 ,5,'akos',1,1,'R');//end of line 
*/
$pdf->Output();
ob_end_flush();
}
?>
<?php
require('fpdf/fpdf.php');
require_once('include/dbcon.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

if(isset($_GET['invoice'])){
   $invoice_no = $_GET['invoice'];
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

$pdf->Cell(130	,5,'Online Furniture Shop',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$query = "SELECT * FROM customer_order WHERE invoice_no= $invoice_no";
$run   = mysqli_query($con,$query);

$row = mysqli_fetch_array($run);
$order_invoice  = $row['invoice_no'];
$cust_id        = $row['customer_id'];
$order_date     = $row['order_date'];
$product_id     = $row['product_id'];
$product_qty    = $row['products_qty'];
$product_amount = $row['product_amount'];    
       //customer Query
      $query = "SELECT * FROM customer WHERE cust_id=$cust_id";
      $run   = mysqli_query($con,$query);
      $row   = mysqli_fetch_array($run);
      $cust_name    = $row['cust_name'];
      $cust_email   = $row['cust_email'];
      $cust_add     = $row['cust_add'];
      $cust_city    = $row['cust_city'];
      $cust_pcode   = $row['cust_postalcode'];
      $cust_number  = $row['cust_number'];
      //end customer query


     //product Query
      $query = "SELECT * FROM furniture_product WHERE id=$product_id";
      $run   = mysqli_query($con,$query);
      $row = mysqli_fetch_array($run);
      $title    = $row['title'];
      $price    = $row['price'];
      //end product query



$pdf->Cell(130	,5,' ',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line

$pdf->Cell(130	,5,'Lahore Cantt, Pakistan , 5400',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$order_date,0,1);//end of line

$pdf->Cell(130	,5,'Phone +923xx-xxxxxxx',0,0);
$pdf->Cell(25	,5,'Invoice #',0,0);
$pdf->Cell(34	,5,$order_invoice,0,1);//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,$cust_id,0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//billing address
$pdf->Cell(100	,5,'Bill to',0,1);//end of line

//add dummy cell at beginning of each line for indentation
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$cust_name,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$cust_email,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$cust_add.' , '.$cust_city.' , '.$cust_pcode,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$cust_number,0,1);

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130	,5,'Description',1,0);
$pdf->Cell(25	,5,'Quantity',1,0);
$pdf->Cell(34	,5,'Single Amount',1,1);//end of line

$pdf->SetFont('Arial','',10);

//Numbers are right-aligned so we give 'R' after new line parameter

$pdf->Cell(130	,5,$title,1,0);
$pdf->Cell(25	,5,$product_qty,1,0);
$pdf->Cell(34	,5,$price,1,1,'R');//end of line


//summary
$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Shipping',1,0);
$pdf->Cell(10	,5,'PKR',1,0);
$pdf->Cell(24	,5,'0',1,1,'R');//end of line


$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Subtotal',1,0);
$pdf->Cell(10	,5,'PKR',1,0);
$pdf->Cell(24	,5,$product_amount,1,1,'R');//end of line

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Total Due',1,0);
$pdf->Cell(10	,5,'PKR',1,0);
$pdf->Cell(24	,5,$product_amount,1,1,'R');//end of line


$pdf->Output();

}
?>

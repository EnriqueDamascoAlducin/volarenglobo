<?php 
include "cotizacion.php";
include_once"../../css/log/c/conexion.php";

$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->Addpage();
$pdf->SetFillColor(0,0,200);
$pdf->SetFont("Arial","B",10);
$pdf->SetY(40);
$pdf->Cell(30,6,"Algo",0,0,"C",1);
$pdf->Cell(30,6,"Otra",0,0,"C",1);
$pdf->Cell(30,6,"Cosa",0,0,"C",1);
$pdf->Ln(20);
$pdf->Output();
?>
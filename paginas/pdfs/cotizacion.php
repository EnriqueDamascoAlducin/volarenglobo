<?php
 include "fpdf181/fpdf.php";

 class PDF extends FPDF
 {
 	
 	function Header()
 	{				//ruta, posX, posY, tamaño
 		$this->Image("../../img/logo.jpg",5,5,20);
 		$this->Image("../../img/logo.jpg",180,5,20);
 		$this->SetFont("Times","B",40);
 		$this->SetTextColor(186,85,211);
 		$this->Cell(185,25,"Volar en Globo",0,0,"C");
 		$this->Ln(20);
 	}
 	function Footer(){
 		$this->Image("../../img/logo.jpg",180,260,20);
 		$this->Image("../../img/logo.jpg",5,260,20);
 		$this->SetY(-15);
 		$this->SetFont("Arial","I",8);
 		$this->Cell(0,10,"Pagina ". $this->PageNo().'/[nb]',0,0,"C");
 	}
 }
?>
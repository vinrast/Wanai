<?php namespace App;

use Anouar\Fpdf\Fpdf;

class Pdf extends FPDF{
 	function Header(){
		 // Logo
	    $this->Image('../public/imagen_pdf/logowanai.png',170,15,35);
	    // Arial bold 15
	    $this->SetFont('Arial','B',10);
	    $this->SetLeftMargin(20);
	    $this->Cell(0,17,utf8_decode('Agencia de Viajes y Turismo Wanai'),'L');
	    $this->Ln(6);
	    $this->Cell(0,17,utf8_decode('Telefono: xxxx-xxxxxx / xxxx-xxxxxxx'),'L');
	    $this->Ln(6);
	    $this->Cell(0,17,utf8_decode('Dirección: Caracas, Venezuela'),'L');
	    $this->Ln(6);
	    $this->Cell(0,17,utf8_decode('Email: Admin@wanaitravel.com'),'L');
	    $this->Ln(25);
	    // Movernos a la derecha
	    $this->Cell(60);

	    $this->SetFont('Arial','B',15);
	    $this->Cell(60,10,utf8_decode('Cotización'),1,0,'C');
	    // Salto de línea
	    $this->Ln(20);
	}

	// Pie de página
	function Footer(){

	    // Posición: a 1,5 cm del final
	    $this->SetY(-10);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,utf8_decode('Esta Cotización es valida solo por 1 día.'),0,0,'C');
	}
	function TablaBasica($header){

		$this->SetFont('Arial','B', 12);
    //Cabecera
		foreach($header as $col)
		$this->Cell(40,7,$col,1,'','C');
		$this->Ln();
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Ln();
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Ln();
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Ln();
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
		$this->Cell(40,5,"",1);
   }

}
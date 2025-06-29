<?php
session_start();
require('../fpdf/fpdf.php'); // Incluir la librería FPDF
class PDF extends FPDF
{
    function Header()
    {
        // Logo izquierda
        $this->Image('../Imagen/LogoRT.png', 10, 8, 45);
        
        // Logo derecha
        $this->Image('../Imagen/1.png', 160, 8, 45);
        
        // Título
        $this->SetFont('Arial','B',20);
        $this->SetY(25);
        $this->Setx(70);
        $this->Cell(70, 10, utf8_decode('RopaTech'), 1, 0, 'C');
        $this->Ln(13);
        
        // Subtítulo
        $this->SetFont('Arial', '', 16);
        $this->Cell(0, 7, utf8_decode('REPORTE DE CITAS'), 0, 0, 'C');
        $this->Ln(25);
    }
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
include("conexion.php");
$consulta="SELECT * FROM citas";
$resultado=$con->query($consulta);

$pdf = new PDF(); // Crear una instancia de la clase PDF
$pdf->AliasNbPages(); // Establecer el número total de páginas
$pdf->AddPage(); // Añadir una página al documento
$pdf->SetMargins(10,10,10);//se crea un margen en el documento
$pdf->SetAutoPageBreak(true,10);
//titulo citas
    $pdf->SetFont('Arial','B',8);
    $pdf->Ln(5);
    $pdf->setX(50);
    $pdf->SetFont('Arial','BU',16);
    $pdf->cell(100,7,utf8_decode('CITAS'),0,0,'C');
    $pdf->Ln(10);

    //encabezado de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'ID', 1, 0, 'C');
    $pdf->Cell(25, 10, 'ID_CITAS', 1, 0, 'C');
    $pdf->Cell(60, 10, 'DIRECCION', 1, 0, 'C');
    $pdf->Cell(25, 10, 'FECHA', 1, 0, 'C');
    $pdf->Cell(25, 10, 'MATERIAL', 1, 0, 'C');
    $pdf->Cell(20, 10, 'KILOS', 1, 0, 'C');
    $pdf->Cell(25, 10, 'ESTATUS', 1, 0, 'C');
    $pdf->Ln();
    $pdf->SetFont('Arial','',15);
while ($row=$resultado->fetch_assoc()){
    $pdf->SetFont('Arial','',15);
    $pdf->cell(10,10,utf8_decode($row['IDcitas']),1,0,'C');
    $pdf->cell(25,10,utf8_decode($row['ID']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->cell(60,10,utf8_decode($row['DIRECCION']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->cell(25,10,utf8_decode($row['FECHA']),1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->cell(25,10,utf8_decode($row['MATERIAL']),1,0,'C');
    $pdf->SetFont('Arial','',15);
    $pdf->cell(20,10,utf8_decode($row['KILOS']),1,0,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->cell(25,10,utf8_decode($row['ESTATUS']),1,1,'C');
}

$pdf->Output(); // Mostrar el PDF generado
?>

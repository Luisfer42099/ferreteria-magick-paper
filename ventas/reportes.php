<?php
require_once '../reportes/fpdf.php';

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        if (isset($_POST['fecha1']) && isset($_POST['fecha2'])) {
            $fecha1 = isset($_POST['fecha1']) ? $_POST['fecha1'] : false;
            $fecha2 = isset($_POST['fecha2']) ? $_POST['fecha2'] : false;
        } else {
            header('Location: ventas.php');
        }
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Reporte de ventas de ' . $fecha1 . ' a ' . $fecha2, 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
        $this->Cell(7, 10, 'Id', 1, 0, 'C', 0);
        $this->Cell(23, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Articulo', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Cant', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'vlr_unidad', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'Desc', 1, 0, 'C', 0);
        $this->Cell(25, 10, 'vlr_total', 1, 0, 'C', 0);
        $this->Cell(35, 10, 'Forma_pago', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Page ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}



require_once '../conrollers/ventascontroller.php';
$ventas = new Ventas();
$fecha1 = isset($_POST['fecha1']) ? $_POST['fecha1'] : false;
            $fecha2 = isset($_POST['fecha2']) ? $_POST['fecha2'] : false;
$activa = $ventas->getventasporfecha($fecha1, $fecha2);
$tot = $ventas->getTotal($fecha1, $fecha2);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

while ($res = mysqli_fetch_object($activa)) {
    $pdf->Cell(7, 10, $res->id, 1, 0, 'C', 0);
    $pdf->Cell(23, 10, $res->fecha, 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $res->articulo, 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $res->cantidad, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $res->vlr_unidad, 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $res->descuento, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $res->vlr_total, 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $res->forma_pago, 1, 1, 'C', 0);
}

$pdf->Cell(35, 10, 'Total: ' . $tot->total, 1, 1, 'C', 0);

$pdf->Output();

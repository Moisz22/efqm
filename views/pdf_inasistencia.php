<?php
require '../plugins/fpdf183/fpdf.php';
include '../models/ActaModel.php';

$actaModel = new ActaModel();

if (isset($_POST['fecha_desde'])&&isset($_POST['fecha_hasta'])) {
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $datosInasistentes = $actaModel->inasistentesPorFecha($fecha_desde, $fecha_hasta);
}
class PDF extends FPDF {
    var $widths;
    var $aligns;
    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }
    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }
function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}
    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) $this->AddPage($this->CurOrientation);
    }
    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = & $this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") $nb--;
        $sep = - 1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = - 1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') $sep = $i;
            $l+= $cw[$c];
            if ($l > $wmax) {
                if ($sep == - 1) {
                    if ($i == $j) $i++;
                } else $i = $sep + 1;
                $sep = - 1;
                $j = $i;
                $l = 0;
                $nl++;
            } else $i++;
        }
        return $nl;
    }
    function Header() {
        $this->Image('../dist/img/logo_pdf.jpg', 70, 3, 70, 15, 'JPG');
        $this->Ln(10);
    }
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetFont('Arial', 'B', 9);
        $this->SetY(-10);
        $this->MultiCell(0, 3, $this->PageNo(), 0, 'C');
    }
}
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->AliasNbPages('{totalPages}');
$pdf->SetMargins(20,20,20);
$pdf->SetFont('Arial','B',14);
$pdf->ln(5);
$pdf->Cell(0,1,utf8_decode('REPORTE DE FALTAS A REUNIONES DE EQUIPO'),0,1,'C');
$pdf->ln(5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0); 
$pdf->SetFont('Arial','B',9);
$pdf->ln(10);
$pdf->Cell(70,5, utf8_decode('MIEMBRO DEL EQUIPO'),'TB',0,'C',1);
$pdf->Cell(110,5, utf8_decode('EQUIPO'),'TB',1,'C',1);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(229, 229, 229);

foreach ($datosInasistentes as $row)
{
    $pdf->SetFont('Arial','B',9);
    $pdf->Ln(4);
    $pdf->Cell(70,1,utf8_decode($row->descripcion_persona), 0, 0, 'C');
    $pdf->Cell(110,1,utf8_decode($row->descripcion_equipo_trabajo), 0, 0, 'C');
    $pdf->Ln(2);
    $datoFecha = $actaModel->inasistencia($row->id_persona, $fecha_desde, $fecha_hasta);
    foreach ($datoFecha as $rowd)
    {
        $pdf->SetFont('Arial','',9);
        $pdf->Ln(2);
        $pdf->Cell(70,5, utf8_decode(date('d/m/Y', strtotime($rowd->fecha_acta))),0,0,'C',false);
    	$pdf->Cell(110,5, utf8_decode(''),0,1,'C',false);
    }
    $pdf->Ln(2);
    $pdf->Cell(120,5,'_____________________________________________________________________________________________________',0,0,'L',false);
    $pdf->Ln(4);

}
$pdf->Output();

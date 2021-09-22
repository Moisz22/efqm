<?php
require '../plugins/fpdf/fpdf.php';
include '../models/ProcesoModel.php';
include '../models/ActividadModel.php';
$amodel = new ActividadModel;
$rmodel = new ProcesoModel;

if (isset($_POST['tipo_proceso'])) {
    $id_tipo_proceso = $_POST['tipo_proceso'];
    $datosProceso = $rmodel->consultaProcesoPorTipo($id_tipo_proceso);
    $datosTipoProceso = $rmodel->searchTableWhere('tipo_proceso', 'id_tipo_proceso', $id_tipo_proceso);
    $nombre_tipo_proceso = $datosTipoProceso[0]->descripcion_tipo_proceso;
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
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(5);
$pdf->MultiCell(190, 1, utf8_decode('REPORTE POR TIPOS DE PROCESO'), 0, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(8);
$pdf->SetFillColor(60,141,188);//Fondo verde de celda
$pdf->SetTextColor(0,0,0); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
$pdf->SetDrawColor(0,0,0);
$pdf->Cell(190, 10, utf8_decode($nombre_tipo_proceso), 1, 1, 'C');
$pdf->Cell(40, 10, utf8_decode('NOMBRE'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('RESPONSABLE'), 1, 0, 'C');
$pdf->Cell(110, 10, utf8_decode('ACTIVIDADES'), 1, 1, 'C');
$pdf->SetWidths(array(40,40,110));
$pdf->SetFont('Arial', '', 9);
foreach ($datosProceso as $row)
{   
    $datos_actividad = '';
    $actividades = $amodel->consulta($row->id_proceso);
    foreach ($actividades as $rowa) :
        $datos_actividad .= $datos_actividad =='' ? $rowa->orden_actividad.') '.nl2br($rowa->descripcion_actividad) : "\n".$rowa->orden_actividad.') '.$rowa->descripcion_actividad;
    endforeach;
    $pdf->Row(array(utf8_decode($row->descripcion_proceso."\n".$row->abreviatura_tipo_proceso.'-'.$row->abreviatura_proceso.'-'.$row->secuencial_proceso),utf8_decode( $row->propietario),utf8_decode($datos_actividad)));
}
$pdf->Output();

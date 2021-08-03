<?php
require '../plugins/fpdf183/fpdf.php';
include '../models/ActaModel.php';
include '../controllers/ActaController.php';
$rmodel = new ActaModel;
$actaController = new ActaController;

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $datoActa = $rmodel->datosActa($id);
    $nombre_equipo = utf8_decode(mb_strtoupper($datoActa[0]->descripcion_equipo_trabajo));
    $secuencial = $datoActa[0]->secuencial_acta;
    $fecha_acta = $datoActa[0]->fecha_acta;
    $hora_inicio_acta = $datoActa[0]->hora_inicio_acta;
    $nombre_lugar = utf8_decode($datoActa[0]->descripcion_lugar);
    $asistentes = $rmodel->consultaAsistentes($id);
    $desarrollo_acta = $datoActa[0]->desarrollo_acta;
    $hora_finalizacion_acta = $datoActa[0]->hora_finalizacion_acta;
    $bitacora_aprendizaje_acta = $datoActa[0]->bitacora_aprendizaje_acta;
}
class PDF extends FPDF
{
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }

    function Header()
    {
        $this->Image('../dist/img/logo_pdf.jpg', 70, 3, 70, 15, 'JPG');
        $this->Ln(5);
    }
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetFont('Arial', 'B', 9);
        $this->SetY(-10);
        $this->MultiCell(0, 3, $this->PageNo(), 0, 'C');
    }

    function OneTable($header, $data, $x = 0, $y = 0)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(223, 222, 222); //Fondo verde de celda
        $this->SetTextColor(0, 0, 0); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
        $this->SetXY($x, $y);
        // Header
        foreach ($header as $col)
            $this->Cell(160, 7, $col, 1, 0, 'C', true);
        $this->Ln();

        // Data
        $i = 7;
        $this->SetXY($x, $y + $i);
        foreach ($data as $row) {
            foreach ($row as $col) {
                //$this->SetXY($x , $y + $i);		$this->SetXY(25,17);
                $this->SetFont('Arial', '', 10);
                $this->SetFillColor(255, 255, 255); //Gris tenue de cada fila
                $this->SetTextColor(3, 3, 3); //Color del texto: Negro
                $bandera = false; //Para alternar el relleno
                $this->MultiCell(160, 7, $col, 1, 1, 'L', 1);
            }
            $i = $i + 6;  // incremento el valor de la columna
            $this->SetXY($x, $y + $i);
            //$this->Ln();
        }
    }
}
$meses = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
$pdf = new PDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetMargins(20, 20, 20);
$pdf->SetFont('Arial', 'B', 14);
$pdf->ln(12);
$pdf->Cell(0, 1, 'ACTA DE EQUIPO DE ' . $nombre_equipo . ' #  ' . $secuencial, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 15, utf8_decode('Guayaquil, ' . date('d', strtotime($fecha_acta)) . ' de ' . $meses[date('n', strtotime($fecha_acta))] . ' de ' . date('Y', strtotime($fecha_acta))), 0, 1, 'R');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(177, 6, utf8_decode('Al día ' . $actaController->convertirFechaLetra(date('j', strtotime($fecha_acta))) . ' del mes de ' . $meses[date('n', strtotime($fecha_acta))] . ' de ') . $actaController->convertirFechaLetra(date('Y', strtotime($fecha_acta))) . ', siendo las ' . date('H', strtotime($hora_inicio_acta)) . 'h' . date('i', strtotime($hora_inicio_acta)) . ' en ' . $nombre_lugar . ' se' . utf8_decode(' reunió') . ' el equipo de ' . $nombre_equipo . ' conformado por los siguientes integrantes:', 0, 'J');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 14);
$pdf->MultiCell(177, 6, utf8_decode('Nómina de Integrantes: '), 0, 'J');
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(223, 222, 222); //Fondo verde de celda
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(160, 7, 'NOMBRES Y APELLIDOS DE MIEMBROS', 1, 0, 'C', true);
$pdf->Ln();
foreach ($asistentes as $row) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
    $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
    if ($row->es_miembro_equipo == 1) {
        $pdf->Cell(5);
        $pdf->MultiCell(160, 7, utf8_decode($row->impresion_persona), 1, 1, 'L', 1);
    }
}
$pdf->Ln(6);
$pdf->Cell(5);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(223, 222, 222); //Fondo verde de celda
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(160, 7, 'NOMBRES Y APELLIDOS DE INVITADOS', 1, 0, 'C', true);
$pdf->Ln();
foreach ($asistentes as $rowa) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
    $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro

    if ($rowa->es_miembro_equipo == 0) {
        $pdf->Cell(5);
        $pdf->MultiCell(160, 7, utf8_decode($rowa->impresion_persona), 1, 1, 'L', 1);
    }
}
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 14);
$pdf->MultiCell(177, 6, utf8_decode('Desarrollo de la Reunión y Resoluciones: '), 0, 'J');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);
$pdf->MultiCell(177, 6, utf8_decode($desarrollo_acta), 0, 'J');
$pdf->Ln(5);
$pdf->MultiCell(177, 6, 'Siendo las ' . $actaController->convertirFechaLetra(date('g', strtotime($hora_finalizacion_acta))) . ' horas ' . $actaController->convertirFechaLetra(intval(date('i', strtotime($hora_finalizacion_acta)))) . ' minutos se da por concluida la ' . utf8_decode('sesión') . ', firman para constancia los miembros del equipo ' . $nombre_equipo . '.', 0, 'J');
$pdf->AddPage();
$pdf->MultiCell(177, 6, utf8_decode('Suscribimos la presente ACTA # ') . $secuencial . ' DE EQUIPO DE ' . $nombre_equipo . ' DEL ' . date('d', strtotime($fecha_acta)) . ' DE ' . strtoupper($meses[date('n', strtotime($fecha_acta))]) . ' DE ' . date('Y', strtotime($fecha_acta)) . ':', 0, 'J');
$indice = 0;
foreach ($asistentes as $row1) {
    $indice++;
    if ($indice % 2 == 0) {
        $pdf->Ln(-12);

        if ($row1->fl_asistencia == 1) {

            $pdf->Cell(100);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(80, 4, '________________________________', 0, 'C');
            $pdf->Cell(100);
            $pdf->MultiCell(80, 4, utf8_decode($row1->impresion_persona), 0, 'C');
            $pdf->Cell(100);
            $pdf->MultiCell(80, 4, utf8_decode($row1->descripcion_cargo), 0, 'C');
            $pdf->Cell(100);
        } else {
            $pdf->Ln(-4);
            $pdf->Cell(100);
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(80, 4, 'AUSENTE', 0, 'C');
            $pdf->Cell(100);
            $pdf->MultiCell(80, 4, '________________________________', 0, 'C');
            $pdf->Cell(100);
            $pdf->MultiCell(80, 4, utf8_decode($row1->impresion_persona), 0, 'C');
            $pdf->Cell(100);
            $pdf->MultiCell(80, 4, utf8_decode($row1->descripcion_cargo), 0, 'C');
            $pdf->Cell(100);
        }
    } else {
        $pdf->Ln(30);
        if ($row1->fl_asistencia == 1) {
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(80, 4, '________________________________', 0, 'C');
            $pdf->MultiCell(80, 4, utf8_decode($row1->impresion_persona), 0, 'C');
            $pdf->MultiCell(80, 4, utf8_decode($row1->descripcion_cargo), 0, 'C');
        } else {
            $pdf->SetFont('Arial', '', 10);
            $pdf->MultiCell(80, 4, 'AUSENTE', 0, 'C');
            $pdf->MultiCell(80, 4, '________________________________', 0, 'C');
            $pdf->MultiCell(80, 4, utf8_decode($row1->impresion_persona), 0, 'C');
            $pdf->MultiCell(80, 4, utf8_decode($row1->descripcion_cargo), 0, 'C');
        }
    }
}
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(177, 6, utf8_decode('BITÁCORA DE APRENDIZAJE'), 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->SetDrawColor(31, 73, 125);
$pdf->SetLineWidth(.10);
$pdf->MultiCell(177, 6, utf8_decode($bitacora_aprendizaje_acta), 1, 1, 'C');
$pdf->Output();

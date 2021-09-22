<?php
require '../plugins/fpdf/fpdf.php';
include '../models/ProcesoModel.php';
include '../models/PoliticaModel.php';
include '../models/ActividadModel.php';
include '../models/SubactividadModel.php';
include '../models/AnexoProcesoModel.php';
include '../models/ControlCambioModel.php';
include '../models/RecursoProcesoModel.php';
include '../models/IndicadorModel.php';
$rmodel = new ProcesoModel;
$pmodel = new PoliticaModel;
$amodel = new ActividadModel;
$subactividadModel = new SubactividadModel;
$anexoProcesoModel = new AnexoProcesoModel;
$controlCambioModel = new ControlCambioModel;
$recursoProcesoModel = new RecursoProcesoModel;
$indicadorModel = new IndicadorModel;
if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);
    $datoProceso = $rmodel->datosProceso($id);
    $secuencial_proceso = $datoProceso[0]->secuencial_proceso;
    $nombre_proceso = $datoProceso[0]->descripcion_proceso;
    $abreviatura_proceso = $datoProceso[0]->abreviatura_proceso;
    $abreviatura_tipo_proceso = $datoProceso[0]->abreviatura_tipo_proceso;
    $propietario = $datoProceso[0]->propietario;
    $version = $datoProceso[0]->version;
    $fecha_elaboracion = $datoProceso[0]->fecha_elaboracion_proceso;
    $objetivo = $datoProceso[0]->objetivo_proceso;
    $politicas = $pmodel->consulta($id);
    $alcance = $datoProceso[0]->alcance_proceso;
    $actividades = $amodel->consulta($id);
    $anexos = $anexoProcesoModel->consulta($id);
    $procesosRelacionados = $rmodel->selected('proceso_relacionado', 'id_proceso', $id);
    $responsables = $rmodel->selected('responsable_proceso', 'id_proceso', $id);
    $versiones = $controlCambioModel->consulta($id);
    $recursos = $recursoProcesoModel->consulta($id);
    $indicadores = $rmodel->selected('proceso_indicador', 'id_proceso', $id);
    $datosAprobacion = $rmodel->datosAprobacion($id);
    if(!empty($datosAprobacion))
    {
        $aprobadoPor = $datosAprobacion[0]->descripcion_cargo;
        $fechaAprobacion = date('d/m/Y', strtotime($datosAprobacion[0]->fecha_aprobacion));
    }
    else
    {
        $aprobadoPor = '';
        $fechaAprobacion = '';
    }
    
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
    //FIN COMPLEMENTOS PARA MULTICELL
    function BasicTable($header, $data, $x = 0, $y = 0)
    {
        $this->SetFont('Arial', 'B', 8.5);
        $this->SetFillColor(35, 28, 30); //Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0);
        $this->SetXY($x, $y);

        // Header
        foreach ($header as $col)
            $this->Cell(95, 7, utf8_decode($col), 1, 0, 'L', true);
        $this->Ln();

        // Data
        $i = 7;
        $this->SetXY($x, $y + $i);
        foreach ($data as $row) {
            foreach ($row as $col) {
                //$this->SetXY($x , $y + $i);       $this->SetXY(25,17);
                $this->SetFont('Arial', '', 8.5);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $this->SetDrawColor(0, 0, 0);
                $this->SetLineWidth(0);
                $this->MultiCell(95, 7, utf8_decode($col), 1, 1, 'L', 1);
            }
            $i = $i + 6;  // incremento el valor de la columna
            $this->SetXY($x, $y + $i);
            //$this->Ln();
        }
    }
    function MultiCellBltArray($w, $h, $blt_array, $border = 0, $align = 'J', $fill = false)
    {
        if (!is_array($blt_array)) {
            die('MultiCellBltArray requires an array with the following keys: bullet,margin,text,indent,spacer');
            exit;
        }

        //Save x
        $bak_x = $this->x;

        for ($i = 0; $i < sizeof($blt_array['text']); $i++) {
            //Get bullet width including margin
            $blt_width = $this->GetStringWidth($blt_array['bullet'] . $blt_array['margin']) + $this->cMargin * 2;

            // SetX
            $this->SetX($bak_x);

            //Output indent
            if ($blt_array['indent'] > 0)
                $this->Cell($blt_array['indent']);
            $this->SetFont('Arial', '', 10);
            //Output bullet
            $this->Cell($blt_width, $h, $blt_array['bullet'] . $blt_array['margin'], 0, '', $fill);

            //Output text
            $this->MultiCell($w - $blt_width, $h, utf8_decode($blt_array['text'][$i]), $border, $align, $fill);

            //Insert a spacer between items if not the last item
            if ($i != sizeof($blt_array['text']) - 1)
                $this->Ln($blt_array['spacer']);

            //Increment bullet if it's a number
            if (is_numeric($blt_array['bullet']))
                $blt_array['bullet']++;
        }

        //Restore x
        $this->x = $bak_x;
    }

    function Header()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(255, 255, 255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(53, 10, $this->Image("../dist/img/logo_pdf.jpg", 17, 10, 40, 10), 1);
        $this->ln();
        $this->Cell(53, 5, utf8_decode('Código: ') . $GLOBALS['abreviatura_tipo_proceso'] . "-" . $GLOBALS['abreviatura_proceso'] . "-".$GLOBALS['secuencial_proceso'], 1, 1, 'C');
        $this->Cell(2);
        $this->SetXY(63, 10);
        $this->Cell(84, 15, $GLOBALS['nombre_proceso'], 1, 1, 'C');
        $this->SetXY(147, 10);
        $this->Cell(53, 10, utf8_decode('Página: ') . $this->PageNo() . "/{totalPages}", 1, 1, 'C');
        $this->ln();
        $this->SetXY(147, 20);
        $this->Cell(53, 5, utf8_decode("Versión: ") . $GLOBALS['version'], 1, 1, 'C');
        $header = array("Elaborado por: " . $GLOBALS['propietario'], "Aprobado por: " . $GLOBALS['aprobadoPor']);
        $data1 = [];
        $this->OneTable1($header, $data1, 25, 219);
        $header = array("Fecha de elaboración: " . date('d/m/Y', strtotime($GLOBALS['fecha_elaboracion'])), "Fecha de aprobación: " . $GLOBALS['fechaAprobacion']);
        $data1 = [];
        $this->OneTable1($header, $data1, 25, 219);
        $this->ln();
    }
    function OneTable($header, $data, $x = 0, $y = 0)
    {
        $this->SetFont('Arial', 'B', 8.5);
        $this->SetFillColor(35, 28, 30); //Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
        //$this->SetXY($x , $y);
        // Header
        foreach ($header as $col)
            $this->Cell(190, 7, utf8_decode($col), 1, 0, 'L', true);
        $this->Ln();

        // Data
        //$i = 7;
        //$this->SetXY($x , $y + $i);
        foreach ($data as $row) {
            foreach ($row as $col) {
                //$this->SetXY($x , $y + $i);       $this->SetXY(25,17);
                $this->SetFont('Arial', '', 8.5);
                $this->SetFillColor(255, 255, 255); //Gris tenue de cada fila
                $this->SetTextColor(3, 3, 3); //Color del texto: Negro
                $bandera = false; //Para alternar el relleno
                $this->MultiCell(190, 7, $col, 1, 1, 'L', 1);
            }
            //$i= $i + 6 ;  // incremento el valor de la columna
            //$this->SetXY($x , $y + $i);       
            //$this->Ln();
        }
    }
    function OneTable1($header, $data, $x = 0, $y = 0)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(255, 255, 255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetTextColor(0, 0, 0);
        //$this->SetXY($x , $y);
        // Header
        foreach ($header as $col)
            $this->Cell(95, 5, utf8_decode($col), 1, 0, 'L', true);
        $this->Ln();

        // Data
        //$i = 7;
        //$this->SetXY($x , $y + $i);
        foreach ($data as $row) {
            foreach ($row as $col) {
                //$this->SetXY($x , $y + $i);       $this->SetXY(25,17);
                $this->SetFont('Arial', '', 10);
                $this->SetFillColor(255, 255, 255);
                $this->SetDrawColor(0, 0, 0);
                $this->SetTextColor(0, 0, 0);
                $bandera = false; //Para alternar el relleno
                $this->MultiCell(95, 7, utf8_encode($col), 1, 1, 'L', 1);
            }
            //$i= $i + 6 ;  // incremento el valor de la columna
            //$this->SetXY($x , $y + $i);       
            //$this->Ln();
        }
    }
}
$pdf = new PDF();
$pdf->SetFont('Arial', 'B', 10);
$pdf->AliasNbPages('{totalPages}');
$pdf->AddPage();
$pdf->Cell(53, 5, '1. Objetivo.-', 0, 0, 'L');
$pdf->ln();
$pdf->SetFont('Arial', '', 10);
$pdf->cell(4);
$pdf->MultiCell(185, 5, utf8_decode($objetivo), 0, 'J');
$pdf->ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('2. Política.- '), 0, 1);
$pdf->ln(2);
$pdf->SetFont('Arial', '', 10);
$array_politicas = array();
$array_politicas['bullet'] = chr(149);
$array_politicas['margin'] = ' ';
$array_politicas['indent'] = 0;
$array_politicas['spacer'] = 0;
$array_politicas['text'] = array();
$i = 0;
foreach ($politicas as $rowp) :
    $array_politicas['text'][$i] = $rowp->descripcion_politica;
    $i++;
endforeach;
$pdf->cell(4);
$pdf->MultiCellBltArray(190, 6, $array_politicas);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('3. Alcance.- '), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->cell(4);
$pdf->MultiCell(185, 5, utf8_decode($alcance), 0, 'J');
$pdf->SetFont('Arial', 'B', 10);
$pdf->ln(2);
$pdf->MultiCell(195, 5, utf8_decode('4. Procedimiento.- '), 0, 1);
$indice_actividad = 1;
foreach ($actividades as $rowa) :
    $pdf->SetFillColor(60, 141, 188);
    $pdf->SetTextColor(240, 255, 240);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(190, 5, '4.' . $indice_actividad . '. ' . utf8_decode($rowa->descripcion_actividad), 1, 0, 'L', true);
    $pdf->ln();
    $subactividades = $subactividadModel->consulta($rowa->id_actividad);
    foreach ($subactividades as $rows) :
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(3, 3, 3);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(190, 5, chr(149) . ' ' . utf8_decode($rows->descripcion_subactividad), 1, 'J', 1);
    endforeach;
    $indice_actividad++;
endforeach;
$pdf->Ln(4);
$pdf->SetTextColor(3, 3, 3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('5. Anexos.- '), 0, 1);
$indice_anexo = 1;
foreach ($anexos as $rowax) :
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0);
    $pdf->MultiCell(40, 6, $abreviatura_proceso . "-" . $rowax->abreviatura_tipo_documento . "-" . $indice_anexo, 1, 1, 'LR', 'L', 1);
    $pdf->Ln(-6);
    $pdf->Cell(40);
    $pdf->SetTextColor(2, 2, 255);
    $pdf->Cell(150, 6, utf8_decode($rowax->descripcion_tipo_documento), 1, 1, '', 1, "../storage/anexo_proceso/" . $rowax->ruta_anexo_proceso);
    $indice_anexo++;
endforeach;
$pdf->Ln(4);
$pdf->SetTextColor(3, 3, 3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('6. Procesos relacionados.- '), 0, 1);
if ($procesosRelacionados != false) {
    foreach ($procesosRelacionados as $rowpr) :
        $pdf->SetFont('Arial', '', 8.5);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0);
        $nombre_proceso_relacionado = $rmodel->searchTableWhere('proceso', 'id_proceso', $rowpr['id_proceso_relacionado']);
        $pdf->MultiCell(190, 6, utf8_decode($nombre_proceso_relacionado[0]->descripcion_proceso), 1, 1, 'LR', 'L', 1);
    endforeach;
}

$pdf->Ln(4);
$pdf->SetTextColor(3, 3, 3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('7. Responsables.- '), 0, 1);
if ($responsables != false) {
    foreach ($responsables as $rowres) :
        $pdf->SetFont('Arial', '', 8.5);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0);
        $nombre_responsable = $rmodel->searchTableWhere('cargo', 'id_cargo', $rowres['id_cargo']);
        $pdf->MultiCell(190, 6, utf8_decode($nombre_responsable[0]->descripcion_cargo), 1, 1, 'LR', 'L', 1);
    endforeach;
}
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('8. Control de cambios.- '), 0, 1);
$pdf->SetFillColor(60, 141, 188);
$pdf->SetTextColor(240, 255, 240);
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(40, 5, utf8_decode("Versión"), 1, 0, 'C', true);
$pdf->Cell(150, 5, utf8_decode("Cambio Efectuado"), 1, 0, 'C', true);
$pdf->ln();
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
$pdf->SetTextColor(3, 3, 3);
$pdf->SetWidths(array(40, 150));
foreach ($versiones as $rowve) :
    $pdf->Row(array(utf8_decode('Version ' . $rowve->descripcion_version), utf8_decode($rowve->descripcion_control_cambio)));
endforeach;
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(195, 5, utf8_decode('9. Control del proceso.- '), 0, 1);
$pdf->SetFillColor(60, 141, 188); //Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(58.85, 5, utf8_decode("ENTRADA"), 1, 0, 'C', true);
$pdf->Cell(72.3, 5, utf8_decode("PROCESO"), 1, 0, 'C', true);
$pdf->Cell(58.85, 5, utf8_decode("SALIDA"), 1, 0, 'C', true);
$pdf->ln();
$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(255, 255, 255); //Gris tenue de cada fila
$pdf->SetTextColor(3, 3, 3);
$pdf->SetFont('Arial', '', 10);
$pdf->SetWidths(array(58.85, 72.3, 58.85));
foreach ($actividades as $rowacp) :
    $datos_entrada = '';
    $entradas = $rmodel->searchTableWhere('entrada', 'id_actividad', $rowacp->id_actividad);
    foreach ($entradas as $rowen) :
        $datos_entrada .= $datos_entrada == '' ? "* " . nl2br($rowen->descripcion_entrada) . "\n " : "\n * " . $rowen->descripcion_entrada . "\n ";
    endforeach;
    $datos_salida = '';
    $salidas = $rmodel->searchTableWhere('salida', 'id_actividad', $rowacp->id_actividad);
    foreach ($salidas as $rowsa) :
        $datos_salida .= $datos_salida == '' ? "* " . nl2br($rowsa->descripcion_salida) . "\n " : "\n * " . $rowerowsan->descripcion_salida . "\n ";
    endforeach;
    $pdf->Row(array(utf8_decode($datos_entrada), utf8_decode($rowacp->descripcion_actividad), utf8_decode($datos_salida)));
endforeach;
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(60, 141, 188); //Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190, 5, utf8_decode("RECURSOS"), 1, 0, 'C', true);
$pdf->ln();
foreach ($recursos as $rowrec) :
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetLineWidth(0);
    $pdf->MultiCell(190, 6, utf8_decode($rowrec->descripcion_recurso), 1, 1, 'LR', 'L', 1);
endforeach;
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(60, 141, 188); //Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); //Letra color blanco //Atención!! el parámetro true rellena la celda con 
$pdf->SetDrawColor(0, 0, 0);
$pdf->Cell(190, 5, utf8_decode("INDICADORES DE GESTIÓN"), 1, 0, 'C', true);
$pdf->ln();
$pdf->Cell(42.3, 5, utf8_decode("Indicador"), 1, 0, 'C', true);
$pdf->Cell(83.1, 5, utf8_decode("Fórmula"), 1, 0, 'C', true);
$pdf->Cell(32.3, 5, utf8_decode("Meta"), 1, 0, 'C', true);
$pdf->Cell(32.3, 5, utf8_decode("Frecuencia"), 1, 0, 'C', true);
$pdf->ln();
$pdf->SetWidths(array(42.3, 83.1, 32.3, 32.3));
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial', '', 10);
if ($indicadores != false) {
    foreach ($indicadores as $rowin) :
        $dato_indicador = $indicadorModel->consultaIdicadorFichaProceso($rowin['id_indicador']);
        $pdf->Row(array(utf8_decode($dato_indicador[0]->descripcion_indicador), utf8_decode($dato_indicador[0]->formula_indicador), $dato_indicador[0]->meta_indicador, $dato_indicador[0]->descripcion_frecuencia));
    endforeach;
}
$pdf->Output();

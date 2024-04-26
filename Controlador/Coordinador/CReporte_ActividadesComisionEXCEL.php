<?php

session_start();

if ($_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 4 && $_SESSION['PersonaAcademica']['ID_Tipo_Usuario'] != 3)   {


    header('Location: ../../Vista/General/Iniciar_Sesion.php');//Aqui lo redireccionas al lugar que quieras.
    die();

}
require_once("../../Modelo/Coordinador/MComisionAsignada.php");

$MCAsignada = new ModComisionA();

if (isset($_GET['variable1'])) {
    $IDcomisionA = $_GET['variable1'];
} 
if (isset($_GET['variable2'])) {
    $variable2 = $_GET['variable2'];
}

$ActividadesCom = $MCAsignada->Listar_ReporteActividadesComisionExcell($IDcomisionA);
$NombreFeria = $MCAsignada->ConsultarNombreFeria();









$titleXLSX = "Plan de Trabajo " . $variable2 . ".xlsx";

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_LETTER);
$sheet->getPageSetup()->setFitToPage(true);

// Agrega el contenido dinámico a las celdas correspondientes
$sheet->setCellValue('B2', 'UNIVERSIDAD NACIONAL DE INGENIERÍA');
$sheet->setCellValue('B3', 'FACULTAD DE CIENCIAS Y SISTEMAS');
$sheet->setCellValue('B4', $NombreFeria);
$sheet->setCellValue('B5', 'Plan de Trabajo de la ' . $variable2);

$sheet->mergeCells('B2:F2');
$sheet->mergeCells('B3:F3');
$sheet->mergeCells('B4:F4');
$sheet->mergeCells('B5:F5');

// Ajusta el ancho de las columnas para adaptarse al contenido
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);

// Obtén el estilo de las celdas combinadas y establece la alineación centrada
$style = $sheet->getStyle('B2:D5');
$alignment = $style->getAlignment();
$alignment->setHorizontal(Alignment::HORIZONTAL_CENTER);
$alignment->setVertical(Alignment::VERTICAL_CENTER);
// Agrega los datos de las actividades a la tabla
$encabezados = array(
    'N',
    'Actividad',
    'Descripción',
    'Fecha Inicio',
    'Fecha Fin',
    'Responsables',
    'Comision de Apoyo',
    'Otros Participantes',
    'Requerimientos'
);

// Ajustar el ancho de las celdas de los encabezados
$column = 'A';
foreach ($encabezados as $encabezado) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
    $column++;
}

// Establecer la variable $row antes de agregar los encabezados
$row = 8;

// Agrega los encabezados de las columnas
$sheet->fromArray($encabezados, null, 'A' . $row);
$row++;

// Agrega los datos de las actividades a la tabla
$actividades = explode("</tr>", $ActividadesCom);
foreach ($actividades as $actividad) {
    $column = 0;
    $tds = explode("</td>", $actividad);
    foreach ($tds as $td) {
        $value = strip_tags($td);
        
        // Ajustar el ancho de la columna de la actividad
        if ($column === 1) {
            $sheet->getColumnDimensionByColumn($column)->setAutoSize(true);
            $sheet->getStyleByColumnAndRow($column, $row)->getAlignment()->setWrapText(true);
        }
        
        $sheet->setCellValueByColumnAndRow($column, $row, $value);
        $column++;
    }
    $row++;
}

// Ajustar el ancho de las celdas de los datos de las actividades
$columnCount = count($encabezados);
for ($i = 0; $i < $columnCount; $i++) {
    $sheet->getColumnDimensionByColumn($i)->setAutoSize(true);
}

$encabezadosStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '84A3DA'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_MEDIUM,
            'color' => ['rgb' => '000000'],
        ],
    ],
];

// Estilo de la tabla de actividades
$actividadesStyle = [
    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'],
        ],
    ],
];


// Aplicar estilo a la tabla de encabezados
$sheet->getStyle('A8:I8')->applyFromArray($encabezadosStyle);

// Aplicar estilo a la tabla de actividades
$lastRow = $row - 2; // Última fila de las actividades
$sheet->getStyle('A8:I' . $lastRow)->applyFromArray($actividadesStyle);
// Mostrar la imagen del logo de la universidad
$logoImagePath = '../../Assets/imagenes/Recursos/Logo_UNI.png';
$logo = new Drawing();
$logo->setPath($logoImagePath);
$logo->setHeight(120);
$logo->setWidth(120);
$logo->setCoordinates('B2');
$logo->setWorksheet($sheet);

// Configurar encabezados HTTP para descargar el archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $titleXLSX . '"');
header('Cache-Control: max-age=0');

// Crear un escritor para el archivo de salida
$writer = new Xlsx($spreadsheet);

// Guardar el archivo Excel en la salida
$writer->save('php://output');
/*

// Mostrar la imagen del logo de la universidad
$logoImagePath = '../../Assets/imagenes/Recursos/Logo_UNI.png';
$logo = new Drawing();
$logo->setPath($logoImagePath);
$logo->setHeight(80);
$logo->setWidth(80);
$logo->setCoordinates('A2');
$logo->setWorksheet($sheet);

// Crear un escritor para el archivo de salida
$writer = new Xlsx($spreadsheet);
/*
// Guardar el archivo Excel en un buffer de salida
ob_start();
$writer->save('php://output');
$spreadsheetData = ob_get_clean();

// Configurar encabezados HTTP para mostrar el archivo Excel en el navegador
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: inline; filename="PruebaUNI.xlsx"');
header('Cache-Control: max-age=0');

// Imprimir los datos del archivo Excel en la salida
echo $spreadsheetData;*/
?>

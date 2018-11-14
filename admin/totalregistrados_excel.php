<?php

require '../vendor/autoload.php';
require ('../inc/config.php');
require ('../inc/conexion.php');
require ('php/nuevoestado.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$query = mysqli_query($conexion, "SET @row_number=0;");
$querytext="SELECT (@row_number:=@row_number + 1) AS num,id,nombreyapellidoInput,pais,estudiante,universidad,carrera,correoElectronico,telefono,facebook,instagram,fechaNacimiento,estado 
            FROM login";
$query = mysqli_query($conexion, $querytext);
$estado = array();
while($row = mysqli_fetch_assoc($query)) {
    $row['estado']=nuevoestado($row['estado']);
    $estado[] = $row;
}
$titulos = ["Codigo Usuario","Id","Nombre","Nacionalidad","Nivel","Universidad","Carrera","Correo Electronico","Teléfono" ,"Facebook","Instagram","Fecha Nacimiento","Estado"];

$spreadsheet = new Spreadsheet();
// Set document properties
$spreadsheet->getProperties()->setCreator('CLEIN República Dominicana')
    ->setLastModifiedBy('CLEIN República Dominicana')
    ->setTitle('Usuarios Registrados CLEIN República Dominicana')
    ->setSubject('UsuariosRegistrados '.date("Y-m-d_Hi"))
    ->setDescription('Usuarios Registrados CLEIN República Dominicana hasta '.date("Y-m-d_Hi"))
    ->setKeywords('')
    ->setCategory('');
try{
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(
        $titulos,  // The data to set
        NULL,        // Array values with this value will not be set
        'A1'         // Top left coordinate of the worksheet range where
    //    we want to set these values (default is A1)
    );
    $sheet->fromArray(
        $estado,  // The data to set
        NULL,        // Array values with this value will not be set
        'A2'         // Top left coordinate of the worksheet range where
    //    we want to set these values (default is A1)
    );
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    $sheet->getColumnDimension('I')->setAutoSize(true);
    $sheet->getColumnDimension('J')->setAutoSize(true);
    $sheet->getColumnDimension('K')->setAutoSize(true);
    $sheet->getColumnDimension('L')->setAutoSize(true);

// Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Listado');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="UsuariosRegistrados-'.date("Y-m-d_Hi").'.xlsx"');
    header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
}catch(Exception $exception)
{

}



exit;

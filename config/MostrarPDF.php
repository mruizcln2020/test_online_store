<?php

$pdf = $_GET['filePath'];
//echo $pdf;

//$mi_pdf = 'ANALITICAS.pdf';
/*
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$pdf.'"');
echo readfile($pdf);
*/

if (file_exists($pdf)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($pdf).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($pdf));
    echo readfile($pdf);

}



?>
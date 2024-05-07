<?php

// Include PhpSpreadsheet autoloader
require "vendor/vendor/autoload.php";
// Include dependencies
include("config.php");
include("Faculty_Cover.php");

// Fetch data from the database
// (Assuming $result variable contains the fetched data)

// Create Excel file
$objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $objPHPExcel->getActiveSheet();

// Define table headers
$headers = ["#", "Applicant #", "Last Name", "Middle Name", "First Name", "Classification", "GWA", "Test Score"];
// Add headers to the first row
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

// Add data to the Excel sheet
$rowCount = 2;
while ($row = $result->fetch_assoc()) {
    $column = 'A';
    foreach ($row as $cell) {
        $sheet->setCellValue($column . $rowCount, $cell);
        $column++;
    }
    $rowCount++;
}

// Set appropriate headers for Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="faculty_data.xlsx"');
header('Cache-Control: max-age=0');

// Save Excel file to output
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$writer->save('php://output');
exit;
?>

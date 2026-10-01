<?php
// Include Composer autoloader
require_once 'vendor/autoload.php';

use Smalot\PdfParser\Parser;

// 1. Parse the PDF file
$parser = new Parser();
$pdf = $parser->parseFile('Barbara.pdf');
$text = $pdf->getText();

// 2. Process text into lines or rows
// Split text by new lines
$lines = explode("\n", $text);

// 3. Open a file pointer for the output CSV
$csvFile = fopen('Barbara.csv', 'w');

foreach ($lines as $line) {
    // Basic example: Split each line by spaces or tabs, or apply custom regex
    // Adjust delimiter matching based on your PDF's internal structure
    $row = preg_split('/\s+/', trim($line));
    
    // Write data to CSV file
    if (!empty(array_filter($row))) {
        fputcsv($csvFile, $row);
    }
}

// 4. Close the file pointer
fclose($csvFile);

echo "PDF successfully converted to output.csv!";
?>
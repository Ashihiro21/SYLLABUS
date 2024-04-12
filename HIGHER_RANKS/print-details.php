<?php 
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('generate_pdf_syllabus.php');
$html =ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('syllabus.pdf',['Attachment'=>false]);

// Close the database connection
$conn->close();
?>

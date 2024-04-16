<?php
/* this is the copy pase read example */
require_once 'vendor/autoload.php';



$objReader= \PhpOffice\PhpWord\IOFactory::createReader('Word2007');


$contents=$objReader->load("helloWorld.docx");

$objWriter= \PhpOffice\PhpWord\IOFactory::createWriter($contents,'Word2007');
$objWriter->save("new.docx");


?>
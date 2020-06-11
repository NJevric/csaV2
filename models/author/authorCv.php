



<?php

require_once("../../config/connection.php");
require_once("../../vendor/autoload.php");


// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();


// Adding an empty Section to the document...
$section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...


$handle = fopen(LOG_FAJL, "r");



$section->addText(
    
    fread($handle, filesize(AUTOR_FAJL))
    

);

fclose($handle);




 header("Content-Type: application/msword");
 header("Content-Disposition: attachment;Filename = author_cv.doc");


// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "Word2007" );
$objWriter->save("php://output");

//Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// // Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');
// }
/* Note: any element you append to a document must reside inside of a Section. */




?>
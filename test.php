<?php

$pdfFilename = 'IDAHO_2579977_Published Opinion.request.pdf';

 $cmd = 'C:\\xampp\\htdocs\\primoTHUCL\\QPDF\\pdfinfo.exe "C:\\XAMPP\\htdocs\\primoTHUCL\\uploadfiles\\SourceFiles\\'.$pdfFilename.'"';


$output = shell_exec($cmd);
$A1= explode("Pages:",$output);
$A2= explode("\n",$A1[1]);

echo $A2[0];
?>
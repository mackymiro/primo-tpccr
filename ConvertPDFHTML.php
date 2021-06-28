
<?php

session_start();
$JobId= $_SESSION['JobID'];
$filename=$_POST['data'];



$pdf_file =  "C:\\xampp\\htdocs\\primoIdeagen_v2.0\\uploadfiles\\".$JobId."\\".pathinfo($filename, PATHINFO_FILENAME).".pdf";
$html_dir =  "C:\\xampp\\htdocs\\primoIdeagen_v2.0\\uploadfiles\\".$JobId."\\".pathinfo($filename, PATHINFO_FILENAME).".html";
//$cmd = "pdftotext $pdf_file $html_dir";

$cmd = "mutool convert -o $html_dir $pdf_file";
exec($cmd, $out, $ret);

echo '<a href="uploadfiles/'.$JobId.'/'.pathinfo($filename, PATHINFO_FILENAME).'.html" target="_blank"><i class="fa fa-gear"></i>View HTML</a>';

?>
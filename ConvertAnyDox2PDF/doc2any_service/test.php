<?php

error_reporting(E_ALL);

if(function_exists('exec'))
  echo "exec is enabled.<br>";
else
	echo "exec is disabled.<br>";

$cmd = '"C:\\VeryPDF\\doc2any_cmd\\doc2any_service\\docPrint_client.exe"';
$cmd = $cmd . ' wait ';
$cmd = $cmd . ' "C:\\VeryPDF\\doc2any_cmd\\doc2any.exe" -$ XXXXXXXXXXXXXXXXXX "C:\\xampp\\htdocs\\d2m\\archivos\\example.doc" "C:\\xampp\\htdocs\\d2m\\archivos\\example2.pdf"';

echo $cmd . "<br>";
exec($cmd, $output, $return);
echo "The command returned $return, and output:\\n";
echo "<br><pre>";
echo "<pre>";
var_dump($output);
echo "</pre>";
exit;

?>
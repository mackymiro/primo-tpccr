<?php
$post_data = $_POST['data'];
$filename= $_POST['Filename'];

$filename = pathinfo(basename($filename), PATHINFO_FILENAME).".txt";
$dir = 'uploadfiles';
file_put_contents($dir."/ForConversion/".$filename, $post_data);

 $cmd = 'C:\\xampp\\htdocs\\primoTHUCL\\ParaSequencer\\ParaSequencer.exe "C:\\xampp\\htdocs\\primoTHUCL\\uploadfiles\\ForConversion\\'.$filename .'"';

exec($cmd, $out, $ret);
 
echo file_get_contents($dir."/ForConversion/".$filename);
unlink($dir."/ForConversion/".$filename);
?>
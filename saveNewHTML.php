<?php
//error_reporting(E_ALL);
// error_reporting(0);
//var_dump($_SERVER);
session_start();
$post_data = $_POST['data'];
 
$filename=$_POST['Filename'];
$JobID=$_SESSION['JobID'];
 
$info = pathinfo($filename);
 
$nFilename ="uploadfiles/".$JobID."/".$info["filename"].".wrt";
 
 
if (!empty($post_data)) {
    $xml = utf8_decode($post_data);
    // unlink ($dir."/". $nFile);
    file_put_contents($nFilename,$xml );
    // echo $nFilename;
    echo "File successfully saved.";
    //echo $nfile;
}
?>
<?php
 
$post_data = trim($_POST['data']);
 
$sFile= preg_replace('/(<regtext )(part=")([\w]+)(" title=")([\w]+)(">)/', '<h2>Title:$5</h2> <h3>Part: $3</h3>', $post_data) ;

$sFile = str_replace("&acirc;&euro;&oelig;", "", $sFile );
$sFile = str_replace("&acirc;&euro;￾, &acirc;&euro;&oelig;", " ", $sFile );
$sFile = str_replace("&acirc;&euro;￾", "", $sFile );
$sFile = str_replace("&acirc;&euro;&oelig;", "", $sFile );
$sFile = str_replace("&acirc;&euro;￾", "", $sFile );
// $sFile = str_replace("&acirc;&euro;&oelig;", "", $sFile );
echo $sFile;
 
?>



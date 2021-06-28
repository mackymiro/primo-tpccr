<?php
 
$post_data = trim($_POST['data']);
 
$sFile= preg_replace('/(<regtext )(part=")([\w]+)(" title=")([\w]+)(">)/', '<br>Title:<b>$5</b><br> Part: <b>$3</b><br>', $post_data) ;
echo $sFile;
 
?>



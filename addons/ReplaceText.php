<?php
 
$post_data = trim($_POST['data']);
$s1= explode("|||", $post_data);

$sFile= str_replace($s1[1], $s1[2], $s1[0]) ;
echo $sFile;
 
?>



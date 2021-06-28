<?php
 
$post_data = trim($_POST['data']);
$s1= explode("|||", $post_data);
$s1[1]= str_replace("[HRT]", '\n', $s1[1]);

$s1[2]= str_replace("[HRT]", '\n', $s1[2]);
$sFile= str_replace($s1[1], $s1[2], $s1[0]) ;
echo $sFile;
 
?>



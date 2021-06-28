<?php
	set_time_limit(0);
	$sTEXT = $_POST["editor1"];
	$fileVal = $_POST["fileVal"];
	unlink("../uploadfiles/$fileVal");
	file_put_contents("../uploadfiles/Transform/$fileVal", $sTEXT);
	$fileVal1=str_replace(".xml",".htm",$fileVal);
	file_put_contents("../uploadfiles/$fileVal1", $sTEXT);
	//$fileVal1=str_replace(".htm",".xml",$fileVal);
	while( !file_exists("../uploadfiles/$fileVal" ) )
{
 
}
	 sleep(3);
	

	$fullscr=$_POST['fullscr'];
	
	if ($fullscr==1){
		header("Location:https://10.160.0.88/primoDataForAI/fullscr.php"); 
	}
	else{
		header("Location:https://10.160.0.88/primoDataForAI/index.php"); 
	}primoDataForAI
?>
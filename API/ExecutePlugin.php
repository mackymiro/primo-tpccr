<?php
	
	$sTEXT = $_POST["editor2"];
	$fileVal = $_POST["fileVal"];
	$plugin =$_POST["Plugin"];
	$fullscr=$_POST['fullscr'];
	unlink("../uploadfiles/Plugin/Styling/".$plugin."/input/$fileVal");
	unlink("../uploadfiles/Plugin/Styling/".$plugin."/output/$fileVal");
	file_put_contents("../uploadfiles/Plugin/Styling/".$plugin."/input/$fileVal", $sTEXT);
	
	//$fileVal1=str_replace(".htm",".xml",$fileVal);
	while( !file_exists("../uploadfiles/Plugin/Styling/".$plugin."/output/$fileVal" ) )
	{
	}
	copy ("../uploadfiles/Plugin/Styling/".$plugin."/output/$fileVal","../uploadfiles/$fileVal");
	unlink("../uploadfiles/Plugin/Styling/".$plugin."/output/$fileVal");
	sleep(3);



	
if ($fullscr==1){
 header("Location:https://10.160.0.88/primoDataForAI/fullscr.php"); 

}
else{
header("Location:https://10.160.0.88/primoDataForAI/index.php"); 

}

?>
 
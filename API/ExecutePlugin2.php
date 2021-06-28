<?php
	
	$sTEXT = $_POST["editor2"];
	$fileVal = $_POST["fileVal"];
	$plugin =$_POST["Plugin"];
	$fullscr=$_POST['fullscr'];
	unlink("../uploadfiles/Plugin/XMLEditor/".$plugin."/input/$fileVal");
	unlink("../uploadfiles/Plugin/XMLEditor/".$plugin."/output/$fileVal");
	file_put_contents("../uploadfiles/Plugin/XMLEditor/".$plugin."/input/$fileVal", $sTEXT);
	
	//$fileVal1=str_replace(".htm",".xml",$fileVal);
	while( !file_exists("../uploadfiles/Plugin/XMLEditor/".$plugin."/output/$fileVal" ) )
	{
	}
	copy ("../uploadfiles/Plugin/XMLEditor/".$plugin."/output/$fileVal","../uploadfiles/$fileVal");
	unlink("../uploadfiles/Plugin/XMLEditor/".$plugin."/output/$fileVal");
	sleep(3);
	
	
if ($fullscr==1){
 header("Location:https://10.160.0.88/primoDataForAI/fullscr.php"); 

}
else{
header("Location:https://10.160.0.88/primoDataForAI/index.php"); 

}
?>

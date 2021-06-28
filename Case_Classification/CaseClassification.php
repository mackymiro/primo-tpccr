<?php
include "../conn.php";

session_start();

	$Task=$_SESSION['Task'];
	$BatchID=$_SESSION['BatchID'];


	 ini_set('max_execution_time', 300); 
	$fileURL = $_GET['FileURL'];
	$file = $_GET['FileName'];
	$sFileVal =explode('.',$file);
	$sfile	=  $sFileVal[0] ;
	$RedirectURL=$_GET['RedirectURL'];

	copy($fileURL, "$sfile.txt");	

 
 
	
	
	$txtFile= file_get_contents("$sfile.txt");
	 
	$keywordVal="";
	
	$Casefile = fopen("Case.tbl","r");

	while(! feof($Casefile))
	  {
	  
		$keyword=fgets($Casefile);
		$Subject= explode("\t", $keyword);
		$pos = strrpos(strtolower($txtFile), strtolower(trim($Subject[1])));
		//echo $Subject[0]."|||".$Subject[1]."|||".$pos."<BR>";
		if ($pos!==false){
			$posVal = strrpos(strtolower($keywordVal), strtolower(trim($Subject[0])));
			if ($posVal===false){
				$keywordVal=$keywordVal.$Subject[0]."\r\n";
			}
		}
	  
	  }
	file_put_contents("$sfile.cls", $keywordVal);
	copy("$file.cls",str_replace(".html",".cls",$fileURL) );	
		
	if (!unlink("$sfile.txt"))
	{
		 
	}
	else
	{
	 
	}
	
	$prSQL ="DELETE from tblStatus Where Jobname='$BatchID' AND Process='$Task' AND MLName='Text Categorization'";
	ExecuteQuery($prSQL,$con);

	$prSQL ="INSERT INTO tblStatus (Jobname,Process,MLName) VALUES ('$BatchID','$Task','Text Categorization')";
	ExecuteQuery($prSQL,$con);

	//unlink("$file.cls");
	  header("Location:".$RedirectURL); 	

	//file_put_contents("$sfile.cls", $keywordVal);
  	
?>


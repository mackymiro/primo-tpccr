<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Config.php');
require_once(__ROOT__.'/conn.php');

$form =  $_POST['form'];




$PDFname =  $_POST['PDFname'];
$Ref =  $_POST['Ref'];




$inventory_id =  $_POST['inventory_id'];
$outlook_id =  $_POST['outlook_id'];
$ProcessType = $_POST['ProcessType'];





$pages = array();
$sgm = array();
$imageedit = array();
foreach($form as $page)
{
	$pages[$page['group']]= $page['page'];
	$sgm[$page['group']]= $page['sgm'];
	$imageedit[$page['group']]= $page['checkbox'];
}




foreach($pages as $startPage => $endPage)
{
	$pageCat = "cat ".$startPage."-".$endPage;
	

	
	$File_Name = pathinfo($PDFname,PATHINFO_FILENAME);
	$File_Extension = pathinfo($PDFname,PATHINFO_EXTENSION);
	
	$NewNAME = $File_Name."_".$startPage."-".$endPage.".".$File_Extension;
	  
	  

	$INPUT 	= '"'. $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\".$folderName."\\".$Ref."\\".$File_Name.".".$File_Extension .'"';
	$OUTPUT = '"'. $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\".$folderName."\\".$Ref."\\".$NewNAME .'"';
	$exeute = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\pdfSplitter\\pdftk.exe {$INPUT} {$pageCat} output {$OUTPUT}";
	
	$finalname =  $sgm[$startPage];
	
	
	if($imageedit[$startPage] == "true")
	{
		
		 $withImageEdit = 1;
		
	}
	else
	{		
		 $withImageEdit = 0;	
	}
	
	

	exec($exeute, $out, $ret);
	

	
	$SQLinsert = "INSERT INTO TPCCR_DOCUMENT_SEG (RefId,DocFilename,FinalFilename,NumberOfPages,ByteSize,DateRegistered,status,ProcessType,WithImageEdit) VALUES ('".$outlook_id."', '".$NewNAME."', '".$finalname."', '' , '' , '".date('Y-m-d H:i:s')."', 'forposting','".$ProcessType."','".$withImageEdit."')";
	$res=odbc_exec($conWMS,$SQLinsert);
	
	
}


$sql1 = "UPDATE  TPCCR_INVENTORY  SET status = 'done_segregated' where RefId = {$outlook_id} AND  Id = {$inventory_id} ";
odbc_exec($conWMS,$sql1);	

echo  "DONE";

?>
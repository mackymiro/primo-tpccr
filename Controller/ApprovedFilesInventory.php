<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Config.php');
require_once(__ROOT__.'/conn.php');

    
ini_set('max_execution_time', 0);


$Ref =  $_POST['Ref'];
$RefId =  $_POST['RefId'];




$sql = "SELECT * FROM TPCCR_INVENTORY where RefId =".$RefId;
$res=odbc_exec($conWMS,$sql);	

$data = array();
while ($dataGroup = odbc_fetch_array($res)) {
		
	if(empty($dataGroup['ProductType'])) 
	{
		echo "EMPTY";
		exit;
	}
	
	if(!empty($dataGroup['ProductType']) &&  $dataGroup['ProductType'] != "Inventory" && $dataGroup['ProductType'] != "Specs" ) {
		$data[] =  $dataGroup;
	}
}




foreach($data as $val)
{
	
	
	
	$File_Name = pathinfo($val['DocFilename'],PATHINFO_FILENAME);
	$File_Extension = pathinfo($val['DocFilename'],PATHINFO_EXTENSION);

	$doc_dir 	= '"'. $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\".$folderName."\\".$Ref."\\".$File_Name.".".$File_Extension .'"';
	$outdirFile = '"'. $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\".$folderName."\\".$Ref .'"';
	
	
	$exeute     = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\LibreOffice\\program\\soffice.exe --headless  -convert-to pdf  ".  $doc_dir  ." -outdir ". $outdirFile;
	exec($exeute, $out, $ret);
	


	
	
	//CONVERT PDF AND DOC SEGRAGETE
	if($val['WithDocSegregate'] == "Yes" )
	{
		withDocSegragete($val,$Ref,$RefId);
	}
	else if($val['WithDocSegregate'] == "No" )
	{
		
		forPosting($val,$Ref,$RefId);
		
	}
	

}


function withDocSegragete($val,$Ref,$RefId)
{
	include('../Config.php');
	
	$sql = "UPDATE  TPCCR_INVENTORY  SET remarks = 'converted' , status = 'forsegregate'   where Id =".$val['Id'];
	$res=odbc_exec($conWMS,$sql);
	
}


function forPosting($val,$Ref,$RefId)
{
	include('../Config.php');
	
	$sql = "UPDATE  TPCCR_INVENTORY  SET status = 'forPosting'  where Id =".$val['Id'];
	$res=odbc_exec($conWMS,$sql);
	
}



$sql = "UPDATE  tbl_tpccr_outlook_files  SET status = 'Approved'  where Id =".$RefId;
$res=odbc_exec($conWMS,$sql);

echo "DONE";



?>
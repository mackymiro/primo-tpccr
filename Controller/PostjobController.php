<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Config.php');
require_once(__ROOT__.'/conn.php');



$Id =  $_POST['Id'];
$RefId =  $_POST['RefId'];
$ProcessType =  $_POST['ProcessType'];
$WithImageEdit =  $_POST['WithImageEdit'];



$sql =  "SELECT seg.DocFilename,outlook.Ref FROM TPCCR_DOCUMENT_SEG seg LEFT JOIN tbl_tpccr_outlook_files outlook ON outlook.Id = seg.RefId  where seg.RefId = {$RefId} AND seg.Id = {$Id}
		 UNION ALL 
		SELECT inv.DocFilename,outlook.Ref FROM TPCCR_INVENTORY inv LEFT JOIN tbl_tpccr_outlook_files outlook ON outlook.Id = inv.RefId  where inv.RefId = {$RefId} AND inv.Id = {$Id}";
$res=odbc_exec($conWMS,$sql);	
$data = odbc_fetch_array($res);


$getfilename = ($data['DocFilename']);


 $File_Name = pathinfo($getfilename,PATHINFO_FILENAME);
 $File_Extension = pathinfo($getfilename,PATHINFO_EXTENSION);

if($File_Extension != "PDF" || $File_Extension != "pdf")
{
	$filename =  $File_Name.'.pdf';
}
else
{
	$filename = $getfilename ;
}

 


$sqls="EXEC USP_PRIMO_INTEGRATE @Filename='".$filename."',@ProcessType='".$ProcessType."',@WithImageEdit='".$WithImageEdit."',@Jobid='' ";
ExecuteQuerySQLSERVER ($sqls,$conWMS);



$RefId_PRIMO = GetWMSValue("Select RefId From PRIMO_Integration WHERE Filename='".$filename."'","RefId",$conWMS);


$Createdirectory = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName.'\\uploadfiles\\'.$RefId_PRIMO;
if (!file_exists($Createdirectory)){
	mkdir($Createdirectory, 0777, true);
}

$SOURCE_FILE  = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\".$folderName."\\".$data['Ref']."\\".$filename;
$DESTINATION  = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName.'\\uploadfiles\\'.$RefId_PRIMO.'\\'.$filename; 
copy($SOURCE_FILE,$DESTINATION);



	
$sql1 = "UPDATE  TPCCR_INVENTORY  SET status = 'posted' where RefId = {$RefId} AND  Id = {$Id} ";
odbc_exec($conWMS,$sql1);	

$sql2 = "UPDATE  TPCCR_DOCUMENT_SEG  SET status = 'posted' where RefId = {$RefId} AND  Id = {$Id} ";
odbc_exec($conWMS,$sql2);	






echo "DONE";
?>
<?php
// error_reporting(0);
include "conn.php";

$ParamVal=$_POST['data'];

$sFileVal =explode('@@@',$ParamVal);

$BatchID=$sFileVal[0];
$strUser=$sFileVal[1];

$isonRework = GetWMSValue("Select * from PRIMO_Integration Where Filename='$BatchID' AND Status='Rework'","Status",$conWMS);

if($isonRework==''){
	
	$sqls="Update PRIMO_Integration SET ReworkBy='$strUser',Status='Rework',ReworkStatus='Assigned' Where Filename='$BatchID'"; 
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
}

 
?>
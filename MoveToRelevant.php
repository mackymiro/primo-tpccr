<?php
 
  include ("conn.php");
  // error_reporting(0);
  session_start();
   
 	$BatchID = trim($_POST['data']);
 	$JobID = trim($_POST['JobID']);
 	 
  	
	$sqls="Update primo_Integration SET QCStatus='VERIFIED',Relevancy='Relevant' WHere JobId='".$JobID."'";
	ExecuteQuerySQLSERVER ($sqls,$conWMS);


	$UserName=$_SESSION['login_user'];
	

	$UserID=$_SESSION[UserID];

	$sql="SELECT  * from wms_view_HoldTasks Where BatchID='$BatchID'";
	$objExec= odbc_exec($conWMS,$sql);
 
  
   while ($row = odbc_fetch_array($objExec)) 
    {
      $HoldRefId=$row['HoldRefId'];
  	}


 	
	$sqls="Exec usp_wms_unholdtask @HoldRefId=".$HoldRefId.", @AllocateToLoginName=".$UserName.", @Mode=2, @UserId=".$UserID.", @responseRemarks='Unhold'";
	ExecuteQuerySQLSERVER ($sqls,$conWMS);


	$sqls="EXEC usp_PRIMO_STARTBATCH @BatchId=".$BatchID;
	 
	ExecuteQuerySQLSERVER ($sqls,$conWMS);

	$sqls="EXEC USP_PRIMO_DONEBATCH @BatchId=".$BatchID;
	 
	ExecuteQuerySQLSERVER ($sqls,$conWMS);

 

?>
 
<?php
  include ("conn.php");
   error_reporting(0);
   session_start();

	$BatchID=$_POST['BatchID'];
	$UserName=$_POST['UserName'];
	

	$UserID=$_SESSION[UserID];

	$sql="SELECT  * from wms_view_HoldTasks Where BatchID='$BatchID'";
	$objExec= odbc_exec($conWMS,$sql);
 
  
   while ($row = odbc_fetch_array($objExec)) 
    {
      $HoldRefId=$row['HoldRefId'];
  	}


 	
	$sqls="Exec usp_wms_unholdtask @HoldRefId=".$HoldRefId.", @AllocateToLoginName=".$UserName.", @Mode=2, @UserId=".$UserID.", @responseRemarks='Unhold'";
	
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
 
?>
 

 <script language="javascript">
	window.location = "TrackingReport.php";
</script>
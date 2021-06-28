<?php
 
  include ("conn.php");
  // error_reporting(0);
  session_start();
   
 
	$BatchID=$_POST['BatchID'];

	$UserID=$_POST['UserName'];
 	$sqls="EXEC usp_wms_Allocate_RemoveAllocation @BatchID=".$BatchID;		  
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
 
	$sqls="EXEC usp_wms_Allocate_BatchToUser @BatchID=".$BatchID.", @UserID=".$UserID;
  
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
 

?>

<script language="javascript">
	window.location = "TrackingReport.php";
</script>
 
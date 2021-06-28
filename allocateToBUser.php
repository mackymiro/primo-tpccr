<?php
 
  include ("conn.php");
  // error_reporting(0);
  session_start();
   
 	$post_data = trim($_POST['data']);
 	$sVal= explode("@@@", $post_data);

	// $BatchID=$_POST['BatchID'];

	// $UserID=$_POST['UserName'];
 
	$BatchID=$sVal[0];

	$UserID=$sVal[1];
  	
  	$sqls="EXEC usp_wms_Allocate_RemoveAllocation @BatchID=".$BatchID;		  
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
	 	
	$sqls="EXEC usp_wms_Allocate_BatchToUser @BatchID=".$BatchID.", @UserID=".$UserID;
    
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
 

?>
<!-- 
<script language="javascript">
	window.location = "TrackingReport.php";
</script>
  -->
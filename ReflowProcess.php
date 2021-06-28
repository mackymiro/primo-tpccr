<?php
  include ("conn.php");
 //  error_reporting(0);
    session_start();

    $BatchName=$_POST['BatchName'];
    $RuleName=$_POST['RuleName'];


	$sqls="EXEC usp_wms_UTILITIES_PerformReprocessRules @WorkflowName='PRIMO Workflow2', @RuleName='".$RuleName."', @Batchname='".$BatchName."',@UserId=".$_SESSION['UserID'].",@Remarks='Reflow'";
	  // echo $sqls;
	ExecuteQuerySQLSERVER ($sqls,$conWMS);

	
?>
 
 

<script language="javascript">
	window.location = "TrackingReport.php?page=COMMENTARY&WorkFlowID=1";
</script>
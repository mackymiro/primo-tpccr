<?php
  include ("conn.php");
 //  error_reporting(0);
    session_start();

    // $BatchName=$_POST['BatchName'];
    $RuleName=$_POST['RuleName'];
    $sBatchID=$_POST['BatchID'];
    $categories = '';
	$cats = explode("|",$sBatchID);
	foreach($cats as $cat) {
	    $cat = trim($cat);
	    if ($cat!=''){
	    	$BatchName= GetWMSValue("Select BatchName from wms_JobsBatchInfo Where BatchId='".$cat."'","BatchName",$conWMS);
			$sqls="EXEC usp_wms_UTILITIES_PerformReprocessRules @WorkflowName='PRIMO Workflow2', @RuleName='".$RuleName."', @Batchname='".$BatchName."',@UserId=".$_SESSION['UserID'].",@Remarks='Reflow'";
			 
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

			$BatchID=$cat;

			$UserID=$_POST['UserName'];
		 
		 
			$sqls="EXEC usp_wms_Allocate_BatchToUser @BatchID=".$BatchID.", @UserID=".$UserID;
		  
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

	    }
	}


	
?>
 
 
<!-- 
<script language="javascript">
	window.location = "TrackingReport.php?page=COMMENTARY&WorkFlowID=1";
</script> -->
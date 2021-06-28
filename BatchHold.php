<?php
  include ("conn.php");
  session_start();
   // error_reporting(0);
   
	$BatchID=$_POST['data'];
	 


	$cats = explode("|",$BatchID);
	foreach($cats as $cat) {
		$cat = trim($cat);
		if ($cat!=''){
			$sqls="EXEC usp_wms_Allocate_RemoveAllocation @BatchID=".$cat;		  
			ExecuteQuerySQLSERVER ($sqls,$conWMS);
 
			$sqls="EXEC usp_wms_Allocate_BatchToUser @BatchID=".$cat.", @UserID=".$_SESSION['UserID'];
		  
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

			$sqls="EXEC USP_PRIMO_STARTBATCH @BatchId=".$cat;
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

			$sqls="EXEC USP_PRIMO_HOLDBATCH @BatchId=".$cat;
			ExecuteQuerySQLSERVER ($sqls,$conWMS);

				$JobID=GetWMSValue("Select JobID from primo_view_Jobs Where BatchID='$cat'","JobID",$conWMS);

				ExecuteQuerySQLSERVER ("Update PRIMO_Integration SET HoldRemarks='Hold by Admin' Where JobID='$JobID'",$conWMS);

		}
		

	}
	 
?>
 
 
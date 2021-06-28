<?php
  include ("conn.php");
   error_reporting(0);
   
	$BatchID=$_POST['BatchID3'];
	$Remarks=$_POST['Remarks'];
	$Remarks= str_replace("'","''", $Remarks);
	$sqls="EXEC USP_PRIMO_HOLDBATCH @BatchId=".$BatchID;
	 
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
	
	$fullscr=$_POST['fullscr'];
	
	if ($fullscr==1){
		$page="fullscr.php";
	}
	else{
		$page="index.php";
	}

	$JobID=GetWMSValue("Select * from primo_view_Jobs Where BatchID='$BatchID'","JobID",$conWMS);

	ExecuteQuerySQLSERVER ("Update PRIMO_Integration SET HoldRemarks='$Remarks' Where JobID='$JobID'",$conWMS);

?>
 


<script language="javascript">
	window.location = "<?= $page;?>";
</script>
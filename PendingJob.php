<?php
  include ("conn.php");
   error_reporting(0);
   
	$BatchID=$_POST['data'];
	$sqls="EXEC USP_PRIMO_PENDINGBATCH @BatchId=".$BatchID;
	 
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
   $fullscr=$_POST['fullscr'];
	
	if ($fullscr==1){
		$page="fullscr.php";
	}
	else{
		$page="index.php";
	}
?>
 


<script language="javascript">
	window.location = "<?php echo $page;?>";
</script>
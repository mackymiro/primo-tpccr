<?php
	//error_reporting(0);
	session_start();
  	require_once "conn.php";
 
	$Task=$_GET['Task'];
	$page=$_GET['page'];
	//$fullscr=$_GET['fullscr'];
	$WorkFlowID=2;
	 
	$sqls="EXEC usp_PRIMO_AUTOALLOCATE  @UserName='".$_SESSION['login_user']."', @ProcessCode='".$Task."',@WorkflowId='".$WorkFlowID."'";
	  
	ExecuteQuerySQLSERVER($sqls,$conWMS);
	
	$sql="SELECT * FROM primo_view_Jobs Where ProcessCode='$Task' AND statusstring in('Allocated','Pending','Ongoing', 'New') AND AssignedTo='$_SESSION[login_user]'";	
	

	$rs=odbc_exec($conWMS,$sql);
	$ctr = odbc_num_rows($rs);

	
	//echo $sql;
	
	while(odbc_fetch_row($rs))
	{	
		$sFilename=odbc_result($rs,"Filename");
		$filename="uploadfiles/".odbc_result($rs,"Filename");
		$Batchname=odbc_result($rs,"BatchId");
		$snFilename ="uploadfiles/".odbc_result($rs,"JobId")."/".odbc_result($rs,"Filename");
	}

	
	if($sFilename == ''){
		header("Location:no-file-found.php");
	}else{
		ExecuteQuerySQLSERVER ("Update primo_Integration SET Status='".$Task."' Where Filename='".$sFilename."'",$conWMS);
	}

	if ($Task=='CONTENTREVIEW'){
		if (file_exists($snFilename)){
			$sHTML = file_get_contents($snFilename);
			$sHTML =str_replace("<link ", "<pre ", $sHTML);
			$sHTML =str_replace("</link>", "</pre>", $sHTML);
			$sHTML =str_replace("<script", "<pre", $sHTML);
			$sHTML =str_replace("</script>", "</pre>", $sHTML);
			file_put_contents($snFilename, $sHTML);
		}
		
	}

	if ($Task=='WRITING'||$Task=='WRITINGQC'||$Task=='FINALREVIEW'){
		$fullscr=1;

	}

  //if ($fullscr==1){
?>

<!--<script language="javascript">
	window.location = "fullscr.php?file=<?= $filename;?>&BatchID=<?= $Batchname;?>&Task=<?= $Task;?>";
</script> -->
<?php
//}
//else{
?>

<script language="javascript">
	window.location = "index.php?page=Enrich&file=<?= $filename;?>&BatchID=<?= $Batchname;?>&Task=<?= $Task;?>";
</script>

<?php
//}

?>
 


<?php
  include ("conn.php");
   error_reporting(0);
   session_start();

	$BatchID=$_POST['BatchID'];
	$UserID=$_SESSION[UserID];

	$sqls="Update PRIMO_Integration SET Status='Styling' WHERE Filename='$BatchID'";
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
 
?>
 

 <script language="javascript">
	window.location = "QAReport.php";
</script>
<?php
 
  include ("conn.php");
  // error_reporting(0);
  session_start();
   
 	$post_data = trim($_POST['data']);
 	$JobID = trim($_POST['JobID']);
 	 
  
	$sqls="Update primo_Integration SET QCStatus='VERIFIED' WHere JobId='".$JobID."'";
  
	ExecuteQuerySQLSERVER ($sqls,$conWMS);

?>
 
<?php
 
  include ("conn.php");
  // error_reporting(0);
  session_start();
   
 	$post_data = trim($_POST['data']);
 	 
  
	$sqls="EXEC usp_PRIMO_DELETEJOB @JobId=".$post_data;
  
	ExecuteQuerySQLSERVER ($sqls,$conWMS);
 

?>
 
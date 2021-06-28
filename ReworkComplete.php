<?php
// error_reporting(0);
include "conn.php";

$BatchID=$_POST['data'];


$sqls="Update PRIMO_Integration SET ReworkStatus='Completed' Where Filename='$BatchID'"; 
ExecuteQuerySQLSERVER ($sqls,$conWMS);
echo $sqls;
 
?>